<?php

class Mhistory extends CI_Model {
  public function __construct() {
    parent::__construct();
  }


  public function getHistorysSelectionList($OutputFormatCount = false, $page = '', $filter_room_id = '', $sorting = '', $sort = '') {
    $HistorysList= $this->mhistory->getHistorysList( false, '', $filter_room_id, $sorting, $sort );
    $ResArray= array();
    foreach( $HistorysList as $lHistory ) {
      $ResArray[ $lHistory['id'] ]= $lHistory['name'];
    }
    return $ResArray;
  }


  public function getHistorysList( $OutputFormatCount = false, $page = '', $filter_room_id = '', $sorting = 'name', $sort = '' ) {
    $filter_room_id= AppUtils::AddRealEscape( $filter_room_id );
    $sorting= AppUtils::AddRealEscape( $sorting );
    if (empty($sorting)) $sorting= 'from_date';
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

    $this->db->join('user', 'user.id = history.tenant_id', 'left');
    $this->db->join( 'room', 'room.id = history.room_id', 'left' );
    $this->db->select('history.*, user.username as tenant_name, room.name as room_name');

    if ( $OutputFormatCount ) {
      return $this->db->count_all_results('history');
    } else {
      $query = $this->db->from('history');
      return AppUtils::ClearRealEscape($query->get()->result('array'));
    }

  }

  public function getRowById($id) {
    $id= AppUtils::AddRealEscape( $id );
    $query = $this->db->get_where('history', array('id' => $id), 1, 0);
    $ResultRow = AppUtils::ClearRealEscape($query->result('array'));
    if (!empty($ResultRow[0])) {
      return $ResultRow[0];
    }
    return false;
  }

  public function UpdateHistory($id,$DataArray ) {
    $id= AppUtils::AddRealEscape( $id );
    $DataArray= AppUtils::AddRealEscape($DataArray);
    if ( empty($id) ) {
      $DataArray['created_at'] = AppUtils::ShowFormattedDateTime(time(), 'MySql');
      $Res = $this->db->insert('history', $DataArray );
      if ($Res)
        return mysql_insert_id();
    } else {
      $this->name = $DataArray['name'];
      $Res = $this->db->update('history', $DataArray, array('id' => $id));
      if ($Res)
        return $id;
    }
  }

  public function DeleteHistory($id) {
    $id= AppUtils::AddRealEscape($id);
    if (!empty($id)) {
      $this->db->where('id', $id);
      $Res = $this->db->delete('history');
      return $Res;
    }
  }

  public function DeleteHistoryByRoomId($room_id) {
    $room_id= AppUtils::AddRealEscape( $room_id );
    if (!empty($room_id)) {
      $this->db->where('room_id', $room_id);
      $Res = $this->db->delete('history');
      return $Res;
    }
  }

  public function DeleteHistoryByTenantId($tenant_id) {
    $tenant_id= AppUtils::AddRealEscape( $tenant_id );
    if (!empty($tenant_id)) {
      $this->db->where('tenant_id', $tenant_id);
      $Res = $this->db->delete('history');
      return $Res;
    }
  }

}

?>