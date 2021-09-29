<?php
/**
 * Copyright (C) 2017-2019 thirty bees
 * Copyright (C) 2007-2016 PrestaShop SA
 *
 * thirty bees is an extension to the PrestaShop software by PrestaShop SA.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License (AFL 3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/afl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@thirtybees.com so we can send you a copy immediately.
 *
 * @author    thirty bees <modules@thirtybees.com>
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2017-2019 thirty bees
 * @copyright 2007-2016 PrestaShop SA
 * @license   Academic Free License (AFL 3.0)
 * PrestaShop is an internationally registered trademark of PrestaShop SA.
 */

if (!defined('_TB_VERSION_')) {
    exit;
}

class StatsBestProducts extends StatsModule
{
    protected $type = 'Grid';
    protected $html = null;
    protected $query = null;
    protected $columns = null;
    protected $default_sort_column = null;
    protected $default_sort_direction = null;
    protected $empty_message = null;
    protected $paging_message = null;

    public function __construct()
    {
        $this->name = 'statsbestproducts';
        $this->tab = 'analytics_stats';
        $this->version = '2.0.0';
        $this->author = 'thirty bees';
        $this->need_instance = 0;

        parent::__construct();

        $this->default_sort_column = 'totalPriceSold';
        $this->default_sort_direction = 'DESC';
        $this->empty_message = Translate::getModuleTranslation('statsmodule', 'An empty record-set was returned.', 'statsmodule');
        $this->paging_message = sprintf(Translate::getModuleTranslation('statsmodule', 'Displaying %1$s of %2$s', 'statsmodule'), '{0} - {1}', '{2}');

        $this->columns = array(
            array(
                'id'        => 'reference',
                'header'    => Translate::getModuleTranslation('statsmodule', 'Reference', 'statsmodule'),
                'dataIndex' => 'reference',
                'align'     => 'left',
            ),
            array(
                'id'        => 'name',
                'header'    => Translate::getModuleTranslation('statsmodule', 'Name', 'statsmodule'),
                'dataIndex' => 'name',
                'align'     => 'left',
            ),
            array(
                'id'        => 'totalQuantitySold',
                'header'    => Translate::getModuleTranslation('statsmodule', 'Quantity sold', 'statsmodule'),
                'dataIndex' => 'totalQuantitySold',
                'align'     => 'center',
            ),
            array(
                'id'        => 'avgPriceSold',
                'header'    => Translate::getModuleTranslation('statsmodule', 'Price sold', 'statsmodule'),
                'dataIndex' => 'avgPriceSold',
                'align'     => 'right',
            ),
            array(
                'id'        => 'totalPriceSold',
                'header'    => Translate::getModuleTranslation('statsmodule', 'Sales', 'statsmodule'),
                'dataIndex' => 'totalPriceSold',
                'align'     => 'right',
            ),
            array(
                'id'        => 'averageQuantitySold',
                'header'    => Translate::getModuleTranslation('statsmodule', 'Quantity sold in a day', 'statsmodule'),
                'dataIndex' => 'averageQuantitySold',
                'align'     => 'center',
            ),
            array(
                'id'        => 'totalPageViewed',
                'header'    => Translate::getModuleTranslation('statsmodule', 'Page views', 'statsmodule'),
                'dataIndex' => 'totalPageViewed',
                'align'     => 'center',
            ),
            array(
                'id'        => 'quantity',
                'header'    => Translate::getModuleTranslation('statsmodule', 'Available quantity for sale', 'statsmodule'),
                'dataIndex' => 'quantity',
                'align'     => 'center',
            ),
            array(
                'id'        => 'active',
                'header'    => Translate::getModuleTranslation('statsmodule', 'Active', 'statsmodule'),
                'dataIndex' => 'active',
                'align'     => 'center',
            ),
        );

        $this->displayName = Translate::getModuleTranslation('statsmodule', 'Best-selling products', 'statsmodule');
        $this->description = Translate::getModuleTranslation('statsmodule', 'Adds a list of the best-selling products to the Stats dashboard.', 'statsmodule');
    }

    public function install()
    {
        return (parent::install() && $this->registerHook('AdminStatsModules'));
    }

    public function hookAdminStatsModules($params)
    {
        $engine_params = array(
            'id'                   => 'id_product',
            'title'                => $this->displayName,
            'columns'              => $this->columns,
            'defaultSortColumn'    => $this->default_sort_column,
            'defaultSortDirection' => $this->default_sort_direction,
            'emptyMessage'         => $this->empty_message,
            'pagingMessage'        => $this->paging_message,
        );

        if (Tools::getValue('export'))
            $this->csvExport($engine_params);

        return '<div class="panel-heading">'.$this->displayName.'</div>
		'.$this->engine($this->type, $engine_params).'
		<a class="btn btn-default export-csv" href="'.Tools::safeOutput($_SERVER['REQUEST_URI'].'&export=1').'">
			<i class="icon-cloud-upload"></i> '.Translate::getModuleTranslation('statsmodule', 'CSV Export', 'statsmodule').'
		</a>';
    }

    public function getData($layers = null)
    {
        $currency = new Currency(Configuration::get('PS_CURRENCY_DEFAULT'));
        $date_between = $this->getDate();
        $array_date_between = explode(' AND ', $date_between);

        $this->query = 'SELECT SQL_CALC_FOUND_ROWS p.reference, p.id_product, pl.name,
				ROUND(AVG(od.product_price / o.conversion_rate), 2) as avgPriceSold,
				IFNULL(stock.quantity, 0) as quantity,
				IFNULL(SUM(od.product_quantity), 0) AS totalQuantitySold,
				ROUND(IFNULL(IFNULL(SUM(od.product_quantity), 0) / (1 + LEAST(TO_DAYS('.$array_date_between[1].'), TO_DAYS(NOW())) - GREATEST(TO_DAYS('.$array_date_between[0].'), TO_DAYS(product_shop.date_add))), 0), 2) as averageQuantitySold,
				ROUND(IFNULL(SUM((od.product_price * od.product_quantity) / o.conversion_rate), 0), 2) AS totalPriceSold,
				(
					SELECT IFNULL(SUM(pv.counter), 0)
					FROM '._DB_PREFIX_.'page pa
					LEFT JOIN '._DB_PREFIX_.'page_viewed pv ON pa.id_page = pv.id_page
					LEFT JOIN '._DB_PREFIX_.'date_range dr ON pv.id_date_range = dr.id_date_range
					WHERE pa.id_object = p.id_product AND pa.id_page_type = '.(int) Page::getPageTypeByName('product').'
					AND dr.time_start BETWEEN '.$date_between.'
					AND dr.time_end BETWEEN '.$date_between.'
				) AS totalPageViewed,
				product_shop.active
				FROM '._DB_PREFIX_.'product p
				'.Shop::addSqlAssociation('product', 'p').'
				LEFT JOIN '._DB_PREFIX_.'product_lang pl ON (p.id_product = pl.id_product AND pl.id_lang = '.(int) $this->getLang().' '.Shop::addSqlRestrictionOnLang('pl').')
				LEFT JOIN '._DB_PREFIX_.'order_detail od ON od.product_id = p.id_product
				LEFT JOIN '._DB_PREFIX_.'orders o ON od.id_order = o.id_order
				'.Shop::addSqlRestriction(Shop::SHARE_ORDER, 'o').'
				'.Product::sqlStock('p', 0).'
				WHERE o.valid = 1
				AND o.invoice_date BETWEEN '.$date_between.'
				GROUP BY od.product_id';

        if (Validate::IsName($this->_sort)) {
            $this->query .= ' ORDER BY `'.bqSQL($this->_sort).'`';
            if (isset($this->_direction) && Validate::isSortDirection($this->_direction))
                $this->query .= ' '.$this->_direction;
        }

        if (($this->_start === 0 || Validate::IsUnsignedInt($this->_start)) && Validate::IsUnsignedInt($this->_limit))
            $this->query .= ' LIMIT '.(int) $this->_start.', '.(int) $this->_limit;

        $values = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($this->query);
        foreach ($values as &$value) {
            $value['avgPriceSold'] = Tools::displayPrice($value['avgPriceSold'], $currency);
            $value['totalPriceSold'] = Tools::displayPrice($value['totalPriceSold'], $currency);
        }
        unset($value);

        $this->_values = $values;
        $this->_totalCount = Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue('SELECT FOUND_ROWS()');
    }
}
