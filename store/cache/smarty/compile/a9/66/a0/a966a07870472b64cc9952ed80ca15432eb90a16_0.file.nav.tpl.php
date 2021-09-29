<?php
/* Smarty version 3.1.31, created on 2021-03-02 07:32:18
  from "/home/sexthera/public_html/mohope.web.za/store/admin123/themes/default/template/nav.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_603e305239d883_76558356',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a966a07870472b64cc9952ed80ca15432eb90a16' => 
    array (
      0 => '/home/sexthera/public_html/mohope.web.za/store/admin123/themes/default/template/nav.tpl',
      1 => 1564078910,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:search_form.tpl' => 1,
  ),
),false)) {
function content_603e305239d883_76558356 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="bootstrap">
	<nav id="<?php if ($_smarty_tpl->tpl_vars['employee']->value->bo_menu) {?>nav-sidebar<?php } else { ?>nav-topbar<?php }?>" role="navigation">
		<?php if (!$_smarty_tpl->tpl_vars['tab']->value) {?>
			<div class="mainsubtablist" style="display:none;"></div>
		<?php }?>
		<ul class="menu">
			<li class="searchtab">
				<?php $_smarty_tpl->_subTemplateRender("file:search_form.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('id'=>"header_search",'show_clear_btn'=>1), 0, false);
?>

			</li>
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tabs']->value, 't');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['t']->value) {
?>
				<?php if ($_smarty_tpl->tpl_vars['t']->value['active']) {?>
				<li class="maintab <?php if ($_smarty_tpl->tpl_vars['t']->value['current']) {?>active<?php }?> <?php if (count($_smarty_tpl->tpl_vars['t']->value['sub_tabs'])) {?>has_submenu<?php }?>" id="maintab-<?php echo $_smarty_tpl->tpl_vars['t']->value['class_name'];?>
" data-submenu="<?php echo $_smarty_tpl->tpl_vars['t']->value['id_tab'];?>
">
					<a href="<?php if (count($_smarty_tpl->tpl_vars['t']->value['sub_tabs']) && isset($_smarty_tpl->tpl_vars['t']->value['sub_tabs'][0]['href'])) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['t']->value['sub_tabs'][0]['href'], ENT_QUOTES, 'UTF-8', true);
} else {
echo htmlspecialchars($_smarty_tpl->tpl_vars['t']->value['href'], ENT_QUOTES, 'UTF-8', true);
}?>" class="title" >
						<i class="icon-<?php echo $_smarty_tpl->tpl_vars['t']->value['class_name'];?>
"></i>
						<span><?php if ($_smarty_tpl->tpl_vars['t']->value['name'] == '') {
echo htmlspecialchars($_smarty_tpl->tpl_vars['t']->value['class_name'], ENT_QUOTES, 'UTF-8', true);
} else {
echo htmlspecialchars($_smarty_tpl->tpl_vars['t']->value['name'], ENT_QUOTES, 'UTF-8', true);
}?></span>
					</a>
					<?php if (count($_smarty_tpl->tpl_vars['t']->value['sub_tabs'])) {?>
						<ul class="submenu">
						<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['t']->value['sub_tabs'], 't2');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['t2']->value) {
?>
							<?php if ($_smarty_tpl->tpl_vars['t2']->value['active']) {?>
							<li id="subtab-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['t2']->value['class_name'], ENT_QUOTES, 'UTF-8', true);?>
" <?php if ($_smarty_tpl->tpl_vars['t2']->value['current']) {?> class="active"<?php }?>>
								<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['t2']->value['href'], ENT_QUOTES, 'UTF-8', true);?>
">
									<?php if ($_smarty_tpl->tpl_vars['t2']->value['name'] == '') {
echo htmlspecialchars($_smarty_tpl->tpl_vars['t2']->value['class_name'], ENT_QUOTES, 'UTF-8', true);
} else {
echo htmlspecialchars($_smarty_tpl->tpl_vars['t2']->value['name'], ENT_QUOTES, 'UTF-8', true);
}?>
								</a>
							</li>
							<?php }?>
						<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

						</ul>
					<?php }?>
				</li>
				<?php }?>
			<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

		</ul>
		<span class="menu-collapse">
			<i class="icon-align-justify icon-rotate-90"></i>
		</span>
		<?php echo smartyHook(array('h'=>'displayAdminNavBarBeforeEnd'),$_smarty_tpl);?>

	</nav>
</div>
<?php }
}
