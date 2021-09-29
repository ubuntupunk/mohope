<?php
/* Smarty version 3.1.31, created on 2021-03-02 07:32:22
  from "/home/sexthera/public_html/mohope.web.za/store/themes/niara/modules/homefeatured/homefeatured.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_603e30565a2802_98467124',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8b3cff7d91286b2317218eed84a746ec87c8b8e0' => 
    array (
      0 => '/home/sexthera/public_html/mohope.web.za/store/themes/niara/modules/homefeatured/homefeatured.tpl',
      1 => 1563910602,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_603e30565a2802_98467124 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '819008607603e305659a6e7_52374598';
?>
<div class="tm-home col-xs-12">
<?php if (isset($_smarty_tpl->tpl_vars['products']->value) && $_smarty_tpl->tpl_vars['products']->value) {?>
  <div class="tm-hp text-center">
    <h2><span class="tm-over"><?php echo smartyTranslate(array('s'=>'Our','mod'=>'homefeatured'),$_smarty_tpl);?>
 <span><?php echo smartyTranslate(array('s'=>'featured','mod'=>'homefeatured'),$_smarty_tpl);?>
</span> <?php echo smartyTranslate(array('s'=>'products','mod'=>'homefeatured'),$_smarty_tpl);?>
</span></h2>
    <p><?php echo smartyTranslate(array('s'=>'The best selection for top prices.','mod'=>'homefeatured'),$_smarty_tpl);?>
</p>
  </div>
  <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./product-list.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array('class'=>'homefeatured','id'=>'homefeatured'), 0, true);
?>

<?php } else { ?>
  <ul id="homefeatured" class="homefeatured">
    <li class="alert alert-info"><?php echo smartyTranslate(array('s'=>'No featured products at this time.','mod'=>'homefeatured'),$_smarty_tpl);?>
</li>
  </ul>
<?php }?>
</div>
<?php }
}
