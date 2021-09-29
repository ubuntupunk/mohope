<?php
/* Smarty version 3.1.31, created on 2021-03-02 07:32:18
  from "/home/sexthera/public_html/mohope.web.za/store/modules/dashproducts/views/templates/hook/dashboard_zone_two.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_603e30522d7997_06097320',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e14d6ecc61327d6f8b6630e6c84393269cef9bf7' => 
    array (
      0 => '/home/sexthera/public_html/mohope.web.za/store/modules/dashproducts/views/templates/hook/dashboard_zone_two.tpl',
      1 => 1562437314,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_603e30522d7997_06097320 (Smarty_Internal_Template $_smarty_tpl) {
?>


<section id="dashproducts" class="panel widget <?php if ($_smarty_tpl->tpl_vars['allow_push']->value) {?> allow_push<?php }?>">
  <header class="panel-heading">
    <i class="icon-bar-chart"></i> <?php echo smartyTranslate(array('s'=>'Products and Sales','mod'=>'dashproducts'),$_smarty_tpl);?>

    <span class="panel-heading-action">
      <a class="list-toolbar-btn" href="#" onclick="toggleDashConfig('dashproducts'); return false;"
         title="<?php echo smartyTranslate(array('s'=>'Configure','mod'=>'dashproducts'),$_smarty_tpl);?>
">
        <i class="process-icon-configure"></i>
      </a>
      <a class="list-toolbar-btn" href="#" onclick="refreshDashboard('dashproducts'); return false;"
         title="<?php echo smartyTranslate(array('s'=>'Refresh','mod'=>'dashproducts'),$_smarty_tpl);?>
">
        <i class="process-icon-refresh"></i>
      </a>
    </span>
  </header>

  <section id="dashproducts_config" class="dash_config hide">
    <header><i class="icon-wrench"></i> <?php echo smartyTranslate(array('s'=>'Configuration','mod'=>'dashproducts'),$_smarty_tpl);?>
</header>
    <?php echo $_smarty_tpl->tpl_vars['dashproducts_config_form']->value;?>

  </section>

  <section>
    <nav>
      <ul class="nav nav-pills">
        <li class="active">
          <a href="#dash_recent_orders" data-toggle="tab">
            <i class="icon-fire"></i>
            <span class="hidden-inline-xs"><?php echo smartyTranslate(array('s'=>'Recent Orders','mod'=>'dashproducts'),$_smarty_tpl);?>
</span>
          </a>
        </li>
        <li>
          <a href="#dash_best_sellers" data-toggle="tab">
            <i class="icon-trophy"></i>
            <span class="hidden-inline-xs"><?php echo smartyTranslate(array('s'=>'Best Sellers','mod'=>'dashproducts'),$_smarty_tpl);?>
</span>
          </a>
        </li>
        <li>
          <a href="#dash_most_viewed" data-toggle="tab">
            <i class="icon-eye-open"></i>
            <span class="hidden-inline-xs"><?php echo smartyTranslate(array('s'=>'Most Viewed','mod'=>'dashproducts'),$_smarty_tpl);?>
</span>
          </a>
        </li>
        <li>
          <a href="#dash_top_search" data-toggle="tab">
            <i class="icon-search"></i>
            <span class="hidden-inline-xs"><?php echo smartyTranslate(array('s'=>'Top Searches','mod'=>'dashproducts'),$_smarty_tpl);?>
</span>
          </a>
        </li>
      </ul>
    </nav>

    <div class="tab-content panel">
      <div class="tab-pane active" id="dash_recent_orders">
        <h3><?php echo smartyTranslate(array('s'=>'Last %d orders','sprintf'=>intval($_smarty_tpl->tpl_vars['DASHPRODUCT_NBR_SHOW_LAST_ORDER']->value),'mod'=>'dashproducts'),$_smarty_tpl);?>
</h3>
        <div class="table-responsive">
          <table class="table data_table" id="table_recent_orders">
            <thead></thead>
            <tbody></tbody>
          </table>
        </div>
      </div>
      <div class="tab-pane" id="dash_best_sellers">
        <h3>
          <?php echo smartyTranslate(array('s'=>'Top %d products','sprintf'=>intval($_smarty_tpl->tpl_vars['DASHPRODUCT_NBR_SHOW_BEST_SELLER']->value),'mod'=>'dashproducts'),$_smarty_tpl);?>

          <span><?php echo smartyTranslate(array('s'=>"From",'mod'=>'dashproducts'),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->tpl_vars['date_from']->value;?>
 <?php echo smartyTranslate(array('s'=>"to",'mod'=>'dashproducts'),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->tpl_vars['date_to']->value;?>
</span>
        </h3>
        <div class="table-responsive">
          <table class="table data_table" id="table_best_sellers">
            <thead></thead>
            <tbody></tbody>
          </table>
        </div>
      </div>
      <div class="tab-pane" id="dash_most_viewed">
        <h3>
          <?php echo smartyTranslate(array('s'=>"Most Viewed",'mod'=>'dashproducts'),$_smarty_tpl);?>

          <span><?php echo smartyTranslate(array('s'=>"From",'mod'=>'dashproducts'),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->tpl_vars['date_from']->value;?>
 <?php echo smartyTranslate(array('s'=>"to",'mod'=>'dashproducts'),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->tpl_vars['date_to']->value;?>
</span>
        </h3>
        <div class="table-responsive">
          <table class="table data_table" id="table_most_viewed">
            <thead></thead>
            <tbody></tbody>
          </table>
        </div>
      </div>
      <div class="tab-pane" id="dash_top_search">
        <h3>
          <?php echo smartyTranslate(array('s'=>'Top %d most search terms','sprintf'=>intval($_smarty_tpl->tpl_vars['DASHPRODUCT_NBR_SHOW_TOP_SEARCH']->value),'mod'=>'dashproducts'),$_smarty_tpl);?>

          <span><?php echo smartyTranslate(array('s'=>"From",'mod'=>'dashproducts'),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->tpl_vars['date_from']->value;?>
 <?php echo smartyTranslate(array('s'=>"to",'mod'=>'dashproducts'),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->tpl_vars['date_to']->value;?>
</span>
        </h3>
        <div class="table-responsive">
          <table class="table data_table" id="table_top_10_most_search">
            <thead></thead>
            <tbody></tbody>
          </table>
        </div>
      </div>
    </div>

  </section>
</section>
<?php }
}
