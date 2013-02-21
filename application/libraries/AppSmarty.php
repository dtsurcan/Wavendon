<?php
 require_once(SMARTY_DIR . 'Smarty.class.php');

class AppSmarty extends Smarty {

  function __construct() {
    parent::__construct();
    $true->debugging = true; //Uncomment this if you want to see the debugging window pop up when you call a template!
    //echo '<pre>AppSmarty::__construct::'.print_r( 1, true ).'</pre><br>';
  }
  public function RunSmartyTemplate( $template_name, $data, $config_object, $is_backend, $show_header_template= false, $show_footer_template= false ) {
    $config_array= $config_object->config;
    $this->template_dir = $config_array['document_root'] . 'application/smarty/templates';
    $this->compile_dir = $config_array['document_root'] . 'application/smarty/templates_c';
    $this->cache_dir = $config_array['document_root'] . 'application/smarty/cache';
    $this->config_dir = $config_array['document_root'] . 'application/smarty/configs';

    foreach( $data as $DataKey=>$DataValue ) {
      $this->assign( $DataKey, $DataValue );
    }
    $this->registerPlugin("function","date_now", "print_current_date");
    $this->registerPlugin("function","show_sorting_directory", "smShowSortingDirectory");
    $this->registerPlugin("function","show_list_sorting_image", "smShowListSortingImage");
    $this->registerPlugin("function","show_feature_type_title", "smShowFeatureTypeTitle");
    $this->registerPlugin("function","show_formatted_datetime", "smShowFormattedDatetime");
    $this->registerPlugin("function","concat_str", "smConcatStr");
    $this->registerPlugin("function","show_user_type_title", "smShowUserTypeTitle");
    $this->registerPlugin("function","show_title_of_text", "smShowshowTitleOfText");
    $this->registerPlugin("function","show_property_type_title", "smShowPropertyTypeTitle");
    $this->registerPlugin("function","show_room_status_title", "smShowRoomStatusTitle");
    $this->registerPlugin("compiler","return", "smarty_compiler_return");
    if ( $show_header_template ) {
      $this->display( ($is_backend?'admin/':'') . 'header.tpl');
    }
    $this->display($template_name);
    if ( $show_footer_template ) {
      $this->display( ($is_backend?'admin/':'') . 'footer.tpl' );
    }
  }


  public static function AddSystemParameters( $data, $ControllerRef, $config_object= null, $AddCSRF= false ) {
    if ( !empty($config_object) ) {
      $data['base_url']= $config_object->base_url();
      $data['base_root_url']= $config_object->config['base_root_url'];
      $data['images_dir']= $config_object->config['images_dir'];
      $data['images_dir_full_url']= $data['base_root_url'] . $config_object->config['images_dir'];
      $data['css_dir']= $config_object->config['css_dir'];
      $data['js_dir']= $config_object->config['js_dir'];
      $data['document_root']= $config_object->config['document_root'];
    }
    if ( $AddCSRF ) {
      $data['csrf_token_name_hidden']= '<input type="hidden" name="' .$ControllerRef->security->get_csrf_token_name() . '" value="' .$ControllerRef->security->get_csrf_hash() . '" />';
      $data['LoggedUserName']= AppAuth::getLoggedUserName($ControllerRef);
    }
    $data['DateFormat']= AppUtils::getDateFormat();
    $UriArray =$ControllerRef->uri->uri_to_assoc(1) ;
    if ( !empty($UriArray['admin']) ) {
      $data['admin_link']= $UriArray['admin'];
    }
    // $UriArray['admin']
    return $data;
  }

}


function print_current_date($params, $smarty)
{
  if(empty($params["format"])) {
    $format = "%b %e, %Y";
  } else {
    $format = $params["format"];
  }
  return strftime($format,time());
}

function smShowSortingDirectory($params, $smarty) {
  return ( ( $params["sorting"] == $params["fieldname"] and $params["sort"] == 'asc') ? "/sort/desc" : "/sort/asc" );
}

function smShowListSortingImage( $params, $smarty ) {
  if ( $params["sorting"] == $params["fieldname"] and $params["sort"] == 'asc') {
    return '<img src="' . $params["images_dir_full_url"] . 'up-arrow.jpg" alt="Up" title="Up">';
  }
  if ( $params["sorting"] == $params["fieldname"] and $params["sort"] == 'desc') {
    return '<img src="' . $params["images_dir_full_url"] .'down-arrow.jpg" alt="Down" title="Down">';
  }
} // function ShowListSortingImage( $sorting, $sort ) {

function smShowFeatureTypeTitle( $params, $smarty ) {
  return $params['ControllerRef']->mfeature->getTypeTitle( $params['type'] );
}

function smShowUserTypeTitle( $params, $smarty ) {
  return $params['ControllerRef']->muser->getTypeTitle( $params['type'] );
}

function smShowFormattedDatetime( $params, $smarty ) {
  if ( empty($params['datetime_label']) )  return '';
  return AppUtils::ShowFormattedDateTime( $params['datetime_label'], $params['format'] );
}

function smConcatStr( $params, $smarty ) {
  return AppUtils::ConcatStr( $params['str'], $params['len'] ) ;
}

function smShowshowTitleOfText( $params, $smarty ) {
  $ResStr= substr( $params['str'], 0, $params['maxlen']);
  if ($params['is_replace_crlf']) {
    $ResStr= str_replace( "'"," ",str_replace("\n"," ",$ResStr) );
  }
  return $ResStr;
}

function smShowPropertyTypeTitle( $params, $smarty ) {
  return $params['ControllerRef']->mproperty->getTypeTitle( $params['type'] );
}
function smShowRoomStatusTitle( $params, $smarty ) {
  return $params['ControllerRef']->mroom->getStatusTitle( $params['status'] );
}

function smarty_compiler_return($tag_arg, &$smarty)
{
//  AppUtils::WriteToFileName( '', "QQQWWWEEERRRTTTYYYsmarty_compiler_return:::;" );
  return "<?php return; ?>";
}
?>