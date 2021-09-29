<?php
/* Smarty version 3.1.31, created on 2021-03-02 07:40:25
  from "/home/sexthera/public_html/mohope.web.za/store/themes/niara/modules/blockcategories/blockcategories.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_603e3239d21ed5_45752102',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e3830c39ff169696fa3df9537331f2036998b80a' => 
    array (
      0 => '/home/sexthera/public_html/mohope.web.za/store/themes/niara/modules/blockcategories/blockcategories.tpl',
      1 => 1563910602,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./list_group_item.tpl' => 1,
  ),
),false)) {
function content_603e3239d21ed5_45752102 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '1511263066603e3239d13049_11961234';
if (!empty($_smarty_tpl->tpl_vars['blockCategTree']->value) && !empty($_smarty_tpl->tpl_vars['blockCategTree']->value['children'])) {?>
    <section id="blockcategories" class="blockcategories block">
        <h2 class="title_block section-title-column">
            <?php if (isset($_smarty_tpl->tpl_vars['currentCategory']->value)) {?>
                <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['currentCategory']->value->name, ENT_QUOTES, 'UTF-8', true);?>

            <?php } else { ?>
                <?php echo smartyTranslate(array('s'=>'Categories','mod'=>'blockcategories'),$_smarty_tpl);?>

            <?php }?>
        </h2>
        <nav>
            <div class="list-group block_content">
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['blockCategTree']->value['children'], 'list_item_child');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['list_item_child']->value) {
?>
                    <?php $_smarty_tpl->_subTemplateRender('file:./list_group_item.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array('list_item'=>$_smarty_tpl->tpl_vars['list_item_child']->value,'level'=>1), 0, true);
?>

                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

            </div>
        </nav>
    </section>
<?php }?>


    <?php echo '<script'; ?>
 type="text/javascript">
        $(function () {

            $('.blockcategories').each(function () {
                var $collapse = $(this).find('.collapse');
                var $triggers = $(this).find('.btn-toggle');

                $collapse.on('show.bs.collapse', function () {
                    var $target = $(this);
                    var $targetAndParents = $target.parents().filter('.collapse').add($target);

                    // Collapse all other menus which are not in the current tree
                    $collapse.filter('.collapse.in').not($targetAndParents).collapse('hide');

                    // Add 'active' class to triggers which show this element
                    $triggers.filter('[href="#' + $target.prop('id') + '"],' +
                            '[data-target="#' + $target.prop('id') + '"]').parent().addClass('active');
                });

                $collapse.on('hide.bs.collapse', function (e) {
                    // Fixes event being handled twice (event is trigger twice). WTF? @bootstrap, @jquery
                    if (e.handled) {
                        return;
                    } else {
                        e.handled = true;
                    }

                    // Remove 'active' class from triggers which show this collapsed element
                    $triggers.filter('[href="#' + $(this).prop('id') + '"],' +
                            '[data-target="#' + $(this).prop('id') + '"]').parent().removeClass('active');
                });

                // JavaScript workaround for expanding the active category tree line.
                // Preferably you should use an override and return expanded tree from the server side
                // @see themes/niara/modules/blockcategories/list_group_item.tpl
                var $activeMenuLink = $('.list-group-item.current');
                // Collect and expand all expandable parent nodes (going up)
                $activeMenuLink.parents('.collapse').add(
                        // Open up the current node also (if it's a tree)
                        $activeMenuLink.parent().next()
                ).collapse('show');

            });

        });
    <?php echo '</script'; ?>
>

<?php }
}
