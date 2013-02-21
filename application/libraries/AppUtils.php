<?php
class AppUtils {
  private static $DateFormat= '%B %d, %Y';
  private static $DateTimeFormat= '%Y-%m-%d %H:%M';
  private static $DateTimeAsTextFormat= '%B %d, %Y %H:%M%p';
  private static $DateAsTextFormat= '%B %d, %Y';
  private static $DateTimeMySqlFormat= '%Y-%m-%d %H:%M:%S';
  private static $YesNoValueArray= array(0=>'No', 1=>'Yes');
  private static $ConcatStrMaxLength= 30;
  private static $ConcatStrAddChars= '...';
  private static $MinValidYear= 2000;
  private static $MaxValidYear= 2050;

  private static $DatePickerSelectionFormat= 'mm/dd/yy';

  // AppUtils::AddSystemParameters( $data, $this, $config_array, true );
  /*public static function AddSystemParameters( $data, $ControllerRef, $config_object= null, $AddCSRF= false ) {
    if ( !empty($config_object) ) {
      $data['base_url']= $config_object->base_url();
      $data['base_root_url']= $config_object->config['base_root_url'];
      $data['images_dir']= $config_object->config['images_dir'];
      $data['images_dir_full_url']= $data['base_root_url'] . $config_object->config['images_dir'];
      $data['css_dir']= $config_object->config['css_dir'];
      $data['js_dir']= $config_object->config['js_dir'];
    }
    if ( $AddCSRF ) {
      $data['csrf_token_name_hidden']= '<input type="hidden" name="' .$ControllerRef->security->get_csrf_token_name() . '" value="' .$ControllerRef->security->get_csrf_hash() . '" />';
    }
    $data['LoggedUserName']= AppAuth::getLoggedUserName($ControllerRef);
    $data['DateFormat']= self::getDateFormat();
    $UriArray =$ControllerRef->uri->uri_to_assoc(1) ;
    if ( !empty($UriArray['admin']) ) {
      $data['admin_link']= $UriArray['admin'];
    }
    // $UriArray['admin']
    return $data;
  } */

  public static function getDateFormat() {
    return self::$DateFormat;
  }

  public static function getDateTimeMySqlFormat() {
    return self::$DateTimeMySqlFormat;
  }

  public static function getDatePickerSelectionFormat() {
    return self::$DatePickerSelectionFormat;
  }

  public static function ConvirtDateToMySqlFormat($StringDate) { // 12-14-2012
    $A= preg_split( "/\//", $StringDate);
    if ( count($A) == 3 ) {
      return self::ShowFormattedDateTime( mktime(null,null,null, $A[0], $A[1], $A[2] ), "MYSQL" );
    }
  }

  public static function ConvertFromMySqlToEditorFormat($StringDate) { // 	2012-12-28
    if (empty($StringDate)) return '';
    $A= preg_split( "/-/", $StringDate);
    if ( count($A) == 3 ) {
      return $A[1].'/'.$A[2].'/'.$A[0];
    }
  }


  public static function IsValidDate($StringDate) { // 12-14-2012
    $A= preg_split( "/\//", $StringDate);
    if ( count($A) != 3 ) return false;
    $Day= (int)$A[1];
    $Month= (int)$A[0];
    $Year= (int)$A[2];
    if ( !( $Year >= self::$MinValidYear and $Year <= self::$MaxValidYear ) ) return false;
    if ( !( $Month >= 1 and $Month <= 12 ) ) return false;
    if ( !( $Day >= 1 and $Day <= 31 ) ) return false;
    $DaysInMonth= self::DaysInMonth($Year, $Month);
    if ( !( $DaysInMonth > 0 and $Day <= $DaysInMonth ) ) return false;
    return true;
  }

  public static function DaysInMonth($Year, $Month) {
    //Util::deb($Year,'DaysInMonth  $Year::');
    //Util::deb($Month,'  $Month::');
    switch ($Month) {
      case 1:
        return 31;
      case 2:
        if (ceil($Year % 4) == 0)
          return 29; // високосный год
        else
          return 28;
      case 3:
        return 31;
      case 4:
        return 30;
      case 5:
        return 31;
      case 6:
        return 30;
      case 7:
        return 31;
      case 8:
        return 31;
      case 9:
        return 30;
      case 10:
        return 31;
      case 11:
        return 30;
      case 12:
        return 31;
    }
    return 0;
  }
/*
  public static function RunSmartyTemplate( $template_name, $data, $config_array ) {
    require_once(SMARTY_DIR . 'Smarty.class.php');
    $smarty = new Smarty;
    $smarty->template_dir = $config_array['document_root'] . 'application/smarty/templates';
    $smarty->compile_dir = $config_array['document_root'] . 'application/smarty/templates_c';
    $smarty->cache_dir = $config_array['document_root'] . 'application/smarty/cache';
    $smarty->config_dir = $config_array['document_root'] . 'application/smarty/configs';

    foreach( $data as $DataKey=>$DataValue ) {
      $smarty->assign( $DataKey, $DataValue );
    }
    $smarty->registerPlugin("function","date_now", "print_current_date");
    $smarty->registerPlugin("function","show_sorting_directory", "smShowSortingDirectory");
    $smarty->registerPlugin("function","show_list_sorting_image", "smShowListSortingImage");
    $smarty->registerPlugin("function","show_feature_type_title", "smShowFeatureTypeTitle");
    $smarty->registerPlugin("function","show_formatted_datetime", "smShowFormattedDatetime");
//    $smarty->registerPlugin("function","", "");

    // show_formatted_datetime datetime_label=$FeaturesList[row].created_at $format= 'AsText'} function smShowFormattedDatetime( $params, $smarty ) {

    // ShowListSortingImage( 'name', $sorting, $sort, $base_root_url . $images_dir )
    $smarty->display($template_name);
  } */

  public static function WasFieldChanged( $DataRow, $PostArray, $FieldsToSkip= array() ) {
    foreach( $DataRow as $Key=>$Value ) {
      if ( in_array( $Key, $FieldsToSkip ) ) continue;
      if ( !isset($PostArray[$Key]) ) continue;
      if ( trim($Value)!= trim($PostArray[$Key]) ) return $Key;
    }
    return '';
  }

  public static function ConcatStr( $Str, $MaxLength= '', $AddStr= '') {
    if (empty($MaxLength)) $MaxLength= self::$ConcatStrMaxLength;
    if ( empty($AddStr) ) $AddStr= self::$ConcatStrAddChars;
    if( strlen($Str) > $MaxLength ) return substr($Str,0,$MaxLength).$AddStr;
    return $Str;
  }

  public static function ShowSortingDir( $fieldname, $sorting, $sort ) {
    return ( ( $sorting == $fieldname and $sort == 'asc') ? "/sort/desc" : "/sort/asc" );
  } // function ShowSortingDir( $sorting, $sort ) {

  public static function ShowListSortingImage( $fieldname, $sorting, $sort, $images_dir ) {
    if ( $sorting == $fieldname and $sort == 'asc') {
      return '<img src="' . $images_dir . 'up-arrow.jpg" alt="Up" title="Up">';
    }
    if ( $sorting == $fieldname and $sort == 'desc') {
      return '<img src="' . $images_dir .'down-arrow.jpg" alt="Down" title="Down">';
    }
  } // function ShowListSortingImage( $sorting, $sort ) {

  public static function ShowFormattedDateTime( $DateTimeLabel= '', $format='') {
    if ( empty($DateTimeLabel) ) $DateTimeLabel= time();
    if ( !is_numeric($DateTimeLabel) ) $DateTimeLabel= strtotime($DateTimeLabel);
    if ( empty($format) ) {
      return strftime( self::$DateTimeFormat, $DateTimeLabel );
    }
    if ( strtoupper($format)=="ASTEXT" ) {
      return strftime( self::$DateTimeAsTextFormat, $DateTimeLabel );
    }
    if ( strtoupper($format)=="DATEASTEXT" ) {
      return strftime( self::$DateAsTextFormat, $DateTimeLabel );
    }
    if ( strtoupper($format)=="MYSQL" ) {
      return strftime( self::$DateTimeMySqlFormat, $DateTimeLabel );
    }
  } // function public ShowFormattedDateTime( $DateTimeLabel, $format='') {

  public static function SetArrayHeader($HeaderArray, $DataArray) {
    //AppUtils::deb($HeaderArray, '$HeaderArray::');
    //AppUtils::deb($DataArray, '$DataArray::');
    if (empty($HeaderArray) or !is_array(($HeaderArray)))
      return $DataArray;
    $ResArray = array();
    foreach ($HeaderArray as /*$HeaderKey =>*/ $HeaderItem) {
      $ResArray[] = $HeaderItem;
      if ( is_array($DataArray) ) {
        foreach ($DataArray as /*$DataKey => */$DataItem) {
          $ResArray[] = $DataItem;
        }
      }
    }
    return $ResArray;
  }

  public static function getYesNoValueArray() {
    return self::$YesNoValueArray;
  }

  public static function getParameter( $Controller, $UriArray, $PostArray, $ParameterName, $DefaultValue= '' ) {
    if (!empty($PostArray)) { // form was submitted
      $ParameterValue = $Controller->input->post( $ParameterName );
    } else {
      $ParameterValue= !empty( $UriArray[$ParameterName] ) ? $UriArray[$ParameterName] : $DefaultValue;
    }
    return $ParameterValue;
  }

  public static function isDeveloperComp() {
    // return true;
    if (empty($_SERVER["HTTP_HOST"]))
      return false;
    if (  /* !(strpos($_SERVER["HTTP_HOST"], "localhost:93") === false) or */ !(strpos($_SERVER["HTTP_HOST"], "local-wavendon-props.com") === false)  ) {
      return true;
    }
    return false;
  }

  public static function deb($Var, $Descr = '', $isSql = false) {
    if (!self::isDeveloperComp()) return;
    include_once("dbug.php");
    if (!empty($Descr)) {
      echo "<h5><b><u>" . '<font color= green>' . HtmlSpecialChars($Descr) . " </font></u></b>";
    }
    if (is_array($Var))
      new dBug($Var);
    else if (is_object($Var))
      echo var_dump($Var);
    else {
      if (gettype($Var) == 'string') {
        if ($isSql) {
          echo '<b><I>' . gettype($Var) . "</I>" . '&nbsp;$Var:=<font color= red>&nbsp;' . AppUtil::ShowFormattedSql($Var) . "</font></b></h5>";
        } else {
          echo '<b><I>' . gettype($Var) . "</I>" . '&nbsp;$Var:=<font color= red>&nbsp;' . HtmlSpecialChars($Var) . "</font></b></h5>";
        }
      } else {
        echo '<b><I>' . gettype($Var) . "</I>" . '&nbsp;$Var:=<font color= red>&nbsp;' . $Var . "</font></b></h5>";
      }
    }
  }

  public static function ShowFormattedSql($Sql, $isBreakLine = true) {
    $BreakLine = '';
    if ($isBreakLine) {
      $BreakLine = '<br>';
    }
    $Sql = ' ' . $Sql . ' ';
    $Sql = preg_replace("/insert into/", "&nbsp;&nbsp;<B>INSERT INTO</B>", $Sql);
    $Sql = preg_replace("/insert/", "&nbsp;<B>INSERT</B>", $Sql);
    $Sql = preg_replace("/delete/", "&nbsp;<B>DELETE</B>", $Sql);
    $Sql = preg_replace("/values/", $BreakLine . "&nbsp;&nbsp;<B>VALUES</B>", $Sql);
    $Sql = preg_replace("/update/", "&nbsp;<B>UPDATE</B>", $Sql);
    $Sql = preg_replace("/straight_join/", $BreakLine . "<B>&nbsp;&nbsp;STRAIGHT_JOIN</B>", $Sql);
    $Sql = preg_replace("/left join/", $BreakLine . "&nbsp;&nbsp;<B>LEFT JOIN</B>", $Sql);
//    $Sql = preg_replace("join", $BreakLine."&nbsp;&nbsp;<B>JOIN</B>", $Sql)  ;
    $Sql = preg_replace("/select/", "&nbsp;<B>SELECT</B>", $Sql);
    $Sql = preg_replace("/from/", $BreakLine . "&nbsp;&nbsp;<B>FROM</B>", $Sql);
    $Sql = preg_replace("/where/", $BreakLine . "&nbsp;&nbsp;<B>WHERE</B>", $Sql);
    $Sql = preg_replace("/group by/", $BreakLine . "&nbsp;&nbsp;<B>GROUP BY</B>", $Sql);
    $Sql = preg_replace("/having/", $BreakLine . "&nbsp;&nbsp;<B>HAVING</B>", $Sql);
    $Sql = preg_replace("/order by/", $BreakLine . "&nbsp;&nbsp;<B>ORDER BY</B>", $Sql);
    return $Sql;
  }

  public static function getFileSizeAsString($FileSize) {
    if ( (int)$FileSize< 1024 ) return $FileSize . ' b';
    if ( (int)$FileSize< 1024*1024 ) return floor($FileSize/1024).' kb';
    return floor($FileSize/(1024*1024)).' mb';
  }


  public static function DebToFile($contents, $IsClearText= true, $FileName= '' ) {
    try {
      if (empty($FileName)) $FileName= './log/logging_deb.txt';
      $fd = fopen( $FileName, ( $IsClearText ?"w+":"a+" ) );
      fwrite($fd, $contents.chr(13));
      fclose($fd);
      return true;
    } catch (Exception $lException) {
      return false;
    }
  }



  public static function ClearRealEscape( $DataValue ) {
    return $DataValue;
    //AppUtils::deb( $DataValue, '$DataValue::');
    if ( is_array($DataValue) ) {
      foreach( $DataValue as $Key=>$Value ) {
        if ( !is_array($Value) ) {
          $DataValue[$Key]= stripslashes($Value);
        } else {
          $DataValue[$Key]= AppUtils::ClearRealEscape($Value);
        }
      }
    } else {
       $DataValue= stripslashes($DataValue);
    }
    return $DataValue;
  }

  public static function AddRealEscape( $DataValue ) {
    return $DataValue;
    if ( is_array($DataValue) ) {
      foreach( $DataValue as $Key=>$Value ) {
        $DataValue[$Key]= mysql_real_escape_string($Value);
      }
    } else {
       $DataValue= mysql_real_escape_string($DataValue);
    }
    return $DataValue;
  }

  public static function DeleteDirectory( $DirectoryName ) {
    $H = OpenDir( $DirectoryName   );
    while ( $NextFile = readdir($H) ) { // All files in dir
      if ($NextFile == "." or $NextFile == "..") continue;
      AppUtils::deb( $DirectoryName . DIRECTORY_SEPARATOR . $NextFile, '$DirectoryName . DIRECTORY_SEPARATOR . $NextFile::');
      unlink( $DirectoryName . DIRECTORY_SEPARATOR . $NextFile);
    }
    closedir( $H );
    rmdir( $DirectoryName);
  }

  public static function tbUrlDecode( $Url ) {
    $Url= str_replace('ZZZZZ', '/', $Url);
    $Url= str_replace('XXXXX', '.', $Url);
    $Url= str_replace('YYYYY', '-', $Url);
    $Url= str_replace('WWWWW', '_', $Url);
    return $Url;
  }

  public static function tbUrlEncode( $Url ) {
    $Url= str_replace('/', 'ZZZZZ',  $Url);
    $Url= str_replace('.', 'XXXXX',  $Url);
    $Url= str_replace('-', 'YYYYY',  $Url);
    $Url= str_replace('_', 'WWWWW',  $Url);
    return $Url;
  }

  public static function WriteToFileName($FileName= '', $contents, $IsTruncateData= false) {
    try {
      // $config_array = $ControllerRef->config->config;
      // if( $config_array['log_path'] ) return;
      //$CurrentDir = str_replace('\\', '/', sfConfig::get('sf_web_dir'));
      //Util::deb($CurrentDir,'$CurrentDir::');
      if (empty($FileName)) $FileName= '/_SymfonyProjects/wavendon-props/log/deb.txt';
      $fd = fopen( $FileName, ( $IsTruncateData ?"w+":"a+") );
      fwrite($fd, $contents);
      fclose($fd);
      return true;
    } catch (Exception $lException) {
      return false;
    }
  }


  public static function GeneratePassword($ControllerRef, $Length=8) {
    $I= 0;
    while (true) {
      $Password= AppUtils::PreparePassword($Length);
      $User= $ControllerRef->muser->getRowByPassword( md5($Password) );
      if ( empty($User) ) return $Password;
    }
    return '';
  }

  /**
  * Prepare Password with given length($Length)
  *
  */
  public static function PreparePassword($Length) {
    $alphabet = "0123456789abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $Res='';
    for ($I=0; $I< $Length; $I++ ) {
      $Index= rand(0,strlen($alphabet)-1);
      $Res.= substr($alphabet,$Index,1);
    }
    return $Res;
  }

} // class AppUtils {


?>
