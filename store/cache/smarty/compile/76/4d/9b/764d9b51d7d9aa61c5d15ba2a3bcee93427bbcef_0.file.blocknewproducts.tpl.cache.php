<?php
/* Smarty version 3.1.31, created on 2021-03-02 07:40:25
  from "/home/sexthera/public_html/mohope.web.za/store/themes/niara/modules/blocknewproducts/views/templates/hook/blocknewproducts.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_603e3239dc40a8_24954611',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '764d9b51d7d9aa61c5d15ba2a3bcee93427bbcef' => 
    array (
      0 => '/home/sexthera/public_html/mohope.web.za/store/themes/niara/modules/blocknewproducts/views/templates/hook/blocknewproducts.tpl',
      1 => 1563910602,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_603e3239dc40a8_24954611 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '1064346783603e3239dacc98_79430745';
?>


<!-- MODULE Block new products -->
<div id="new-products_block_right" class="block products_block">
	<h4 class="title_block"><a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('new-products'), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'New products','mod'=>'blocknewproducts'),$_smarty_tpl);?>
"><?php echo smartyTranslate(array('s'=>'New products','mod'=>'blocknewproducts'),$_smarty_tpl);?>
</a></h4>
	<div class="block_content">
	<?php if ($_smarty_tpl->tpl_vars['new_products']->value !== false) {?>
		<ul class="product_images clearfix">
		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['new_products']->value, 'product', false, NULL, 'newProducts', array (
  'index' => true,
  'first' => true,
));
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['product']->value) {
$_smarty_tpl->tpl_vars['__smarty_foreach_newProducts']->value['index']++;
$_smarty_tpl->tpl_vars['__smarty_foreach_newProducts']->value['first'] = !$_smarty_tpl->tpl_vars['__smarty_foreach_newProducts']->value['index'];
?>
			<?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_newProducts']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_newProducts']->value['index'] : null) < 2) {?>
				<li<?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_newProducts']->value['first']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_newProducts']->value['first'] : null)) {?> class="first"<?php }?>><a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['link'], ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['legend'], ENT_QUOTES, 'UTF-8', true);?>
"><img src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getImageLink($_smarty_tpl->tpl_vars['product']->value['link_rewrite'],$_smarty_tpl->tpl_vars['product']->value['id_image'],'medium_default'), ENT_QUOTES, 'UTF-8', true);?>
" height="<?php echo $_smarty_tpl->tpl_vars['mediumSize']->value['height'];?>
" width="<?php echo $_smarty_tpl->tpl_vars['mediumSize']->value['width'];?>
" alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['legend'], ENT_QUOTES, 'UTF-8', true);?>
" /></a></li>
			<?php }?>
		<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

		</ul>
		<dl class="products">
		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['new_products']->value, 'newproduct', false, NULL, 'myLoop', array (
  'first' => true,
  'last' => true,
  'index' => true,
  'iteration' => true,
  'total' => true,
));
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['newproduct']->value) {
$_smarty_tpl->tpl_vars['__smarty_foreach_myLoop']->value['iteration']++;
$_smarty_tpl->tpl_vars['__smarty_foreach_myLoop']->value['index']++;
$_smarty_tpl->tpl_vars['__smarty_foreach_myLoop']->value['first'] = !$_smarty_tpl->tpl_vars['__smarty_foreach_myLoop']->value['index'];
$_smarty_tpl->tpl_vars['__smarty_foreach_myLoop']->value['last'] = $_smarty_tpl->tpl_vars['__smarty_foreach_myLoop']->value['iteration'] == $_smarty_tpl->tpl_vars['__smarty_foreach_myLoop']->value['total'];
?>
			<dt class="<?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_myLoop']->value['first']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_myLoop']->value['first'] : null)) {?>first_item<?php } elseif ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_myLoop']->value['last']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_myLoop']->value['last'] : null)) {?>last_item<?php } else { ?>item<?php }?>"><a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['newproduct']->value['link'], ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['newproduct']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
"><?php echo htmlspecialchars(preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['newproduct']->value['name']), ENT_QUOTES, 'UTF-8', true);?>
</a></dt>
			<?php if ($_smarty_tpl->tpl_vars['newproduct']->value['description_short']) {?><dd class="<?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_myLoop']->value['first']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_myLoop']->value['first'] : null)) {?>first_item<?php } elseif ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_myLoop']->value['last']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_myLoop']->value['last'] : null)) {?>last_item<?php } else { ?>item<?php }?>"><a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['newproduct']->value['link'], ENT_QUOTES, 'UTF-8', true);?>
"><?php echo smarty_modifier_truncate(strip_tags($_smarty_tpl->tpl_vars['newproduct']->value['description_short']),75,'...');?>
</a><br /><a href="<?php echo $_smarty_tpl->tpl_vars['newproduct']->value['link'];?>
" class="lnk_more"><?php echo smartyTranslate(array('s'=>'Read more','mod'=>'blocknewproducts'),$_smarty_tpl);?>
</a></dd><?php }?>
		<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

		</dl>
		<p><a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('new-products'), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'All new products','mod'=>'blocknewproducts'),$_smarty_tpl);?>
" class="button_large">&raquo; <?php echo smartyTranslate(array('s'=>'All new products','mod'=>'blocknewproducts'),$_smarty_tpl);?>
</a></p>
	<?php } else { ?>
		<p>&raquo; <?php echo smartyTranslate(array('s'=>'Do not allow new products at this time.','mod'=>'blocknewproducts'),$_smarty_tpl);?>
</p>
	<?php }?>
	</div>
</div>
<!-- /MODULE Block new products -->
<?php }
}
