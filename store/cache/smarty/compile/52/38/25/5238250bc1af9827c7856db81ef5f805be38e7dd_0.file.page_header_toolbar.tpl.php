<?php
/* Smarty version 3.1.31, created on 2021-03-02 07:30:17
  from "/home/sexthera/public_html/mohope.web.za/store/admin123/themes/default/template/page_header_toolbar.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_603e2fd974bfb7_35460741',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5238250bc1af9827c7856db81ef5f805be38e7dd' => 
    array (
      0 => '/home/sexthera/public_html/mohope.web.za/store/admin123/themes/default/template/page_header_toolbar.tpl',
      1 => 1564078910,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_603e2fd974bfb7_35460741 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>



<?php if (!isset($_smarty_tpl->tpl_vars['title']->value) && isset($_smarty_tpl->tpl_vars['page_header_toolbar_title']->value)) {?>
	<?php $_smarty_tpl->_assignInScope('title', $_smarty_tpl->tpl_vars['page_header_toolbar_title']->value);
}
if (isset($_smarty_tpl->tpl_vars['page_header_toolbar_btn']->value)) {?>
	<?php $_smarty_tpl->_assignInScope('toolbar_btn', $_smarty_tpl->tpl_vars['page_header_toolbar_btn']->value);
}?>

<div class="bootstrap">
	<div class="page-head">
		<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_2090524064603e2fd97150a4_56568463', 'pageTitle');
?>


		<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1814013290603e2fd9718719_63651679', 'pageBreadcrumb');
?>

		<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1866545027603e2fd9722200_18342056', 'toolbarBox');
?>

	</div>
</div>
<?php }
/* {block 'pageTitle'} */
class Block_2090524064603e2fd97150a4_56568463 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'pageTitle' => 
  array (
    0 => 'Block_2090524064603e2fd97150a4_56568463',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

		<h2 class="page-title">
			
			<?php if (is_array($_smarty_tpl->tpl_vars['title']->value)) {
echo preg_replace('!<[^>]*?>!', ' ', end($_smarty_tpl->tpl_vars['title']->value));
} else {
echo preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['title']->value);
}?>
		</h2>
		<?php
}
}
/* {/block 'pageTitle'} */
/* {block 'pageBreadcrumb'} */
class Block_1814013290603e2fd9718719_63651679 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'pageBreadcrumb' => 
  array (
    0 => 'Block_1814013290603e2fd9718719_63651679',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

		<ul class="breadcrumb page-breadcrumb">
			
			<?php if ($_smarty_tpl->tpl_vars['breadcrumbs2']->value['container']['name'] != '') {?>
				<li class="breadcrumb-container">
					<?php if ($_smarty_tpl->tpl_vars['breadcrumbs2']->value['container']['href'] != '') {?><a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['breadcrumbs2']->value['container']['href'], ENT_QUOTES, 'UTF-8', true);?>
"><?php }?>
					<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['breadcrumbs2']->value['container']['name'], ENT_QUOTES, 'UTF-8', true);?>

					<?php if ($_smarty_tpl->tpl_vars['breadcrumbs2']->value['container']['href'] != '') {?></a><?php }?>
				</li>
			<?php }?>

			
			<?php if ($_smarty_tpl->tpl_vars['breadcrumbs2']->value['tab']['name'] != '' && $_smarty_tpl->tpl_vars['breadcrumbs2']->value['container']['name'] != $_smarty_tpl->tpl_vars['breadcrumbs2']->value['tab']['name']) {?>
				<li class="breadcrumb-current">
					<?php if ($_smarty_tpl->tpl_vars['breadcrumbs2']->value['tab']['href'] != '') {?><a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['breadcrumbs2']->value['tab']['href'], ENT_QUOTES, 'UTF-8', true);?>
"><?php }?>
					<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['breadcrumbs2']->value['tab']['name'], ENT_QUOTES, 'UTF-8', true);?>

					<?php if ($_smarty_tpl->tpl_vars['breadcrumbs2']->value['tab']['href'] != '') {?></a><?php }?>
				</li>
			<?php }?>

			
			
			</ul>
		<?php
}
}
/* {/block 'pageBreadcrumb'} */
/* {block 'toolbarBox'} */
class Block_1866545027603e2fd9722200_18342056 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'toolbarBox' => 
  array (
    0 => 'Block_1866545027603e2fd9722200_18342056',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

		<div class="page-bar toolbarBox">
			<div class="btn-toolbar">
				<a href="#" class="toolbar_btn dropdown-toolbar navbar-toggle" data-toggle="collapse" data-target="#toolbar-nav"><i class="process-icon-dropdown"></i><div><?php echo smartyTranslate(array('s'=>'Menu'),$_smarty_tpl);?>
</div></a>
				<ul id="toolbar-nav" class="nav nav-pills pull-right collapse navbar-collapse">
					<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['toolbar_btn']->value, 'btn', false, 'k');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['btn']->value) {
?>
					<?php if ($_smarty_tpl->tpl_vars['k']->value != 'back' && $_smarty_tpl->tpl_vars['k']->value != 'modules-list') {?>
					<li>
						<a id="page-header-desc-<?php echo $_smarty_tpl->tpl_vars['table']->value;?>
-<?php if (isset($_smarty_tpl->tpl_vars['btn']->value['imgclass'])) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['btn']->value['imgclass'], ENT_QUOTES, 'UTF-8', true);
} else {
echo $_smarty_tpl->tpl_vars['k']->value;
}?>" class="toolbar_btn <?php if (isset($_smarty_tpl->tpl_vars['btn']->value['target']) && $_smarty_tpl->tpl_vars['btn']->value['target']) {?> _blank<?php }?> pointer"<?php if (isset($_smarty_tpl->tpl_vars['btn']->value['href'])) {?> href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['btn']->value['href'], ENT_QUOTES, 'UTF-8', true);?>
"<?php }?> title="<?php if (isset($_smarty_tpl->tpl_vars['btn']->value['help'])) {
echo $_smarty_tpl->tpl_vars['btn']->value['help'];
} else {
echo htmlspecialchars($_smarty_tpl->tpl_vars['btn']->value['desc'], ENT_QUOTES, 'UTF-8', true);
}?>"<?php if (isset($_smarty_tpl->tpl_vars['btn']->value['js']) && $_smarty_tpl->tpl_vars['btn']->value['js']) {?> onclick="<?php echo $_smarty_tpl->tpl_vars['btn']->value['js'];?>
"<?php }
if (isset($_smarty_tpl->tpl_vars['btn']->value['modal_target']) && $_smarty_tpl->tpl_vars['btn']->value['modal_target']) {?> data-target="<?php echo $_smarty_tpl->tpl_vars['btn']->value['modal_target'];?>
" data-toggle="modal"<?php }
if (isset($_smarty_tpl->tpl_vars['btn']->value['help'])) {?> data-toggle="tooltip" data-placement="bottom"<?php }?>>
							<i class="<?php if (isset($_smarty_tpl->tpl_vars['btn']->value['icon'])) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['btn']->value['icon'], ENT_QUOTES, 'UTF-8', true);
} else { ?>process-icon-<?php if (isset($_smarty_tpl->tpl_vars['btn']->value['imgclass'])) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['btn']->value['imgclass'], ENT_QUOTES, 'UTF-8', true);
} else {
echo $_smarty_tpl->tpl_vars['k']->value;
}
}
if (isset($_smarty_tpl->tpl_vars['btn']->value['class'])) {?> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['btn']->value['class'], ENT_QUOTES, 'UTF-8', true);
}?>"></i>
							<div<?php if (isset($_smarty_tpl->tpl_vars['btn']->value['force_desc']) && $_smarty_tpl->tpl_vars['btn']->value['force_desc'] == true) {?> class="locked"<?php }?>><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['btn']->value['desc'], ENT_QUOTES, 'UTF-8', true);?>
</div>
						</a>
					</li>
					<?php }?>
					<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

					<?php if (isset($_smarty_tpl->tpl_vars['toolbar_btn']->value['modules-list'])) {?>
					<li>
						<a id="page-header-desc-<?php echo $_smarty_tpl->tpl_vars['table']->value;?>
-<?php if (isset($_smarty_tpl->tpl_vars['toolbar_btn']->value['modules-list']['imgclass'])) {
echo $_smarty_tpl->tpl_vars['toolbar_btn']->value['modules-list']['imgclass'];
} else { ?>modules-list<?php }?>" class="toolbar_btn<?php if (isset($_smarty_tpl->tpl_vars['toolbar_btn']->value['modules-list']['class'])) {?> <?php echo $_smarty_tpl->tpl_vars['toolbar_btn']->value['modules-list']['class'];
}
if (isset($_smarty_tpl->tpl_vars['toolbar_btn']->value['modules-list']['target']) && $_smarty_tpl->tpl_vars['toolbar_btn']->value['modules-list']['target']) {?> _blank<?php }?>" <?php if (isset($_smarty_tpl->tpl_vars['toolbar_btn']->value['modules-list']['href'])) {?>href="<?php echo $_smarty_tpl->tpl_vars['toolbar_btn']->value['modules-list']['href'];?>
"<?php }?> title="<?php echo $_smarty_tpl->tpl_vars['toolbar_btn']->value['modules-list']['desc'];?>
"<?php if (isset($_smarty_tpl->tpl_vars['toolbar_btn']->value['modules-list']['js']) && $_smarty_tpl->tpl_vars['toolbar_btn']->value['modules-list']['js']) {?> onclick="<?php echo $_smarty_tpl->tpl_vars['toolbar_btn']->value['modules-list']['js'];?>
"<?php }?>>
							<i class="<?php if (isset($_smarty_tpl->tpl_vars['toolbar_btn']->value['modules-list']['icon'])) {
echo $_smarty_tpl->tpl_vars['toolbar_btn']->value['modules-list']['icon'];
} else { ?>process-icon-<?php if (isset($_smarty_tpl->tpl_vars['toolbar_btn']->value['modules-list']['imgclass'])) {
echo $_smarty_tpl->tpl_vars['toolbar_btn']->value['modules-list']['imgclass'];
} else { ?>modules-list<?php }
}?>"></i>
							<div<?php if (isset($_smarty_tpl->tpl_vars['toolbar_btn']->value['modules-list']['force_desc']) && $_smarty_tpl->tpl_vars['toolbar_btn']->value['modules-list']['force_desc'] == true) {?> class="locked"<?php }?>><?php echo $_smarty_tpl->tpl_vars['toolbar_btn']->value['modules-list']['desc'];?>
</div>
						</a>
					</li>
					<?php }?>
					<?php if (isset($_smarty_tpl->tpl_vars['help_link']->value)) {?>
					<li>
						<a class="toolbar_btn btn-help" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['help_link']->value, ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'Help'),$_smarty_tpl);?>
">
							<i class="process-icon-help"></i>
							<div><?php echo smartyTranslate(array('s'=>'Help'),$_smarty_tpl);?>
</div>
						</a>
					</li>
					<?php }?>
				</ul>
				<?php if ((isset($_smarty_tpl->tpl_vars['tab_modules_open']->value) && $_smarty_tpl->tpl_vars['tab_modules_open']->value) || isset($_smarty_tpl->tpl_vars['tab_modules_list']->value)) {?>
				<?php echo '<script'; ?>
 type="text/javascript">
				//<![CDATA[
					var modules_list_loaded = false;
					<?php if (isset($_smarty_tpl->tpl_vars['tab_modules_open']->value) && $_smarty_tpl->tpl_vars['tab_modules_open']->value) {?>
						$(function() {
								$('#modules_list_container').modal('show');
								openModulesList();

						});
					<?php }?>
					<?php if (isset($_smarty_tpl->tpl_vars['tab_modules_list']->value)) {?>
						$('.process-icon-modules-list').parent('a').unbind().bind('click', function (){
							$('#modules_list_container').modal('show');
							openModulesList();
						});
					<?php }?>
				//]]>
				<?php echo '</script'; ?>
>
				<?php }?>
			</div>
		</div>
		<?php
}
}
/* {/block 'toolbarBox'} */
}
