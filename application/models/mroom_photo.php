<?php

class Mroom_photo extends CI_Model {

  public function __construct() {
    parent::__construct();
  }

  public function getRoomPhotosList( $OutputFormatCount = false, $page = '', $filter_room_id = '', $sorting = '', $sort = '') {
    $filter_room_id= AppUtils::AddRealEscape( $filter_room_id );
    $sorting= AppUtils::AddRealEscape( $sorting );
    if (empty($sorting)) $sorting= 'photo';
    $sort= AppUtils::AddRealEscape( $sort );
    $config_data= $this->config->config;
    $limit = '';
    $offset = '';
    if (!empty($config_data)) {
      $limit = $config_data['per_page'];
      $offset = ($page - 1) * $config_data['per_page'];
    }
    if (!empty($filter_room_id)) {
      $this->db->where('room_id', $filter_room_id);
    }
    if ( !$OutputFormatCount and  isset($limit) and isset($offset) and is_numeric($page)) {
      $this->db->limit($limit, $offset);
    }
    if ( !empty($sorting) ) {
      $this->db->order_by( $sorting, ( ( strtolower($sort) == 'desc' or strtolower($sort) == 'asc' ) ? $sort : '' ) );
    }
    if ( $OutputFormatCount ) {
      return $this->db->count_all_results('room_photo');
    } else {
      $query = $this->db->from('room_photo');
      return AppUtils::ClearRealEscape($query->get()->result('array'));
    }

  }

  public function getRowById($id) {
    $id= AppUtils::AddRealEscape( $id );
    $query = $this->db->get_where('room_photo', array('id' => $id), 1, 0);
    $ResultRow = AppUtils::ClearRealEscape($query->result('array'));
    if (!empty($ResultRow[0])) {
      return $ResultRow[0];
    }
    return false;
  }

  public function UpdateRoomPhoto($id,$DataArray /* Array( 'id'=>$this->input->post('id'), 'name'=>$this->input->post('name') ) */) {
    $id= AppUtils::AddRealEscape( $id );
    $DataArray= AppUtils::AddRealEscape($DataArray);
    if ( empty($id) ) {
      $DataArray['created_at']= AppUtils::ShowFormattedDateTime(time(), 'MySql');
      $Res = $this->db->insert('room_photo', $DataArray );
      if ($Res)
        return mysql_insert_id();
    } else {
      $Res = $this->db->update('room_photo', $DataArray, array('id' => $id));
      if ($Res)
        return $id;
    }
  }

  public function DeleteRoomPhoto($id) {
    $id= AppUtils::AddRealEscape( $id );
    if (!empty($id)) {
      $this->db->where('id', $id);
      $Res = $this->db->delete('room_photo');
      return $Res;
    }
  }

  public function isUniqueRoomPhoto( $photo, $id, $room_id ) {
    $photo= AppUtils::AddRealEscape( $photo );
    $id= AppUtils::AddRealEscape( $id );
    $room_id= AppUtils::AddRealEscape( $room_id );
    $this->db->where('photo', $photo);
    if (!empty($room_id)) {
      $this->db->where('room_id', $room_id);
    }
    if (!empty($id)) {
      $this->db->where('id != ', $id);
    }
    $RowsCount= $this->db->count_all_results('room_photo');
    return $RowsCount== 0;
  }

  public function DeleteRoomPhotosByRoomId($room_id) {
    $room_id= AppUtils::AddRealEscape( $room_id );
    if (!empty($room_id)) {
      $this->db->where('room_id', $room_id);
      $Res = $this->db->delete('room_photo');
      return $Res;
    }
  }

}

?>