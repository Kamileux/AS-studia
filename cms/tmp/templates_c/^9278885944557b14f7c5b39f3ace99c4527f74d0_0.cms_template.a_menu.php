<?php
/* Smarty version 4.5.2, created on 2025-05-28 17:58:41
  from 'cms_template:a_menu' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.2',
  'unifunc' => 'content_683732b1349b96_43863306',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9278885944557b14f7c5b39f3ace99c4527f74d0' => 
    array (
      0 => 'cms_template:a_menu',
      1 => '1748442512',
      2 => 'cms_template',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_683732b1349b96_43863306 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->smarty->ext->_tplFunction->registerTplFunctions($_smarty_tpl, array (
  'Nav_menu' => 
  array (
    'compiled_filepath' => 'C:\\xampp\\htdocs\\cms\\tmp\\templates_c\\^9278885944557b14f7c5b39f3ace99c4527f74d0_0.cms_template.a_menu.php',
    'uid' => '9278885944557b14f7c5b39f3ace99c4527f74d0',
    'call_name' => 'smarty_template_function_Nav_menu_1100373564683732b13304a6_63013538',
  ),
));
?>

<?php if ((isset($_smarty_tpl->tpl_vars['nodes']->value))) {?>
  <?php $_smarty_tpl->smarty->ext->_tplFunction->callTemplateFunction($_smarty_tpl, 'Nav_menu', array('data'=>$_smarty_tpl->tpl_vars['nodes']->value,'depth'=>1), true);?>

<?php }
}
/* smarty_template_function_Nav_menu_1100373564683732b13304a6_63013538 */
if (!function_exists('smarty_template_function_Nav_menu_1100373564683732b13304a6_63013538')) {
function smarty_template_function_Nav_menu_1100373564683732b13304a6_63013538(Smarty_Internal_Template $_smarty_tpl,$params) {
$params = array_merge(array('depth'=>1), $params);
foreach ($params as $key => $value) {
$_smarty_tpl->tpl_vars[$key] = new Smarty_Variable($value, $_smarty_tpl->isRenderingCache);
}
if ($_smarty_tpl->tpl_vars['depth']->value == 1) {?><div class="pure-menu pure-menu-horizontal"><ul class="pure-menu-list"><?php }
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['data']->value, 'node');
$_smarty_tpl->tpl_vars['node']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['node']->value) {
$_smarty_tpl->tpl_vars['node']->do_else = false;
$_smarty_tpl->_assignInScope('liclass', 'pure-menu-item');
$_smarty_tpl->_assignInScope('aclass', 'pure-menu-link');
if ($_smarty_tpl->tpl_vars['node']->value->current) {
$_smarty_tpl->_assignInScope('liclass', ($_smarty_tpl->tpl_vars['liclass']->value).(' pure-menu-selected'));
}
if ($_smarty_tpl->tpl_vars['node']->value->children) {
$_smarty_tpl->_assignInScope('liclass', ($_smarty_tpl->tpl_vars['liclass']->value).(' pure-menu-has-children pure-menu-allow-hover'));
}?><li class="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['liclass']->value, ENT_QUOTES, 'UTF-8', true);?>
"><a href="<?php echo $_smarty_tpl->tpl_vars['node']->value->url;?>
" class="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['aclass']->value, ENT_QUOTES, 'UTF-8', true);?>
"<?php if ($_smarty_tpl->tpl_vars['node']->value->target) {?> target="<?php echo $_smarty_tpl->tpl_vars['node']->value->target;?>
"<?php }?>><?php echo $_smarty_tpl->tpl_vars['node']->value->menutext;?>
</a><?php if ($_smarty_tpl->tpl_vars['node']->value->children) {?><ul class="pure-menu-children"><?php $_smarty_tpl->smarty->ext->_tplFunction->callTemplateFunction($_smarty_tpl, 'Nav_menu', array('data'=>$_smarty_tpl->tpl_vars['node']->value->children,'depth'=>$_smarty_tpl->tpl_vars['depth']->value+1), true);?>
</ul><?php }?></li><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
if ($_smarty_tpl->tpl_vars['depth']->value == 1) {?></ul></div><?php }
}}
/*/ smarty_template_function_Nav_menu_1100373564683732b13304a6_63013538 */
}
