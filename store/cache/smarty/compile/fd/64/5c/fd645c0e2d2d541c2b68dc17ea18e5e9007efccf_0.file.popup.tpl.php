<?php
/* Smarty version 3.1.31, created on 2021-03-02 07:32:22
  from "/home/sexthera/public_html/mohope.web.za/store/themes/niara/modules/blockcart/includes/popup.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_603e30564d98e4_03392222',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fd645c0e2d2d541c2b68dc17ea18e5e9007efccf' => 
    array (
      0 => '/home/sexthera/public_html/mohope.web.za/store/themes/niara/modules/blockcart/includes/popup.tpl',
      1 => 1563910602,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_603e30564d98e4_03392222 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div id="layer_cart">
  <div class="clearfix">

    <div class="layer_cart_product col-xs-12 col-md-6">

      <button type="button" class="close cross" title="<?php echo smartyTranslate(array('s'=>'Close window','mod'=>'blockcart'),$_smarty_tpl);?>
">&times;</button>

      <span class="text-success cart-title">
        <i class="icon icon-check"></i> <?php echo smartyTranslate(array('s'=>'Product successfully added to your shopping cart','mod'=>'blockcart'),$_smarty_tpl);?>

      </span>

      <div class="row">
        <div class="col-xs-12 col-md-5">
          <div class="thumbnail layer_cart_img"></div>
        </div>
        <div class="col-xs-12 col-md-7">
          <div class="layer_cart_product_info">
            <span id="layer_cart_product_title" class="product-name"></span>
            <p id="layer_cart_product_attributes"></p>
            <p>
              <strong><?php echo smartyTranslate(array('s'=>'Quantity:','mod'=>'blockcart'),$_smarty_tpl);?>
</strong>
              <span id="layer_cart_product_quantity"></span>
            </p>
            <p>
              <strong><?php echo smartyTranslate(array('s'=>'Total:','mod'=>'blockcart'),$_smarty_tpl);?>
</strong>
              <span id="layer_cart_product_price"></span>
            </p>
          </div>
        </div>
      </div>

    </div>

    <div class="layer_cart_cart col-xs-12 col-md-6">

      <span class="title">
        <span class="ajax_cart_product_txt_s <?php if ($_smarty_tpl->tpl_vars['cart_qties']->value < 2) {?> unvisible<?php }?>">
          <?php echo smartyTranslate(array('s'=>'There are [1]%d[/1] items in your cart.','mod'=>'blockcart','sprintf'=>array($_smarty_tpl->tpl_vars['cart_qties']->value),'tags'=>array('<span class="ajax_cart_quantity">')),$_smarty_tpl);?>

        </span>
        <span class="ajax_cart_product_txt <?php if ($_smarty_tpl->tpl_vars['cart_qties']->value > 1) {?> unvisible<?php }?>">
          <?php echo smartyTranslate(array('s'=>'There is 1 item in your cart.','mod'=>'blockcart'),$_smarty_tpl);?>

        </span>
      </span>

      <p class="layer_cart_row">
        <strong>
          <?php echo smartyTranslate(array('s'=>'Total products:','mod'=>'blockcart'),$_smarty_tpl);?>

          <?php if ($_smarty_tpl->tpl_vars['use_taxes']->value && $_smarty_tpl->tpl_vars['display_tax_label']->value && $_smarty_tpl->tpl_vars['show_tax']->value) {?>
            <?php if ($_smarty_tpl->tpl_vars['priceDisplay']->value == 1) {?>
              <?php echo smartyTranslate(array('s'=>'(tax excl.)','mod'=>'blockcart'),$_smarty_tpl);?>

            <?php } else { ?>
              <?php echo smartyTranslate(array('s'=>'(tax incl.)','mod'=>'blockcart'),$_smarty_tpl);?>

            <?php }?>
          <?php }?>
        </strong>
        <span class="ajax_block_products_total">
          <?php if ($_smarty_tpl->tpl_vars['cart_qties']->value > 0) {?>
            <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0][0]->convertPrice(array('price'=>$_smarty_tpl->tpl_vars['cart']->value->getOrderTotal(false,Cart::ONLY_PRODUCTS)),$_smarty_tpl);?>

          <?php }?>
        </span>
      </p>

      <?php if ($_smarty_tpl->tpl_vars['show_wrapping']->value) {?>
        <p class="layer_cart_row">
          <strong>
            <?php echo smartyTranslate(array('s'=>'Wrapping:','mod'=>'blockcart'),$_smarty_tpl);?>

            <?php if ($_smarty_tpl->tpl_vars['use_taxes']->value && $_smarty_tpl->tpl_vars['display_tax_label']->value && $_smarty_tpl->tpl_vars['show_tax']->value) {?>
              <?php if ($_smarty_tpl->tpl_vars['priceDisplay']->value == 1) {?>
                <?php echo smartyTranslate(array('s'=>'(tax excl.)','mod'=>'blockcart'),$_smarty_tpl);?>

              <?php } else { ?>
                <?php echo smartyTranslate(array('s'=>'(tax incl.)','mod'=>'blockcart'),$_smarty_tpl);?>

              <?php }?>
            <?php }?>
          </strong>
          <span class="price ajax_block_wrapping_cost">
            <?php if ($_smarty_tpl->tpl_vars['priceDisplay']->value == 1) {?>
              <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0][0]->convertPrice(array('price'=>$_smarty_tpl->tpl_vars['cart']->value->getOrderTotal(false,Cart::ONLY_WRAPPING)),$_smarty_tpl);?>

            <?php } else { ?>
              <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0][0]->convertPrice(array('price'=>$_smarty_tpl->tpl_vars['cart']->value->getOrderTotal(true,Cart::ONLY_WRAPPING)),$_smarty_tpl);?>

            <?php }?>
          </span>
        </p>
      <?php }?>

      <p class="layer_cart_row">
        <strong class="<?php if ($_smarty_tpl->tpl_vars['shipping_cost_float']->value == 0 && ($_smarty_tpl->tpl_vars['cart_qties']->value || $_smarty_tpl->tpl_vars['cart']->value->isVirtualCart() || !isset($_smarty_tpl->tpl_vars['cart']->value->id_address_delivery) || !$_smarty_tpl->tpl_vars['cart']->value->id_address_delivery)) {?> unvisible<?php }?>">
          <?php echo smartyTranslate(array('s'=>'Total shipping:','mod'=>'blockcart'),$_smarty_tpl);?>
&nbsp;<?php if ($_smarty_tpl->tpl_vars['use_taxes']->value && $_smarty_tpl->tpl_vars['display_tax_label']->value && $_smarty_tpl->tpl_vars['show_tax']->value) {
if ($_smarty_tpl->tpl_vars['priceDisplay']->value == 1) {
echo smartyTranslate(array('s'=>'(tax excl.)','mod'=>'blockcart'),$_smarty_tpl);
} else {
echo smartyTranslate(array('s'=>'(tax incl.)','mod'=>'blockcart'),$_smarty_tpl);
}
}?>
        </strong>
        <span class="ajax_cart_shipping_cost<?php if ($_smarty_tpl->tpl_vars['shipping_cost_float']->value == 0 && ($_smarty_tpl->tpl_vars['cart_qties']->value || $_smarty_tpl->tpl_vars['cart']->value->isVirtualCart() || !isset($_smarty_tpl->tpl_vars['cart']->value->id_address_delivery) || !$_smarty_tpl->tpl_vars['cart']->value->id_address_delivery)) {?> unvisible<?php }?>">
          <?php if ($_smarty_tpl->tpl_vars['shipping_cost_float']->value == 0) {?>
            <?php if ((!isset($_smarty_tpl->tpl_vars['cart']->value->id_address_delivery) || !$_smarty_tpl->tpl_vars['cart']->value->id_address_delivery)) {
echo smartyTranslate(array('s'=>'To be determined','mod'=>'blockcart'),$_smarty_tpl);
} else {
echo smartyTranslate(array('s'=>'Free shipping!','mod'=>'blockcart'),$_smarty_tpl);
}?>
          <?php } else { ?>
            <?php echo $_smarty_tpl->tpl_vars['shipping_cost']->value;?>

          <?php }?>
        </span>
      </p>

      <?php if ($_smarty_tpl->tpl_vars['show_tax']->value && isset($_smarty_tpl->tpl_vars['tax_cost']->value)) {?>
        <p class="layer_cart_row">
          <strong><?php echo smartyTranslate(array('s'=>'Tax:','mod'=>'blockcart'),$_smarty_tpl);?>
</strong>
          <span class="price ajax_cart_tax_cost"><?php echo $_smarty_tpl->tpl_vars['tax_cost']->value;?>
</span>
        </p>
      <?php }?>

      <p class="layer_cart_row">
        <strong>
          <?php echo smartyTranslate(array('s'=>'Total:','mod'=>'blockcart'),$_smarty_tpl);?>

          <?php if ($_smarty_tpl->tpl_vars['use_taxes']->value && $_smarty_tpl->tpl_vars['display_tax_label']->value && $_smarty_tpl->tpl_vars['show_tax']->value) {?>
            <?php if ($_smarty_tpl->tpl_vars['priceDisplay']->value == 1) {?>
              <?php echo smartyTranslate(array('s'=>'(tax excl.)','mod'=>'blockcart'),$_smarty_tpl);?>

            <?php } else { ?>
              <?php echo smartyTranslate(array('s'=>'(tax incl.)','mod'=>'blockcart'),$_smarty_tpl);?>

            <?php }?>
          <?php }?>
        </strong>
        <span class="ajax_block_cart_total">
          <?php if ($_smarty_tpl->tpl_vars['cart_qties']->value > 0) {?>
            <?php if ($_smarty_tpl->tpl_vars['priceDisplay']->value == 1) {?>
              <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0][0]->convertPrice(array('price'=>$_smarty_tpl->tpl_vars['cart']->value->getOrderTotal(false)),$_smarty_tpl);?>

            <?php } else { ?>
              <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0][0]->convertPrice(array('price'=>$_smarty_tpl->tpl_vars['cart']->value->getOrderTotal(true)),$_smarty_tpl);?>

            <?php }?>
          <?php }?>
        </span>
      </p>

      <div class="button-container">
        <nav>
          <ul class="pager">
            <li class="previous">
              <a href="#" class="continue">&laquo; <?php echo smartyTranslate(array('s'=>'Continue shopping','mod'=>'blockcart'),$_smarty_tpl);?>
</a>
            </li>
            <li class="next">
              <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink(((string)$_smarty_tpl->tpl_vars['order_process']->value),true), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'Proceed to checkout','mod'=>'blockcart'),$_smarty_tpl);?>
" rel="nofollow">
                <?php echo smartyTranslate(array('s'=>'Proceed to checkout','mod'=>'blockcart'),$_smarty_tpl);?>
 &raquo;
              </a>
            </li>
          </ul>
        </nav>
      </div>

    </div>
  </div>
  <div class="crossseling"></div>
</div>

<div class="layer_cart_overlay"></div>
<?php }
}
