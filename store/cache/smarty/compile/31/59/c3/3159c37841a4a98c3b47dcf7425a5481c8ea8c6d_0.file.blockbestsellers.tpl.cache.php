<?php
/* Smarty version 3.1.31, created on 2021-03-02 07:40:25
  from "/home/sexthera/public_html/mohope.web.za/store/themes/niara/modules/blockbestsellers/blockbestsellers.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_603e3239ce0f67_16419958',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3159c37841a4a98c3b47dcf7425a5481c8ea8c6d' => 
    array (
      0 => '/home/sexthera/public_html/mohope.web.za/store/themes/niara/modules/blockbestsellers/blockbestsellers.tpl',
      1 => 1563910602,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_603e3239ce0f67_16419958 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '322004547603e3239cb8a37_37619836';
?>


<!-- MODULE Block best sellers -->
<div class="tm-home col-xs-12">
<?php if (isset($_smarty_tpl->tpl_vars['best_sellers']->value) && $_smarty_tpl->tpl_vars['best_sellers']->value) {?>
  <div class="tm-hp text-center">
    <h2><span class="tm-over"><?php echo smartyTranslate(array('s'=>'What others','mod'=>'blockbestsellers'),$_smarty_tpl);?>
 <span><?php echo smartyTranslate(array('s'=>'love','mod'=>'blockbestsellers'),$_smarty_tpl);?>
</span> <?php echo smartyTranslate(array('s'=>'most'),$_smarty_tpl);?>
</span></h2>
    <p><?php echo smartyTranslate(array('s'=>'Browse our top selling products.','mod'=>'blockbestsellers'),$_smarty_tpl);?>
</p>
  </div>
  <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./product-list.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array('products'=>$_smarty_tpl->tpl_vars['best_sellers']->value,'class'=>'blockbestsellers','id'=>'blockbestsellers'), 0, true);
?>

<?php } else { ?>
  <ul id="blockbestsellers" class="blockbestsellers">
    <li class="alert alert-info"><?php echo smartyTranslate(array('s'=>'No best sellers at this time11.','mod'=>'blockbestsellers'),$_smarty_tpl);?>
</li>
  </ul>
<?php }?>
</div>
<!-- /MODULE Block best sellers -->
<?php }
}
