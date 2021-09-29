<?php
/* Smarty version 3.1.31, created on 2021-03-02 07:32:22
  from "/home/sexthera/public_html/mohope.web.za/store/themes/niara/modules/beesblogrecentposts/views/templates/hooks/home.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_603e30566f58e3_24703617',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5aff87f0578b18b228fc161199e7d4cf74114b0a' => 
    array (
      0 => '/home/sexthera/public_html/mohope.web.za/store/themes/niara/modules/beesblogrecentposts/views/templates/hooks/home.tpl',
      1 => 1563910602,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_603e30566f58e3_24703617 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_modifier_date_format')) require_once '/home/sexthera/public_html/mohope.web.za/store/vendor/smarty/smarty/libs/plugins/modifier.date_format.php';
?>


<?php if (!empty($_smarty_tpl->tpl_vars['beesblogRecentPostsPosts']->value)) {?>
	<section id="beesblog_home" class="recenthome-block col-xs-12">
		<div class="tm-hp text-center">
			<h2>
				<a href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['beesblogRecentPostsBlogUrl']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" title="<?php echo smartyTranslate(array('s'=>'Recent posts','mod'=>'beesblogrecentposts'),$_smarty_tpl);?>
">
					<span class="tm-over">Latest <span>Blog </span> posts</span>
				</a>
			</h2>
			<p><?php echo smartyTranslate(array('s'=>'Read latest posts from our blog.','mod'=>'beesblog'),$_smarty_tpl);?>
</p>
		</div>
		<div class="row">
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['beesblogRecentPostsPosts']->value, 'post');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['post']->value) {
?>
				<article>
					<div class="col-xs-12 col-md-4">
						<div class="beesblogrecentpostshome-content">
								<a href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['post']->value->link, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" title="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['post']->value->title, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
">
									<?php $_smarty_tpl->_assignInScope('imagePath', Media::getMediaPath(BeesBlog::getPostImagePath($_smarty_tpl->tpl_vars['post']->value->id)));
?>
									<?php if (($_smarty_tpl->tpl_vars['imagePath']->value)) {?>
										<img class="img-responsive" src="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['imagePath']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" title="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['post']->value->title, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" />
									<?php }?>
								</a>
							<h5>
								<a class="beesblogrecentpostshome-title" href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['post']->value->link, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" title="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['post']->value->title, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
">
									<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['post']->value->title, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>

								</a>
								<span>
									<i class="icon icon-time"></i> <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['post']->value->published);?>

									<i class="icon icon-eye"></i> <?php echo intval($_smarty_tpl->tpl_vars['post']->value->viewed);?>

								</span>
							</h5>
							<p><?php echo preg_replace('!<[^>]*?>!', ' ', smarty_modifier_truncate($_smarty_tpl->tpl_vars['post']->value->content,'150'));?>
</p>

							<p><a class="btn btn-primary" href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['post']->value->link, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" title="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['post']->value->title, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
">Read More</a></p>
						</div>
					</div>
				</article>
			<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

		</div>
	</section>
<?php }
}
}
