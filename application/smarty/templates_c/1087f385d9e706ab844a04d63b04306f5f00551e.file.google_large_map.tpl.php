<?php /* Smarty version Smarty-3.1.12, created on 2013-01-13 08:07:45
         compiled from "/_SymfonyProjects/wavendon-props/application/smarty/templates/admin/google_large_map.tpl" */ ?>
<?php /*%%SmartyHeaderCode:104611676250f26b51d6b2e9-24031376%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1087f385d9e706ab844a04d63b04306f5f00551e' => 
    array (
      0 => '/_SymfonyProjects/wavendon-props/application/smarty/templates/admin/google_large_map.tpl',
      1 => 1357826478,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '104611676250f26b51d6b2e9-24031376',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'lat' => 0,
    'lng' => 0,
    'addr' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_50f26b51dd5e67_33241208',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50f26b51dd5e67_33241208')) {function content_50f26b51dd5e67_33241208($_smarty_tpl) {?><!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <style type="text/css">
      html { height: 100% }
      body { height: 100%; margin: 0; padding: 0 }
      #map_canvas { height: 100% }
    </style>
    <script type="text/javascript"
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDUlP_JEwA9gAFkCeNC43P3NZYe8cISg54&sensor=true">
    </script>
    <script type="text/javascript">
      function initialize() {
        var mapOptions = {
          center: new google.maps.LatLng( <?php echo $_smarty_tpl->tpl_vars['lat']->value;?>
, <?php echo $_smarty_tpl->tpl_vars['lng']->value;?>
/*-34.397, 150.644*/ ),
          zoom: 14/*16*/,
          mapTypeId: google.maps.MapTypeId.ROADMAP, // HYBRID
          //"icon" : "http://local-wavendon-props.com/images/up-arrow.jpg"
        };
        var map = new google.maps.Map(document.getElementById("map_canvas"),
            mapOptions);

         marker = new google.maps.Marker({
                position : new google.maps.LatLng(<?php echo $_smarty_tpl->tpl_vars['lat']->value;?>
, <?php echo $_smarty_tpl->tpl_vars['lng']->value;?>
),
                draggable: true,
                  title: '<?php echo $_smarty_tpl->tpl_vars['addr']->value;?>
',
                map : map
            });
      }
    </script>
  </head>
  <body onload="initialize()">
    <div id="map_canvas" style="width:100%; height:100%"></div>
  </body>
</html><?php }} ?>