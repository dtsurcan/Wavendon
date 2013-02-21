<?php

class Property extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->library("AppUtils");
    $this->load->library("AppAuth");
  }

  public function index() {
    AppAuth::IsLogged($this, 'admin');
    $this->load->model('mproperty', '', true);
    $this->load->model('muser', '', true);
    $UriArray = $this->uri->uri_to_assoc(4);
    $editor_message = $this->session->flashdata('editor_message');
    $page = AppUtils::getParameter($this, $UriArray, $_POST, 'page', 1); //$this->input->post('page',1);
    $filter_landlord_id = AppUtils::getParameter($this, $UriArray, $_POST, 'filter_landlord_id');
    $filter_block_id = AppUtils::getParameter($this, $UriArray, $_POST, 'filter_block_id');
    $filter_address = AppUtils::getParameter($this, $UriArray, $_POST, 'filter_address');
    $filter_type = AppUtils::getParameter($this, $UriArray, $_POST, 'filter_type');
    $sorting = AppUtils::getParameter($this, $UriArray, $_POST, 'sorting');
    $sort = AppUtils::getParameter($this, $UriArray, $_POST, 'sort');

    $is_selection = AppUtils::getParameter($this, $UriArray, $_POST, 'is_selection');
    // AppUtils::deb( $is_selection, '$is_selection::' );

    $is_onlyunusedinblocks = AppUtils::getParameter($this, $UriArray, $_POST, 'is_onlyunusedinblocks');
    // AppUtils::deb( $is_onlyunusedinblocks, '$is_onlyunusedinblocks::' );
    // $UsedBlocksInPropertysList = $this->mproperty->getPropertysUsedInBlocksList(false);
    //AppUtils::deb( $UsedBlocksInPropertysList, '$UsedBlocksInPropertysList::' );

    $PageParametersWithSort = $this->PreparePageParameters($UriArray, $_POST, true, true);
    $PageParametersWithoutSort = $this->PreparePageParameters($UriArray, $_POST, true, false);
    $PageParametersWithSortWithoutPage = $this->PreparePageParameters($UriArray, $_POST, false, true);
    $this->load->library('pagination');
    $config_array = $this->config->config;
    $config_array['base_url'] = $this->config->base_url() . 'admin/property/index/page/'; //. $PageParametersWithSortWithoutPage;
    $PropetyListOptions= array();
    if ($is_onlyunusedinblocks) {
      $PropetyListOptions['is_onlyunusedinblocks']= 1;
    }

    $RowsInTable = $this->mproperty->getPropertysList(true, $page, $filter_landlord_id, $filter_block_id, $filter_address, $filter_type, $sorting, $sort, $PropetyListOptions);
    $config_array['total_rows'] = $RowsInTable;

    $PropertysList = $this->mproperty->getPropertysList(false, $page, $filter_landlord_id, $filter_block_id, $filter_address, $filter_type, $sorting, $sort, $PropetyListOptions );
    // AppUtils::deb( $PropertysList, '++ $PropertysList::' );

    $PropertyTypeValueArray = AppUtils::SetArrayHeader(array(array('key' => '', 'value' => ' -Select Type- ')), $this->mproperty->getPropertyTypeValueArray());
    $PropertyLandlordValueArray = AppUtils::SetArrayHeader(array(array('key' => '', 'value' => ' -Select Landlord- ')), $this->mproperty->getPropertyLandlordValueArray());
    $this->pagination->initialize($config_array);

    $this->pagination->suffix = $PageParametersWithSortWithoutPage;
    $pagination_links = $this->pagination->create_links();
    $data = array('PropertysList' => $PropertysList, 'RowsInTable' => $RowsInTable, 'PageParametersWithSort' => $PageParametersWithSort, 'PageParametersWithoutSort' => $PageParametersWithoutSort,
        'page' => $page, 'filter_block_id' => $filter_block_id, 'filter_landlord_id' => $filter_landlord_id, 'filter_address' => $filter_address, 'filter_type' => $filter_type, 'sorting' => $sorting, 'sort' => $sort,
        'pagination_links' => $pagination_links, 'PropertyTypeValueArray' => $PropertyTypeValueArray, 'editor_message' => $editor_message, 'PropertyLandlordValueArray' => $PropertyLandlordValueArray,
        'ControllerRef' => $this, 'is_selection'=> $is_selection, 'is_onlyunusedinblocks'=>$is_onlyunusedinblocks );
    $data = $this->appsmarty->AddSystemParameters($data, $this, $this->config, true);
    $this->appsmarty->RunSmartyTemplate('admin/property_list.tpl', $data, $this->config,true,true,true);
  }

  public function edit($id = 0) {
    AppAuth::IsLogged($this, 'admin');
    $IsInsert = empty($id); //or empty( $_POST['id'] );
    $editor_message = $this->session->flashdata('editor_message');
    $this->load->model('mproperty', '', true);
    $this->load->model('muser', '', true);
    $this->load->model('mproperty_feature', '', true);
    $this->load->model('mroom_photo', '', true);
    $this->load->model('mroom_tenant', '', true);
    $this->load->model('mroom', '', true);
    $this->load->model('mblock', '', true);

    $this->load->library('form_validation');
    $this->form_validation->set_rules('landlord_id', 'Landlord', 'required');
    $this->form_validation->set_rules('address', 'Address', 'required|xss_clean');
    $this->form_validation->set_rules('type', 'Type', 'required');
    $this->form_validation->set_rules('block_id', 'Part of Block', '');
    $this->form_validation->set_rules('rooms_number', 'Rooms Number', 'required|integer|greater_than[0]');
    $this->form_validation->set_rules('rooms_vacant', 'Vacant', '');
    $this->form_validation->set_rules('tenants_currently_in', 'Tenants Currently In', 'required|integer|greater_than[0]');
    $UriArray = $this->uri->uri_to_assoc(5);
    $active_tab = '';
    if (!empty($UriArray['active_tab'])) { //  /active_tab/rooms
      $active_tab = $UriArray['active_tab'];
    }

    $PageParametersWithSort = $this->PreparePageParameters($UriArray, $_POST, true, true);
    $Property = null;
    $PropertyTypeValueArray = AppUtils::SetArrayHeader(array(array('key' => '', 'value' => ' -Select Type- ')), $this->mproperty->getPropertyTypeValueArray());
    $PropertyLandlordValueArray = AppUtils::SetArrayHeader(array(array('key' => '', 'value' => ' -Select Landlord- ')), $this->mproperty->getPropertyLandlordValueArray());
    $BlockArray = AppUtils::SetArrayHeader(array(array('key' => '', 'value' => ' -Not Part of Block- ')), $this->mblock->getBlocksSelectionList());
    $PageParametersWithSort = $this->PreparePageParameters($UriArray, null, true, true);
    $RedirectUrl = $this->config->base_url() . 'admin/property/index' . $PageParametersWithSort;

    $RoomsCount = $this->mroom->getRoomsList(true, '', $id);
    $AvailableRoomsCount = $this->mroom->getRoomsList(true, '', $id, 'A');
    $AvailableRoomsTabHTML = ' <small>&nbsp;(&nbsp;'; //. ( $RoomsCount > 0 ? ( $RoomsCount .'&nbsp;+++room'.($RoomsCount> 0?'s':'') ) : 'No Rooms'.
    if ($RoomsCount > 0) {
      $AvailableRoomsTabHTML.= $RoomsCount . '&nbsp;rooms';
    } else {
      $AvailableRoomsTabHTML.= 'No Rooms' . '&nbsp;)</small>&nbsp;';
    }
    if ($AvailableRoomsCount > 0) {
      $AvailableRoomsTabHTML.= '&nbsp;/&nbsp;' . $AvailableRoomsCount . '&nbsp;available' . '&nbsp;)&nbsp';
    }
    if (!$IsInsert) {
      $Property = $this->mproperty->getRowById($id);
      if (empty($Property)) {
        $this->session->set_flashdata('editor_message', "Property '" . $id . "' not found");
        redirect($RedirectUrl);
        return;
      }
    }
    $form_status = 'edit';
    $CheckedFeaturesArray = array();
    if (!empty($_POST)) { // form was submitted
      $IsInsert = empty($_POST['id']);
      $PropertyFeaturesList = $this->mproperty_feature->getPropertyFeaturesList(false, $id);
      if (!$IsInsert) { // verify if in edit status Row was changed.
        $CheckedFeaturesArray = array();
        foreach ($_POST as $key => $item) {
          $A = preg_split('/cbx_property_feature_/', $key);
          if (!empty($A[1])) {
            $CheckedFeaturesArray[] = $A[1];
          }
        }

        $IsPropertyFeaturesListChanged = $this->IsPropertyFeaturesListChanged($PropertyFeaturesList, $CheckedFeaturesArray);
        $WasFieldChanged = AppUtils::WasFieldChanged($Property, $this->input->post(), array('id', 'created_at', 'username'));
        if ($WasFieldChanged == '' and !$IsPropertyFeaturesListChanged
        ) {
          redirect($RedirectUrl);
          return;
        }
      }

      $validation_status = $this->form_validation->run();
      if ($validation_status != FALSE) {
        $this->db->trans_begin();
        $OkResult = $this->mproperty->UpdateProperty($this->input->post('id'), Array('landlord_id' => $this->input->post('landlord_id'), 'address' => $this->input->post('address'),
            'type' => $this->input->post('type'), 'block_id' => $this->input->post('block_id'), 'rooms_number' => $this->input->post('rooms_number')
            , 'rooms_vacant' => $this->input->post('rooms_vacant'), 'tenants_currently_in' => $this->input->post('tenants_currently_in')));
        if ($OkResult) {
          $Res = $this->mproperty_feature->SaveRelatedFeatures($id, $CheckedFeaturesArray);
        }
        if ($this->db->trans_status() === FALSE) {
          $this->db->trans_rollback();
        } else {
          $this->db->trans_commit();
        }
        $is_reopen = $this->input->post('is_reopen');
        if ($is_reopen) {
          $RedirectUrl = $this->config->base_url() . 'admin/property/edit/' . $OkResult . $PageParametersWithSort;
        }
        if ($OkResult) {
          $this->session->set_flashdata('editor_message', "Property on '" . $this->input->post('address') .
                  "' was " . ($IsInsert ? "inserted" : "updated"));
          redirect($RedirectUrl);
          return;
        }
      } else {
        $form_status = 'invalid';
        $Property['id'] = $id;
        $Property['landlord_id'] = set_value('landlord_id');
        $Property['address'] = set_value('address');
        $Property['type'] = set_value('type');
        $Property['block_id'] = set_value('block_id');
        $Property['rooms_number'] = set_value('rooms_number');
        $Property['rooms_vacant'] = set_value('rooms_vacant');
        $Property['tenants_currently_in'] = set_value('tenants_currently_in');
        $Property['created_at'] = '';
        $Property['updated_at'] = '';
      }
    } // if (!empty($_POST)) { // form was submitted
    $data = array('Property' => $Property, 'id' => $id, 'PageParametersWithSort' => $PageParametersWithSort, 'IsInsert' => $IsInsert, 'PropertyTypeValueArray' => $PropertyTypeValueArray, 'ControllerRef' => $this,
        'PropertyLandlordValueArray' => $PropertyLandlordValueArray, 'form_status' => $form_status, 'editor_message' => $editor_message,
        'CheckedFeaturesArray' => urlencode(json_encode($CheckedFeaturesArray)), 'BlockArray' => $BlockArray, 'active_tab' => $active_tab,
        'AvailableRoomsCount' => $AvailableRoomsCount, 'RoomsCount' => $RoomsCount, 'ControllerRef' => $this, 'validation_errors_text' => validation_errors(), 'AvailableRoomsTabHTML' => $AvailableRoomsTabHTML);
    $data = $this->appsmarty->AddSystemParameters($data, $this, $this->config, true);
    $this->appsmarty->RunSmartyTemplate('admin/property_edit.tpl', $data, $this->config,true,true,true);
  }

  public function delete($id = 0) {
    AppAuth::IsLogged($this, 'admin');
    $this->load->model('mproperty', '', true);
    $this->load->model('mroom', '', true);
    $this->load->model('mhistory', '', true);
    $this->load->model('mroom_photo', '', true);
    $this->load->model('mroom_feature', '', true);
    $this->load->model('mproperty_feature', '', true);
    $this->load->model('mroom_tenant', '', true);
    $config_array = $this->config->config;

    if (!empty($id)) {
      $UriArray = $this->uri->uri_to_assoc(5);
      $PageParametersWithSort = $this->PreparePageParameters($UriArray, null, false, true);
      $RedirectUrl = $this->config->base_url() . 'admin/property/index' . $PageParametersWithSort;
      $Property = $this->mproperty->getRowById($id);
      if (empty($Property)) {
        $this->session->set_flashdata('editor_message', "Property '" . $id . "' not found");
        redirect($RedirectUrl);
        return;
      }
      $PropertyName = $Property['username'] . ' on ' . $Property['address'];

      $this->db->trans_begin();
      $Res = $this->mproperty_feature->DeletePropertyFeaturesByPropertyId($id);
      $RoomsList = $this->mroom->getRoomsList(false, '', $id);
      foreach ($RoomsList as $NextRoom) {
        $this->mhistory->DeleteHistoryByRoomId($NextRoom['id']);
        $this->mroom_photo->DeleteRoomPhotosByRoomId($NextRoom['id']);
        $this->mroom_feature->DeleteRoomFeaturesByRoomId($NextRoom['id']);
        $this->mroom_tenant->DeleteRoomTenantsByRoomId($NextRoom['id']);
        $Res = $this->mroom->DeleteRoom($NextRoom['id']);
      }
      if ($Res) {
        $OkResult = $this->mproperty->DeleteProperty($id);
      }
      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
      } else {
        $this->session->set_flashdata('editor_message', "Property '" . $PropertyName . "' was deleted");
        $this->db->trans_commit();

        reset($RoomsList);
        foreach ($RoomsList as $NextRoom) {
          $dir_path = $config_array['document_root'] . $config_array['uploads_rooms_dir'] . '-room-' . $NextRoom['id'] . DIRECTORY_SEPARATOR;
          AppUtils::DeleteDirectory($dir_path);
        }
      }
      if ($OkResult) {
        redirect($RedirectUrl);
        return;
      }
    }
  }

  private function PreparePageParameters($UriArray, $_post_array, $WithPage, $WithSort) {
    $ResStr = '';
    if (!empty($_post_array)) { // form was submitted
      if ($WithPage) {
        $page = $this->input->post('page');
        $ResStr.=!empty($page) ? 'page/' . $page . '/' : 'page/1/';
      }
      $filter_landlord_id = $this->input->post('filter_landlord_id');
      $ResStr.=!empty($filter_landlord_id) ? 'filter_landlord_id/' . $filter_landlord_id . '/' : '';
      $filter_block_id = $this->input->post('filter_block_id');
      $ResStr.=!empty($filter_block_id) ? 'filter_block_id/' . $filter_block_id . '/' : '';
      $filter_address = $this->input->post('filter_address');
      $ResStr.=!empty($filter_address) ? 'filter_address/' . $filter_address . '/' : '';
      $filter_type = $this->input->post('filter_type');
      $ResStr.=!empty($filter_type) ? 'filter_type/' . $filter_type . '/' : '';

      $is_selection = $this->input->post('is_selection');
      $ResStr.=!empty($is_selection) ? 'is_selection/' . $is_selection . '/' : '';
      $is_onlyunusedinblocks = $this->input->post('is_onlyunusedinblocks');
      $ResStr.=!empty($is_onlyunusedinblocks) ? 'is_onlyunusedinblocks/' . $is_onlyunusedinblocks . '/' : '';

      if ($WithSort) {
        $sorting = $this->input->post('sorting');
        $ResStr.=!empty($sorting) ? 'sorting/' . $sorting . '/' : '';
        $sort = $this->input->post('sort');
        $ResStr.=!empty($sort) ? 'sort/' . $sort . '/' : '';
      }
    } else {
      if ($WithPage) {
        $ResStr.=!empty($UriArray['page']) ? 'page/' . $UriArray['page'] . '/' : 'page/1/';
      }
      $ResStr.=!empty($UriArray['filter_landlord_id']) ? 'filter_landlord_id/' . $UriArray['filter_landlord_id'] . '/' : '';
      $ResStr.=!empty($UriArray['filter_block_id']) ? 'filter_block_id/' . $UriArray['filter_block_id'] . '/' : '';
      $ResStr.=!empty($UriArray['filter_address']) ? 'filter_address/' . $UriArray['filter_address'] . '/' : '';
      $ResStr.=!empty($UriArray['filter_type']) ? 'filter_type/' . $UriArray['filter_type'] . '/' : '';

      $ResStr.=!empty($UriArray['is_selection']) ? 'is_selection/' . $UriArray['is_selection'] . '/' : '';
      $ResStr.=!empty($UriArray['is_onlyunusedinblocks']) ? 'is_onlyunusedinblocks/' . $UriArray['is_onlyunusedinblocks'] . '/' : '';

      if ($WithSort) {
        $ResStr.=!empty($UriArray['sorting']) ? 'sorting/' . $UriArray['sorting'] . '/' : '';
        $ResStr.=!empty($UriArray['sort']) ? 'sort/' . $UriArray['sort'] . '/' : '';
      }
    }
    if (substr($ResStr, strlen($ResStr) - 1, 1) == '/') {
      $ResStr = substr($ResStr, 0, strlen($ResStr) - 1);
    }
    return '/' . $ResStr;
  }

  public function show_map() {
    AppAuth::IsLogged($this, 'admin');
    $UriArray = $this->uri->uri_to_assoc(4);
    $addr = $UriArray['addr'];
    $lat = $UriArray['lat'];
    $lng = $UriArray['lng'];
    $data = array('addr' => urldecode($addr), 'lat' => $lat, 'lng' => $lng);
    $data = $this->appsmarty->AddSystemParameters($data, $this, $this->config, true);
    $this->appsmarty->RunSmartyTemplate('admin/google_large_map.tpl', $data, $this->config,true,false,false);
  }

  public function json_test() {
    AppAuth::IsLogged($this, 'admin');
    echo json_encode(array('items_count' => 11, 'common_sum' => 22));
  }

  public function load_property_features() {
    AppAuth::IsLogged($this, 'admin');
    $this->load->model('mfeature', '', true);
    $this->load->model('mproperty_feature', '', true);
    $UriArray = $this->uri->uri_to_assoc(4);
    $form_status = $UriArray['form_status'];
    $CheckedFeaturesArray = json_decode(urldecode($UriArray['CheckedFeaturesArray']));
    $CkeckedFeaturesList = array();
    if (!empty($UriArray['property_id'])) {
      $FeaturesList = $this->mfeature->getFeaturesList(false, '', '', 'property', 'name');
      $PropertyFeaturesList = $this->mproperty_feature->getPropertyFeaturesList(false, $UriArray['property_id']);
      foreach ($FeaturesList as $Feature) {
        $IsChecked = '';
        if ($form_status != 'invalid') {
          foreach ($PropertyFeaturesList as $PropertyFeature) {
            if ($PropertyFeature['feature_id'] == $Feature['id']) {
              $IsChecked = ' checked ';
              break;
            }
          }
        }  // if ( $form_status == 'invalid' ) {
        else {
          reset($CheckedFeaturesArray);
          foreach ($CheckedFeaturesArray as $PropertyFeatureId) {
            if ($PropertyFeatureId == $Feature['id']) {
              $IsChecked = ' checked ';
              break;
            }
          }
        }
        $CkeckedFeaturesList[]= array('key'=>$Feature['id'], 'value'=>$Feature['name'], 'checked'=>$IsChecked);
      } // foreach($FeaturesList as $Feature ) {
    }

    $data = array( 'CheckedFeaturesArray' => $CheckedFeaturesArray, 'ControllerRef' => $this,  'CkeckedFeaturesList' => $CkeckedFeaturesList);
    $data = $this->appsmarty->AddSystemParameters($data, $this, $this->config, true);
    $this->appsmarty->RunSmartyTemplate('admin/loaded_property_feature_list.tpl', $data, $this->config,true,false, false );
  }

  private function IsPropertyFeaturesListChanged($PropertyFeaturesList, $CheckedFeaturesArray) {
    $PropertyFeaturesInDatabaseArray = array();
    foreach ($PropertyFeaturesList as $PropertyFeature) {
      $PropertyFeaturesInDatabaseArray[] = $PropertyFeature['feature_id'];
    }
    $diff_array = array_diff($CheckedFeaturesArray, $PropertyFeaturesInDatabaseArray);
    $diff_array_2 = array_diff($PropertyFeaturesInDatabaseArray, $CheckedFeaturesArray);
    return count($diff_array) > 0 or count($diff_array_2) > 0;
  }

  public function load_property_rooms() {

    AppAuth::IsLogged($this, 'admin');
    $this->load->model('mroom_photo', '', true);
    $this->load->model('mroom_tenant', '', true);
    $this->load->model('mroom', '', true);
    $UriArray = $this->uri->uri_to_assoc(4);
    $PageParametersWithoutSort = '';
    $PageParametersWithSort = '';
    $pagination_links = '';
    $sorting = '';
    $sort = '';
    if (!empty($UriArray['property_id'])) {
      $property_id = $UriArray['property_id'];
      $RowsInTable = $this->mroom->getRoomsList(true, '', $property_id);
      $RoomsList = $this->mroom->getRoomsList(false, '', $property_id, '', 'status, name ', '', true);
    }
    $data = array('RoomsList' => $RoomsList, 'RowsInTable' => $RowsInTable, 'PageParametersWithSort' => $PageParametersWithSort, 'PageParametersWithoutSort' => $PageParametersWithoutSort,
        'sorting' => $sorting, 'sort' => $sort, 'pagination_links' => $pagination_links, 'property_id' => $property_id, 'ControllerRef' => $this );
    $data = $this->appsmarty->AddSystemParameters($data, $this, $this->config, true);
    $this->appsmarty->RunSmartyTemplate('admin/loaded_property_room_list.tpl', $data, $this->config,true,false, false );
  }

}