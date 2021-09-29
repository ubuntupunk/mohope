<?php
/* Smarty version 3.1.31, created on 2021-03-02 07:32:22
  from "/home/sexthera/public_html/mohope.web.za/store/themes/niara/modules/blockcart/includes/header.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_603e305644db72_30893432',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9d3eef5c983eef5bbe3373b09ed653388be89bf7' => 
    array (
      0 => '/home/sexthera/public_html/mohope.web.za/store/themes/niara/modules/blockcart/includes/header.tpl',
      1 => 1563910602,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_603e305644db72_30893432 (Smarty_Internal_Template $_smarty_tpl) {
?>
<a id="blockcart-header" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink($_smarty_tpl->tpl_vars['order_process']->value,true), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'View my shopping cart','mod'=>'blockcart'),$_smarty_tpl);?>
" rel="nofollow">
  <b><?php echo smartyTranslate(array('s'=>'My Cart','mod'=>'blockcart'),$_smarty_tpl);?>
</b>
  <span class="ajax_cart_quantity"><?php echo $_smarty_tpl->tpl_vars['cart_qties']->value;?>
</span>
  <span class="ajax_cart_product_txt"<?php if ($_smarty_tpl->tpl_vars['cart_qties']->value != 1) {?> style="display: none;"<?php }?>><?php echo smartyTranslate(array('s'=>'Product','mod'=>'blockcart'),$_smarty_tpl);?>
</span>
  <span class="ajax_cart_product_txt_s"<?php if ($_smarty_tpl->tpl_vars['cart_qties']->value < 2) {?> style="display: none;"<?php }?>><?php echo smartyTranslate(array('s'=>'Products','mod'=>'blockcart'),$_smarty_tpl);?>
</span>
  <span class="ajax_cart_total"<?php if ($_smarty_tpl->tpl_vars['cart_qties']->value == 0) {?> style="display: none;"<?php }?>>
    <?php if ($_smarty_tpl->tpl_vars['cart_qties']->value > 0) {?>
      <?php if ($_smarty_tpl->tpl_vars['priceDisplay']->value == 1) {?>
        <?php $_smarty_tpl->_assignInScope('blockcart_cart_flag', constant('Cart::BOTH_WITHOUT_SHIPPING'));
?>
        <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0][0]->convertPrice(array('price'=>$_smarty_tpl->tpl_vars['cart']->value->getOrderTotal(false,$_smarty_tpl->tpl_vars['blockcart_cart_flag']->value)),$_smarty_tpl);?>

      <?php } else { ?>
        <?php $_smarty_tpl->_assignInScope('blockcart_cart_flag', constant('Cart::BOTH_WITHOUT_SHIPPING'));
?>
        <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0][0]->convertPrice(array('price'=>$_smarty_tpl->tpl_vars['cart']->value->getOrderTotal(true,$_smarty_tpl->tpl_vars['blockcart_cart_flag']->value)),$_smarty_tpl);?>

      <?php }?>
    <?php }?>
  </span>
  <span class="ajax_cart_no_product"<?php if ($_smarty_tpl->tpl_vars['cart_qties']->value > 0) {?> style="display: none;"<?php }?>><?php echo smartyTranslate(array('s'=>'(empty)','mod'=>'blockcart'),$_smarty_tpl);?>
</span>
</a>
<?php }
}
