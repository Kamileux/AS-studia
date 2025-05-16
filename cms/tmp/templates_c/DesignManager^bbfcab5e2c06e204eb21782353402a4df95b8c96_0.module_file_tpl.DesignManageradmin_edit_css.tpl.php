<?php
/* Smarty version 4.5.2, created on 2025-05-16 21:54:29
  from 'module_file_tpl:DesignManager;admin_edit_css.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.2',
  'unifunc' => 'content_682797f5e16956_08198561',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bbfcab5e2c06e204eb21782353402a4df95b8c96' => 
    array (
      0 => 'module_file_tpl:DesignManager;admin_edit_css.tpl',
      1 => 1746563353,
      2 => 'module_file_tpl',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_682797f5e16956_08198561 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\xampp\\htdocs\\cms\\lib\\plugins\\function.form_start.php','function'=>'smarty_function_form_start',),1=>array('file'=>'C:\\xampp\\htdocs\\cms\\admin\\plugins\\function.cms_help.php','function'=>'smarty_function_cms_help',),2=>array('file'=>'C:\\xampp\\htdocs\\cms\\lib\\plugins\\modifier.localedate_format.php','function'=>'smarty_modifier_localedate_format',),3=>array('file'=>'C:\\xampp\\htdocs\\cms\\admin\\plugins\\function.tab_header.php','function'=>'smarty_function_tab_header',),4=>array('file'=>'C:\\xampp\\htdocs\\cms\\admin\\plugins\\function.tab_start.php','function'=>'smarty_function_tab_start',),5=>array('file'=>'C:\\xampp\\htdocs\\cms\\lib\\plugins\\function.cms_textarea.php','function'=>'smarty_function_cms_textarea',),6=>array('file'=>'C:\\xampp\\htdocs\\cms\\lib\\smarty\\plugins\\function.html_options.php','function'=>'smarty_function_html_options',),7=>array('file'=>'C:\\xampp\\htdocs\\cms\\admin\\plugins\\function.tab_end.php','function'=>'smarty_function_tab_end',),8=>array('file'=>'C:\\xampp\\htdocs\\cms\\lib\\plugins\\function.form_end.php','function'=>'smarty_function_form_end',),));
echo '<script'; ?>
 type="text/javascript">
$(document).ready(function(){
    var do_locking = <?php if ((($tmp = $_smarty_tpl->tpl_vars['css_id']->value ?? null)===null||$tmp==='' ? 0 ?? null : $tmp) > 0 && (isset($_smarty_tpl->tpl_vars['lock_timeout']->value)) && $_smarty_tpl->tpl_vars['lock_timeout']->value > 0) {?>1<?php } else { ?>0<?php }?>;
    $('#form_editcss').dirtyForm({
        beforeUnload: function() {
            if( do_locking )$('#form_editcss').lockManager('unlock');
        },
        unloadCancel: function() {
            if( do_locking )$('#form_editcss').lockManager('relock');
        }
    });

    // initialize lock manager
    if( do_locking ) {
      $('#form_editcss').lockManager({
        type: 'stylesheet',
        oid: <?php echo (($tmp = $_smarty_tpl->tpl_vars['css_id']->value ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
,
        uid: <?php echo get_userid(FALSE);?>
,
        lock_timeout: <?php echo (($tmp = $_smarty_tpl->tpl_vars['lock_timeout']->value ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
,
        lock_refresh: <?php echo (($tmp = $_smarty_tpl->tpl_vars['lock_refresh']->value ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
,
        error_handler: function(err) {
            cms_alert('got error '+err.type+' // '+err.msg);
        },
        lostlock_handler: function(err) {
            // we lost the lock on this stylesheet... make sure we can't save anything.
            // and display a nice message.
        console.debug('lost lock handler');
            $('[name$=cancel]').fadeOut().attr('value','<?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('cancel');?>
').fadeIn();
            $('#form_editcss').dirtyForm('option','dirty',false);
            $('#submitbtn, #applybtn').attr('disabled','disabled');
            $('#submitbtn, #applybtn').button({ 'disabled' : true });
            $('.lock-warning').removeClass('hidden-item');
            cms_alert('<?php echo strtr((string)$_smarty_tpl->tpl_vars['mod']->value->Lang('msg_lostlock'), array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", 
                       "\n" => "\\n", "</" => "<\/", "<!--" => "<\!--", "<s" => "<\s", "<S" => "<\S",
                       "`" => "\\`", "\${" => "\\\$\{"));?>
');
        }
      });
    }

    $(document).on('cmsms_textchange',function(event){
        // editor textchange, set the form dirty.
        $('#form_editcss').dirtyForm('option','dirty',true);
    });

    $(document).on('click','[name$=apply],[name$=submit]',function(){
        $('#form_editcss').dirtyForm('option','dirty',false);
    });

    $(document).on('click', '#submitbtn, #cancelbtn, #importbtn, #exportbtn', function(ev){
       if( ! do_locking ) return;

       // unlock the item, and submit the form
       var self = this;
       ev.preventDefault();
       var form = $(this).closest('form');
       $('#form_editcss').lockManager('unlock').done(function(){
           var el = $('<input type="hidden"/>');
           el.attr('name',$(self).attr('name')).val($(self).val()).appendTo(form);
           form.submit();
       });
    });

    $(document).on('click', '#applybtn', function(e){
        e.preventDefault();

        var url = $('#form_editcss').attr('action')+'?showtemplate=false&m1_apply=1',
            data = $('#form_editcss').serializeArray();

        $.post(url, data, function(data,textStatus,jqXHR) {
            var $response = $('<aside/>').addClass('message');
            if (data.status === 'success') {

                $response.addClass('pagemcontainer')
                    .append($('<span>').text('Close').addClass('close-warning'))
                    .append($('<p/>').text(data.message));
            } else if (data.status === 'error') {

                $response.addClass('pageerrorcontainer')
                    .append($('<span>').text('Close').addClass('close-warning'))
                    .append($('<p/>').text(data.message));
            }

            $('body').append($response.hide());
            $response.slideDown(1000, function() {
                window.setTimeout(function() {
                    $response.slideUp();
                    $response.remove();
                }, 10000);
            });

            $('#cancelbtn').button('option','label','<?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('cancel');?>
');
            $('#tpl_modified_cont').hide();
            $('#content').focus();
        });
    });

    // disabling Media Type checkboxes if Media query is in use
    if ($('#mediaquery').val() !== '') {
        $('.media-type :checkbox').attr({
            disabled: 'disabled',
            checked: false
        });
    }

    $('#mediaquery').keyup(function(e) {
        if ($('#mediaquery').val() !== '') {
            $('.media-type :checkbox').attr({
                disabled: 'disabled',
                checked: false
            });
        } else {
            $('.media-type:checkbox').removeAttr('disabled');
        }
    });
});
<?php echo '</script'; ?>
>


<?php $_smarty_tpl->_assignInScope('get_lock', $_smarty_tpl->tpl_vars['css']->value->get_lock());
$_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', 'disable', null);?>
    <?php ob_start();
echo get_userid(false);
$_prefixVariable1 = ob_get_clean();
if ((isset($_smarty_tpl->tpl_vars['get_lock']->value)) && ($_prefixVariable1 != $_smarty_tpl->tpl_vars['get_lock']->value['uid'])) {?>disabled="disabled"<?php }
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>


<?php if ((isset($_smarty_tpl->tpl_vars['get_lock']->value))) {?>
    <div class="warning lock-warning">
        <?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('lock_warning');?>

    </div>
<?php }?>

<?php echo smarty_function_form_start(array('id'=>'form_editcss','extraparms'=>$_smarty_tpl->tpl_vars['extraparms']->value),$_smarty_tpl);?>

<fieldset class="cf">
    <div class="grid_6">
        <div class="pageoverflow">
            <p class="pageinput">
                <input type="submit" id="submitbtn" name="<?php echo $_smarty_tpl->tpl_vars['actionid']->value;?>
submit" value="<?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('submit');?>
"<?php echo preg_replace('!\s+!u', ' ',$_smarty_tpl->tpl_vars['disable']->value);?>
/>
                <input type="submit" id="cancelbtn" name="<?php echo $_smarty_tpl->tpl_vars['actionid']->value;?>
cancel" value="<?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('cancel');?>
"/>
                <?php if ($_smarty_tpl->tpl_vars['css']->value->get_id()) {?>
                <input type="submit" id="applybtn" name="<?php echo $_smarty_tpl->tpl_vars['actionid']->value;?>
apply" value="<?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('apply');?>
"<?php echo preg_replace('!\s+!u', ' ',$_smarty_tpl->tpl_vars['disable']->value);?>
/>
                <?php }?>
            </p>
        </div>
        <div class="pageoverflow">
            <p class="pagetext"><label for="css_name">*<?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('prompt_name');?>
:</label>&nbsp;<?php echo smarty_function_cms_help(array('key2'=>'help_stylesheet_name','title'=>$_smarty_tpl->tpl_vars['mod']->value->Lang('prompt_name')),$_smarty_tpl);?>
</p>
            <p class="pageinput">
                <input id="css_name" type="text" name="<?php echo $_smarty_tpl->tpl_vars['actionid']->value;?>
name" size="50" maxlength="90" value="<?php echo $_smarty_tpl->tpl_vars['css']->value->get_name();?>
" placeholder="<?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('new_stylesheet');?>
"/>
            </p>
        </div>
    </div>    <div class="grid_6">
    <?php if ($_smarty_tpl->tpl_vars['css']->value->get_id()) {?>
        <div class="pageoverflow">
            <p class="pagetext"><label for="css_created"><?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('prompt_created');?>
:</label>&nbsp;<?php echo smarty_function_cms_help(array('key2'=>'help_stylesheet_created','title'=>$_smarty_tpl->tpl_vars['mod']->value->Lang('prompt_created')),$_smarty_tpl);?>
</p>
            <p class="pageinput">
                <?php echo smarty_modifier_localedate_format($_smarty_tpl->tpl_vars['css']->value->get_created(),'%x %X');?>

            </p>
        </div>
        <div class="pageoverflow">
            <p class="pagetext"><label for="css_modified"><?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('prompt_modified');?>
:</label>&nbsp;<?php echo smarty_function_cms_help(array('key2'=>'help_stylesheet_modified','title'=>$_smarty_tpl->tpl_vars['mod']->value->Lang('prompt_modified')),$_smarty_tpl);?>
</p>
            <p class="pageinput">
                <?php echo smarty_modifier_localedate_format($_smarty_tpl->tpl_vars['css']->value->get_modified(),'%x %X');?>

            </p>
        </div>
    <?php }?>
    </div></fieldset>

<?php echo smarty_function_tab_header(array('name'=>'content','label'=>$_smarty_tpl->tpl_vars['mod']->value->Lang('prompt_stylesheet')),$_smarty_tpl);?>

<?php echo smarty_function_tab_header(array('name'=>'media_type','label'=>$_smarty_tpl->tpl_vars['mod']->value->Lang('prompt_media_type')),$_smarty_tpl);?>

<?php echo smarty_function_tab_header(array('name'=>'media_query','label'=>$_smarty_tpl->tpl_vars['mod']->value->Lang('prompt_media_query')),$_smarty_tpl);?>

<?php echo smarty_function_tab_header(array('name'=>'description','label'=>$_smarty_tpl->tpl_vars['mod']->value->Lang('prompt_description')),$_smarty_tpl);?>

<?php if ($_smarty_tpl->tpl_vars['has_designs_right']->value) {?>
    <?php echo smarty_function_tab_header(array('name'=>'designs','label'=>$_smarty_tpl->tpl_vars['mod']->value->Lang('prompt_designs')),$_smarty_tpl);?>

<?php }
echo smarty_function_tab_header(array('name'=>'advanced','label'=>$_smarty_tpl->tpl_vars['mod']->value->Lang('prompt_advanced')),$_smarty_tpl);?>


<?php echo smarty_function_tab_start(array('name'=>'content'),$_smarty_tpl);?>

<?php if ($_smarty_tpl->tpl_vars['css']->value->has_content_file()) {?>
  <div class="information"><?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('info_css_content_file',$_smarty_tpl->tpl_vars['css']->value->get_content_filename());?>
</div>
<?php } else { ?>
  <div class="pageoverflow">
      <p class="pagetext"><label for="stylesheet"><?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('prompt_stylesheet');?>
:</label>&nbsp;<?php echo smarty_function_cms_help(array('key2'=>'help_stylesheet_content','title'=>$_smarty_tpl->tpl_vars['mod']->value->Lang('prompt_stylesheet')),$_smarty_tpl);?>
</p>
      <p class="pageinput">
          <?php echo smarty_function_cms_textarea(array('id'=>'stylesheet','prefix'=>$_smarty_tpl->tpl_vars['actionid']->value,'name'=>'content','value'=>$_smarty_tpl->tpl_vars['css']->value->get_content(),'type'=>'css','rows'=>20,'cols'=>80),$_smarty_tpl);?>

      </p>
  </div>
<?php }?>

<?php echo smarty_function_tab_start(array('name'=>'media_type'),$_smarty_tpl);?>

<!-- media -->
<div class="pagewarning"><?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('info_editcss_mediatype_tab');?>
</div>
<div class="pageoverflow">
    <p class="patetext"><?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('prompt_media_type');?>
:</p>
    <?php $_smarty_tpl->_assignInScope('tmp', 'all,aural,speech,braille,embossed,handheld,print,projection,screen,tty,tv');?>
    <?php $_smarty_tpl->_assignInScope('all_types', explode(',',$_smarty_tpl->tpl_vars['tmp']->value));?>

    <p class="pageinput media-type">
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['all_types']->value, 'type', false, NULL, 'media_type', array (
  'last' => true,
  'iteration' => true,
  'total' => true,
));
$_smarty_tpl->tpl_vars['type']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['type']->value) {
$_smarty_tpl->tpl_vars['type']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_media_type']->value['iteration']++;
$_smarty_tpl->tpl_vars['__smarty_foreach_media_type']->value['last'] = $_smarty_tpl->tpl_vars['__smarty_foreach_media_type']->value['iteration'] === $_smarty_tpl->tpl_vars['__smarty_foreach_media_type']->value['total'];
?><input id="media_type_<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
" type="checkbox" name="<?php echo $_smarty_tpl->tpl_vars['actionid']->value;?>
media_type[]" value="<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['css']->value->has_media_type($_smarty_tpl->tpl_vars['type']->value)) {?>checked="checked"<?php }?>/>&nbsp;<?php $_smarty_tpl->_assignInScope('tmp', ('media_type_').($_smarty_tpl->tpl_vars['type']->value));?><label for="media_type_<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang($_smarty_tpl->tpl_vars['tmp']->value);?>
</label><?php if (!(isset($_smarty_tpl->tpl_vars['__smarty_foreach_media_type']->value['last']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_media_type']->value['last'] : null)) {?><br/><?php }
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </p>
</div>

<?php echo smarty_function_tab_start(array('name'=>'media_query'),$_smarty_tpl);?>

<div class="pagewarning"><?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('info_editcss_mediaquery_tab');?>
</div>
<div class="pageoverflow">
    <p class="pagetext"><label for="mediaquery"><?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('prompt_media_query');?>
:</label>&nbsp;<?php echo smarty_function_cms_help(array('key2'=>'help_css_mediaquery','title'=>$_smarty_tpl->tpl_vars['mod']->value->Lang('prompt_media_query')),$_smarty_tpl);?>
</p>
    <p class="pageinput">
        <textarea id="mediaquery" name="<?php echo $_smarty_tpl->tpl_vars['actionid']->value;?>
media_query" rows="10" cols="80"><?php echo $_smarty_tpl->tpl_vars['css']->value->get_media_query();?>
</textarea>
    </p>
</div>

<?php echo smarty_function_tab_start(array('name'=>'description'),$_smarty_tpl);?>

<div class="pageoverflow">
    <p class="pagetext"><label for="txt_description"><?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('prompt_description');?>
:</label>&nbsp;<?php echo smarty_function_cms_help(array('key2'=>'help_css_description','title'=>$_smarty_tpl->tpl_vars['mod']->value->Lang('prompt_description')),$_smarty_tpl);?>
</p>
    <p class="pageinput">
        <textarea id="txt_description" name="<?php echo $_smarty_tpl->tpl_vars['actionid']->value;?>
description" rows="10" cols="80"><?php echo $_smarty_tpl->tpl_vars['css']->value->get_description();?>
</textarea>
    </p>
</div>

<?php if ($_smarty_tpl->tpl_vars['has_designs_right']->value) {?>
    <?php echo smarty_function_tab_start(array('name'=>'designs'),$_smarty_tpl);?>

    <!-- designs -->
    <div class="pageoverflow">
        <p class="pagetext"><label for="designlist"><?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('prompt_designs');?>
:</label>&nbsp;<?php echo smarty_function_cms_help(array('key2'=>'help_css_designs','title'=>$_smarty_tpl->tpl_vars['mod']->value->Lang('prompt_designs')),$_smarty_tpl);?>
</p>
        <p class="pageinput">
            <select id="designlist" name="<?php echo $_smarty_tpl->tpl_vars['actionid']->value;?>
design_list[]" multiple="multiple" size="5">
                <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['design_list']->value,'selected'=>$_smarty_tpl->tpl_vars['css']->value->get_designs()),$_smarty_tpl);?>

            </select>
        </p>
    </div>
<?php }?>

<?php echo smarty_function_tab_start(array('name'=>'advanced'),$_smarty_tpl);?>

<?php if ($_smarty_tpl->tpl_vars['css']->value->get_id() > 0) {?>
  <div class="pageoverflow">
    <p class="pagetext"><?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('prompt_cssfile');?>
:</p>
    <p class="pageinput">
        <?php if ($_smarty_tpl->tpl_vars['css']->value->has_content_file()) {?>
            <input type="submit" id="importbtn" name="<?php echo $_smarty_tpl->tpl_vars['actionid']->value;?>
import" value="<?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('import');?>
"/>
        <?php } else { ?>
            <input type="submit" id="exportbtn" name="<?php echo $_smarty_tpl->tpl_vars['actionid']->value;?>
export" value="<?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('export');?>
"/>
        <?php }?>
    </p>
  </div>
<?php }
echo smarty_function_tab_end(array(),$_smarty_tpl);?>


<?php echo smarty_function_form_end(array(),$_smarty_tpl);?>

<?php }
}
