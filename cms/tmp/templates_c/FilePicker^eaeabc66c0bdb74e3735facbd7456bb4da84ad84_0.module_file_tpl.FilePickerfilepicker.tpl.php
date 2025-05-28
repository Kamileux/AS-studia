<?php
/* Smarty version 4.5.2, created on 2025-05-28 18:19:57
  from 'module_file_tpl:FilePicker;filepicker.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.2',
  'unifunc' => 'content_683737ad7ed706_66313863',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'eaeabc66c0bdb74e3735facbd7456bb4da84ad84' => 
    array (
      0 => 'module_file_tpl:FilePicker;filepicker.tpl',
      1 => 1746563356,
      2 => 'module_file_tpl',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_683737ad7ed706_66313863 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\xampp\\htdocs\\cms\\lib\\plugins\\function.cms_jquery.php','function'=>'smarty_function_cms_jquery',),1=>array('file'=>'C:\\xampp\\htdocs\\cms\\lib\\plugins\\function.cms_action_url.php','function'=>'smarty_cms_function_cms_action_url',),));
?>
<!doctype html>
<html lang="en" data-cmsfp-inst="<?php echo $_smarty_tpl->tpl_vars['inst']->value;?>
">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="Content-type" content="text/html;charset=utf-8"/>
		<title><?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('filepickertitle');?>
</title>
		<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['cssurl']->value;?>
">
	</head>
	<body class="cmsms-filepicker"><div id="full-fp"><div class="filepicker-navbar"><div class="filepicker-navbar-inner"><div class="filepicker-view-option"><p><span class="js-trigger view-list filepicker-button" title="<?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('switchlist');?>
"><i class="cmsms-fp-th-list"></i></span><span class="js-trigger view-grid filepicker-button active" title="<?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('switchgrid');?>
"><i class="cmsms-fp-th"></i></span></p></div><div class="filepicker-options"><p><?php if ($_smarty_tpl->tpl_vars['profile']->value->can_mkdir) {?><span class="filepicker-button make-dir filepicker-cmd" data-cmd="mkdir" title="<?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('create_dir');?>
"><span class="filepicker-icon-stack"><i class="cmsms-fp-folder-close filepicker-icon-stack-1x"></i><i class="cmsms-fp-folder-plus filepicker-icon-stack-1x">+</i></span></span><?php }
if ($_smarty_tpl->tpl_vars['profile']->value->can_upload) {?><span class="filepicker-button upload-file btn-file"><i class="cmsms-fp-upload"></i> <?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('upload');?>
<input id="filepicker-file-upload" type="file" multiple="" title="<?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('select_upload_files');?>
"></span><?php }?></p></div><?php $_smarty_tpl->_assignInScope('type', (($tmp = $_smarty_tpl->tpl_vars['profile']->value->type ?? null)===null||$tmp==='' ? 'any' ?? null : $tmp));
if ($_smarty_tpl->tpl_vars['type']->value == 'any') {?><div class="filepicker-type-filter"><p><span class="filepicker-option-title"><?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('filterby');?>
:&nbsp;</span><span class="js-trigger filepicker-button" data-fb-type='image' title="<?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('switchimage');?>
"><i class="cmsms-fp-picture"></i></span>&nbsp;<span class="js-trigger filepicker-button" data-fb-type='video' title="<?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('switchvideo');?>
"><i class="cmsms-fp-film"></i></span>&nbsp;<span class="js-trigger filepicker-button" data-fb-type='audio' title="<?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('switchaudio');?>
"><i class="cmsms-fp-music"></i></span>&nbsp;<span class="js-trigger filepicker-button" data-fb-type='archive' title="<?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('switcharchive');?>
"><i class="cmsms-fp-zip"></i></span>&nbsp;<span class="js-trigger filepicker-button" data-fb-type='file' title="<?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('switchfiles');?>
"><i class="cmsms-fp-file"></i></span>&nbsp;<span class="js-trigger filepicker-button active" data-fb-type='reset' title="<?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('switchreset');?>
"><i class="cmsms-fp-reorder"></i></span></p></div><?php }?></div></div><div class="filepicker-container"><div id="filepicker-progress" class="filepicker-breadcrumb"><p class="filepicker-breadcrumb-text" title="<?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('youareintext');?>
:"><i class="cmsms-fp-folder-open filepicker-icon"></i> <?php echo $_smarty_tpl->tpl_vars['cwd_for_display']->value;?>
</p><p id="filepicker-progress-text" style="display: none;"></p></div><div id="filelist"><ul class="filepicker-list" id="filepicker-items"><li class="filepicker-item filepicker-item-heading"><div class="filepicker-thumb no-background">&nbsp;</div><div class="filepicker-file-information"><h4 class="filepicker-file-title"><?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('filename');?>
</h4></div><div class="filepicker-file-details"><span class="filepicker-file-dimension"><?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('dimension');?>
</span><span class="filepicker-file-size"><?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('size');?>
</span><span class="filepicker-file-ext"><?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('type');?>
</span></div></li><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['files']->value, 'file');
$_smarty_tpl->tpl_vars['file']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['file']->value) {
$_smarty_tpl->tpl_vars['file']->do_else = false;
?><li class="filepicker-item<?php if ($_smarty_tpl->tpl_vars['file']->value['isdir']) {?> dir<?php } else { ?> <?php echo $_smarty_tpl->tpl_vars['file']->value['filetype'];
}?>" title="<?php if ($_smarty_tpl->tpl_vars['file']->value['isdir']) {
echo $_smarty_tpl->tpl_vars['mod']->value->Lang('changedir');?>
: <?php }
echo $_smarty_tpl->tpl_vars['file']->value['name'];?>
" data-fb-ext='<?php echo $_smarty_tpl->tpl_vars['file']->value['ext'];?>
' data-fb-fname="<?php echo $_smarty_tpl->tpl_vars['file']->value['name'];?>
"><div class="filepicker-thumb<?php if (($_smarty_tpl->tpl_vars['profile']->value->show_thumbs && (isset($_smarty_tpl->tpl_vars['file']->value['thumbnail'])) && $_smarty_tpl->tpl_vars['file']->value['thumbnail'] != '') || $_smarty_tpl->tpl_vars['file']->value['isdir'] || ($_smarty_tpl->tpl_vars['profile']->value->show_thumbs && $_smarty_tpl->tpl_vars['file']->value['is_thumb'])) {?> no-background<?php }?>"><?php if (!$_smarty_tpl->tpl_vars['file']->value['isdir'] && $_smarty_tpl->tpl_vars['profile']->value->can_delete && !$_smarty_tpl->tpl_vars['file']->value['isparent']) {?><span class="filepicker-delete filepicker-cmd cmsms-fp-delete" data-cmd="del" title="<?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('delete');?>
"><i class="cmsms-fp-close"></i></span><?php }
if ($_smarty_tpl->tpl_vars['file']->value['isdir']) {?><a class="icon-no-thumb" href="<?php echo $_smarty_tpl->tpl_vars['file']->value['chdir_url'];?>
" title="<?php if ($_smarty_tpl->tpl_vars['file']->value['isdir']) {
echo $_smarty_tpl->tpl_vars['mod']->value->Lang('changedir');?>
: <?php }
echo $_smarty_tpl->tpl_vars['file']->value['name'];?>
"><i class="cmsms-fp-folder-close"></i></a><?php } elseif ($_smarty_tpl->tpl_vars['profile']->value->show_thumbs && (isset($_smarty_tpl->tpl_vars['file']->value['thumbnail'])) && $_smarty_tpl->tpl_vars['file']->value['thumbnail'] != '') {?><a class="filepicker-file-action js-trigger-insert" href="<?php echo $_smarty_tpl->tpl_vars['file']->value['relurl'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['file']->value['name'];?>
"><?php echo $_smarty_tpl->tpl_vars['file']->value['thumbnail'];?>
</a><?php } elseif ($_smarty_tpl->tpl_vars['profile']->value->show_thumbs && $_smarty_tpl->tpl_vars['file']->value['is_thumb']) {?><a class="filepicker-file-action js-trigger-insert" href="<?php echo $_smarty_tpl->tpl_vars['file']->value['relurl'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['file']->value['name'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['file']->value['fullurl'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['file']->value['name'];?>
"/></a><?php } else { ?><a class="filepicker-file-action js-trigger-insert icon-no-thumb" title="<?php echo $_smarty_tpl->tpl_vars['file']->value['name'];?>
" href="<?php echo $_smarty_tpl->tpl_vars['file']->value['relurl'];?>
"><?php if ($_smarty_tpl->tpl_vars['file']->value['filetype'] == 'image') {?><i class="cmsms-fp-picture"></i><?php } elseif ($_smarty_tpl->tpl_vars['file']->value['filetype'] == 'video') {?><i class="cmsms-fp-facetime-video"></i><?php } elseif ($_smarty_tpl->tpl_vars['file']->value['filetype'] == 'audio') {?><i class="cmsms-fp-music"></i><?php } elseif ($_smarty_tpl->tpl_vars['file']->value['filetype'] == 'archive') {?><i class="cmsms-fp-zip"></i><?php } else { ?><i class="cmsms-fp-file"></i><?php }?></a><?php }?></div><div class="filepicker-file-information"><h4 class="filepicker-file-title"><?php if ($_smarty_tpl->tpl_vars['file']->value['isdir']) {?><a class="filepicker-dir-action" href="<?php echo $_smarty_tpl->tpl_vars['file']->value['chdir_url'];?>
" title="<?php if ($_smarty_tpl->tpl_vars['file']->value['isdir']) {
echo $_smarty_tpl->tpl_vars['mod']->value->Lang('changedir');?>
: <?php }
echo $_smarty_tpl->tpl_vars['file']->value['name'];?>
"><?php echo $_smarty_tpl->tpl_vars['file']->value['name'];?>
</a><?php } else { ?><a class="filepicker-file-action js-trigger-insert" href="<?php echo $_smarty_tpl->tpl_vars['file']->value['relurl'];?>
" title="<?php if ($_smarty_tpl->tpl_vars['file']->value['isdir']) {
echo $_smarty_tpl->tpl_vars['mod']->value->Lang('changedir');?>
: <?php }
echo $_smarty_tpl->tpl_vars['file']->value['name'];?>
" data-fb-filetype='<?php echo $_smarty_tpl->tpl_vars['file']->value['filetype'];?>
'><?php echo $_smarty_tpl->tpl_vars['file']->value['name'];?>
</a><?php }?></h4></div><div class="filepicker-file-details visuallyhidden"><span class="filepicker-file-dimension"><?php echo $_smarty_tpl->tpl_vars['file']->value['dimensions'];?>
</span><span class="filepicker-file-size"><?php if (!$_smarty_tpl->tpl_vars['file']->value['isdir']) {
echo $_smarty_tpl->tpl_vars['file']->value['size'];
}?></span><span class="filepicker-file-ext"><?php if (!$_smarty_tpl->tpl_vars['file']->value['isdir']) {
echo $_smarty_tpl->tpl_vars['file']->value['ext'];
} else { ?>dir<?php }?></span><?php if (!$_smarty_tpl->tpl_vars['file']->value['isdir'] && $_smarty_tpl->tpl_vars['profile']->value->can_delete && !$_smarty_tpl->tpl_vars['file']->value['isparent']) {?><span class="filepicker-delete filepicker-cmd cmsms-fp-delete" data-cmd="del" title="<?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('delete');?>
"><i class="cmsms-fp-close"></i></span><?php }?></div></li><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></ul></div></div></div></body>
	<?php echo smarty_function_cms_jquery(array('exclude'=>'ui_touch_punch,nestedSortable,json,migrate,cms_autorefresh,cms_dirtyform,cms_hiersel,cms_lock,cms_filepicker'),$_smarty_tpl);?>

        <?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['mod']->value->GetModuleURLPath();?>
/js/ext/jquery.fileupload.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['mod']->value->GetModuleURLPath();?>
/lib/js/cmsms_filebrowser/filebrowser.js"><?php echo '</script'; ?>
>
  	<?php echo '<script'; ?>
 type="text/javascript">
          $(document).ready(function(){
            var options = {};
            options.cmd_url = '<?php echo smarty_cms_function_cms_action_url(array('action'=>'ajax_cmd','forjs'=>1),$_smarty_tpl);?>
&showtemplate=false';
            options.cwd = '<?php echo $_smarty_tpl->tpl_vars['cwd']->value;?>
';
	    options.sig = '<?php echo $_smarty_tpl->tpl_vars['sig']->value;?>
';
	    options.inst = '<?php echo $_smarty_tpl->tpl_vars['inst']->value;?>
';
            options.lang = <?php echo $_smarty_tpl->tpl_vars['lang_js']->value;?>
;
            options.prefix = '<?php echo $_smarty_tpl->tpl_vars['profile']->value->prefix;?>
';
            var filepicker = new CMSFileBrowser(options);
          })
  	<?php echo '</script'; ?>
>

  	<div id="mkdir_dlg" title="<?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('title_mkdir');?>
" style="display: none;" data-oklbl="<?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('ok');?>
">
		<div class="dlg-options">
       	<label><?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('name');?>
:</label> <input type="text" id="fld_mkdir" size="40"/>
    	</div>
  	</div>
</html>
<?php }
}
