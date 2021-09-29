<?php
/* Smarty version 3.1.31, created on 2021-03-02 07:32:22
  from "/home/sexthera/public_html/mohope.web.za/store/themes/niara/modules/blockbestsellers/blockbestsellers-home.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_603e30566c2583_23178975',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '464f2814e94280548b54f56890fe16730ca27813' => 
    array (
      0 => '/home/sexthera/public_html/mohope.web.za/store/themes/niara/modules/blockbestsellers/blockbestsellers-home.tpl',
      1 => 1563910602,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_603e30566c2583_23178975 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '1396184370603e30566bd3b0_92229459';
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
    <li class="alert alert-info"><?php echo smartyTranslate(array('s'=>'No best sellers at this time.','mod'=>'blockbestsellers'),$_smarty_tpl);?>
</li>
  </ul>
<?php }?>
</div>
<!-- /MODULE Block best sellers -->
<?php }
}
