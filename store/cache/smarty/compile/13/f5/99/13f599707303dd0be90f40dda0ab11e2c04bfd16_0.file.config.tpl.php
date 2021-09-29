<?php
/* Smarty version 3.1.31, created on 2021-03-02 07:32:18
  from "/home/sexthera/public_html/mohope.web.za/store/modules/dashgoals/views/templates/hook/config.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_603e30522b2aa5_26301358',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '13f599707303dd0be90f40dda0ab11e2c04bfd16' => 
    array (
      0 => '/home/sexthera/public_html/mohope.web.za/store/modules/dashgoals/views/templates/hook/config.tpl',
      1 => 1562437080,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_603e30522b2aa5_26301358 (Smarty_Internal_Template $_smarty_tpl) {
?>


<section id="dashgoals_config" class="dash_config hide">
  <header><i class="icon-wrench"></i> <?php echo smartyTranslate(array('s'=>'Configuration','mod'=>'dashgoals'),$_smarty_tpl);?>
</header>
  <form class="defaultForm form-horizontal" method="post"
        action="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getAdminLink('AdminDashboard'), ENT_QUOTES, 'UTF-8', true);?>
">
    <table class="table table-condensed table-striped table-bordered">
      <thead>
        <tr>
          <th class="fixed-width-md"><?php echo $_smarty_tpl->tpl_vars['goals_year']->value;?>
</th>
          <th class="fixed-width-md"><?php echo smartyTranslate(array('s'=>'Traffic','mod'=>'dashgoals'),$_smarty_tpl);?>
</th>
          <th class="fixed-width-md"><?php echo smartyTranslate(array('s'=>'Conversion Rate','mod'=>'dashgoals'),$_smarty_tpl);?>
</th>
          <th class="fixed-width-lg"><?php echo smartyTranslate(array('s'=>'Average Cart Value','mod'=>'dashgoals'),$_smarty_tpl);?>
</th>
          <th><?php echo smartyTranslate(array('s'=>'Sales','mod'=>'dashgoals'),$_smarty_tpl);?>
</th>
        </tr>
      </thead>
      <tbody>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['goals_months']->value, 'month');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['month']->key => $_smarty_tpl->tpl_vars['month']->value) {
$__foreach_month_31_saved = $_smarty_tpl->tpl_vars['month'];
?>
          <tr>
            <td>
              <?php echo $_smarty_tpl->tpl_vars['month']->value['label'];?>

            </td>
            <td>
              <div class="input-group">
                <input id="dashgoals_traffic_<?php echo $_smarty_tpl->tpl_vars['month']->key;?>
" name="dashgoals_traffic_<?php echo $_smarty_tpl->tpl_vars['month']->key;?>
"
                       class="dashgoals_config_input form-control"
                       value="<?php echo intval($_smarty_tpl->tpl_vars['month']->value['values']['traffic']);?>
"/>
              </div>
            </td>
            <td>
              <div class="input-group">
                <input id="dashgoals_conversion_<?php echo $_smarty_tpl->tpl_vars['month']->key;?>
" name="dashgoals_conversion_<?php echo $_smarty_tpl->tpl_vars['month']->key;?>
"
                       class="dashgoals_config_input form-control"
                       value="<?php echo floatval($_smarty_tpl->tpl_vars['month']->value['values']['conversion']);?>
"/>
                <span class="input-group-addon">%</span>
              </div>
            </td>
            <td>
              <div class="input-group">
                <span class="input-group-addon"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['currency']->value->iso_code, ENT_QUOTES, 'UTF-8', true);?>
</span>
                <input id="dashgoals_avg_cart_value_<?php echo $_smarty_tpl->tpl_vars['month']->key;?>
" name="dashgoals_avg_cart_value_<?php echo $_smarty_tpl->tpl_vars['month']->key;?>
"
                       class="dashgoals_config_input form-control"
                       value="<?php echo intval($_smarty_tpl->tpl_vars['month']->value['values']['avg_cart_value']);?>
"/>
              </div>
            </td>
            <td id="dashgoals_sales_<?php echo $_smarty_tpl->tpl_vars['month']->key;?>
" class="dashgoals_sales">
            </td>
          </tr>
        <?php
$_smarty_tpl->tpl_vars['month'] = $__foreach_month_31_saved;
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

      </tbody>
    </table>
    <div class="panel-footer">
      <button class="btn btn-default pull-right" name="submitDashGoals" type="submit"><i
                class="process-icon-save"></i> <?php echo smartyTranslate(array('s'=>'Save','mod'=>'dashgoals'),$_smarty_tpl);?>
</button>
    </div>
  </form>
</section>
<?php }
}
