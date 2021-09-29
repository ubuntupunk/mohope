<?php
/* Smarty version 3.1.31, created on 2021-09-09 18:44:24
  from "/home/sexthera/public_html/mohope.web.za/store/themes/niara/modules/blockcategories/blockcategories.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_613a8e48d36ad4_12766523',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e3830c39ff169696fa3df9537331f2036998b80a' => 
    array (
      0 => '/home/sexthera/public_html/mohope.web.za/store/themes/niara/modules/blockcategories/blockcategories.tpl',
      1 => 1563910602,
      2 => 'file',
    ),
    'cc507b780725cdf2f426741881232e028288c9b9' => 
    array (
      0 => '/home/sexthera/public_html/mohope.web.za/store/themes/niara/modules/blockcategories/list_group_item.tpl',
      1 => 1563910602,
      2 => 'file',
    ),
  ),
  'cache_lifetime' => 31536000,
),true)) {
function content_613a8e48d36ad4_12766523 (Smarty_Internal_Template $_smarty_tpl) {
?>
    <section id="blockcategories" class="blockcategories block">
        <h2 class="title_block section-title-column">
                            Categories
                    </h2>
        <nav>
            <div class="list-group block_content">
                                    
    <div class="list-group-item-wrapper">
    <a href="http://mohope.web.za/store/coffee-and-tea" class="list-group-item ilvl-1">
      <span>Coffee and Tea</span>
    </a>
    <a class="btn-toggle collapsed ilvl-1" href="#ct-3" data-toggle="collapse" title="Expand/Collapse">
      <i class="icon icon-caret-up"></i>
    </a>
  </div>
  <div  class="list-group collapse" style="height: 0px;" id="ct-3">
          
  <a class="list-group-item ilvl-2" href="http://mohope.web.za/store/Coffee">
    <span>Coffee</span>
  </a>

          
  <a class="list-group-item ilvl-2" href="http://mohope.web.za/store/tea">
    <span>Tea</span>
  </a>

    
  </div>

                                    
  <a class="list-group-item ilvl-1" href="http://mohope.web.za/store/gifts">
    <span>Gifts</span>
  </a>

                                    
  <a class="list-group-item ilvl-1" href="http://mohope.web.za/store/office">
    <span>Office</span>
  </a>

                
            </div>
        </nav>
    </section>


    <script type="text/javascript">
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
    </script>

<?php }
}
