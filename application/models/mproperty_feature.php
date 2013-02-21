<?php

class Mproperty_feature extends CI_Model {

  public function __construct() {
    parent::__construct();
  }

  public function getPropertyFeaturesList( $OutputFormatCount = false,  $filter_property_id = '', $filter_feature_id = '', $sorting = '', $sort = '') {
    $filter_property_id= AppUtils::AddRealEscape( $filter_property_id );
    $filter_feature_id= AppUtils::AddRealEscape( $filter_feature_id );
    $sorting= AppUtils::AddRealEscape( $sorting );
    if (empty($sorting)) $sorting= 'property_id';
    $sort= AppUtils::AddRealEscape( $sort );
    $config_data= $this->config->config;
    if (!empty($filter_property_id)) {
      $this->db->where('property_id', $filter_property_id);
    }

    if (!empty($filter_feature_id)) {
      $this->db->where('feature_id', $filter_feature_id);
    }

    if ( !empty($sorting) ) {
      $this->db->order_by( $sorting, ( ( strtolower($sort) == 'desc' or strtolower($sort) == 'asc' ) ? $sort : '' ) );
    }

    $this->db->join( 'feature', 'feature.id = property_feature.feature_id', 'left' );
    $this->db->select('property_feature.*, feature.name as feature_name ');

    if ( $OutputFormatCount ) {
      return $this->db->count_all_results('property_feature');
    } else {
      $query = $this->db->from('property_feature');
      return AppUtils::ClearRealEscape($query->get()->result('array'));
    }

  }

  public function SaveRelatedFeatures( $property_id, $CheckedFeaturesArray ) {
    $this->DeletePropertyFeaturesByPropertyId($property_id);
    foreach( $CheckedFeaturesArray as $FeatureId ) {
      $Res = $this->db->insert( 'property_feature', array( 'property_id'=> $property_id, 'feature_id'=> $FeatureId, 'created_at' => AppUtils::ShowFormattedDateTime(time(), 'MySql') ) );
      if (!$Res) return false;
    }
    return true;
  }

  public function DeletePropertyFeaturesByPropertyId($property_id) {
    $property_id= AppUtils::AddRealEscape( $property_id );
    if (!empty($property_id)) {
      $this->db->where('property_id', $property_id);
      $Res = $this->db->delete('property_feature');
      return $Res;
    }
  }

}

?>