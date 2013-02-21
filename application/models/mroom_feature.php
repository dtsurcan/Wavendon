<?php
class Mroom_feature extends CI_Model {

  public function __construct() {
    parent::__construct();
  }

  public function getRoomFeaturesList( $OutputFormatCount = false,  $filter_room_id = '', $filter_feature_id = '', $sorting = '', $sort = '') {
    $filter_room_id= AppUtils::AddRealEscape( $filter_room_id );
    $filter_feature_id= AppUtils::AddRealEscape( $filter_feature_id );
    $sorting= AppUtils::AddRealEscape( $sorting );
    if (empty($sorting)) $sorting= 'room_id';
    $sort= AppUtils::AddRealEscape( $sort );
    $config_data= $this->config->config;
    if (!empty($filter_room_id)) {
      $this->db->where('room_id', $filter_room_id);
    }
    if (!empty($filter_feature_id)) {
      $this->db->where('feature_id', $filter_feature_id);
    }
    if ( !empty($sorting) ) {
      $this->db->order_by( $sorting, ( ( strtolower($sort) == 'desc' or strtolower($sort) == 'asc' ) ? $sort : '' ) );
    }
    if ( $OutputFormatCount ) {
      return $this->db->count_all_results('room_feature');
    } else {
      $query = $this->db->from('room_feature');
      return AppUtils::ClearRealEscape($query->get()->result('array'));
    }

  }

  public function SaveRelatedFeatures( $room_id, $CheckedFeaturesArray ) {
    $this->DeleteRoomFeaturesByRoomId($room_id);
    foreach( $CheckedFeaturesArray as $FeatureId ) {
      $Res = $this->db->insert( 'room_feature', array( 'room_id'=> $room_id, 'feature_id'=> $FeatureId, 'created_at' => AppUtils::ShowFormattedDateTime(time(), 'MySql') ) );
      if (!$Res) return false;

    }
    return true;
  }

  public function DeleteRoomFeaturesByRoomId($room_id) {
    $room_id= AppUtils::AddRealEscape( $room_id );
    if (!empty($room_id)) {
      $this->db->where('room_id', $room_id);
      $Res = $this->db->delete('room_feature');
      return $Res;
    }
  }

}

?>