<?php

class Muser_notes extends CI_Model {

  public function __construct() {
    parent::__construct();
  }

  public function getUserNotesList( $OutputFormatCount = false,  $page = '', $filter_user_id = '', $sorting = '', $sort = '') {
    $page= AppUtils::AddRealEscape( $page );
    $filter_user_id= AppUtils::AddRealEscape( $filter_user_id );
    $sorting= AppUtils::AddRealEscape( $sorting );
    if(empty($sorting)) $sorting= 'created_at';

    $sort= AppUtils::AddRealEscape( $sort );
    if(empty($sort)) $sort= 'desc';

    $config_data= $this->config->config;
    if (!empty($filter_user_id)) {
      $this->db->where('user_notes.user_id', $filter_user_id);
    }
    if ( !empty($sorting) ) {
      $this->db->order_by( $sorting, ( ( strtolower($sort) == 'desc' or strtolower($sort) == 'asc' ) ? $sort : '' ) );
    }
    if ( $OutputFormatCount ) {
      return $this->db->count_all_results('user_notes');
    } else {
      $query = $this->db->from('user_notes');
      return AppUtils::ClearRealEscape($query->get()->result('array'));
    }
  }

  public function getRowById($id) {
    $query = $this->db->get_where('user_notes', array('id' => $id), 1, 0);
    $ResultRow = $query->result('array');
    if (!empty($ResultRow[0])) {
      return AppUtils::ClearRealEscape( $ResultRow[0] );
    }
    return false;
  }

  public function AddUserNotes( $DataArray ) {
    $DataArray['created_at']= AppUtils::ShowFormattedDateTime(time(), 'MySql');
    $Res = $this->db->insert( 'user_notes', $DataArray );
    if (!$Res) return false;
    return mysql_insert_id();;
  }

  public function DeleteUserNotes($id) {
    $id= AppUtils::AddRealEscape( $id );
    if (!empty($id)) {
      $this->db->where('id', $id);
      $Res = $this->db->delete('user_notes');
      return $Res;
    }
  }

  public function DeleteUserNotesByUserId($user_id) {
    $user_id= AppUtils::AddRealEscape( $user_id );
    if (!empty($user_id)) {
      $this->db->where('user_id', $user_id);
      $Res = $this->db->delete('user_notes');
      return $Res;
    }
  }


}

?>