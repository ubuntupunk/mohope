<?php
/* Smarty version 3.1.31, created on 2021-03-02 07:40:25
  from "/home/sexthera/public_html/mohope.web.za/store/themes/niara/modules/beesblog/views/templates/front/post_info.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_603e3239e6d329_10457226',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2413f3248e387d475fa40de1c2be8594cbfd5a2a' => 
    array (
      0 => '/home/sexthera/public_html/mohope.web.za/store/themes/niara/modules/beesblog/views/templates/front/post_info.tpl',
      1 => 1563910602,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_603e3239e6d329_10457226 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_modifier_date_format')) require_once '/home/sexthera/public_html/mohope.web.za/store/vendor/smarty/smarty/libs/plugins/modifier.date_format.php';
?>
<div class="beesblog-post-info">
    <?php if (isset($_smarty_tpl->tpl_vars['showAuthor']->value) && $_smarty_tpl->tpl_vars['showAuthor']->value) {?>
        <?php echo smartyTranslate(array('s'=>'Posted by','mod'=>'beesblog'),$_smarty_tpl);?>

        <span>
            <?php if ($_smarty_tpl->tpl_vars['authorStyle']->value) {?>
                <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['post']->value->employee->firstname, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
 <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['post']->value->employee->lastname, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>

            <?php } else { ?>
                 <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['post']->value->employee->lastname, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
 <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['post']->value->employee->firstname, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>

            <?php }?>
        </span>
    <?php }?>
    <?php if (isset($_smarty_tpl->tpl_vars['showDate']->value) && $_smarty_tpl->tpl_vars['showDate']->value) {?>
        <i class="icon icon-time"></i>&nbsp;
        <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['post']->value->published);?>

    <?php }?>

    <i class="icon icon-sitemap"></i>&nbsp;
    <span>
        <a href="<?php echo BeesBlog::GetBeesBlogLink('beesblog_category',array('cat_rewrite'=>$_smarty_tpl->tpl_vars['post']->value->category->link_rewrite));?>
">
            <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['post']->value->category->title, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>

        </a>
    </span>
    <?php if (isset($_smarty_tpl->tpl_vars['showComments']->value) && $_smarty_tpl->tpl_vars['showComments']->value && $_smarty_tpl->tpl_vars['post']->value->comments_enabled) {?>
        <span class="beesblog-comment-counter">
            <i class="icon icon-comments"></i>&nbsp;
            <a title="<?php echo smartyTranslate(array('s'=>'0 Comments','mod'=>'beesblog'),$_smarty_tpl);?>
"
               href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['postPath']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
#disqus_thread"
               data-disqus-identifier="<?php echo intval(((strtolower(('blog-').(Context::getContext()->language->iso_code))).('-')).($_smarty_tpl->tpl_vars['post']->value->id));?>
"
            >
                <?php echo smartyTranslate(array('s'=>'0 Comments','mod'=>'beesblog'),$_smarty_tpl);?>

            </a>
        </span>
    <?php }?>
    <?php if (isset($_smarty_tpl->tpl_vars['showViewed']->value) && $_smarty_tpl->tpl_vars['showViewed']->value) {?>
        <i class="icon icon-eye-open"></i>
        <?php echo smartyTranslate(array('s'=>' views','mod'=>'beesblog'),$_smarty_tpl);?>
 (<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['post']->value->viewed, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
)
    <?php }?>
</div>
<?php }
}
