<?php /* Smarty version Smarty-3.1.12, created on 2013-01-13 06:12:56
         compiled from "/_SymfonyProjects/wavendon-props/application/smarty/templates/admin/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:166665760550f250689bcb09-83236012%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '88a01b200eba09acd4b1373625ee6b00d649a578' => 
    array (
      0 => '/_SymfonyProjects/wavendon-props/application/smarty/templates/admin/header.tpl',
      1 => 1357460726,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '166665760550f250689bcb09-83236012',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'base_root_url' => 0,
    'css_dir' => 0,
    'images_dir' => 0,
    'js_dir' => 0,
    'base_url' => 0,
    'images_dir_full_url' => 0,
    'LoggedUserName' => 0,
    'DateFormat' => 0,
    'admin_link' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_50f25068a507c8_78410185',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50f25068a507c8_78410185')) {function content_50f25068a507c8_78410185($_smarty_tpl) {?><!DOCTYPE html>
<html>
  <head>
    <title>
      Wavendon Properties is a business that buys properties
    </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['base_root_url']->value;?>
<?php echo $_smarty_tpl->tpl_vars['css_dir']->value;?>
main.css" type="text/css" media="all" />
    <link rel="shortcut icon" href="<?php echo $_smarty_tpl->tpl_vars['base_root_url']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['images_dir']->value;?>
favicon.ico" />
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['base_root_url']->value;?>
<?php echo $_smarty_tpl->tpl_vars['js_dir']->value;?>
jquery/jquery.js"></script>
    <script type="text/javascript" src="/<?php echo $_smarty_tpl->tpl_vars['js_dir']->value;?>
funcs.js"></script>
    <link rel="stylesheet" href="/<?php echo $_smarty_tpl->tpl_vars['css_dir']->value;?>
thickbox.css" type="text/css" media="all" />
    <script type="text/javascript" src="/<?php echo $_smarty_tpl->tpl_vars['js_dir']->value;?>
jquery/thickbox-compressed.js"></script>
    <script type="text/javascript" src="/<?php echo $_smarty_tpl->tpl_vars['js_dir']->value;?>
jquery/jquery.cookie.js"></script>
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['base_root_url']->value;?>
<?php echo $_smarty_tpl->tpl_vars['css_dir']->value;?>
jquery-ui.css" type="text/css" media="all" />

  </head>
  <body>

    <div id="container">
      <div id="header">
        Wavendon Properties is a business that buys properties. Logo
      </div>

      <?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
<?php $_tmp1=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['base_root_url']->value;?>
<?php $_tmp2=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['images_dir']->value;?>
<?php $_tmp3=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['images_dir_full_url']->value;?>
<?php $_tmp4=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['css_dir']->value;?>
<?php $_tmp5=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['js_dir']->value;?>
<?php $_tmp6=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['LoggedUserName']->value;?>
<?php $_tmp7=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['DateFormat']->value;?>
<?php $_tmp8=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['admin_link']->value;?>
<?php $_tmp9=ob_get_clean();?><?php echo $_smarty_tpl->getSubTemplate ('admin/menu.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>'foo','base_url'=>$_tmp1,'base_root_url'=>$_tmp2,'images_dir'=>$_tmp3,'images_dir_full_url'=>$_tmp4,'css_dir'=>$_tmp5,'js_dir'=>$_tmp6,'LoggedUserName'=>$_tmp7,'DateFormat'=>$_tmp8,'admin_link'=>$_tmp9), 0);?>

<?php }} ?>