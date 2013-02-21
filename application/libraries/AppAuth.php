<?php

class AppAuth {

  public static function Login($ControllerRef, $post_array, $SuccessfullLoginUrl) {
    $base_url = $ControllerRef->config->item('base_url');
    $config_array = $ControllerRef->config->config;
    $post_array_password= $post_array['password'];
    $post_array_login= $post_array['login'];

    $post_array_password= AppUtils::AddRealEscape( $post_array_password );
    $post_array_login= AppUtils::AddRealEscape( $post_array_login );
    if ($post_array_login == $config_array['admin_login'] and $post_array_password == $config_array['admin_password']) {
      $ControllerRef->session->set_userdata( array( 'is_logged' => 1, 'user_role' => 'admin', 'logged_name' => $post_array_login  ) );
      $url_on_login = $ControllerRef->session->userdata('url_on_login');
      if (!empty($url_on_login) ) {
        if (!empty( $ControllerRef->config->config['sql_queries_to_file'] ) ) $ControllerRef->output->_display(); //To View debugging Info
        redirect($base_url . DIRECTORY_SEPARATOR . $url_on_login);
        return true;
      }
      redirect($base_url . $SuccessfullLoginUrl);
      return true;
    }
    self::Logout($ControllerRef, 'Login or password are invalid.');
    return false;
  }

  public static function IsLogged($ControllerRef, $UserRole) {
    $ControllerRef->load->library('session');
    $base_url = $ControllerRef->config->item('base_url');
    $is_logged = $ControllerRef->session->userdata('is_logged');
    $user_role = $ControllerRef->session->userdata('user_role');
    if ( $is_logged != 1 and $user_role != $UserRole ) {
      $uri_string= $ControllerRef->uri->uri_string();
      if ( !empty($uri_string) ) {
        $ControllerRef->session->set_userdata( array( 'url_on_login' => $uri_string  ) );
      }
      if (!empty( $ControllerRef->config->config['sql_queries_to_file'] ) ) $ControllerRef->output->_display(); //To View debugging Info
      redirect( $base_url . '/admin/admin/login' );
    }
    return true;
  }

  public static function getLoggedUserName($ControllerRef, $showUserRole = true, $showLogoutRef = true) {
    $ControllerRef->load->library('session');
    if (empty($ControllerRef->session))
      return '';
    $is_logged = $ControllerRef->session->userdata('is_logged');
    $user_role = $ControllerRef->session->userdata('user_role');
    $logged_name = $ControllerRef->session->userdata('logged_name');
    if ($is_logged and !empty($user_role)) {
      $base_url = $ControllerRef->config->item('base_url');
      return '<small>' . $logged_name .
        ( $showUserRole ? ('(&nbsp;' . $user_role . '&nbsp;)') : '' ) . '.' .
        ( $showLogoutRef ? ('&nbsp;<a href="' . $base_url . '/admin/admin/logout">Logout</a>&nbsp;') : '' ) . '</small>';
    }
    return '';
  }

  public static function Logout($ControllerRef, $Message = '') {
    $base_url = $ControllerRef->config->item('base_url');
    $ControllerRef->load->library('session');
    $ControllerRef->session->unset_userdata('is_logged');
    $ControllerRef->session->unset_userdata('user_role');
    $ControllerRef->session->unset_userdata('logged_name');
    if (!empty($Message)) {
      $ControllerRef->session->set_flashdata('login_message', $Message);
    }
    if (!empty( $ControllerRef->config->config['sql_queries_to_file'] ) ) $ControllerRef->output->_display(); //To View debugging Info
    redirect( $base_url . '/admin/admin/login' );
  }

}

?>