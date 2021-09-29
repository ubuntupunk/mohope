<?php
/* Smarty version 3.1.31, created on 2021-03-02 07:32:22
  from "/home/sexthera/public_html/mohope.web.za/store/themes/niara/modules/blockcart/includes/dropdown.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_603e30564b16c7_44300346',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9d6f92e2aec463b7461639423843b6d563450d99' => 
    array (
      0 => '/home/sexthera/public_html/mohope.web.za/store/themes/niara/modules/blockcart/includes/dropdown.tpl',
      1 => 1563910602,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_603e30564b16c7_44300346 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_modifier_replace')) require_once '/home/sexthera/public_html/mohope.web.za/store/vendor/smarty/smarty/libs/plugins/modifier.replace.php';
?>
<div id="blockcart-dropdown" class="cart_block" style="display: none;">
  <div class="cart_block_list">
    <?php if ($_smarty_tpl->tpl_vars['products']->value) {?>
      <dl class="products">
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['products']->value, 'product');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['product']->value) {
?>

          <?php $_smarty_tpl->_assignInScope('productId', $_smarty_tpl->tpl_vars['product']->value['id_product']);
?>
          <?php $_smarty_tpl->_assignInScope('productAttributeId', $_smarty_tpl->tpl_vars['product']->value['id_product_attribute']);
?>

          <dt data-id="cart_block_product_<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product']);?>
_<?php if ($_smarty_tpl->tpl_vars['product']->value['id_product_attribute']) {
echo intval($_smarty_tpl->tpl_vars['product']->value['id_product_attribute']);
} else { ?>0<?php }?>_<?php if ($_smarty_tpl->tpl_vars['product']->value['id_address_delivery']) {
echo intval($_smarty_tpl->tpl_vars['product']->value['id_address_delivery']);
} else { ?>0<?php }?>" class="clearfix">
            <a class="cart-images" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getProductLink($_smarty_tpl->tpl_vars['product']->value['id_product'],$_smarty_tpl->tpl_vars['product']->value['link_rewrite'],$_smarty_tpl->tpl_vars['product']->value['category']), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
">
              <?php if (!empty($_smarty_tpl->tpl_vars['lazy_load']->value)) {?>
                <noscript>
                  <img src="<?php echo $_smarty_tpl->tpl_vars['link']->value->getImageLink($_smarty_tpl->tpl_vars['product']->value['link_rewrite'],$_smarty_tpl->tpl_vars['product']->value['id_image'],'cart','webp',ImageManager::retinaSupport());?>
"
                       alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
"
                       width="<?php echo intval($_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['getWidthSize'][0][0]->getWidth(array('type'=>'cart'),$_smarty_tpl));?>
"
                       height="<?php echo intval($_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['getHeightSize'][0][0]->getHeight(array('type'=>'cart'),$_smarty_tpl));?>
"
                  >
                </noscript>
              <?php }?>
              <picture <?php if (!empty($_smarty_tpl->tpl_vars['lazy_load']->value)) {?>class="tb-lazy-image"<?php }?>>
                <!--[if IE 9]><video style="display: none;"><![endif]-->
                <?php if (!empty($_smarty_tpl->tpl_vars['webp']->value)) {?>
                <source <?php if (!empty($_smarty_tpl->tpl_vars['lazy_load']->value)) {?>srcset="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII= 1w" data-<?php }?>srcset="<?php echo $_smarty_tpl->tpl_vars['link']->value->getImageLink($_smarty_tpl->tpl_vars['product']->value['link_rewrite'],$_smarty_tpl->tpl_vars['product']->value['id_image'],'cart','webp',ImageManager::retinaSupport());?>
"
                        alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
"
                        type="image/webp"
                >
                <?php }?>
                <!--[if IE 9]></video><![endif]-->
                <img <?php if (!empty($_smarty_tpl->tpl_vars['lazy_load']->value)) {?>srcset="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII= 1w" data-<?php }?>srcset="<?php echo $_smarty_tpl->tpl_vars['link']->value->getImageLink($_smarty_tpl->tpl_vars['product']->value['link_rewrite'],$_smarty_tpl->tpl_vars['product']->value['id_image'],'cart',null,ImageManager::retinaSupport());?>
"
                     <?php if (!empty($_smarty_tpl->tpl_vars['lazy_load']->value)) {?>src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII="<?php }?>
                     alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
"
                     width="<?php echo intval($_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['getWidthSize'][0][0]->getWidth(array('type'=>'cart'),$_smarty_tpl));?>
"
                     height="<?php echo intval($_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['getHeightSize'][0][0]->getHeight(array('type'=>'cart'),$_smarty_tpl));?>
"
                >
              </picture>
            </a>
            <div class="cart-info clearfix">
              <div class="product-name">
                <span class="quantity-formatted">
                  <span class="quantity"><?php echo intval($_smarty_tpl->tpl_vars['product']->value['cart_quantity']);?>
</span> &times;
                </span>
                <a class="cart_block_product_name" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getProductLink($_smarty_tpl->tpl_vars['product']->value,$_smarty_tpl->tpl_vars['product']->value['link_rewrite'],$_smarty_tpl->tpl_vars['product']->value['category'],null,null,$_smarty_tpl->tpl_vars['product']->value['id_shop'],$_smarty_tpl->tpl_vars['product']->value['id_product_attribute']), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
">
                  <?php echo htmlspecialchars(smarty_modifier_truncate($_smarty_tpl->tpl_vars['product']->value['name'],13,'...'), ENT_QUOTES, 'UTF-8', true);?>

                </a>
              </div>
              <?php if (isset($_smarty_tpl->tpl_vars['product']->value['attributes_small'])) {?>
                <div class="product-attributes">
                  <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getProductLink($_smarty_tpl->tpl_vars['product']->value,$_smarty_tpl->tpl_vars['product']->value['link_rewrite'],$_smarty_tpl->tpl_vars['product']->value['category'],null,null,$_smarty_tpl->tpl_vars['product']->value['id_shop'],$_smarty_tpl->tpl_vars['product']->value['id_product_attribute']), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'Product detail','mod'=>'blockcart'),$_smarty_tpl);?>
"><?php echo $_smarty_tpl->tpl_vars['product']->value['attributes_small'];?>
</a>
                </div>
              <?php }?>
              <div class="price">
                <?php if (!isset($_smarty_tpl->tpl_vars['product']->value['is_gift']) || !$_smarty_tpl->tpl_vars['product']->value['is_gift']) {?>
                  <?php if ($_smarty_tpl->tpl_vars['priceDisplay']->value == @constant('PS_TAX_EXC')) {
echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayWtPrice'][0][0]->displayWtPrice(array('p'=>((string)$_smarty_tpl->tpl_vars['product']->value['total'])),$_smarty_tpl);
} else {
echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayWtPrice'][0][0]->displayWtPrice(array('p'=>((string)$_smarty_tpl->tpl_vars['product']->value['total_wt'])),$_smarty_tpl);
}?>
                  <span class="hookDisplayProductPriceBlock-price">
                    <?php echo smartyHook(array('h'=>"displayProductPriceBlock",'product'=>$_smarty_tpl->tpl_vars['product']->value,'type'=>"price",'from'=>"blockcart"),$_smarty_tpl);?>

                  </span>
                <?php } else { ?>
                  <?php echo smartyTranslate(array('s'=>'Free!','mod'=>'blockcart'),$_smarty_tpl);?>

                <?php }?>
              </div>
            </div>
          </dt>

          <?php if (isset($_smarty_tpl->tpl_vars['product']->value['attributes_small'])) {?>
            <dd data-id="cart_block_combination_of_<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product']);
if ($_smarty_tpl->tpl_vars['product']->value['id_product_attribute']) {?>_<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product_attribute']);
}?>_<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_address_delivery']);?>
">
          <?php }?>

          <?php if (isset($_smarty_tpl->tpl_vars['customizedDatas']->value[$_smarty_tpl->tpl_vars['productId']->value][$_smarty_tpl->tpl_vars['productAttributeId']->value][$_smarty_tpl->tpl_vars['product']->value['id_address_delivery']])) {?>

            <?php if (!isset($_smarty_tpl->tpl_vars['product']->value['attributes_small'])) {?>
              <dd data-id="cart_block_combination_of_<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product']);?>
_<?php if ($_smarty_tpl->tpl_vars['product']->value['id_product_attribute']) {
echo intval($_smarty_tpl->tpl_vars['product']->value['id_product_attribute']);
} else { ?>0<?php }?>_<?php if ($_smarty_tpl->tpl_vars['product']->value['id_address_delivery']) {
echo intval($_smarty_tpl->tpl_vars['product']->value['id_address_delivery']);
} else { ?>0<?php }?>">
            <?php }?>

            <ul class="cart_block_customizations list-unstyled" data-id="customization_<?php echo $_smarty_tpl->tpl_vars['productId']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['productAttributeId']->value;?>
">
              <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['customizedDatas']->value[$_smarty_tpl->tpl_vars['productId']->value][$_smarty_tpl->tpl_vars['productAttributeId']->value][$_smarty_tpl->tpl_vars['product']->value['id_address_delivery']], 'customization', false, 'id_customization', 'customizations', array (
));
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['id_customization']->value => $_smarty_tpl->tpl_vars['customization']->value) {
?>
                <li name="customization">
                  <?php if (isset($_smarty_tpl->tpl_vars['customization']->value['datas'][$_smarty_tpl->tpl_vars['CUSTOMIZE_TEXTFIELD']->value][0])) {?>
                    <?php echo htmlspecialchars(smarty_modifier_truncate(smarty_modifier_replace($_smarty_tpl->tpl_vars['customization']->value['datas'][$_smarty_tpl->tpl_vars['CUSTOMIZE_TEXTFIELD']->value][0]['value'],"<br />"," "),28,'...'), ENT_QUOTES, 'UTF-8', true);?>

                  <?php } else { ?>
                    <?php echo smartyTranslate(array('s'=>'Customization #%d:','sprintf'=>intval($_smarty_tpl->tpl_vars['id_customization']->value),'mod'=>'blockcart'),$_smarty_tpl);?>

                  <?php }?>
                </li>
              <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

            </ul>

            <?php if (!isset($_smarty_tpl->tpl_vars['product']->value['attributes_small'])) {?></dd><?php }?>

          <?php }?>

          <?php if (isset($_smarty_tpl->tpl_vars['product']->value['attributes_small'])) {?></dd><?php }?>
        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

      </dl>
    <?php }?>

    <p class="cart_block_no_products"<?php if ($_smarty_tpl->tpl_vars['products']->value) {?> style="display: none;"<?php }?>>
      <?php echo smartyTranslate(array('s'=>'No products','mod'=>'blockcart'),$_smarty_tpl);?>

    </p>

    <?php if (!empty($_smarty_tpl->tpl_vars['discounts']->value)) {?>
      <table class="table vouchers">
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['discounts']->value, 'discount');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['discount']->value) {
?>
          <?php if ($_smarty_tpl->tpl_vars['discount']->value['value_real'] > 0) {?>
            <tr class="bloc_cart_voucher" data-id="bloc_cart_voucher_<?php echo intval($_smarty_tpl->tpl_vars['discount']->value['id_discount']);?>
">
              <td class="quantity">1 x</td>
              <td class="name" title="<?php echo $_smarty_tpl->tpl_vars['discount']->value['description'];?>
">
                <?php echo htmlspecialchars(smarty_modifier_truncate($_smarty_tpl->tpl_vars['discount']->value['name'],18,'...'), ENT_QUOTES, 'UTF-8', true);?>

              </td>
              <td class="price">
                -<?php if ($_smarty_tpl->tpl_vars['priceDisplay']->value == 1) {
echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0][0]->convertPrice(array('price'=>$_smarty_tpl->tpl_vars['discount']->value['value_tax_exc']),$_smarty_tpl);
} else {
echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0][0]->convertPrice(array('price'=>$_smarty_tpl->tpl_vars['discount']->value['value_real']),$_smarty_tpl);
}?>
              </td>
              <td class="delete">
                <?php if (strlen($_smarty_tpl->tpl_vars['discount']->value['code'])) {?>
                  <a class="delete_voucher" href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getPageLink(((string)$_smarty_tpl->tpl_vars['order_process']->value),true);?>
?deleteDiscount=<?php echo intval($_smarty_tpl->tpl_vars['discount']->value['id_discount']);?>
" title="<?php echo smartyTranslate(array('s'=>'Delete','mod'=>'blockcart'),$_smarty_tpl);?>
" rel="nofollow">
                    <i class="icon icon-times"></i>
                  </a>
                <?php }?>
              </td>
            </tr>
          <?php }?>
        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

      </table>
    <?php }?>

    <?php $_smarty_tpl->_assignInScope('free_ship', count($_smarty_tpl->tpl_vars['cart']->value->getDeliveryAddressesWithoutCarriers(true,$_smarty_tpl->tpl_vars['errors']->value)));
?>

    <div class="cart-prices">

      <div class="cart-prices-line" <?php if (!($_smarty_tpl->tpl_vars['page_name']->value == 'order-opc') && $_smarty_tpl->tpl_vars['shipping_cost_float']->value == 0 && (!$_smarty_tpl->tpl_vars['cart_qties']->value || $_smarty_tpl->tpl_vars['cart']->value->isVirtualCart() || !isset($_smarty_tpl->tpl_vars['cart']->value->id_address_delivery) || !$_smarty_tpl->tpl_vars['cart']->value->id_address_delivery || $_smarty_tpl->tpl_vars['free_ship']->value)) {?> style="display: none;"<?php }?>>
        <span><?php echo smartyTranslate(array('s'=>'Shipping','mod'=>'blockcart'),$_smarty_tpl);?>
</span>
        <span class="price cart_block_shipping_cost ajax_cart_shipping_cost">
          <?php if ($_smarty_tpl->tpl_vars['shipping_cost_float']->value == 0) {?>
            <?php if (!($_smarty_tpl->tpl_vars['page_name']->value == 'order-opc') && (!isset($_smarty_tpl->tpl_vars['cart']->value->id_address_delivery) || !$_smarty_tpl->tpl_vars['cart']->value->id_address_delivery)) {
echo smartyTranslate(array('s'=>'To be determined','mod'=>'blockcart'),$_smarty_tpl);
} else {
echo smartyTranslate(array('s'=>'Free shipping!','mod'=>'blockcart'),$_smarty_tpl);
}?>
          <?php } else { ?>
            <?php echo $_smarty_tpl->tpl_vars['shipping_cost']->value;?>

          <?php }?>
        </span>
      </div>

      <?php if ($_smarty_tpl->tpl_vars['show_wrapping']->value) {?>
        <div class="cart-prices-line">
          <?php $_smarty_tpl->_assignInScope('cart_flag', constant('Cart::ONLY_WRAPPING'));
?>
          <span><?php echo smartyTranslate(array('s'=>'Wrapping','mod'=>'blockcart'),$_smarty_tpl);?>
</span>
          <span class="price ajax_block_wrapping_cost cart_block_wrapping_cost">
            <?php if ($_smarty_tpl->tpl_vars['priceDisplay']->value == 1) {?>
              <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0][0]->convertPrice(array('price'=>$_smarty_tpl->tpl_vars['cart']->value->getOrderTotal(false,$_smarty_tpl->tpl_vars['cart_flag']->value)),$_smarty_tpl);
} else {
echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0][0]->convertPrice(array('price'=>$_smarty_tpl->tpl_vars['cart']->value->getOrderTotal(true,$_smarty_tpl->tpl_vars['cart_flag']->value)),$_smarty_tpl);?>

            <?php }?>
          </span>
        </div>
      <?php }?>

      <?php if ($_smarty_tpl->tpl_vars['show_tax']->value && isset($_smarty_tpl->tpl_vars['tax_cost']->value)) {?>
        <div class="cart-prices-line">
          <span><?php echo smartyTranslate(array('s'=>'Tax','mod'=>'blockcart'),$_smarty_tpl);?>
</span>
          <span class="price cart_block_tax_cost ajax_cart_tax_cost"><?php echo $_smarty_tpl->tpl_vars['tax_cost']->value;?>
</span>
        </div>
      <?php }?>

      <div class="cart-prices-line">
        <span><?php echo smartyTranslate(array('s'=>'Total','mod'=>'blockcart'),$_smarty_tpl);?>
</span>
        <span class="price cart_block_total ajax_block_cart_total"><?php echo $_smarty_tpl->tpl_vars['total']->value;?>
</span>
      </div>

      <?php if ($_smarty_tpl->tpl_vars['use_taxes']->value && $_smarty_tpl->tpl_vars['display_tax_label']->value && $_smarty_tpl->tpl_vars['show_tax']->value) {?>
        <div class="cart-prices-line">
          <?php if ($_smarty_tpl->tpl_vars['priceDisplay']->value == 0) {?>
            <?php echo smartyTranslate(array('s'=>'Prices are tax included','mod'=>'blockcart'),$_smarty_tpl);?>

          <?php } elseif ($_smarty_tpl->tpl_vars['priceDisplay']->value == 1) {?>
            <?php echo smartyTranslate(array('s'=>'Prices are tax excluded','mod'=>'blockcart'),$_smarty_tpl);?>

          <?php }?>
        </div>
      <?php }?>

    </div>

    <div class="cart-buttons">
      <a id="button_order_cart" class="btn btn-block btn-success" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink(((string)$_smarty_tpl->tpl_vars['order_process']->value),true), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'Check out','mod'=>'blockcart'),$_smarty_tpl);?>
" rel="nofollow">
        <?php echo smartyTranslate(array('s'=>'Check out','mod'=>'blockcart'),$_smarty_tpl);?>
 <i class="icon icon-angle-right"></i>
      </a>
    </div>

  </div>
</div>
<?php }
}
