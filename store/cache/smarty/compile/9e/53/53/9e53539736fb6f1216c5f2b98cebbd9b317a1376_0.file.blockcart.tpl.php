<?php
/* Smarty version 3.1.31, created on 2021-03-02 07:32:22
  from "/home/sexthera/public_html/mohope.web.za/store/themes/niara/modules/blockcart/blockcart.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_603e305643da93_60550488',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9e53539736fb6f1216c5f2b98cebbd9b317a1376' => 
    array (
      0 => '/home/sexthera/public_html/mohope.web.za/store/themes/niara/modules/blockcart/blockcart.tpl',
      1 => 1563910602,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./includes/header.tpl' => 1,
    'file:./includes/dropdown.tpl' => 1,
    'file:./includes/popup.tpl' => 1,
  ),
),false)) {
function content_603e305643da93_60550488 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_function_counter')) require_once '/home/sexthera/public_html/mohope.web.za/store/vendor/smarty/smarty/libs/plugins/function.counter.php';
if (isset($_smarty_tpl->tpl_vars['blockcart_top']->value) && $_smarty_tpl->tpl_vars['blockcart_top']->value) {?>
<div class="col-sm-4 col-md-3<?php if ($_smarty_tpl->tpl_vars['PS_CATALOG_MODE']->value) {?> header_user_catalog<?php }?>">
  <?php }?>
  <div id="blockcart" class="shopping_cart">
    <?php $_smarty_tpl->_subTemplateRender('file:./includes/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    <?php if (!$_smarty_tpl->tpl_vars['PS_CATALOG_MODE']->value) {?>
      <?php $_smarty_tpl->_subTemplateRender('file:./includes/dropdown.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    <?php }?>
  </div>
  <?php if (isset($_smarty_tpl->tpl_vars['blockcart_top']->value) && $_smarty_tpl->tpl_vars['blockcart_top']->value) {?>
</div>
<?php }?>

<?php echo smarty_function_counter(array('name'=>'active_overlay','assign'=>'active_overlay'),$_smarty_tpl);?>

<?php if (!$_smarty_tpl->tpl_vars['PS_CATALOG_MODE']->value && $_smarty_tpl->tpl_vars['active_overlay']->value == 1) {?>
  <?php $_smarty_tpl->_subTemplateRender('file:./includes/popup.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php }?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0][0]->addJsDef(array('CUSTOMIZE_TEXTFIELD'=>$_smarty_tpl->tpl_vars['CUSTOMIZE_TEXTFIELD']->value),$_smarty_tpl);
echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0][0]->addJsDef(array('img_dir'=>preg_replace("%(?<!\\\\)'%", "\'",$_smarty_tpl->tpl_vars['img_dir']->value)),$_smarty_tpl);
echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0][0]->addJsDef(array('generated_date'=>intval(time())),$_smarty_tpl);
echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0][0]->addJsDef(array('ajax_allowed'=>$_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['boolval'][0][0]->boolval($_smarty_tpl->tpl_vars['ajax_allowed']->value)),$_smarty_tpl);
echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0][0]->addJsDef(array('hasDeliveryAddress'=>(isset($_smarty_tpl->tpl_vars['cart']->value->id_address_delivery) && $_smarty_tpl->tpl_vars['cart']->value->id_address_delivery)),$_smarty_tpl);
$_block_plugin1 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin1, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'customizationIdMessage'));
$_block_repeat=true;
echo $_block_plugin1->addJsDefL(array('name'=>'customizationIdMessage'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo smartyTranslate(array('s'=>'Customization #','mod'=>'blockcart','js'=>1),$_smarty_tpl);
$_block_repeat=false;
echo $_block_plugin1->addJsDefL(array('name'=>'customizationIdMessage'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_plugin2 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin2, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'removingLinkText'));
$_block_repeat=true;
echo $_block_plugin2->addJsDefL(array('name'=>'removingLinkText'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo smartyTranslate(array('s'=>'remove this product from my cart','mod'=>'blockcart','js'=>1),$_smarty_tpl);
$_block_repeat=false;
echo $_block_plugin2->addJsDefL(array('name'=>'removingLinkText'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_plugin3 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin3, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'freeShippingTranslation'));
$_block_repeat=true;
echo $_block_plugin3->addJsDefL(array('name'=>'freeShippingTranslation'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo smartyTranslate(array('s'=>'Free shipping!','mod'=>'blockcart','js'=>1),$_smarty_tpl);
$_block_repeat=false;
echo $_block_plugin3->addJsDefL(array('name'=>'freeShippingTranslation'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_plugin4 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin4, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'freeProductTranslation'));
$_block_repeat=true;
echo $_block_plugin4->addJsDefL(array('name'=>'freeProductTranslation'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo smartyTranslate(array('s'=>'Free!','mod'=>'blockcart','js'=>1),$_smarty_tpl);
$_block_repeat=false;
echo $_block_plugin4->addJsDefL(array('name'=>'freeProductTranslation'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_plugin5 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin5, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'delete_txt'));
$_block_repeat=true;
echo $_block_plugin5->addJsDefL(array('name'=>'delete_txt'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo smartyTranslate(array('s'=>'Delete','mod'=>'blockcart','js'=>1),$_smarty_tpl);
$_block_repeat=false;
echo $_block_plugin5->addJsDefL(array('name'=>'delete_txt'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_plugin6 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin6, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'toBeDetermined'));
$_block_repeat=true;
echo $_block_plugin6->addJsDefL(array('name'=>'toBeDetermined'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo smartyTranslate(array('s'=>'To be determined','mod'=>'blockcart','js'=>1),$_smarty_tpl);
$_block_repeat=false;
echo $_block_plugin6->addJsDefL(array('name'=>'toBeDetermined'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>

<?php }
}
