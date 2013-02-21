<?php

class Mtenant_guarantor extends CI_Model {

  public function __construct() {
    parent::__construct();
  }

  public function getTenantGuarantorsList( $OutputFormatCount = false,  $page = '', $filter_user_id = '', $sorting = '', $sort = '') {
    $page= AppUtils::AddRealEscape( $page );
    $filter_user_id= AppUtils::AddRealEscape( $filter_user_id );
    $sorting= AppUtils::AddRealEscape( $sorting );
    if (empty($sorting)) $sorting= 'tenant_id';

    $sort= AppUtils::AddRealEscape( $sort );
    $config_data= $this->config->config;
    if (!empty($filter_user_id)) {
      $this->db->where('tenant_guarantor.tenant_id', $filter_user_id);
    }
    if ( !empty($sorting) ) {
      $this->db->order_by( $sorting, ( ( strtolower($sort) == 'desc' or strtolower($sort) == 'asc' ) ? $sort : '' ) );
    }
    $this->db->join('user', 'user.id = tenant_guarantor.guarantor_id', 'right');
    if ( $OutputFormatCount ) {
      return $this->db->count_all_results('tenant_guarantor');
    } else {
      $query = $this->db->from('tenant_guarantor');
      $query->select('tenant_guarantor.*,user.username');
      return AppUtils::ClearRealEscape($query->get()->result('array'));
    }
  }

  public function AddTenantGuarantor( $DataArray ) {
    $DataArray['created_at']= AppUtils::ShowFormattedDateTime(time(), 'MySql');
    $Res = $this->db->insert( 'tenant_guarantor', $DataArray );
    if (!$Res) return false;
    return mysql_insert_id();;
  }

  public function DeleteTenantGuarantor($id) {
    $id= AppUtils::AddRealEscape( $id );
    if (!empty($id)) {
      $this->db->where('id', $id);
      $Res = $this->db->delete('tenant_guarantor');
      return $Res;
    }
  }

  public function getUsedGuarantorsList( $OutputFormatCount = false) {
    $this->db->distinct();
    if ( $OutputFormatCount ) {
      return $this->db->count_all_results('tenant_guarantor');
    } else {
      $query = $this->db->from('tenant_guarantor');
      $query->select('guarantor_id');
      return AppUtils::ClearRealEscape($query->get()->result('array'));
    }
  }

  public function ClearAllTenants( $tenant_id ) {
    $tenant_id= AppUtils::AddRealEscape( $tenant_id );
    if (!empty($tenant_id)) {
      AppUtils::deb( $tenant_id, ' $tenant_id +++ ::');
      $this->db->where( 'tenant_id', $tenant_id );
      $Res = $this->db->delete('tenant_guarantor');
      return $Res;
    }
  }

  public function ClearAllGuarantors( $guarantor_id ) {
    $guarantor_id= AppUtils::AddRealEscape( $guarantor_id );
    if (!empty($guarantor_id)) {
      $this->db->where( 'guarantor_id', $guarantor_id );
      $Res = $this->db->delete('tenant_guarantor');
      return $Res;
    }
  }

  public function getTenantTenantsList( $OutputFormatCount = false,  $page = '', $filter_user_id = '', $sorting = '', $sort = '') {
    $page= AppUtils::AddRealEscape( $page );
    $filter_user_id= AppUtils::AddRealEscape( $filter_user_id );
    $sorting= AppUtils::AddRealEscape( $sorting );
    $sort= AppUtils::AddRealEscape( $sort );
    $config_data= $this->config->config;
    if (!empty($filter_user_id)) {
      $this->db->where('tenant_guarantor.guarantor_id', $filter_user_id);
    }
    if ( !empty($sorting) ) {
      $this->db->order_by( $sorting, ( ( strtolower($sort) == 'desc' or strtolower($sort) == 'asc' ) ? $sort : '' ) );
    }
    $this->db->join('user', 'user.id = tenant_guarantor.tenant_id', 'right');
    if ( $OutputFormatCount ) {
      return $this->db->count_all_results('tenant_guarantor');
    } else {
      $query = $this->db->from('tenant_guarantor');
      $query->select('tenant_guarantor.*,user.username');
      return AppUtils::ClearRealEscape($query->get()->result('array'));
    }
  }

  public function AddTenantGuarantorByTenant( $DataArray ) {
    $DataArray['created_at']= AppUtils::ShowFormattedDateTime(time(), 'MySql');
    $Res = $this->db->insert( 'tenant_guarantor', $DataArray );
    if (!$Res) return false;
    return mysql_insert_id();;
  }

}

?>