<?php
/* Smarty version 3.1.31, created on 2021-03-02 07:32:18
  from "/home/sexthera/public_html/mohope.web.za/store/modules/dashtrends/views/templates/hook/dashboard_zone_two.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_603e3052294e93_59298952',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4525997d38e300e2da7525b43bf18d27a94146f9' => 
    array (
      0 => '/home/sexthera/public_html/mohope.web.za/store/modules/dashtrends/views/templates/hook/dashboard_zone_two.tpl',
      1 => 1562437426,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_603e3052294e93_59298952 (Smarty_Internal_Template $_smarty_tpl) {
?>


<?php echo '<script'; ?>
>
  var currency_format = <?php echo floatval($_smarty_tpl->tpl_vars['currency']->value->format);?>
;
  var currency_sign = '<?php echo addcslashes($_smarty_tpl->tpl_vars['currency']->value->sign,'\'');?>
';
  var currency_blank = <?php echo intval($_smarty_tpl->tpl_vars['currency']->value->blank);?>
;
<?php echo '</script'; ?>
>
<div class="clearfix"></div>
<section id="dashtrends" class="panel widget<?php if ($_smarty_tpl->tpl_vars['allow_push']->value) {?> allow_push<?php }?>">
  <header class="panel-heading">
    <i class="icon-bar-chart"></i> <?php echo smartyTranslate(array('s'=>'Dashboard','mod'=>'dashtrends'),$_smarty_tpl);?>

    <span class="panel-heading-action">
			<a class="list-toolbar-btn"
         href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getAdminLink('AdminDashboard'), ENT_QUOTES, 'UTF-8', true);?>
&amp;profitability_conf=1"
         title="<?php echo smartyTranslate(array('s'=>'Configure','mod'=>'dashtrends'),$_smarty_tpl);?>
">
				<i class="process-icon-configure"></i>
			</a>
			<a class="list-toolbar-btn" href="#" onclick="refreshDashboard('dashtrends'); return false;"
         title="<?php echo smartyTranslate(array('s'=>'Refresh','mod'=>'dashtrends'),$_smarty_tpl);?>
">
				<i class="process-icon-refresh"></i>
			</a>
		</span>
  </header>
  <div id="dashtrends_toolbar" class="row">
    <dl class="col-xs-4 col-lg-2 label-tooltip" onclick="selectDashtrendsChart(this, 'sales');" data-toggle="tooltip"
        data-original-title="<?php echo smartyTranslate(array('s'=>'Sum of revenue (excl. tax) generated within the date range by orders considered validated.','mod'=>'dashtrends'),$_smarty_tpl);?>
"
        data-placement="bottom">
      <dt><?php echo smartyTranslate(array('s'=>'Sales','mod'=>'dashtrends'),$_smarty_tpl);?>
</dt>
      <dd class="data_value size_l"><span id="sales_score"></span></dd>
      <dd class="dash_trend"><span id="sales_score_trends"></span></dd>
    </dl>
    <dl class="col-xs-4 col-lg-2 label-tooltip" onclick="selectDashtrendsChart(this, 'orders');" data-toggle="tooltip"
        data-original-title="<?php echo smartyTranslate(array('s'=>'Total number of orders received within the date range that are considered validated.','mod'=>'dashtrends'),$_smarty_tpl);?>
"
        data-placement="bottom">
      <dt><?php echo smartyTranslate(array('s'=>'Orders','mod'=>'dashtrends'),$_smarty_tpl);?>
</dt>
      <dd class="data_value size_l"><span id="orders_score"></span></dd>
      <dd class="dash_trend"><span id="orders_score_trends"></span></dd>
    </dl>
    <dl class="col-xs-4 col-lg-2 label-tooltip" onclick="selectDashtrendsChart(this, 'average_cart_value');"
        data-toggle="tooltip"
        data-original-title="<?php echo smartyTranslate(array('s'=>'Average Cart Value is a metric representing the value of an average order within the date range. It is calculated by dividing Sales by Orders.','mod'=>'dashtrends'),$_smarty_tpl);?>
"
        data-placement="bottom">
      <dt><?php echo smartyTranslate(array('s'=>'Cart Value','mod'=>'dashtrends'),$_smarty_tpl);?>
</dt>
      <dd class="data_value size_l"><span id="cart_value_score"></span></dd>
      <dd class="dash_trend"><span id="cart_value_score_trends"></span></dd>
    </dl>
    <dl class="col-xs-4 col-lg-2 label-tooltip" onclick="selectDashtrendsChart(this, 'visits');" data-toggle="tooltip"
        data-original-title="<?php echo smartyTranslate(array('s'=>'Total number of visits within the date range. A visit is the period of time a user is actively engaged with your website.','mod'=>'dashtrends'),$_smarty_tpl);?>
"
        data-placement="bottom">
      <dt><?php echo smartyTranslate(array('s'=>'Visits','mod'=>'dashtrends'),$_smarty_tpl);?>
</dt>
      <dd class="data_value size_l"><span id="visits_score"></span></dd>
      <dd class="dash_trend"><span id="visits_score_trends"></span></dd>
    </dl>
    <dl class="col-xs-4 col-lg-2 label-tooltip" onclick="selectDashtrendsChart(this, 'conversion_rate');"
        data-toggle="tooltip"
        data-original-title="<?php echo smartyTranslate(array('s'=>'Ecommerce Conversion Rate is the percentage of visits that resulted in an validated order.','mod'=>'dashtrends'),$_smarty_tpl);?>
"
        data-placement="bottom">
      <dt><?php echo smartyTranslate(array('s'=>'Conversion Rate','mod'=>'dashtrends'),$_smarty_tpl);?>
</dt>
      <dd class="data_value size_l"><span id="conversion_rate_score"></span></dd>
      <dd class="dash_trend"><span id="conversion_rate_score_trends"></span></dd>
    </dl>
    <dl class="col-xs-4 col-lg-2 label-tooltip" onclick="selectDashtrendsChart(this, 'net_profits');"
        data-toggle="tooltip"
        data-original-title="<?php echo smartyTranslate(array('s'=>'Net profit is a measure of the profitability of a venture after accounting for all Ecommerce costs. You can provide these costs by clicking on the configuration icon right above here.','mod'=>'dashtrends'),$_smarty_tpl);?>
"
        data-placement="bottom">
      <dt><?php echo smartyTranslate(array('s'=>'Net Profit','mod'=>'dashtrends'),$_smarty_tpl);?>
</dt>
      <dd class="data_value size_l"><span id="net_profits_score"></span></dd>
      <dd class="dash_trend"><span id="net_profits_score_trends"></span></dd>
    </dl>
  </div>
  <div id="dash_trends_chart1" class="chart with-transitions">
    <svg></svg>
  </div>
</section>
<?php }
}
