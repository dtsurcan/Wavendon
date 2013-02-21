<?php
class Admin extends CI_Controller {


  public function __construct()
  {
    parent::__construct();
    $this->load->library("AppUtils");
    $this->load->library("AppAuth");
    // if (AppUtils::isDeveloperComp()) $this->output->enable_profiler(true);
  }

	public function index()
	{
    AppAuth::IsLogged( $this, 'admin');
      $SystemInfo= 'Operation:"' . php_uname().'"<br>'.
      '&nbsp;&nbsp;&nbsp;PHP:"' . phpversion(). '"&nbsp;&nbsp;&nbsp;"'.//$Db->GetVersion( false ) .
      '"&nbsp;&nbsp;&nbsp;DataBaseName:"'.  // DataBaseName .
      '"&nbsp;&nbsp;&nbsp;Browser:"' . getenv("HTTP_USER_AGENT") .
      '"&nbsp;&nbsp;&nbsp;Remote Addr:"' . getenv("REMOTE_ADDR") .
      '"&nbsp;&nbsp;&nbsp;Server name:"' . getenv("SERVER_NAME") .
      '"&nbsp;&nbsp;&nbsp;Document root:"' . getenv("DOCUMENT_ROOT") .
      '"&nbsp;&nbsp;&nbsp;SERVER_SOFTWARE:"' . getenv("SERVER_SOFTWARE") .
      '"&nbsp;&nbsp;&nbsp;SystemRoot :"'.getenv("SystemRoot") .
      '"&nbsp;&nbsp;&nbsp;HTTP_HOST:"'.getenv("HTTP_HOST") .
      '"&nbsp;&nbsp;&nbsp;HTTP_ACCEPT_LANGUAGE:"'.getenv("HTTP_ACCEPT_LANGUAGE") .
      '"&nbsp;&nbsp;&nbsp;GATEWAY_INTERFACE:"' . getenv("GATEWAY_INTERFACE") . '"&nbsp;';
    /*HRef(HostName.'admin/phpinfo.php' , ' [PHP info] ', 'PHP info', $Done, $HRefClass ).'"&nbsp;'.
    HRef(HostName.'admin/sql_run.php?'.$LangRef , ' [SQL run] ', 'Sql run', $Done, $HRefClass ).'"&nbsp;'.
    HRef(HostName.'admin/php_run.php?'.$LangRef , ' [PHP run] ', 'PHP run', $Done, $HRefClass );  */
//AppUtils::deb( $SystemInfo, '$SystemInfo::' );
    $PhpInfoHRef= '<a class="thickbox" href="' . $this->config->config['base_url'] . '/admin/admin/show_php_info?width=850&height=800">php info</a>';
    $data = $this->appsmarty->AddSystemParameters( array('SystemInfo'=>$SystemInfo, 'PhpInfoHRef'=>$PhpInfoHRef), $this, $this->config, true);
    $this->appsmarty->RunSmartyTemplate('admin/index.tpl', $data, $this->config,true,true,true);
	}


  public function login() {

    $base_url = $this->config->item('base_url');
    $this->load->library('form_validation');
    $this->load->library('session');
    $this->form_validation->set_rules('login', 'Login', 'required|xss_clean');
    $this->form_validation->set_rules('password', 'Password', 'required|xss_clean');
    $login_message= $this->session->flashdata('login_message');
    $form_status = 'edit';
    $entered_login= '';
    if (!empty($_POST)) { // form was submitted
      $validation_status = $this->form_validation->run();
      if ($validation_status != FALSE) {
        $post_array= $this->input->post();
          AppAuth::Login($this, $post_array, '/admin/admin/index' );
      } else {
        $form_status = 'invalid';
        $entered_login= set_value('login');
      }
    } // if (!empty($_POST)) { // form was submitted
    $data = $this->appsmarty->AddSystemParameters( array( 'login_message'=> $login_message, 'form_status'=> $form_status, 'entered_login'=>$entered_login, 'validation_errors_text' => validation_errors() ), $this, $this->config, true);
    $this->appsmarty->RunSmartyTemplate('admin/login_to_admin.tpl', $data, $this->config,true,true,true);
  }

  public function logout() {
    AppAuth::Logout( $this );
  }

  public function show_image() {
    $UriArray = $this->uri->uri_to_assoc(5);
    $ImagePath= '';
    foreach( $UriArray as $key=>$Value ) {
      $ImagePath.= ( !empty($key) ? "/" . $key : "" ) . ( !empty($Value) ? "/".$Value : "" ) ;
    }
    $ImagePath= AppUtils::tbUrlDecode( $ImagePath );
    if ( substr($ImagePath,0,1) == '/' ) $ImagePath= substr($ImagePath,1);
    $data = array( 'image'=> $ImagePath );
    $data= $this->appsmarty->AddSystemParameters( $data, $this, $this->config, true );
    $this->appsmarty->RunSmartyTemplate('admin/showimage.tpl', $data, $this->config,true,false,false );
  }

  public function show_php_info() {
    $data= $this->appsmarty->AddSystemParameters( array( 'phpinfo'=>phpinfo() ), $this, $this->config, true );
    AppUtils::deb( $data, '$data::' );
    $this->appsmarty->RunSmartyTemplate('admin/show_php_info.tpl', $data, $this->config,true,false,false );

  }
}
