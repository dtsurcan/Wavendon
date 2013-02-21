<?php

class Mblock extends CI_Model {
  public function __construct() {
    parent::__construct();
  }

  public function getBlocksSelectionList($OutputFormatCount = false, $page = '', $filter_name = '', $sorting = '', $sort = '') {
    $BlocksList= $this->mblock->getBlocksList( false, '', $filter_name, $sorting, $sort, 'id,name' );
    $ResArray= array();
    foreach( $BlocksList as $lBlock ) {
      $ResArray[]= array( 'key'=>$lBlock['id'], 'value'=>$lBlock['name'] );
    }
    return $ResArray;
  }

  public function getBlocksList( $OutputFormatCount = false, $page = '', $filter_name = '', $sorting = 'name', $sort = '', $fields_for_select = '', $show_related_count= false ) {
    $filter_name= AppUtils::AddRealEscape( $filter_name );
    $sorting= AppUtils::AddRealEscape( $sorting );
    $sort= AppUtils::AddRealEscape( $sort );
    if (empty($sorting)) $sorting= 'name';
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
    if ( !$OutputFormatCount and  isset($limit) and isset($offset) and is_numeric($page)) {
      $this->db->limit($limit, $offset);
    }

    if ( !empty($sorting) ) {
      $this->db->order_by( $sorting, ( ( strtolower($sort) == 'desc' or strtolower($sort) == 'asc' ) ? $sort : '' ) );
    }
    if ( $show_related_count ) {
      $this->db->select('block.*, ( select count(*) from `'.$this->db->dbprefix.'property` where `'.$this->db->dbprefix.'property`.`block_id` = `'.$this->db->dbprefix.'block`.`id`) as property_block_count ');
    }

    if ( $OutputFormatCount ) {
      return $this->db->count_all_results('block');
    } else {
      $query = $this->db->from('block');
      if (strlen(trim($fields_for_select)) > 0) {
        $query->select($fields_for_select);
      }
      return AppUtils::ClearRealEscape($query->get()->result('array'));
    }

  }

  public function getRowById($id) {
    $id= AppUtils::AddRealEscape( $id );
    $query = $this->db->get_where('block', array('id' => $id), 1, 0);
    $ResultRow = AppUtils::ClearRealEscape($query->result('array'));
    if (!empty($ResultRow[0])) {
      return $ResultRow[0];
    }
    return false;
  }

  public function UpdateBlock($id,$DataArray ) {
    $id= AppUtils::AddRealEscape( $id );
    $DataArray= AppUtils::AddRealEscape($DataArray);
    if ( empty($id) ) {
      $DataArray['created_at'] = AppUtils::ShowFormattedDateTime(time(), 'MySql');
      $Res = $this->db->insert('block', $DataArray );
      if ($Res)
        return mysql_insert_id();
    } else {
      $this->name = $DataArray['name'];
      $Res = $this->db->update('block', $DataArray, array('id' => $id));
      if ($Res)
        return $id;
    }
  }

  public function DeleteBlock($id) {
    $id= AppUtils::AddRealEscape($id);
    if (!empty($id)) {
      $this->db->where('id', $id);
      $Res = $this->db->delete('block');
      return $Res;
    }
  }

}

?>