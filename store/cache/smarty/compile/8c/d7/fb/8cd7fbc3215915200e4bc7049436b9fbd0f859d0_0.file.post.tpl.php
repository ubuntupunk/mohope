<?php
/* Smarty version 3.1.31, created on 2021-03-02 07:40:25
  from "/home/sexthera/public_html/mohope.web.za/store/themes/niara/modules/beesblog/views/templates/front/post.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_603e3239e5b483_25275858',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8cd7fbc3215915200e4bc7049436b9fbd0f859d0' => 
    array (
      0 => '/home/sexthera/public_html/mohope.web.za/store/themes/niara/modules/beesblog/views/templates/front/post.tpl',
      1 => 1563910602,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./post_info.tpl' => 1,
    'file:./disqus.tpl' => 1,
  ),
),false)) {
function content_603e3239e5b483_25275858 (Smarty_Internal_Template $_smarty_tpl) {
?>

<?php $_smarty_tpl->_assignInScope('postPath', BeesBlog::GetBeesBlogLink('beesblog_post',array('blog_rewrite'=>$_smarty_tpl->tpl_vars['post']->value->link_rewrite)));
$_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'path', null, null);?>
    <a href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['blogHome']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"><?php echo smartyTranslate(array('s'=>'Blog','mod'=>'beesblog'),$_smarty_tpl);?>
</a>
    <span class="navigation-pipe"><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['navigationPipe']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</span><?php echo $_smarty_tpl->tpl_vars['post']->value->title;?>

<?php $_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
<div id="beesblog-content" class="block">
    <div id="sdsblogArticle" class="blog-post">
        <div id="beesblog-before-pos" class="row">
            <?php echo $_smarty_tpl->tpl_vars['displayBeesBlogBeforePost']->value;?>

        </div>
        <?php $_smarty_tpl->_assignInScope('imagePath', Media::getMediaPath(BeesBlog::getPostImagePath($_smarty_tpl->tpl_vars['post']->value->id)));
?>
        <?php if (($_smarty_tpl->tpl_vars['imagePath']->value)) {?>
            <img class="img-responsive" alt="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['post']->value->title, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" src="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['imagePath']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
">
        <?php }?>
        <h4 class="title_block"><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['post']->value->title, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</h4>
        <?php $_smarty_tpl->_subTemplateRender("file:./post_info.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

        <div class="">
            <?php echo $_smarty_tpl->tpl_vars['post']->value->content;?>

        </div>
        <div id="beesblog-after-post" class="row">
            <?php echo $_smarty_tpl->tpl_vars['displayBeesBlogAfterPost']->value;?>

        </div>
    </div>
    <?php if (isset($_smarty_tpl->tpl_vars['socialSharing']->value) && $_smarty_tpl->tpl_vars['socialSharing']->value) {?>
        <br/>
        <p class="socialsharing_beesblog hidden-print">
            <button data-type="twitter" type="button" class="btn btn-xs btn-twitter">
                <i class="icon-twitter"></i> Tweet
            </button>
            <button data-type="facebook" type="button" class="btn btn-xs btn-facebook">
                <i class="icon-facebook"></i> Share
            </button>
            <button data-type="pinterest" type="button" class="btn btn-xs btn-pinterest">
                <i class="icon-pinterest"></i> Pinterest
            </button>
        </p>
    <?php }?>
    <?php if ($_smarty_tpl->tpl_vars['showComments']->value && $_smarty_tpl->tpl_vars['post']->value->comments_enabled) {?>
        <?php $_smarty_tpl->_subTemplateRender("file:./disqus.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    <?php }?>
</div>
<?php }
}
