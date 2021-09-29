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

class StatsBestVouchers extends StatsModule
{
    protected $type = 'Grid';
    protected $html;
    protected $query;
    protected $columns;
    protected $default_sort_column;
    protected $default_sort_direction;
    protected $empty_message;
    protected $paging_message;

    public function __construct()
    {
        $this->name = 'statsbestvouchers';
        $this->tab = 'analytics_stats';
        $this->version = '2.0.0';
        $this->author = 'thirty bees';
        $this->need_instance = 0;

        parent::__construct();

        $this->default_sort_column = 'ca';
        $this->default_sort_direction = 'DESC';
        $this->empty_message = Translate::getModuleTranslation('statsmodule', 'Empty recordset returned.', 'statsmodule');
        $this->paging_message = sprintf(Translate::getModuleTranslation('statsmodule', 'Displaying %1$s of %2$s', 'statsmodule'), '{0} - {1}', '{2}');

        $this->columns = array(
            array(
                'id'        => 'code',
                'header'    => Translate::getModuleTranslation('statsmodule', 'Code', 'statsmodule'),
                'dataIndex' => 'code',
                'align'     => 'left',
            ),
            array(
                'id'        => 'name',
                'header'    => Translate::getModuleTranslation('statsmodule', 'Name', 'statsmodule'),
                'dataIndex' => 'name',
                'align'     => 'left',
            ),
            array(
                'id'        => 'ca',
                'header'    => Translate::getModuleTranslation('statsmodule', 'Sales', 'statsmodule'),
                'dataIndex' => 'ca',
                'align'     => 'right',
            ),
            array(
                'id'        => 'total',
                'header'    => Translate::getModuleTranslation('statsmodule', 'Total used', 'statsmodule'),
                'dataIndex' => 'total',
                'align'     => 'center',
            ),
        );

        $this->displayName = Translate::getModuleTranslation('statsmodule', 'Best vouchers', 'statsmodule');
        $this->description = Translate::getModuleTranslation('statsmodule', 'Adds a list of the best vouchers to the Stats dashboard.', 'statsmodule');
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

        $this->html = '
			<div class="panel-heading">
				'.$this->displayName.'
			</div>
			'.$this->engine($this->type, $engine_params).'
			<a class="btn btn-default export-csv" href="'.Tools::safeOutput($_SERVER['REQUEST_URI'].'&export=1').'">
				<i class="icon-cloud-upload"></i> '.Translate::getModuleTranslation('statsmodule', 'CSV Export', 'statsmodule').'
			</a>';

        return $this->html;
    }

    public function getData($layers = null)
    {
        $currency = new Currency(Configuration::get('PS_CURRENCY_DEFAULT'));
        $this->query = 'SELECT SQL_CALC_FOUND_ROWS cr.code, ocr.name, COUNT(ocr.id_cart_rule) AS total, ROUND(SUM(o.total_paid_real) / o.conversion_rate,2) AS ca
				FROM '._DB_PREFIX_.'order_cart_rule ocr
				LEFT JOIN '._DB_PREFIX_.'orders o ON o.id_order = ocr.id_order
				LEFT JOIN '._DB_PREFIX_.'cart_rule cr ON cr.id_cart_rule = ocr.id_cart_rule
				WHERE o.valid = 1
					'.Shop::addSqlRestriction(Shop::SHARE_ORDER, 'o').'
					AND o.invoice_date BETWEEN '.$this->getDate().'
				GROUP BY ocr.id_cart_rule';

        if (Validate::IsName($this->_sort)) {
            $this->query .= ' ORDER BY `'.bqSQL($this->_sort).'`';
            if (isset($this->_direction) && (Tools::strtoupper($this->_direction) == 'ASC' || Tools::strtoupper($this->_direction) == 'DESC'))
                $this->query .= ' '.pSQL($this->_direction);
        }

        if (($this->_start === 0 || Validate::IsUnsignedInt($this->_start)) && Validate::IsUnsignedInt($this->_limit))
            $this->query .= ' LIMIT '.(int) $this->_start.', '.(int) $this->_limit;

        $values = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($this->query);
        foreach ($values as &$value)
            $value['ca'] = Tools::displayPrice($value['ca'], $currency);

        $this->_values = $values;
        $this->_totalCount = Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue('SELECT FOUND_ROWS()');
    }
}
