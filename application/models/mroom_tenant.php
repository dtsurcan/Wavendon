<?php

class Mroom_tenant extends CI_Model {

  public function __construct() {
    parent::__construct();
  }

  public function getRoomTenantsList( $OutputFormatCount = false,  $page = '', $filter_user_id = '', $filter_room_id = '', $sorting = '', $sort = '') {
    $page= AppUtils::AddRealEscape( $page );
    $filter_user_id= AppUtils::AddRealEscape( $filter_user_id );
    $filter_room_id= AppUtils::AddRealEscape( $filter_room_id );
    $sorting= AppUtils::AddRealEscape( $sorting );
    if(empty($sorting)) $sorting= 'room_tenant.created_at';

    $sort= AppUtils::AddRealEscape( $sort );
    if(empty($sort)) $sort= 'desc';

    $config_data= $this->config->config;
    if (!empty($filter_user_id)) {
      $this->db->where('room_tenant.user_id', $filter_user_id);
    }
    if (!empty($filter_room_id)) {
      $this->db->where('room_tenant.room_id', $filter_room_id);
    }
    if ( !empty($sorting) ) {
      $this->db->order_by( $sorting, ( ( strtolower($sort) == 'desc' or strtolower($sort) == 'asc' ) ? $sort : '' ) );
    }

    $this->db->join('user', 'user.id = room_tenant.tenant_id', 'left');
    $this->db->join( 'room', 'room.id = room_tenant.room_id', 'left' );
    $this->db->select('room_tenant.*, user.username as tenant_name, room.name as room_name');

    if ( $OutputFormatCount ) {
      return $this->db->count_all_results('room_tenant');
    } else {
      $query = $this->db->from('room_tenant');
      return AppUtils::ClearRealEscape($query->get()->result('array'));
    }
  }

  public function getRowById($id) {
    $query = $this->db->get_where('room_tenant', array('id' => $id), 1, 0);
    $ResultRow = $query->result('array');
    if (!empty($ResultRow[0])) {
      return AppUtils::ClearRealEscape( $ResultRow[0] );
    }
    return false;
  }

  public function UpdateRoomTenant($id, $DataArray ) {
    $id= AppUtils::AddRealEscape( $id );
    $DataArray= AppUtils::AddRealEscape($DataArray);
    if (empty($id)) {
      $DataArray['created_at'] = AppUtils::ShowFormattedDateTime(time(), 'MySql');
      $DataArray['updated_at'] = AppUtils::ShowFormattedDateTime(time(), 'MySql');
      $Res = $this->db->insert('room_tenant', $DataArray);
      if ($Res)
        return mysql_insert_id();
    } else {
      $DataArray['updated_at'] = AppUtils::ShowFormattedDateTime(time(), 'MySql');
      $Res = $this->db->update('room_tenant', $DataArray, array('id' => $id));
      if ($Res)
        return $id;
    }
  }


  public function DeleteRoomTenant($id) {
    $id= AppUtils::AddRealEscape( $id );
    if (!empty($id)) {
      $this->db->where('id', $id);
      $Res = $this->db->delete('room_tenant');
      return $Res;
    }
  }

  public function DeleteRoomTenantsByRoomId($room_id) {
    $room_id= AppUtils::AddRealEscape( $room_id );
    if (!empty($room_id)) {
      $this->db->where('room_id', $room_id);
      $Res = $this->db->delete('room_tenant');
      return $Res;
    }
  }

  public function DeleteRoomTenantsByTenantId($tenant_id) {
    $tenant_id= AppUtils::AddRealEscape( $tenant_id );
    if (!empty($tenant_id)) {
      $this->db->where('tenant_id', $tenant_id);
      $Res = $this->db->delete('room_tenant');
      return $Res;
    }
  }

}

?>