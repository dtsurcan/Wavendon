<?php

class Mroom extends CI_Model {
  private $RoomStatusValueArray = Array('A' => 'Available', 'O' => 'Occupied', 'U' => 'Unavailable');

  public function __construct() {
    parent::__construct();
  }

    public function getStatusTitle($Status) {
    if (!empty($this->RoomStatusValueArray[$Status])) {
      return $this->RoomStatusValueArray[$Status];
    }
    return '';
  }

  public function getRoomStatusValueArray() {
    $ResArray= array();
    foreach( $this->RoomStatusValueArray as $Key=>$Value ) {
      $ResArray[]= array( 'key'=>$Key,'value'=>$Value );
    }
    return $ResArray;
  }

  public function getRoomsList( $OutputFormatCount = false, $page = '', $filter_property_id = '', $filter_status = '', $sorting = '', $sort = '', $show_related_count= false ) {
    $filter_property_id= AppUtils::AddRealEscape( $filter_property_id );
    $filter_status= AppUtils::AddRealEscape( $filter_status );
    $sorting= AppUtils::AddRealEscape( $sorting );
    if (empty($sorting)) $sorting= 'name';
    $sort= AppUtils::AddRealEscape( $sort );
    $config_data= $this->config->config;
    $limit = '';
    $offset = '';
    if (!empty($config_data)) {
      $limit = $config_data['per_page'];
      $offset = ($page - 1) * $config_data['per_page'];
    }
    if (!empty($filter_property_id)) {
      $this->db->where('property_id', $filter_property_id);
    }
    if (!empty($filter_status)) {
      $this->db->where('status', $filter_status);
    }
    if ( !$OutputFormatCount and  isset($limit) and isset($offset) and is_numeric($page)) {
      $this->db->limit($limit, $offset);
    }

    if ( !empty($sorting) ) {
      $this->db->order_by( $sorting, ( ( strtolower($sort) == 'desc' or strtolower($sort) == 'asc' ) ? $sort : '' ) );
    }

    if ( $show_related_count ) {
      $this->db->select('room.*, ( select count(*) from `'.$this->db->dbprefix.'room_photo` where `'.$this->db->dbprefix.'room_photo`.`room_id` = `'.$this->db->dbprefix.'room`.`id`) as room_photo_room_count ');
      $this->db->select('room.*, ( select count(*) from `'.$this->db->dbprefix.'room_tenant` where `'.$this->db->dbprefix.'room_tenant`.`room_id` = `'.$this->db->dbprefix.'room`.`id`) as room_tenant_room_count ');

//          $RoomPhotosCount= $this->mroom_photo->getRoomPhotosList( true, '', $Room['id'], '', '');
 //       $RoomTenantsCount= $this->mroom_tenant->getRoomTenantsList( true, '', '', $Room['id'], '', '');

    }

    if ( $OutputFormatCount ) {
      return $this->db->count_all_results('room');
    } else {
      $query = $this->db->from('room');
      return AppUtils::ClearRealEscape( $query->get()->result('array') );
    }
  }

  public function getRowById($id) {
    $id= AppUtils::AddRealEscape( $id );
    $query = $this->db->get_where('room', array('id' => $id), 1, 0);
    $ResultRow = AppUtils::ClearRealEscape( $query->result('array') );
    if (!empty($ResultRow[0])) {
      return $ResultRow[0];
    }
    return false;
  }

  public function UpdateRoom($id,$DataArray) {
    $id= AppUtils::AddRealEscape( $id );
    $DataArray= AppUtils::AddRealEscape($DataArray);
    if ( empty($id) ) {
      $DataArray['created_at'] = AppUtils::ShowFormattedDateTime(time(), 'MySql');
      $DataArray['updated_at'] = AppUtils::ShowFormattedDateTime(time(), 'MySql');
      $Res = $this->db->insert('room', $DataArray );
      if ($Res)
        return mysql_insert_id();
    } else {
      $DataArray['updated_at'] = AppUtils::ShowFormattedDateTime(time(), 'MySql');
      $Res = $this->db->update('room', $DataArray, array('id' => $id));
      if ($Res)
        return $id;
    }
  }

  public function DeleteRoom( $id ) {
    $id= AppUtils::AddRealEscape( $id );
    if (!empty($id)) {
      $this->db->where('id', $id);
      $Res = $this->db->delete('room');
      return $Res;
    }
  }

  public function UploadRoomImage($ControllerRef, $RoomId, $files_array, $post_array, $config_array) {
    $dir_path =  $config_array['document_root'] . $config_array['uploads_rooms_dir'] . '-room-' . $RoomId . DIRECTORY_SEPARATOR;
    if (!is_dir($dir_path)) {
      mkdir($dir_path, 0777);
    }
    $upload_config['upload_path'] = $dir_path;
    if ( !empty($config_array['uploads_images_allowed_types']) ) $upload_config['allowed_types'] = $config_array['uploads_images_allowed_types'];
    if ( !empty($config_array['uploads_images_max_size']) ) $upload_config['max_size'] = $config_array['uploads_images_max_size'];
    if ( !empty($config_array['uploads_images_max_width']) ) $upload_config['max_width'] = $config_array['uploads_images_max_width'];
    if ( !empty($config_array['uploads_images_max_height']) ) $upload_config['max_height'] = $config_array['uploads_images_max_height'];

    $ControllerRef->load->library('upload', $upload_config);
    $add_image= '';

    if ( !empty($files_array['add_image']) ) {
      $ControllerRef->upload->do_upload('add_image');
      $add_image = $files_array['add_image']['name'];
    }
    $images_upload_display_errors = $ControllerRef->upload->display_errors();

    $DataArray= array();
    if ( !empty($add_image) ) {
      $DataArray['photo']= $add_image;
    }
    $DataArray['description']= $post_array['add_image_description'];
    $DataArray['room_id']= $RoomId;

    $OkResult = $this->mroom_photo->UpdateRoomPhoto( '', $DataArray );
    return $images_upload_display_errors;
  }

  public function isUniqueRoomName( $name, $id, $property_id ) {
    $name= AppUtils::AddRealEscape( $name );
    $id= AppUtils::AddRealEscape( $id );
    $property_id= AppUtils::AddRealEscape( $property_id );
    $this->db->where('name', $name);
    if (!empty($property_id)) {
      $this->db->where('property_id', $property_id);
    }
    if (!empty($id)) {
      $this->db->where('id != ', $id);
    }
    $RowsCount= $this->db->count_all_results('room');
    return $RowsCount== 0;
  }

}

?>