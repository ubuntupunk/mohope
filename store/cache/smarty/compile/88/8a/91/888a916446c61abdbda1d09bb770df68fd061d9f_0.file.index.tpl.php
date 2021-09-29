<?php
/* Smarty version 3.1.31, created on 2021-03-02 07:32:22
  from "/home/sexthera/public_html/mohope.web.za/store/themes/niara/index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_603e30567c4069_57573756',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '888a916446c61abdbda1d09bb770df68fd061d9f' => 
    array (
      0 => '/home/sexthera/public_html/mohope.web.za/store/themes/niara/index.tpl',
      1 => 1563910602,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_603e30567c4069_57573756 (Smarty_Internal_Template $_smarty_tpl) {
if (!empty($_smarty_tpl->tpl_vars['HOOK_HOME_TAB']->value)) {?>
  <ul id="home-page-tabs" class="nav nav-tabs">
    <?php echo $_smarty_tpl->tpl_vars['HOOK_HOME_TAB']->value;?>

  </ul>
<?php }?>

<?php if (!empty($_smarty_tpl->tpl_vars['HOOK_HOME_TAB_CONTENT']->value)) {?>
  <div class="tab-content">
    <?php echo $_smarty_tpl->tpl_vars['HOOK_HOME_TAB_CONTENT']->value;?>

  </div>
<?php }?>

<?php if (!empty($_smarty_tpl->tpl_vars['HOOK_HOME']->value)) {?>
  <div class="row">
    <?php echo $_smarty_tpl->tpl_vars['HOOK_HOME']->value;?>

  </div>
<?php }
}
}
