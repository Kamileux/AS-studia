<?php
/* Smarty version 4.5.2, created on 2025-05-16 22:02:42
  from 'tpl_body:14' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.2',
  'unifunc' => 'content_682799e2f31be3_53682509',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '650460e1799b95e04d87ae3036cb2c53a06b88df' => 
    array (
      0 => 'tpl_body:14',
      1 => '1747425707',
      2 => 'tpl_body',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_682799e2f31be3_53682509 (Smarty_Internal_Template $_smarty_tpl) {
?><body style="font-family: sans-serif; margin: 0; padding: 0;">

  <!-- MENU -->
  <nav style="background-color: #1A3636; padding: 1em;">
    <ul style="list-style: none; margin: 0; padding: 0; display: flex; gap: 1em;">
      <?php echo MenuManager::function_plugin(array('template'=>'simple_navigation.tpl'),$_smarty_tpl);?>

    </ul>
  </nav>

  <!-- TREŚĆ -->
  <main style="padding: 2em;">
    <?php CMS_Content_Block::smarty_internal_fetch_contentblock(array(),$_smarty_tpl); ?>
  </main>

  <!-- STOPKA -->
  <footer style="background-color: #D6BD98; text-align: center; padding: 1em;">
    © Cozy Shelf – Twoja biblioteczka 2025
  </footer>

</body>
</html><?php }
}
