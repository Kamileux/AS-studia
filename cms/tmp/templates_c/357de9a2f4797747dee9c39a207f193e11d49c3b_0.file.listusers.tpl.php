<?php
/* Smarty version 4.5.2, created on 2025-05-06 22:33:44
  from 'C:\xampp\htdocs\cms\admin\templates\listusers.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.2',
  'unifunc' => 'content_681a72286c7e96_50884415',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '357de9a2f4797747dee9c39a207f193e11d49c3b' => 
    array (
      0 => 'C:\\xampp\\htdocs\\cms\\admin\\templates\\listusers.tpl',
      1 => 1746563335,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_681a72286c7e96_50884415 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\xampp\\htdocs\\cms\\lib\\plugins\\function.form_start.php','function'=>'smarty_function_form_start',),1=>array('file'=>'C:\\xampp\\htdocs\\cms\\admin\\plugins\\function.admin_icon.php','function'=>'smarty_function_admin_icon',),2=>array('file'=>'C:\\xampp\\htdocs\\cms\\lib\\smarty\\plugins\\function.cycle.php','function'=>'smarty_function_cycle',),3=>array('file'=>'C:\\xampp\\htdocs\\cms\\lib\\smarty\\plugins\\function.html_options.php','function'=>'smarty_function_html_options',),4=>array('file'=>'C:\\xampp\\htdocs\\cms\\lib\\plugins\\function.form_end.php','function'=>'smarty_function_form_end',),));
echo '<script'; ?>
 type="text/javascript">
$(document).ready(function() {

    $('#sel_all').cmsms_checkall();

    $('.switchuser').click(function(ev){
	ev.preventDefault();
	var _href = $(this).attr('href');
	cms_confirm('<?php echo strtr((string)lang('confirm_switchuser'), array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", 
                       "\n" => "\\n", "</" => "<\/", "<!--" => "<\!--", "<s" => "<\s", "<S" => "<\S",
                       "`" => "\\`", "\${" => "\\\$\{"));?>
').done(function(){
	    window.location.href = _href;
	});
    });

    $('.toggleactive').click(function(ev){
        ev.preventDefault();
	var _href = $(this).attr('href');
        cms_confirm('<?php echo strtr((string)lang('confirm_toggleuseractive'), array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", 
                       "\n" => "\\n", "</" => "<\/", "<!--" => "<\!--", "<s" => "<\s", "<S" => "<\S",
                       "`" => "\\`", "\${" => "\\\$\{"));?>
').done(function(){
	    window.location.href = _href;
	});
    });

    $(document).on('click', '.js-delete', function(ev){
        ev.preventDefault();
	var _href = $(this).attr('href');
        cms_confirm('<?php echo strtr((string)lang('confirm_delete_user'), array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", 
                       "\n" => "\\n", "</" => "<\/", "<!--" => "<\!--", "<s" => "<\s", "<S" => "<\S",
                       "`" => "\\`", "\${" => "\\\$\{"));?>
').done(function(){
	    window.location.href = _href;
	});
    });

    $('#withselected, #bulksubmit').attr('disabled','disabled');
    $('#bulksubmit').button({ 'disabled' : true });
    $('#sel_all, .multiselect').on('click',function(){
        if( !$(this).is(':checked') ) {
            $('#withselected').attr('disabled','disabled');
            $('#bulksubmit').attr('disabled','disabled');
            $('#bulksubmit').button({ 'disabled' : true });
        } else {
            $('#withselected').removeAttr('disabled');
            $('#bulksubmit').removeAttr('disabled');
            $('#bulksubmit').button({ 'disabled' : false });
        }
    });

    $('#listusers').submit(function(ev){
        ev.preventDefault();
        var v = $('#withselected').val();
	if( v === 'delete' ) {
	    cms_confirm('<?php echo strtr((string)lang('confirm_delete_user'), array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", 
                       "\n" => "\\n", "</" => "<\/", "<!--" => "<\!--", "<s" => "<\s", "<S" => "<\S",
                       "`" => "\\`", "\${" => "\\\$\{"));?>
').done(function(){
	        $('#listusers').unbind('submit');
            $('#bulksubmit').click();
	    }).fail(function() {
	        return false;
	    });
	} else {
            cms_confirm('<?php echo strtr((string)lang('confirm_bulkuserop'), array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", 
                       "\n" => "\\n", "</" => "<\/", "<!--" => "<\!--", "<s" => "<\s", "<S" => "<\S",
                       "`" => "\\`", "\${" => "\\\$\{"));?>
').done(function(){
            $('#listusers').unbind('submit');
            $('#bulksubmit').click();
	        return true;
	    });
	}
    });

    $('#withselected').change(function(){
        var v = $(this).val();

        if (v === 'copyoptions') {
            $('#userlist').show();
        } else {
            $('#userlist').hide();
        }
    });
});
<?php echo '</script'; ?>
>
<h3 class="invisible"><?php echo lang('currentusers');?>
</h3><?php echo smarty_function_form_start(array('url'=>'listusers.php','id'=>"listusers"),$_smarty_tpl);?>
<div class="pageoptions"><a href="adduser.php<?php echo $_smarty_tpl->tpl_vars['urlext']->value;?>
" title="<?php echo lang('info_adduser');?>
"><?php echo smarty_function_admin_icon(array('icon'=>'newobject.gif','class'=>'systemicon'),$_smarty_tpl);?>
&nbsp;<?php echo lang('adduser');?>
</a></div><table class="pagetable"><thead><tr><th><?php echo lang('username');?>
</th><th style="text-align: center;"><?php echo lang('active');?>
</th><?php if ($_smarty_tpl->tpl_vars['is_admin']->value) {?><th class="pageicon"></th><?php }?><th class="pageicon"></th><th class="pageicon"></th><th class="pageicon"><input type="checkbox" id="sel_all" value="1" title="<?php echo lang('selectall');?>
"/></th></tr></thead><tbody><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['users']->value, 'user');
$_smarty_tpl->tpl_vars['user']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['user']->value) {
$_smarty_tpl->tpl_vars['user']->do_else = false;
?><tr class="<?php echo smarty_function_cycle(array('values'=>'row1,row2'),$_smarty_tpl);?>
"><?php $_smarty_tpl->_assignInScope('can_edit', 1);
if (!$_smarty_tpl->tpl_vars['user']->value->access_to_user) {
$_smarty_tpl->_assignInScope('can_edit', 0);
}?><td><?php if ($_smarty_tpl->tpl_vars['can_edit']->value) {?><a href="edituser.php<?php echo $_smarty_tpl->tpl_vars['urlext']->value;?>
&amp;user_id=<?php echo $_smarty_tpl->tpl_vars['user']->value->id;?>
" title="<?php echo lang('edituser');?>
"><?php echo $_smarty_tpl->tpl_vars['user']->value->username;?>
</a><?php } else { ?><span title="<?php echo lang('info_noedituser');?>
"><?php echo $_smarty_tpl->tpl_vars['user']->value->username;?>
</span><?php }?></td><td style="text-align: center;"><?php if ($_smarty_tpl->tpl_vars['can_edit']->value && $_smarty_tpl->tpl_vars['user']->value->id != $_smarty_tpl->tpl_vars['my_userid']->value) {?><a href="listusers.php<?php echo $_smarty_tpl->tpl_vars['urlext']->value;?>
&amp;toggleactive=<?php echo $_smarty_tpl->tpl_vars['user']->value->id;?>
" title="<?php echo lang('info_user_active2');?>
" class="toggleactive"><?php if ($_smarty_tpl->tpl_vars['user']->value->active) {
echo smarty_function_admin_icon(array('icon'=>'true.gif'),$_smarty_tpl);
} else {
echo smarty_function_admin_icon(array('icon'=>'false.gif'),$_smarty_tpl);
}?></a><?php }?></td><?php if ($_smarty_tpl->tpl_vars['is_admin']->value) {?><td><?php if ($_smarty_tpl->tpl_vars['user']->value->active && $_smarty_tpl->tpl_vars['user']->value->id != $_smarty_tpl->tpl_vars['my_userid']->value) {?><a href="listusers.php<?php echo $_smarty_tpl->tpl_vars['urlext']->value;?>
&amp;switchuser=<?php echo $_smarty_tpl->tpl_vars['user']->value->id;?>
" title="<?php echo lang('info_user_switch');?>
" class="switchuser"><?php echo smarty_function_admin_icon(array('icon'=>'run.gif'),$_smarty_tpl);?>
</a><?php }?></td><?php }?><td><?php if ($_smarty_tpl->tpl_vars['can_edit']->value) {?><a href="edituser.php<?php echo $_smarty_tpl->tpl_vars['urlext']->value;?>
&amp;user_id=<?php echo $_smarty_tpl->tpl_vars['user']->value->id;?>
" title="<?php echo lang('edituser');?>
"><?php echo smarty_function_admin_icon(array('icon'=>'edit.gif'),$_smarty_tpl);?>
</a><?php }?></td><td><?php if ($_smarty_tpl->tpl_vars['can_edit']->value && $_smarty_tpl->tpl_vars['user']->value->id != $_smarty_tpl->tpl_vars['my_userid']->value) {?><a class="js-delete" href="deleteuser.php<?php echo $_smarty_tpl->tpl_vars['urlext']->value;?>
&amp;user_id=<?php echo $_smarty_tpl->tpl_vars['user']->value->id;?>
" title="<?php echo lang('deleteuser');?>
"><?php echo smarty_function_admin_icon(array('icon'=>'delete.gif'),$_smarty_tpl);?>
</a><?php }?></td><td><?php if ($_smarty_tpl->tpl_vars['can_edit']->value && $_smarty_tpl->tpl_vars['user']->value->id != $_smarty_tpl->tpl_vars['my_userid']->value) {?><input class="multiselect" type="checkbox" name="multiselect[]" value="<?php echo $_smarty_tpl->tpl_vars['user']->value->id;?>
" title="<?php echo lang('info_selectuser');?>
"/><?php }?></td></tr><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></tbody></table><div class="pageoptions"><div style="width: 40%; float: left;"><a href="adduser.php<?php echo $_smarty_tpl->tpl_vars['urlext']->value;?>
" title="<?php echo lang('info_adduser');?>
"><?php echo smarty_function_admin_icon(array('icon'=>'newobject.gif'),$_smarty_tpl);?>
&nbsp;<?php echo lang('adduser');?>
</a></div><div style="width: 40%; float: right; text-align: right;"><label for="withselected"><?php echo lang('selecteditems');?>
:</label>&nbsp;<select name="bulkaction" id="withselected"><option value="delete"><?php echo lang('delete');?>
</option><option value="clearoptions"><?php echo lang('clearusersettings');?>
</option><option value="copyoptions"><?php echo lang('copyusersettings2');?>
</option><option value="disable"><?php echo lang('disable');?>
</option><option value="enable"><?php echo lang('enable');?>
</option></select>&nbsp;<div id="userlist" style="display: none;"><label for="userlist_sub"><?php echo lang('copyfromuser');?>
:</label>&nbsp;<select name="userlist" id="userlist_sub"><?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['userlist']->value),$_smarty_tpl);?>
</select>&nbsp;</div><input type="submit" id="bulksubmit" name="bulk" value="<?php echo lang('submit');?>
"/></div></div><?php echo smarty_function_form_end(array(),$_smarty_tpl);?>

<?php }
}
