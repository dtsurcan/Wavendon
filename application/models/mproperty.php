<?php

class Mproperty extends CI_Model {
  private $PropertyTypeValueArray= Array( 'house'=>'House', 'flat' => 'Flat' );

  public function __construct() {
    parent::__construct();
  }

  public function getPropertyTypeValueArray() {
    $ResArray= array();
    foreach( $this->PropertyTypeValueArray as $key=>$value ) {
      $ResArray[]= array( 'key'=>$key,'value'=>$value );
    }
    return $ResArray;
  }
  public function getPropertyLandlordValueArray() {
    $UsersList= $this->muser->getUsersList( false, '', '', 'landlord', 'username', '', 'id,username' );
    $ResArray= array();
    foreach( $UsersList as $lUser ) {
      $ResArray[]= array( 'key'=>$lUser['id'], 'value'=>$lUser['username'] );
    }
    return $ResArray;
  }


  public function getPropertysList($OutputFormatCount = false, $page = '', $filter_landlord_id= '', $filter_block_id= '', $filter_address = '', $filter_type= '', $sorting = '', $sort = '', $PropetyListOptions= array() ) {
    $filter_landlord_id= AppUtils::AddRealEscape( $filter_landlord_id );
    $filter_block_id= AppUtils::AddRealEscape( $filter_block_id );
    $filter_address= AppUtils::AddRealEscape( $filter_address );
    $filter_type= AppUtils::AddRealEscape( $filter_type );
    $sorting= AppUtils::AddRealEscape( $sorting );

    if (empty($sorting)) $sorting= 'username,address';
    $sort= AppUtils::AddRealEscape( $sort );
    $config_data= $this->config->config;
    $limit = '';
    $offset = '';
    if (!empty($config_data)) {
      $limit = $config_data['per_page'];
      $offset = ($page - 1) * $config_data['per_page'];
    }
    if (!$OutputFormatCount and isset($limit) and isset($offset) and is_numeric($page) ) {
      $this->db->limit($limit, $offset);
    }

    if (!empty($filter_landlord_id)) {
      $this->db->where( 'property.landlord_id', $filter_landlord_id );
    }

    if (!empty($filter_block_id)) {
      $this->db->where( 'property.block_id', $filter_block_id );
    }

    if (!empty($filter_address)) {
      $this->db->like('property.address', $filter_address);
    }

    if (!empty($filter_type)) {
      $this->db->where( 'property.type', $filter_type );
    }

    if ( !empty($sorting) ) {
      $this->db->order_by( $sorting, ( ( strtolower($sort) == 'desc' or strtolower($sort) == 'asc' ) ? $sort : '' ) );
    }
//AppUtils::deb( $PropetyListOptions, '$PropetyListOptions::' );
    if ( !empty($PropetyListOptions['is_onlyunusedinblocks']) and $PropetyListOptions['is_onlyunusedinblocks'] ) {
      $where = "".$this->db->dbprefix."property`.`block_id` is null ";
      $this->db->where($where);
    }
    $this->db->join('user', 'user.id = property.landlord_id', 'left');
    $this->db->join( 'block', 'block.id = property.block_id', 'left' );
    $this->db->select('property.*, user.username, block.name as block_name ');

    if ( $OutputFormatCount ) {
      return $this->db->count_all_results('property');
    } else {
      $query = $this->db->from('property');
      $ResultRows= $query->get()->result('array');
      return AppUtils::ClearRealEscape($ResultRows);
    }
  }

  public function getRowById($id) {
    $id= AppUtils::AddRealEscape( $id );
    $this->db->join('user', 'user.id = property.landlord_id', 'left');
    $this->db->join( 'block', 'block.id = property.block_id', 'left' );
    $this->db->select( 'property.*, user.username, block.name as block_name  ' );
    $query = $this->db->get_where( 'property', array('property.id' => $id), 1, 0);
    $ResultRow = $query->result('array');
    if (!empty($ResultRow[0])) {
      return AppUtils::ClearRealEscape($ResultRow[0]);
    }
    return false;
  }

  public function UpdateProperty($id, $DataArray ) {
    $id= AppUtils::AddRealEscape( $id );
    $DataArray= AppUtils::AddRealEscape($DataArray);
    if ( empty($DataArray['block_id']) ) $DataArray['block_id']= null;
    if ( empty($id) ) {
      $this->id = null;
      $DataArray['created_at'] = AppUtils::ShowFormattedDateTime(time(), 'MySql');
      $DataArray['updated_at'] = AppUtils::ShowFormattedDateTime(time(), 'MySql');
      $Res = $this->db->insert('property', $DataArray );
      if ($Res)
        return mysql_insert_id();
    } else {
      $DataArray['updated_at'] = AppUtils::ShowFormattedDateTime(time(), 'MySql');
      $Res = $this->db->update('property', $DataArray, array('id' => $id) );
      if ($Res)
        return $id;
    }
  }

  public function DeleteProperty( $id ) {
    $id= AppUtils::AddRealEscape($id);
    if (!empty($id)) {
      $this->db->where('id', $id);
      $Res = $this->db->delete('property');
      return $Res;
    }
  }

  public function getTypeTitle( $Type ) {
    if ( !empty($this->PropertyTypeValueArray[$Type]) ) {
      return $this->PropertyTypeValueArray[$Type];
    }
    return '';
  }

  public function getBlockTitle( $Block ) {
    $YesNoValueArray= AppUtils::getYesNoValueArray();
    if ( !empty($YesNoValueArray[$Block]) ) {
      return $YesNoValueArray[$Block];
    }
    return '';
  }

  public function getPropertysUsedInBlocksList( $OutputFormatCount = false) {
    $this->db->distinct();
    if ( $OutputFormatCount ) {
      return $this->db->count_all_results('property');
    } else {
      $query = $this->db->from('property');
      $query->select('block_id');
      return AppUtils::ClearRealEscape($query->get()->result('array'));
    }
  }

  public function ClearBlockOfProperty($block_id ) {
    $block_id= AppUtils::AddRealEscape( $block_id );
    $DataArray= array('block_id'=>null);
    $Res = $this->db->update('property', $DataArray, array('block_id' => $block_id) );
    if ($Res) {
      return $block_id;
    }
  }

}

?>