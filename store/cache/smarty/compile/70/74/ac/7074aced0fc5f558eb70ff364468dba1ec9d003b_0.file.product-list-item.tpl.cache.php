<?php
/* Smarty version 3.1.31, created on 2021-03-02 07:32:22
  from "/home/sexthera/public_html/mohope.web.za/store/themes/niara/product-list-item.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_603e305665d885_06609720',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7074aced0fc5f558eb70ff364468dba1ec9d003b' => 
    array (
      0 => '/home/sexthera/public_html/mohope.web.za/store/themes/niara/product-list-item.tpl',
      1 => 1563910602,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_603e305665d885_06609720 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '1820599498603e30565bb819_87206201';
?>
<article>
    <div class="product-container" itemscope itemtype="https://schema.org/Product">
        <div class="product-image-container">
            <a class="product_img_link"
               href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['link'], ENT_QUOTES, 'UTF-8', true);?>
"
               title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
"
               itemprop="url"
            >
              <?php if (!empty($_smarty_tpl->tpl_vars['lazy_load']->value)) {?>
                <noscript>
                  <img class="img-responsive center-block"
                       src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getImageLink($_smarty_tpl->tpl_vars['product']->value['link_rewrite'],$_smarty_tpl->tpl_vars['product']->value['id_image'],'home',null,ImageManager::retinaSupport()), ENT_QUOTES, 'UTF-8', true);?>
"
                       srcset="
                     <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getImageLink($_smarty_tpl->tpl_vars['product']->value['link_rewrite'],$_smarty_tpl->tpl_vars['product']->value['id_image'],'home_smallest',null,ImageManager::retinaSupport()), ENT_QUOTES, 'UTF-8', true);?>
 211w,
                     <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getImageLink($_smarty_tpl->tpl_vars['product']->value['link_rewrite'],$_smarty_tpl->tpl_vars['product']->value['id_image'],'home_smaller',null,ImageManager::retinaSupport()), ENT_QUOTES, 'UTF-8', true);?>
 218w,
                     <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getImageLink($_smarty_tpl->tpl_vars['product']->value['link_rewrite'],$_smarty_tpl->tpl_vars['product']->value['id_image'],'home',null,ImageManager::retinaSupport()), ENT_QUOTES, 'UTF-8', true);?>
 250w"
                       sizes="(min-width: 1200px) 250px, (min-width: 992px) 218px, (min-width: 768px) 211px, 250px"
                       alt="<?php if (!empty($_smarty_tpl->tpl_vars['product']->value['legend'])) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['legend'], ENT_QUOTES, 'UTF-8', true);
} else {
echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['name'], ENT_QUOTES, 'UTF-8', true);
}?>"
                       title="<?php if (!empty($_smarty_tpl->tpl_vars['product']->value['legend'])) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['legend'], ENT_QUOTES, 'UTF-8', true);
} else {
echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['name'], ENT_QUOTES, 'UTF-8', true);
}?>"
                       itemprop="image"
                       width="<?php echo intval($_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['getWidthSize'][0][0]->getWidth(array('type'=>'home'),$_smarty_tpl));?>
"
                       height="<?php echo intval($_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['getHeightSize'][0][0]->getHeight(array('type'=>'home'),$_smarty_tpl));?>
"
                  >
                </noscript>
              <?php }?>
              <picture <?php if ($_smarty_tpl->tpl_vars['lazy_load']->value) {?>class="tb-lazy-image"<?php }?>>
                <!--[if IE 9]><video style="display: none;"><![endif]-->
                <?php if (!empty($_smarty_tpl->tpl_vars['webp']->value)) {?>
                  <source class="img-responsive center-block"
                          <?php if (!empty($_smarty_tpl->tpl_vars['lazy_load']->value)) {?>srcset="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII= 1w" data-<?php }?>srcset="
                          <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getImageLink($_smarty_tpl->tpl_vars['product']->value['link_rewrite'],$_smarty_tpl->tpl_vars['product']->value['id_image'],'home_smallest','webp',ImageManager::retinaSupport()), ENT_QUOTES, 'UTF-8', true);?>
 211w,
                          <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getImageLink($_smarty_tpl->tpl_vars['product']->value['link_rewrite'],$_smarty_tpl->tpl_vars['product']->value['id_image'],'home_smaller','webp',ImageManager::retinaSupport()), ENT_QUOTES, 'UTF-8', true);?>
 218w,
                          <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getImageLink($_smarty_tpl->tpl_vars['product']->value['link_rewrite'],$_smarty_tpl->tpl_vars['product']->value['id_image'],'home','webp',ImageManager::retinaSupport()), ENT_QUOTES, 'UTF-8', true);?>
 250w"
                          sizes="(min-width: 1200px) 250px, (min-width: 992px) 218px, (min-width: 768px) 211px, 250px"
                          title="<?php if (!empty($_smarty_tpl->tpl_vars['product']->value['legend'])) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['legend'], ENT_QUOTES, 'UTF-8', true);
} else {
echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['name'], ENT_QUOTES, 'UTF-8', true);
}?>"
                          type="image/webp"
                          itemprop="image"
                  >
                <?php }?>
                <!--[if IE 9]></video><![endif]-->

                <img class="img-responsive center-block"
                     <?php if (!empty($_smarty_tpl->tpl_vars['lazy_load']->value)) {?>src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII="<?php }?>
                     <?php if (!empty($_smarty_tpl->tpl_vars['lazy_load']->value)) {?>srcset="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII= 1w" data-<?php }?>srcset="
                     <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getImageLink($_smarty_tpl->tpl_vars['product']->value['link_rewrite'],$_smarty_tpl->tpl_vars['product']->value['id_image'],'home_smallest',null,ImageManager::retinaSupport()), ENT_QUOTES, 'UTF-8', true);?>
 211w,
                     <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getImageLink($_smarty_tpl->tpl_vars['product']->value['link_rewrite'],$_smarty_tpl->tpl_vars['product']->value['id_image'],'home_smaller',null,ImageManager::retinaSupport()), ENT_QUOTES, 'UTF-8', true);?>
 218w,
                     <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getImageLink($_smarty_tpl->tpl_vars['product']->value['link_rewrite'],$_smarty_tpl->tpl_vars['product']->value['id_image'],'home',null,ImageManager::retinaSupport()), ENT_QUOTES, 'UTF-8', true);?>
 250w"
                     sizes="(min-width: 1200px) 250px, (min-width: 992px) 218px, (min-width: 768px) 211px, 250px"
                     alt="<?php if (!empty($_smarty_tpl->tpl_vars['product']->value['legend'])) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['legend'], ENT_QUOTES, 'UTF-8', true);
} else {
echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['name'], ENT_QUOTES, 'UTF-8', true);
}?>"
                     title="<?php if (!empty($_smarty_tpl->tpl_vars['product']->value['legend'])) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['legend'], ENT_QUOTES, 'UTF-8', true);
} else {
echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['name'], ENT_QUOTES, 'UTF-8', true);
}?>"
                     itemprop="image"
                     width="<?php echo intval($_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['getWidthSize'][0][0]->getWidth(array('type'=>'home'),$_smarty_tpl));?>
"
                     height="<?php echo intval($_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['getHeightSize'][0][0]->getHeight(array('type'=>'home'),$_smarty_tpl));?>
"
                >
                <?php echo smartyHook(array('h'=>'productImageHover','id_product'=>$_smarty_tpl->tpl_vars['product']->value['id_product']),$_smarty_tpl);?>

                <?php if (isset($_smarty_tpl->tpl_vars['quick_view']->value) && $_smarty_tpl->tpl_vars['quick_view']->value) {?>
                <a class="quick-view show-if-product-item-hover"
                   href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['link'], ENT_QUOTES, 'UTF-8', true);?>
"
                   title="<?php echo smartyTranslate(array('s'=>'Open quick view window'),$_smarty_tpl);?>
"
                   data-fancybox-target="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['link'], ENT_QUOTES, 'UTF-8', true);?>
"
                >
                    <i class="icon icon-fullscreen"></i>
                </a>
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['show_functional_buttons']->value) {?>
                <div class="functional-buttons clearfix show-if-product-grid-hover">
                    <?php echo smartyHook(array('h'=>'displayProductListFunctionalButtons','product'=>$_smarty_tpl->tpl_vars['product']->value),$_smarty_tpl);?>

                    <?php if (isset($_smarty_tpl->tpl_vars['comparator_max_item']->value) && $_smarty_tpl->tpl_vars['comparator_max_item']->value) {?>
                        <div class="compare">
                            <a class="add_to_compare" title="<?php echo smartyTranslate(array('s'=>'Add to Compare'),$_smarty_tpl);?>
" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['link'], ENT_QUOTES, 'UTF-8', true);?>
"
                               data-id-product="<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
">
                                <i class="icon icon-plus"></i> <?php echo smartyTranslate(array('s'=>'Add to Compare'),$_smarty_tpl);?>

                            </a>
                        </div>
                    <?php }?>
                </div>
            <?php }?>
              </picture>
            </a>

            <div class="product-label-container">
                <?php if ((!$_smarty_tpl->tpl_vars['PS_CATALOG_MODE']->value && ((isset($_smarty_tpl->tpl_vars['product']->value['show_price']) && $_smarty_tpl->tpl_vars['product']->value['show_price']) || (isset($_smarty_tpl->tpl_vars['product']->value['available_for_order']) && $_smarty_tpl->tpl_vars['product']->value['available_for_order'])))) {?>
                    <?php if (isset($_smarty_tpl->tpl_vars['product']->value['online_only']) && $_smarty_tpl->tpl_vars['product']->value['online_only']) {?>
                        <span class="product-label product-label-online"><?php echo smartyTranslate(array('s'=>'Online only'),$_smarty_tpl);?>
</span>
                    <?php }?>
                <?php }?>
                <?php if (isset($_smarty_tpl->tpl_vars['product']->value['new']) && $_smarty_tpl->tpl_vars['product']->value['new'] == 1) {?>
                    <span class="product-label product-label-new"><?php echo smartyTranslate(array('s'=>'New'),$_smarty_tpl);?>
</span>
                <?php }?>
                <?php if (isset($_smarty_tpl->tpl_vars['product']->value['on_sale']) && $_smarty_tpl->tpl_vars['product']->value['on_sale'] && isset($_smarty_tpl->tpl_vars['product']->value['show_price']) && $_smarty_tpl->tpl_vars['product']->value['show_price'] && !$_smarty_tpl->tpl_vars['PS_CATALOG_MODE']->value) {?>
                    <span class="product-label product-label-sale"><?php echo smartyTranslate(array('s'=>'Sale!'),$_smarty_tpl);?>
</span>
                <?php } elseif (isset($_smarty_tpl->tpl_vars['product']->value['reduction']) && $_smarty_tpl->tpl_vars['product']->value['reduction'] && isset($_smarty_tpl->tpl_vars['product']->value['show_price']) && $_smarty_tpl->tpl_vars['product']->value['show_price'] && !$_smarty_tpl->tpl_vars['PS_CATALOG_MODE']->value) {?>
                    <span class="product-label product-label-discount"><?php echo smartyTranslate(array('s'=>'Reduced price!'),$_smarty_tpl);?>
</span>
                <?php }?>
            </div>

        </div>

        <div class="product-description-container">
            <h3 class="h4 product-name" itemprop="name">
                <?php if (isset($_smarty_tpl->tpl_vars['product']->value['pack_quantity']) && $_smarty_tpl->tpl_vars['product']->value['pack_quantity']) {
echo (intval($_smarty_tpl->tpl_vars['product']->value['pack_quantity'])).(' x ');
}?>
                <a class="product-name" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['link'], ENT_QUOTES, 'UTF-8', true);?>
"
                   title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
" itemprop="url">
                    <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['name'], ENT_QUOTES, 'UTF-8', true);?>

                </a>
            </h3>
            <?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'displayProductListReviews', null, null);
echo smartyHook(array('h'=>'displayProductListReviews','product'=>$_smarty_tpl->tpl_vars['product']->value),$_smarty_tpl);
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
            <?php if ($_smarty_tpl->smarty->ext->_capture->getBuffer($_smarty_tpl, 'displayProductListReviews')) {?>
                <div class="hook-reviews">
                    <?php echo $_smarty_tpl->smarty->ext->_capture->getBuffer($_smarty_tpl, 'displayProductListReviews');?>

                </div>
            <?php }?>

            <?php if (isset($_smarty_tpl->tpl_vars['product']->value['is_virtual']) && !$_smarty_tpl->tpl_vars['product']->value['is_virtual']) {
echo smartyHook(array('h'=>"displayProductDeliveryTime",'product'=>$_smarty_tpl->tpl_vars['product']->value),$_smarty_tpl);
}?>
            <?php echo smartyHook(array('h'=>"displayProductPriceBlock",'product'=>$_smarty_tpl->tpl_vars['product']->value,'type'=>"weight"),$_smarty_tpl);?>


            <p class="product-desc hide-if-product-grid" itemprop="description">
                <?php echo smarty_modifier_truncate(strip_tags($_smarty_tpl->tpl_vars['product']->value['description_short']),360,'...');?>

            </p>
        </div>

        <div class="product-actions-container">

            <div class="product-price-button-wrapper">
                <?php if ((!$_smarty_tpl->tpl_vars['PS_CATALOG_MODE']->value && ((isset($_smarty_tpl->tpl_vars['product']->value['show_price']) && $_smarty_tpl->tpl_vars['product']->value['show_price']) || (isset($_smarty_tpl->tpl_vars['product']->value['available_for_order']) && $_smarty_tpl->tpl_vars['product']->value['available_for_order'])))) {?>
                    <div class="content_price">
                        <?php if (isset($_smarty_tpl->tpl_vars['product']->value['show_price']) && $_smarty_tpl->tpl_vars['product']->value['show_price'] && !isset($_smarty_tpl->tpl_vars['restricted_country_mode']->value)) {?>
                            <?php echo smartyHook(array('h'=>"displayProductPriceBlock",'product'=>$_smarty_tpl->tpl_vars['product']->value,'type'=>'before_price'),$_smarty_tpl);?>

                            <span class="price product-price">
              <?php if (!$_smarty_tpl->tpl_vars['priceDisplay']->value) {
echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0][0]->convertPrice(array('price'=>$_smarty_tpl->tpl_vars['product']->value['price']),$_smarty_tpl);
} else {
echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0][0]->convertPrice(array('price'=>$_smarty_tpl->tpl_vars['product']->value['price_tax_exc']),$_smarty_tpl);
}?>
            </span>
                            <?php if ($_smarty_tpl->tpl_vars['product']->value['price_without_reduction'] > 0 && isset($_smarty_tpl->tpl_vars['product']->value['specific_prices']) && $_smarty_tpl->tpl_vars['product']->value['specific_prices'] && isset($_smarty_tpl->tpl_vars['product']->value['specific_prices']['reduction']) && $_smarty_tpl->tpl_vars['product']->value['specific_prices']['reduction'] > 0) {?>
                                <?php echo smartyHook(array('h'=>"displayProductPriceBlock",'product'=>$_smarty_tpl->tpl_vars['product']->value,'type'=>"old_price"),$_smarty_tpl);?>

                                <span class="old-price product-price">
                <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayWtPrice'][0][0]->displayWtPrice(array('p'=>$_smarty_tpl->tpl_vars['product']->value['price_without_reduction']),$_smarty_tpl);?>

              </span>
                                <?php echo smartyHook(array('h'=>"displayProductPriceBlock",'id_product'=>$_smarty_tpl->tpl_vars['product']->value['id_product'],'type'=>"old_price"),$_smarty_tpl);?>

                                <?php if ($_smarty_tpl->tpl_vars['product']->value['specific_prices']['reduction_type'] == 'percentage') {?>
                                    <span class="price-percent-reduction">-<?php echo $_smarty_tpl->tpl_vars['product']->value['specific_prices']['reduction']*100;?>

                                        %</span>
                                <?php }?>
                            <?php }?>
                            <?php echo smartyHook(array('h'=>"displayProductPriceBlock",'product'=>$_smarty_tpl->tpl_vars['product']->value,'type'=>"price"),$_smarty_tpl);?>

                            <?php echo smartyHook(array('h'=>"displayProductPriceBlock",'product'=>$_smarty_tpl->tpl_vars['product']->value,'type'=>"unit_price"),$_smarty_tpl);?>

                            <?php echo smartyHook(array('h'=>"displayProductPriceBlock",'product'=>$_smarty_tpl->tpl_vars['product']->value,'type'=>'after_price'),$_smarty_tpl);?>

                        <?php }?>
                    </div>
                <?php }?>
                <div class="button-container">
                    <?php if (($_smarty_tpl->tpl_vars['product']->value['id_product_attribute'] == 0 || (isset($_smarty_tpl->tpl_vars['add_prod_display']->value) && ($_smarty_tpl->tpl_vars['add_prod_display']->value == 1))) && $_smarty_tpl->tpl_vars['product']->value['available_for_order'] && !isset($_smarty_tpl->tpl_vars['restricted_country_mode']->value) && $_smarty_tpl->tpl_vars['product']->value['customizable'] != 2 && !$_smarty_tpl->tpl_vars['PS_CATALOG_MODE']->value) {?>
                        <?php if ((!isset($_smarty_tpl->tpl_vars['product']->value['customization_required']) || !$_smarty_tpl->tpl_vars['product']->value['customization_required']) && ($_smarty_tpl->tpl_vars['product']->value['allow_oosp'] || $_smarty_tpl->tpl_vars['product']->value['quantity'] > 0)) {?>
                            <?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', null, null);?>add=1&amp;id_product=<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product']);
if (isset($_smarty_tpl->tpl_vars['product']->value['id_product_attribute']) && $_smarty_tpl->tpl_vars['product']->value['id_product_attribute']) {?>&amp;ipa=<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product_attribute']);
}
if (isset($_smarty_tpl->tpl_vars['static_token']->value)) {?>&amp;token=<?php echo $_smarty_tpl->tpl_vars['static_token']->value;
}
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
                            <a class="ajax_add_to_cart_button btn btn-primary"
                               href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('cart',true,NULL,$_smarty_tpl->smarty->ext->_capture->getBuffer($_smarty_tpl, 'default'),false), ENT_QUOTES, 'UTF-8', true);?>
"
                               rel="nofollow" title="<?php echo smartyTranslate(array('s'=>'Add to cart'),$_smarty_tpl);?>
"
                               data-id-product-attribute="<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product_attribute']);?>
"
                               data-id-product="<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product']);?>
"
                               data-minimal_quantity="<?php if (isset($_smarty_tpl->tpl_vars['product']->value['product_attribute_minimal_quantity']) && $_smarty_tpl->tpl_vars['product']->value['product_attribute_minimal_quantity'] >= 1) {
echo intval($_smarty_tpl->tpl_vars['product']->value['product_attribute_minimal_quantity']);
} else {
echo intval($_smarty_tpl->tpl_vars['product']->value['minimal_quantity']);
}?>">

                                <span><i class="icon icon-shopping-basket"></i><?php echo smartyTranslate(array('s'=>'Add to cart'),$_smarty_tpl);?>
</span>
                            </a>
                        <?php } else { ?>
                            <span class="ajax_add_to_cart_button btn btn-primary disabled">
              <span><i class="icon icon-shopping-basket"></i><?php echo smartyTranslate(array('s'=>'Add to cart'),$_smarty_tpl);?>
</span>
            </span>
                        <?php }?>
                    <?php }?>
                    <!--<a class="btn btn-default" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['link'], ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'View'),$_smarty_tpl);?>
">
                        <span><?php if ((isset($_smarty_tpl->tpl_vars['product']->value['customization_required']) && $_smarty_tpl->tpl_vars['product']->value['customization_required'])) {
echo smartyTranslate(array('s'=>'Customize'),$_smarty_tpl);
} else {
echo smartyTranslate(array('s'=>'More'),$_smarty_tpl);
}?></span>
                    </a>-->
                </div>
                <?php if ($_smarty_tpl->tpl_vars['show_functional_buttons']->value) {?>
                <div class="compare_mb">
                    <?php if (isset($_smarty_tpl->tpl_vars['comparator_max_item']->value) && $_smarty_tpl->tpl_vars['comparator_max_item']->value) {?>
                        <div class="compare">
                            <a class="add_to_compare" title="<?php echo smartyTranslate(array('s'=>'Add to Compare'),$_smarty_tpl);?>
" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['link'], ENT_QUOTES, 'UTF-8', true);?>
"
                               data-id-product="<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
">
                                <i class="icon icon-plus"></i> <?php echo smartyTranslate(array('s'=>'Add to Compare'),$_smarty_tpl);?>

                            </a>
                        </div>
                    <?php }?>
                </div>
            <?php }?>
            </div>

            <?php if (isset($_smarty_tpl->tpl_vars['product']->value['color_list'])) {?>
                <div class="color-list-container"><?php echo $_smarty_tpl->tpl_vars['product']->value['color_list'];?>
</div>
            <?php }?>
            <?php if ((!$_smarty_tpl->tpl_vars['PS_CATALOG_MODE']->value && $_smarty_tpl->tpl_vars['PS_STOCK_MANAGEMENT']->value && ((isset($_smarty_tpl->tpl_vars['product']->value['show_price']) && $_smarty_tpl->tpl_vars['product']->value['show_price']) || (isset($_smarty_tpl->tpl_vars['product']->value['available_for_order']) && $_smarty_tpl->tpl_vars['product']->value['available_for_order'])))) {?>
                <?php if (isset($_smarty_tpl->tpl_vars['product']->value['available_for_order']) && $_smarty_tpl->tpl_vars['product']->value['available_for_order'] && !isset($_smarty_tpl->tpl_vars['restricted_country_mode']->value)) {?>
                    <div class="availability">
                        <?php if (($_smarty_tpl->tpl_vars['product']->value['allow_oosp'] || $_smarty_tpl->tpl_vars['product']->value['quantity'] > 0)) {?>
                            <span class="label <?php if ($_smarty_tpl->tpl_vars['product']->value['quantity'] <= 0 && isset($_smarty_tpl->tpl_vars['product']->value['allow_oosp']) && !$_smarty_tpl->tpl_vars['product']->value['allow_oosp']) {?> label-danger<?php } elseif ($_smarty_tpl->tpl_vars['product']->value['quantity'] <= 0) {?> label-warning<?php } else { ?> label-success<?php }?>">
              <?php if ($_smarty_tpl->tpl_vars['product']->value['quantity'] <= 0) {
if ($_smarty_tpl->tpl_vars['product']->value['allow_oosp']) {
if (isset($_smarty_tpl->tpl_vars['product']->value['available_later']) && $_smarty_tpl->tpl_vars['product']->value['available_later']) {
echo $_smarty_tpl->tpl_vars['product']->value['available_later'];
} else {
echo smartyTranslate(array('s'=>'In Stock'),$_smarty_tpl);
}
} else {
echo smartyTranslate(array('s'=>'Out of stock'),$_smarty_tpl);
}
} else {
if (isset($_smarty_tpl->tpl_vars['product']->value['available_now']) && $_smarty_tpl->tpl_vars['product']->value['available_now']) {
echo $_smarty_tpl->tpl_vars['product']->value['available_now'];
} else {
echo smartyTranslate(array('s'=>'In Stock'),$_smarty_tpl);
}
}?>
            </span>
                        <?php } elseif ((isset($_smarty_tpl->tpl_vars['product']->value['quantity_all_versions']) && $_smarty_tpl->tpl_vars['product']->value['quantity_all_versions'] > 0)) {?>
                            <span class="label label-warning"><?php echo smartyTranslate(array('s'=>'Product available with different options'),$_smarty_tpl);?>
</span>
                        <?php } else { ?>
                            <span class="label label-danger"><?php echo smartyTranslate(array('s'=>'Out of stock'),$_smarty_tpl);?>
</span>
                        <?php }?>
                    </div>
                <?php }?>
            <?php }?>
        </div>

    </div>
</article>
<?php }
}
