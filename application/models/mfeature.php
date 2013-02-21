<?php

class Mfeature extends CI_Model {
  private $FeatureTypeValueArray = Array('room' => 'Only Room', 'property' => 'Property' );

  public function __construct() {
    parent::__construct();
  }

  public function getFeatureTypeValueArray() {
    $ResArray= array();
    foreach( $this->FeatureTypeValueArray as $Key=>$Value ) {
      $ResArray[]= array('key'=>$Key, 'value'=>$Value);
    }
    return $ResArray;//$this->FeatureTypeValueArray;
  }

  public function getTypeTitle($Type) {
    if (!empty($this->FeatureTypeValueArray[$Type])) {
      return $this->FeatureTypeValueArray[$Type];
    }
    return '';
  }

  public function getFeaturesList( $OutputFormatCount = false, $page = '', $filter_name = '', $filter_type = '', $sorting = '', $sort = '', $show_related_count= false) {
    $filter_name= AppUtils::AddRealEscape( $filter_name );
    $filter_type= AppUtils::AddRealEscape( $filter_type );
    $sorting= AppUtils::AddRealEscape( $sorting );
    if(empty($sorting)) $sorting= 'name';

    $sort= AppUtils::AddRealEscape( $sort );
    $config_data= $this->config->config;
    $limit = '';
    $offset = '';
    if (!empty($config_data)) {
      $limit = $config_data['per_page'];
      $offset = ($page - 1) * $config_data['per_page'];
    }
    if (!empty($filter_name)) {
      $this->db->like('name', $filter_name);
    }
    if (!empty($filter_type)) {
      $this->db->like('type', $filter_type);
    }
    if ( !$OutputFormatCount and  isset($limit) and isset($offset) and is_numeric($page)) {
      $this->db->limit($limit, $offset);
    }

    if ( !empty($sorting) ) {
      $this->db->order_by( $sorting, ( ( strtolower($sort) == 'desc' or strtolower($sort) == 'asc' ) ? $sort : '' ) );
    }

    if ( $show_related_count ) {
      $this->db->select('feature.*, ( select count(*) from `'.$this->db->dbprefix.'property_feature` where `'.$this->db->dbprefix.'property_feature`.`feature_id` = `'.$this->db->dbprefix.'feature`.`id`) as property_feature_count, ' .
      ' ( select count(*) from `'.$this->db->dbprefix.'room_feature` where `'.$this->db->dbprefix.'room_feature`.`feature_id` = `'.$this->db->dbprefix.'feature`.`id`) as room_feature_count ');
    }

    if ( $OutputFormatCount ) {
      return $this->db->count_all_results('feature');
    } else {
      $query = $this->db->from('feature');
      return AppUtils::ClearRealEscape($query->get()->result('array'));
    }

  }

  public function getRowById($id) {
    $id= AppUtils::AddRealEscape( $id );
    $query = $this->db->get_where('feature', array('id' => $id), 1, 0);
    $ResultRow = AppUtils::ClearRealEscape($query->result('array'));
    if (!empty($ResultRow[0])) {
      return $ResultRow[0];
    }
    return false;
  }

  public function UpdateFeature($id,$DataArray ) {
    $id= AppUtils::AddRealEscape( $id );
    $DataArray= AppUtils::AddRealEscape($DataArray);
    if ( empty($id) ) {
      $DataArray['created_at'] = AppUtils::ShowFormattedDateTime(time(), 'MySql');
      $Res = $this->db->insert( 'feature', $DataArray );
      if ($Res)
        return mysql_insert_id();
    } else {
      $Res = $this->db->update( 'feature', $DataArray, array('id' => $id) );
      if ($Res)
        return $id;
    }
  }

  public function DeleteFeature($id) {
    $id= AppUtils::AddRealEscape($id);
    if (!empty($id)) {
      $this->db->where('id', $id);
      $Res = $this->db->delete('feature');
      return $Res;
    }
  }

}

?>