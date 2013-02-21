<?php

class Muser extends CI_Model {

  private $UserTypeValueArray = Array('tenant' => 'Tenant', 'guarantor' => 'Guarantor', 'landlord' => 'Landlord');
  private $UserTitleValueArray = Array('Mr' => 'Mr', 'Mrs' => 'Mrs', 'Ms' => 'Ms', 'Dr' => 'Dr', 'Sir' => 'Sir', 'Dame' => 'Dame'/* , '' => '', '' => '', '' => '', '' => '', '' => '', '' => '' */);

  public function __construct() {
    parent::__construct();
  }

  public function getUserTypeValueArray() {
    $ResArray= array();
    foreach( $this->UserTypeValueArray as $Key=>$Value ) {
      $ResArray[]= array( 'key'=>$Key,'value'=>$Value );
    }
    return $ResArray;
  }

  public function getUserTitleValueArray() {
//    return $this->UserTitleValueArray;
    $ResArray= array();
    foreach( $this->UserTitleValueArray as $Key=>$Value ) {
      $ResArray[]= array( 'key'=>$Key,'value'=>$Value );
    }
    return $ResArray;
  }

  public function getUsersSelectionList($OutputFormatCount = false, $page = '', $filter_username = '', $filter_type = '', $sorting = '', $sort = '') {
    $UsersList= $this->muser->getUsersList( false, '', '', $filter_type, 'username', '', 'id,username' );
    $ResArray= array();
    foreach( $UsersList as $lUser ) {
      $ResArray[]= array( 'key'=>$lUser['id'], 'value'=>$lUser['username'] );
    }
    return $ResArray;
  }

  public function getUsersList($OutputFormatCount = false, $page = '', $filter_username = '', $filter_type = '', $sorting = '', $sort = '', $fields_for_select = '', $show_related_count= false) {
    $filter_username= AppUtils::AddRealEscape( $filter_username );
    $filter_type= AppUtils::AddRealEscape( $filter_type );
    $sorting= AppUtils::AddRealEscape( $sorting );
    $sort= AppUtils::AddRealEscape( $sort );
    if(empty($sorting)) $sorting= 'username';
    $fields_for_select= AppUtils::AddRealEscape( $fields_for_select );
    $config_data = $this->config->config;

    $limit = '';
    $offset = '';
    if (!empty($config_data) and $page > 0) {
      $limit = $config_data['per_page'];
      $offset = ($page - 1) * $config_data['per_page'];
    }

    if (!$OutputFormatCount and isset($limit) and (int) $limit > 0 and isset($offset) and is_numeric($page)) {
      $this->db->limit($limit, $offset);
    }

    if (!empty($filter_username)) {
      $this->db->like('username', $filter_username);
    }

    if (!empty($filter_type)) {
      $this->db->where('type', $filter_type);
    }

    if (!empty($sorting)) {
      $this->db->order_by($sorting, ( ( strtolower($sort) == 'desc' or strtolower($sort) == 'asc' ) ? $sort : ''));
    }

    if ( $show_related_count ) {
      $this->db->select('user.*, ( select count(*) from `'.$this->db->dbprefix.'property` where `'.$this->db->dbprefix.'property`.`landlord_id` = `'.$this->db->dbprefix.'user`.`id`) as property_user_count ');
    }

    if ($OutputFormatCount) {
      return $this->db->count_all_results('user');
    } else {
      $query = $this->db->from('user');
      if (strlen(trim($fields_for_select)) > 0) {
        $query->select($fields_for_select);
      }
      return AppUtils::ClearRealEscape( $query->get()->result('array') );
    }
  }

  public function getRowById($id) {
    $query = $this->db->get_where('user', array('id' => $id), 1, 0);
    $ResultRow = $query->result('array');
    if (!empty($ResultRow[0])) {
      return AppUtils::ClearRealEscape( $ResultRow[0] );
    }
    return false;
  }

  public function UpdateUser($id, $DataArray ) {
    $id= AppUtils::AddRealEscape( $id );
    $DataArray= AppUtils::AddRealEscape($DataArray);
    if (empty($id)) {
      $DataArray['created_at'] = AppUtils::ShowFormattedDateTime(time(), 'MySql');
      $DataArray['updated_at'] = AppUtils::ShowFormattedDateTime(time(), 'MySql');
      $Res = $this->db->insert('user', $DataArray);
      if ($Res)
        return mysql_insert_id();
    } else {
      $DataArray['updated_at'] = AppUtils::ShowFormattedDateTime(time(), 'MySql');
      $Res = $this->db->update('user', $DataArray, array('id' => $id));
      if ($Res)
        return $id;
    }
  }

  public function DeleteUser($id) {
    $id= AppUtils::AddRealEscape($id);
    if (!empty($id)) {
      $this->db->where('id', $id);
      $Res = $this->db->delete('user');
      return $Res;
    }
  }

  public function getTypeTitle($Type) {
    if (!empty($this->UserTypeValueArray[$Type])) {
      return $this->UserTypeValueArray[$Type];
    }
    return '';
  }

  public function UploadUserImages($ControllerRef, $UserId, $files_array, $post_array, $config_array) {
    $dir_path = $config_array['document_root'] . $config_array['uploads_people_dir'] . '-user-' . $UserId ;//. DIRECTORY_SEPARATOR;
    if (!is_dir($dir_path)) {
      AppUtils::deb($dir_path, 'INSIDE$dir_path::');
      mkdir($dir_path, 0777);
    }
    $upload_config['upload_path'] = $dir_path;  //'./uploads/people/';
    if ( !empty($config_array['uploads_images_allowed_types']) ) $upload_config['allowed_types'] = $config_array['uploads_images_allowed_types'];
    if ( !empty($config_array['uploads_images_max_size']) ) $upload_config['max_size'] = $config_array['uploads_images_max_size'];
    if ( !empty($config_array['uploads_images_max_width']) ) $upload_config['max_width'] = $config_array['uploads_images_max_width'];
    if ( !empty($config_array['uploads_images_max_height']) ) $upload_config['max_height'] = $config_array['uploads_images_max_height'];

    $ControllerRef->load->library('upload', $upload_config);

    $copy_passport_image= '';
    $photo_image= '';
    $copy_dln_image= '';

    if ( !empty($files_array['photo']['name']) ) {
      $ControllerRef->upload->do_upload('photo');
      $photo_image = $files_array['photo']['name'];
    }
    if ( !empty($files_array['copy_passport']['name']) ) {
      $ControllerRef->upload->do_upload('copy_passport');
      $copy_passport_image = $files_array['copy_passport']['name'];
    }

    if ( !empty($files_array['copy_dln']['name']) ) {
      $ControllerRef->upload->do_upload('copy_dln');
      $copy_dln_image = $files_array['copy_dln']['name'];
    }

    $images_upload_display_errors = $ControllerRef->upload->display_errors();
    $DataArray= array();
    if ( !empty($copy_passport_image) ) {
      $DataArray['copy_passport']= $copy_passport_image;
    }
    if ( !empty($photo_image) ) {
      $DataArray['photo']= $photo_image;
    }
    if ( !empty($copy_dln_image) ) {
      $DataArray['copy_dln']= $copy_dln_image;
    }

    //AppUtils::deb( $DataArray, '--$DataArray::');
    $OkResult = $this->muser->UpdateUser($UserId, $DataArray );
    return $images_upload_display_errors;
  }

  public function getRowByPassword($password) {
    $query = $this->db->get_where('user', array('password' => $password), 1, 0);
    //AppUtils::deb( $query, '$query::' );
    $ResultRow = $query->result('array');
    if (!empty($ResultRow[0])) {
      return AppUtils::ClearRealEscape( $ResultRow[0] );
    }
    return false;
  }

}

?>