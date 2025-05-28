<?php
/* Smarty version 4.5.2, created on 2025-05-28 18:03:11
  from 'module_file_tpl:DesignManager;admin_defaultadmin_csstooltip.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.2',
  'unifunc' => 'content_683733bfa1ae82_81523329',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2f3872edfdd2e742c2d51f0121405e9e982fe5fc' => 
    array (
      0 => 'module_file_tpl:DesignManager;admin_defaultadmin_csstooltip.tpl',
      1 => 1746563353,
      2 => 'module_file_tpl',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_683733bfa1ae82_81523329 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\xampp\\htdocs\\cms\\admin\\plugins\\function.cms_admin_user.php','function'=>'smarty_function_cms_admin_user',),1=>array('file'=>'C:\\xampp\\htdocs\\cms\\lib\\plugins\\modifier.localedate_format.php','function'=>'smarty_modifier_localedate_format',),2=>array('file'=>'C:\\xampp\\htdocs\\cms\\lib\\plugins\\modifier.relative_time.php','function'=>'smarty_modifier_relative_time',),3=>array('file'=>'C:\\xampp\\htdocs\\cms\\lib\\plugins\\modifier.cms_date_format.php','function'=>'smarty_modifier_cms_date_format',),4=>array('file'=>'C:\\xampp\\htdocs\\cms\\lib\\plugins\\modifier.cms_escape.php','function'=>'smarty_modifier_cms_escape',),5=>array('file'=>'C:\\xampp\\htdocs\\cms\\lib\\plugins\\modifier.summarize.php','function'=>'smarty_modifier_summarize',),));
if ($_smarty_tpl->tpl_vars['css']->value->locked()) {
$_smarty_tpl->_assignInScope('lock', $_smarty_tpl->tpl_vars['css']->value->get_lock());
if ($_smarty_tpl->tpl_vars['css']->value->lock_expired()) {?><strong style="color: red;"><?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('msg_steal_lock');?>
</strong><br/><?php }?><strong><?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('prompt_lockedby');?>
:</strong> <?php echo smarty_function_cms_admin_user(array('uid'=>$_smarty_tpl->tpl_vars['lock']->value['uid']),$_smarty_tpl);?>
<br/><strong><?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('prompt_lockedsince');?>
:</strong> <?php echo smarty_modifier_localedate_format($_smarty_tpl->tpl_vars['lock']->value['created'],'%x H:i');?>
<br/><?php if ($_smarty_tpl->tpl_vars['lock']->value['expires'] < time()) {?><strong><?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('prompt_lockexpired');?>
:</strong> <span style="color: red;"><?php echo smarty_modifier_relative_time($_smarty_tpl->tpl_vars['lock']->value['expires']);?>
</span><?php } else { ?><strong><?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('prompt_lockexpires');?>
:</strong> <?php echo smarty_modifier_relative_time($_smarty_tpl->tpl_vars['lock']->value['expires']);
}
} else { ?><strong><?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('prompt_name');?>
:</strong> <?php echo $_smarty_tpl->tpl_vars['css']->value->get_name();?>
 <em>(<?php echo $_smarty_tpl->tpl_vars['css']->value->get_id();?>
)</em><br/><strong><?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('prompt_created');?>
:</strong> <?php echo smarty_modifier_cms_date_format($_smarty_tpl->tpl_vars['css']->value->get_created());?>
<br/><strong><?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('prompt_modified');?>
:</strong> <?php echo smarty_modifier_relative_time($_smarty_tpl->tpl_vars['css']->value->get_modified());
$_smarty_tpl->_assignInScope('tmp', $_smarty_tpl->tpl_vars['css']->value->get_description());
if ($_smarty_tpl->tpl_vars['tmp']->value != '') {?><br/><strong><?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('prompt_description');?>
:</strong> <?php echo smarty_modifier_summarize(smarty_modifier_cms_escape(preg_replace('!<[^>]*?>!', ' ', (string) $_smarty_tpl->tpl_vars['tmp']->value)));
}
}
}
}
