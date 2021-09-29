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

class StatsBestSuppliers extends StatsModule
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
        $this->name = 'statsbestsuppliers';
        $this->tab = 'analytics_stats';
        $this->version = '2.0.0';
        $this->author = 'thirty bees';
        $this->need_instance = 0;

        parent::__construct();

        $this->default_sort_column = 'sales';
        $this->default_sort_direction = 'DESC';
        $this->empty_message = Translate::getModuleTranslation('statsmodule', 'Empty record set returned', 'statsmodule');
        $this->paging_message = sprintf(Translate::getModuleTranslation('statsmodule', 'Displaying %1$s of %2$s', 'statsmodule'), '{0} - {1}', '{2}');

        $this->columns = array(
            array(
                'id'        => 'name',
                'header'    => Translate::getModuleTranslation('statsmodule', 'Name', 'statsmodule'),
                'dataIndex' => 'name',
                'align'     => 'center',
            ),
            array(
                'id'        => 'quantity',
                'header'    => Translate::getModuleTranslation('statsmodule', 'Quantity sold', 'statsmodule'),
                'dataIndex' => 'quantity',
                'align'     => 'center',
            ),
            array(
                'id'        => 'sales',
                'header'    => Translate::getModuleTranslation('statsmodule', 'Total paid', 'statsmodule'),
                'dataIndex' => 'sales',
                'align'     => 'center',
            ),
        );

        $this->displayName = Translate::getModuleTranslation('statsmodule', 'Best suppliers', 'statsmodule');
        $this->description = Translate::getModuleTranslation('statsmodule', 'Adds a list of the best suppliers to the Stats dashboard.', 'statsmodule');
    }

    public function install()
    {
        return (parent::install() && $this->registerHook('AdminStatsModules'));
    }

    public function hookAdminStatsModules($params)
    {
        $engine_params = array(
            'id'                   => 'id_category',
            'title'                => $this->displayName,
            'columns'              => $this->columns,
            'defaultSortColumn'    => $this->default_sort_column,
            'defaultSortDirection' => $this->default_sort_direction,
            'emptyMessage'         => $this->empty_message,
            'pagingMessage'        => $this->paging_message,
        );

        if (Tools::getValue('export') == 1)
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

    /**
     * @return int Get total of distinct suppliers
     */
    public function getTotalCount()
    {
        $sql = 'SELECT COUNT(DISTINCT(s.id_supplier))
				FROM '._DB_PREFIX_.'order_detail od
				LEFT JOIN '._DB_PREFIX_.'product p ON p.id_product = od.product_id
				LEFT JOIN '._DB_PREFIX_.'orders o ON o.id_order = od.id_order
				LEFT JOIN '._DB_PREFIX_.'supplier s ON s.id_supplier = p.id_supplier
				WHERE o.invoice_date BETWEEN '.$this->getDate().'
					'.Shop::addSqlRestriction(Shop::SHARE_ORDER, 'o').'
					AND o.valid = 1
					AND s.id_supplier IS NOT NULL';
        return Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue($sql);
    }

    public function getData($layers = null)
    {
        $this->_totalCount = $this->getTotalCount();

        $this->query = 'SELECT s.name, SUM(od.product_quantity) AS quantity, ROUND(SUM(od.product_quantity * od.product_price) / o.conversion_rate, 2) AS sales
				FROM '._DB_PREFIX_.'order_detail od
				LEFT JOIN '._DB_PREFIX_.'product p ON p.id_product = od.product_id
				LEFT JOIN '._DB_PREFIX_.'orders o ON o.id_order = od.id_order
				LEFT JOIN '._DB_PREFIX_.'supplier s ON s.id_supplier = p.id_supplier
				WHERE o.invoice_date BETWEEN '.$this->getDate().'
					'.Shop::addSqlRestriction(Shop::SHARE_ORDER, 'o').'
					AND o.valid = 1
					AND s.id_supplier IS NOT NULL
				GROUP BY p.id_supplier';
        if (Validate::IsName($this->_sort)) {
            $this->query .= ' ORDER BY `'.$this->_sort.'`';
            if (isset($this->_direction) && Validate::isSortDirection($this->_direction))
                $this->query .= ' '.$this->_direction;
        }

        if (($this->_start === 0 || Validate::IsUnsignedInt($this->_start)) && Validate::IsUnsignedInt($this->_limit))
            $this->query .= ' LIMIT '.$this->_start.', '.($this->_limit);
        $this->_values = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($this->query);
    }
}
