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

class StatsStock extends StatsModule
{
	protected $html = '';

	public function __construct()
	{
		$this->name = 'statsstock';
		$this->tab = 'analytics_stats';
		$this->version = '2.0.0';
		$this->author = 'thirty bees';
		$this->need_instance = 0;

		parent::__construct();

		$this->displayName = Translate::getModuleTranslation('statsmodule', 'Available quantities', 'statsmodule');
		$this->description = Translate::getModuleTranslation('statsmodule', 'Adds a tab showing the quantity of available products for sale to the Stats dashboard.', 'statsmodule');
	}

	public function install()
	{
		return parent::install() && $this->registerHook('AdminStatsModules');
	}

	public function hookAdminStatsModules()
	{
		if (Tools::isSubmit('submitCategory'))
			$this->context->cookie->statsstock_id_category = Tools::getValue('statsstock_id_category');

		$ru = AdminController::$currentIndex.'&module=statsstock&token='.Tools::getValue('token');
		$currency = new Currency(Configuration::get('PS_CURRENCY_DEFAULT'));
		$filter = ((int)$this->context->cookie->statsstock_id_category ? ' AND p.id_product IN (SELECT cp.id_product FROM '._DB_PREFIX_.'category_product cp WHERE cp.id_category = '.(int)$this->context->cookie->statsstock_id_category.')' : '');

		$sql = 'SELECT p.id_product, p.reference, pl.name,
				IFNULL((
					SELECT AVG(product_attribute_shop.wholesale_price)
					FROM '._DB_PREFIX_.'product_attribute pa
					'.Shop::addSqlAssociation('product_attribute', 'pa').'
					WHERE p.id_product = pa.id_product
					AND product_attribute_shop.wholesale_price != 0
				), product_shop.wholesale_price) as wholesale_price,
				IFNULL(stock.quantity, 0) as quantity
				FROM '._DB_PREFIX_.'product p
				'.Shop::addSqlAssociation('product', 'p').'
				INNER JOIN '._DB_PREFIX_.'product_lang pl
					ON (p.id_product = pl.id_product AND pl.id_lang = '.(int)$this->context->language->id.Shop::addSqlRestrictionOnLang('pl').')
				'.Product::sqlStock('p', 0).'
				WHERE 1 = 1
				'.$filter;
		$products = Db::getInstance()->executeS($sql);

		foreach ($products as $key => $p)
			$products[$key]['stockvalue'] = $p['wholesale_price'] * $p['quantity'];

		$this->html .= '
		<script type="text/javascript">$(\'#calendar\').slideToggle();</script>

		<div class="panel-heading">'
			.Translate::getModuleTranslation('statsmodule', 'Evaluation of available quantities for sale', 'statsmodule').
		'</div>
		<form action="'.Tools::safeOutput($ru).'" method="post" class="form-horizontal">
			<div class="row row-margin-bottom">
				<label class="control-label col-lg-3">'.Translate::getModuleTranslation('statsmodule', 'Category', 'statsmodule').'</label>
				<div class="col-lg-6">
					<select name="statsstock_id_category" onchange="this.form.submit();">
						<option value="0">- '.Translate::getModuleTranslation('statsmodule', 'All', 'statsmodule').' -</option>';
				foreach (Category::getSimpleCategories($this->context->language->id) as $category)
					$this->html .= '<option value="'.(int)$category['id_category'].'" '.
						($this->context->cookie->statsstock_id_category == $category['id_category'] ? 'selected="selected"' : '').'>'.
						$category['name'].'
					</option>';
		$this->html .= '
					</select>
					<input type="hidden" name="submitCategory" value="1" />
				</div>
			</div>
		</form>';

		if (!count($products))
			$this->html .= '<p>'.Translate::getModuleTranslation('statsmodule', 'Your catalog is empty.', 'statsmodule').'</p>';
		else
		{
			$rollup = array('quantity' => 0, 'wholesale_price' => 0, 'stockvalue' => 0);
			$this->html .= '
			<table class="table">
				<thead>
					<tr>
						<th><span class="title_box active">'.Translate::getModuleTranslation('statsmodule', 'ID', 'statsmodule').'</span></th>
						<th><span class="title_box active">'.Translate::getModuleTranslation('statsmodule', 'Ref.', 'statsmodule').'</span></th>
						<th><span class="title_box active">'.Translate::getModuleTranslation('statsmodule', 'Item', 'statsmodule').'</span></th>
						<th><span class="title_box active">'.Translate::getModuleTranslation('statsmodule', 'Available quantity for sale', 'statsmodule').'</span></th>
						<th><span class="title_box active">'.Translate::getModuleTranslation('statsmodule', 'Price*', 'statsmodule').'</span></th>
						<th><span class="title_box active">'.Translate::getModuleTranslation('statsmodule', 'Value', 'statsmodule').'</span></th>
					</tr>
				</thead>
				<tbody>';
				foreach ($products as $product)
				{
					$rollup['quantity'] += $product['quantity'];
					$rollup['wholesale_price'] += $product['wholesale_price'];
					$rollup['stockvalue'] += $product['stockvalue'];
					$this->html .= '<tr>
						<td>'.$product['id_product'].'</td>
						<td>'.$product['reference'].'</td>
						<td>'.$product['name'].'</td>
						<td>'.$product['quantity'].'</td>
						<td>'.Tools::displayPrice($product['wholesale_price'], $currency).'</td>
						<td>'.Tools::displayPrice($product['stockvalue'], $currency).'</td>
					</tr>';
				}
				$this->html .= '
				</tbody>
				<tfoot>
					<tr>
						<th colspan="3"></th>
						<th><span class="title_box active">'.Translate::getModuleTranslation('statsmodule', 'Total quantities', 'statsmodule').'</span></th>
						<th><span class="title_box active">'.Translate::getModuleTranslation('statsmodule', 'Average price', 'statsmodule').'</span></th>
						<th><span class="title_box active">'.Translate::getModuleTranslation('statsmodule', 'Total value', 'statsmodule').'</span></th>
					</tr>
					<tr>
						<td colspan="3"></td>
						<td>'.$rollup['quantity'].'</td>
						<td>'.Tools::displayPrice($rollup['wholesale_price'] / count($products), $currency).'</td>
						<td>'.Tools::displayPrice($rollup['stockvalue'], $currency).'</td>
					</tr>
				</tfoot>
			</table>
			<i class="icon-asterisk"></i> '.Translate::getModuleTranslation('statsmodule', 'This section corresponds to the default wholesale price according to the default supplier for the product. An average price is used when the product has attributes.', 'statsmodule');

			return $this->html;
		}
	}
}
