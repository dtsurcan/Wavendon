<?php

class Room extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->library("AppUtils");
    $this->load->library("AppAuth");
    //if (AppUtils::isDeveloperComp())    $this->output->enable_profiler(true);
  }

  public function edit($id = 0) {
    AppAuth::IsLogged($this, 'admin');
    $IsInsert = empty($id); //or empty( $_POST['id'] );
    $editor_message = $this->session->flashdata('editor_message');
    $config_array = $this->config->config;
    $post_array = $this->input->post();
    $this->load->model('mroom', '', true);
    $this->load->model('muser', '', true);
    $this->load->model('mproperty', '', true);
    $this->load->model('mproperty_feature', '', true);
    $this->load->model('mroom_feature', '', true);
    $this->load->model('mroom_photo', '', true);

    $this->load->library('form_validation');
    $this->form_validation->set_rules('name', 'Name', 'callback_room_name_check');
    $this->form_validation->set_rules('size', 'Size', 'required|integer|greater_than[0]');
    $this->form_validation->set_rules('max_tenants', 'Max Tenants per room', 'required|integer|greater_than[0]');
    $this->form_validation->set_rules('description', 'Description', '');
    $this->form_validation->set_rules('weekly_rate', 'Weekly Rate', 'required|integer|greater_than[0]');
    $this->form_validation->set_rules('revenue', 'Revenue', 'required|integer|greater_than[0]');
    $this->form_validation->set_rules('status', 'Status', 'required');
    $this->form_validation->set_rules('status_description', 'Status Description', $this->input->post('status') == 'U' ? 'required' : '' );
    $this->form_validation->set_rules('add_image', 'Add Image', 'callback_room_add_image');

    $UriArray = $this->uri->uri_to_assoc(3);
    $PageParametersWithSort = ''; //$this->PreparePageParameters($UriArray, $_POST, true, true);
    $Room = null;
    $RoomStatusValueArray = AppUtils::SetArrayHeader(array(array('key' => '', 'value' => ' -Select Status- ')), $this->mroom->getRoomStatusValueArray());
    $PageParametersWithSort = ''; //$this->PreparePageParameters($UriArray, null, true, true);
    $RedirectUrl = $this->config->base_url() . 'admin/property/edit/' . $this->input->post('property_id') . '/active_tab/Rooms/' . $PageParametersWithSort;
    $ParentPropertyAddress = '';
    $RoomPhotosList = array();
    $RoomsListHTML = '';
    if (!$IsInsert) {
      $Room = $this->mroom->getRowById($id);
      if (empty($Room)) {
        $this->session->set_flashdata('editor_message', "Room '" . $id . "' not found");
        redirect($RedirectUrl);
        return;
      }
      $RoomPhotosList = $this->mroom_photo->getRoomPhotosList(false, '', $id, '', '');
      foreach ($RoomPhotosList as $RoomPhoto) {
        if (!empty($RoomPhoto['photo'])) {
          $filename_path = $config_array['document_root'] . $config_array['uploads_rooms_dir'] . '-room-' . $RoomPhoto['room_id'] . DIRECTORY_SEPARATOR . $RoomPhoto['photo'];
          $filename_url = $config_array['base_root_url'] . $config_array['uploads_rooms_dir'] . '-room-' . $RoomPhoto['room_id'] . DIRECTORY_SEPARATOR . $RoomPhoto['photo'];
          $orig_filename_path = $filename_url;
          if (file_exists($filename_path)) {
            $Filesize = filesize($filename_path);
            $filename_url = AppUtils::tbUrlEncode($filename_url);
            $RoomsListHTML.= '<a class="thickbox" href="' . $config_array['base_url'] . "/admin/admin/show_image/image/" . $filename_url . '?width=850&height=800' . '">View</a>&nbsp;&nbsp;&nbsp;&nbsp;' .
                    basename($orig_filename_path) . ',&nbsp;&nbsp;' . AppUtils::getFileSizeAsString($Filesize) . '&nbsp;' . $RoomPhoto['description'] . '&nbsp;&nbsp;' .
                    '<img  style="cursor:pointer;" src="' . $config_array['base_root_url'] . $config_array['images_dir'] . 'delete.png" alt="Remove Room Photo" onclick="javascript:DeletePhotoImage(' . $RoomPhoto['id'] . ", '" . $RoomPhoto['description'] . "')\" ><br>";
          }
        }
      }

      $ParentProperty = $this->mproperty->getRowById($Room['property_id']);
      if (empty($ParentProperty)) {
        $this->session->set_flashdata('editor_message', "Parent Property '" . $Room['property_id'] . "' not found");
        redirect($RedirectUrl);
        return;
      }
      $ParentPropertyAddress = $ParentProperty['address'];
    } else {
      $ParentProperty = $this->mproperty->getRowById($UriArray['property_id']);
      if (empty($ParentProperty)) {
        $this->session->set_flashdata('editor_message', "Parent Property '" . $Room['property_id'] . "' not found");
        redirect($RedirectUrl);
        return;
      }
      $ParentPropertyAddress = $ParentProperty['address'];
    }
    $form_status = 'edit';
    $images_upload_display_errors = '';
    $CheckedFeaturesArray = array();
    if (!empty($_POST)) { // form was submitted
      $IsInsert = empty($_POST['id']);
      $IsRoomPhotoUploaded = !empty($_FILES['add_image']['name']);
      $RoomFeaturesList = $this->mroom_feature->getRoomFeaturesList(false, $id);
      $CheckedFeaturesArray = array();
      foreach ($_POST as $key => $item) {
        $A = preg_split('/cbx_room_feature_/', $key);
        if (!empty($A[1])) {
          $CheckedFeaturesArray[] = $A[1];
        }
      }

      $IsRoomFeaturesListChanged = $this->IsRoomFeaturesListChanged($RoomFeaturesList, $CheckedFeaturesArray);
      if (!$IsInsert) { // verify if in edit status Row was changed.
        $WasFieldChanged = AppUtils::WasFieldChanged($Room, $this->input->post(), array('id', 'updated_at', 'created_at'));
        if ($WasFieldChanged == '' and !$IsRoomPhotoUploaded and !$IsRoomFeaturesListChanged
        ) {
          redirect($RedirectUrl);
          return;
        }
      }
      $validation_status = $this->form_validation->run();
      if ($validation_status != FALSE) {
        $this->db->trans_begin();
        $OkResult = $this->mroom->UpdateRoom($this->input->post('id'), Array('property_id' => $this->input->post('property_id'), 'name' => $this->input->post('name'), 'size' => $this->input->post('size'),
            'max_tenants' => $this->input->post('max_tenants'), 'description' => $this->input->post('description'), 'weekly_rate' => $this->input->post('weekly_rate'), 'revenue' => $this->input->post('revenue'),
            'status' => $this->input->post('status'), 'status_description' => $this->input->post('status_description')));
        if ($OkResult) {
          $Res = $this->mroom_feature->SaveRelatedFeatures($OkResult, $CheckedFeaturesArray);
        }
        if ($this->db->trans_status() === FALSE or !empty($images_upload_display_errors)) {
          $this->db->trans_rollback();
          $form_status = 'invalid';
          $OkResult = '';
        } else {
          if ($OkResult and $IsRoomPhotoUploaded) {
            $images_upload_display_errors = $this->mroom->UploadRoomImage($this, $OkResult, $_FILES, $post_array, $config_array);
          }
          $this->db->trans_commit();
        }

        $is_reopen = $this->input->post('is_reopen');
        if ($is_reopen) {
          $RedirectUrl = $this->config->base_url() . 'admin/room/edit/' . $OkResult . $PageParametersWithSort . '/property_id/' . $this->input->post('property_id');
        }
        if ($OkResult) {
          $this->session->set_flashdata('editor_message', "Room '" . $this->input->post('name') .
                  "' was " . ($IsInsert ? "inserted" : "updated"));
          redirect($RedirectUrl);
          return;
        }
      } else {
        $form_status = 'invalid';
        $Room['id'] = $id;
        $Room['property_id'] = set_value('property_id');
        $Room['name'] = set_value('name');
        $Room['size'] = set_value('size');
        $Room['max_tenants'] = set_value('max_tenants');
        $Room['description'] = set_value('description');
        $Room['weekly_rate'] = set_value('weekly_rate');
        $Room['revenue'] = set_value('revenue');
        $Room['status'] = set_value('status');
        $Room['status_description'] = set_value('status_description');
        $Room['created_at'] = '';
        $Room['updated_at'] = '';
      }
    } // if (!empty($_POST)) { // form was submitted
    $data = array('Room' => $Room, 'id' => $id, 'property_id' => $UriArray['property_id'], 'PageParametersWithSort' => $PageParametersWithSort, 'IsInsert' => $IsInsert, 'RoomStatusValueArray' => $RoomStatusValueArray,
        'form_status' => $form_status, 'editor_message' => $editor_message, 'images_upload_display_errors' => $images_upload_display_errors, 'RoomPhotosList' => $RoomPhotosList, 'ParentPropertyAddress' => htmlspecialchars_decode($ParentPropertyAddress), 'CheckedFeaturesArray' => urlencode(json_encode($CheckedFeaturesArray)), 'ControllerRef' => $this, 'validation_errors_text' => validation_errors(),
        'RoomsListHTML' => $RoomsListHTML);
    $data = $this->appsmarty->AddSystemParameters($data, $this, $this->config, true);
    $this->appsmarty->RunSmartyTemplate('admin/room_edit.tpl', $data, $this->config,true,true,true);
  }

  public function room_name_check($str) {
    if (strlen(trim($str)) == 0) {
      $this->form_validation->set_message('room_name_check', "The Name field is required.");
      return FALSE;
    }
    $UriArray = $this->uri->uri_to_assoc(3);
    $this->load->model('mroom', '', true);
    $isUniqueRoomName = $this->mroom->isUniqueRoomName($str, $UriArray['edit'], $UriArray['property_id']);
    if (!$isUniqueRoomName) {
      $this->form_validation->set_message('room_name_check', "There is already room with this name '" . $str . "' in current Property! ");
      return FALSE;
    } else {
      return TRUE;
    }
  }

  public function room_add_image($str) {
    $UriArray = $this->uri->uri_to_assoc(3);
    $this->load->model('mroom', '', true);
    if (empty($_FILES['add_image']['name']))
      return true;
    $isUniqueRoomPhoto = $this->mroom_photo->isUniqueRoomPhoto($_FILES['add_image']['name'], $UriArray['edit'], $UriArray['edit']);
    if (!$isUniqueRoomPhoto) {
      $this->form_validation->set_message('room_add_image', "There is already uploaded image with this name '" . $_FILES['add_image']['name'] . "' in current Room! ");
      return FALSE;
    } else {
      return TRUE;
    }
  }

  public function delete($id = 0) {
    AppAuth::IsLogged($this, 'admin');
    $this->load->model('mroom', '', true);
    $this->load->model('mroom_photo', '', true);
    $this->load->model('mroom_feature', '', true);
    $this->load->model('mhistory', '', true);
    $this->load->model('mroom_tenant', '', true);
    if (!empty($id)) {
      $UriArray = $this->uri->uri_to_assoc(5);
      $property_id = $UriArray['property_id'];
      $config_array = $this->config->config;
      $RedirectUrl = $this->config->base_url() . 'admin/property/edit/' . $property_id . '/active_tab/Rooms/';  //$PageParametersWithSort;
      $Room = $this->mroom->getRowById($id);
      if (empty($Room)) {
        $this->session->set_flashdata('editor_message', "Room '" . $id . "' not found");
        redirect($RedirectUrl);
        return;
      }
      $RoomName = $Room['name'];

      $this->db->trans_begin();
      $this->mroom_photo->DeleteRoomPhotosByRoomId($id);
      $this->mroom_feature->DeleteRoomFeaturesByRoomId($id);
      $this->mhistory->DeleteHistoryByRoomId($id);
      $this->mroom_tenant->DeleteRoomTenantsByRoomId($id);
      $OkResult = $this->mroom->DeleteRoom($id);
      $dir_path = $config_array['document_root'] . $config_array['uploads_rooms_dir'] . '-room-' . $id . DIRECTORY_SEPARATOR;

      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $form_status = 'invalid';
        $OkResult = '';
      } else {
        $this->db->trans_commit();
        if (is_dir($dir_path)) {
          AppUtils::DeleteDirectory($dir_path);
        }
      }

      if ($OkResult) {
        $this->session->set_flashdata('editor_message', "Room '" . $RoomName . "' was deleted");
        redirect($RedirectUrl);
        return;
      }
    }
  }

  public function delete_photo_image($id = 0) {
    AppAuth::IsLogged($this, 'admin');
    $this->load->model('mroom', '', true);
    $this->load->model('mroom_photo', '', true);
    if (!empty($id)) {
      $UriArray = $this->uri->uri_to_assoc(4);
      $id = $UriArray['id'];
      $room_id = $UriArray['room_id'];
      $property_id = $UriArray['property_id'];
      $config_array = $this->config->config;
      $RedirectUrl = $this->config->base_url() . 'admin/room/edit/' . $room_id . '/property_id/' . $property_id;  //$PageParametersWithSort;
      $RoomPhoto = $this->mroom_photo->getRowById($id);
      if (empty($RoomPhoto)) {
        $this->session->set_flashdata('editor_message', "Room Photo '" . $id . "' not found");
        redirect($RedirectUrl);
        return;
      }
      $RoomPhotoDescription = $RoomPhoto['description'];
      $OkResult = $this->mroom_photo->DeleteRoomPhoto($id);
      if ($OkResult) {
        $dir_path = $config_array['document_root'] . $config_array['uploads_rooms_dir'] . '-room-' . $room_id . DIRECTORY_SEPARATOR;
        $filepath = $dir_path . $RoomPhoto['photo'];
        unlink($filepath);
      }
      if ($OkResult) {
        $this->session->set_flashdata('editor_message', "Room Image'" . $RoomPhotoDescription . "' was deleted");
        redirect($RedirectUrl);
        return;
      }
    }
  }

  public function load_room_features() {
    AppAuth::IsLogged($this, 'admin');
    $this->load->model('mfeature', '', true);
    $this->load->model('mroom_feature', '', true);
    $UriArray = $this->uri->uri_to_assoc(4);
    $form_status = '';
    if (!empty($UriArray['form_status']))
      $form_status = $UriArray['form_status'];
    $CheckedFeaturesArray = array();
    if (!empty($UriArray['CheckedFeaturesArray']))
      $CheckedFeaturesArray = json_decode(urldecode($UriArray['CheckedFeaturesArray']));
    $RoomFeaturesCheckedList = array();
    if (!empty($UriArray['room_id'])) {
      $FeaturesList = $this->mfeature->getFeaturesList(false, '', '', 'room', 'name');
      $room_id = $UriArray['room_id'];
      $RoomFeaturesList = $this->mroom_feature->getRoomFeaturesList(false, $room_id);
      foreach ($FeaturesList as $Feature) {
        $IsChecked= '';
        if ($form_status != 'invalid') {
          reset($RoomFeaturesList);
          $IsChecked = '';
          foreach ($RoomFeaturesList as $RoomFeature) {
            if ($RoomFeature['feature_id'] == $Feature['id']) {
              $IsChecked = ' checked ';
              break;
            }
          }
        }  // if ( $form_status == 'invalid' ) {
        else {
          reset($CheckedFeaturesArray);
          $IsChecked = '';
          foreach ($CheckedFeaturesArray as $RoomFeatureId) {
            if ($RoomFeatureId == $Feature['id']) {
              $IsChecked = ' checked ';
              break;
            }
          }
        }
        $RoomFeaturesCheckedList[] = array( 'key'=>$Feature['id'],'value'=>$Feature['name'], 'checked'=>$IsChecked );
      }
    }
    $data = array( 'RoomFeaturesCheckedList' => $RoomFeaturesCheckedList, 'ControllerRef' => $this);
    $data = $this->appsmarty->AddSystemParameters($data, $this, $this->config, true);
    $this->appsmarty->RunSmartyTemplate('admin/loaded_room_feature_list.tpl', $data, $this->config,true,false, false );
  }

  private function IsRoomFeaturesListChanged($RoomFeaturesList, $CheckedFeaturesArray) {
    $RoomFeaturesInDatabaseArray = array();
    foreach ($RoomFeaturesList as $RoomFeature) {
      $RoomFeaturesInDatabaseArray[] = $RoomFeature['feature_id'];
    }
    $diff_array = array_diff($CheckedFeaturesArray, $RoomFeaturesInDatabaseArray);
    $diff_array_2 = array_diff($RoomFeaturesInDatabaseArray, $CheckedFeaturesArray);
    return count($diff_array) > 0 or count($diff_array_2) > 0;
  }

  public function load_room_historys() {
    AppAuth::IsLogged($this, 'admin');
    $this->load->model('mhistory', '', true);
    $this->load->model('muser', '', true);
    $UriArray = $this->uri->uri_to_assoc(4);
    if (!empty($UriArray['room_id'])) {
      $room_id = $UriArray['room_id'];
      $HistorysList = $this->mhistory->getHistorysList(false, '', $room_id, 'from_date');
    }
    $data = array('HistorysList' => $HistorysList, 'ControllerRef' => $this);
    $data = $this->appsmarty->AddSystemParameters($data, $this, $this->config, true);
    $this->appsmarty->RunSmartyTemplate('admin/loaded_room_history_list.tpl', $data, $this->config,true,false, false );
  }

  public function load_room_tenants() {
    AppAuth::IsLogged($this, 'admin');
    $this->load->model('mroom', '', true);
    $this->load->model('mroom_tenant', '', true);
    $this->load->model('muser', '', true);
    $UriArray = $this->uri->uri_to_assoc(4);
    $max_tenants = '';
    $property_id = '';
    if (!empty($UriArray['room_id'])) {
      $room_id = $UriArray['room_id'];
      $RoomTenantsList = $this->mroom_tenant->getRoomTenantsList(false, '', '', $room_id, 'from_date');
      $Room = $this->mroom->getRowById($room_id);
      if (!empty($Room['max_tenants'])) {
        $max_tenants = $Room['max_tenants'];
        $property_id = $Room['property_id'];
      }
    }
    $data = array('RoomTenantsList' => $RoomTenantsList, 'max_tenants' => $max_tenants, 'room_id' => $room_id, 'property_id' => $property_id, 'ControllerRef' => $this);
    $data = $this->appsmarty->AddSystemParameters($data, $this, $this->config, true);
    $this->appsmarty->RunSmartyTemplate('admin/loaded_room_tenant_list.tpl', $data, $this->config,true,false, false );
  }

  public function room_tenant_edit($id = 0) {
    AppAuth::IsLogged($this, 'admin');
    $post_array = $this->input->post();
    $editor_message = $this->session->flashdata('editor_message');
    $IsInsert = empty($id);

    $this->load->model('mroom_tenant', '', true);
    $this->load->model('muser', '', true);
    $this->load->library('form_validation');
    $this->form_validation->set_rules('from_date', 'From Date', 'required|callback_from_date_valid_date_check');
    $this->form_validation->set_rules('tenant_id', 'Tenant', 'required');
    $this->form_validation->set_rules('weekly_rate', 'Weekly Rate', 'required|integer|greater_than[0]');
    $this->form_validation->set_rules('text', 'Description', '');

    $UriArray = $this->uri->uri_to_assoc(5);
    $room_id = $UriArray['room_id'];
    $property_id = $UriArray['property_id'];

    $PageParametersWithSort = ''; // $this->PreparePageParameters( $UriArray, $post_array, true, true );
    $RedirectUrl = $this->config->base_url() . 'admin/room/edit/' . $room_id . '/property_id/' . $property_id . $PageParametersWithSort;
    $TenantsList = AppUtils::SetArrayHeader(array(array('key' => '','value' => ' -Select Tenant- ') ), $this->muser->getUsersSelectionList(false, '', '', 'tenant', 'username'));

    $RoomTenant = null;
    if (!$IsInsert) {
      $RoomTenant = $this->mroom_tenant->getRowById($id);
      $RoomTenant['from_date']= AppUtils::ConvertFromMySqlToEditorFormat($RoomTenant['from_date']);
      if (empty($RoomTenant)) {
        $this->session->set_flashdata('editor_message', "RoomTenant '" . $id . "' not found");
        redirect($RedirectUrl);
        return;
      }
    }
    $form_status = 'edit';
    if (!empty($_POST)) { // form was submitted
      $IsInsert = empty($post_array ['id']);
      $PageParametersWithSort = ''; // $this->PreparePageParameters( $UriArray, null, true, true );
      if (!$IsInsert) { // verify if in edit status Row was changed.
        $WasFieldChanged = AppUtils::WasFieldChanged($RoomTenant, $this->input->post(), array('id', 'updated_at', 'created_at'));
        if ($WasFieldChanged == '') {
          redirect($RedirectUrl);
          return;
        }
      }
      $validation_status = $this->form_validation->run();
      if ($validation_status != FALSE) {
        $OkResult = $this->mroom_tenant->UpdateRoomTenant($this->input->post('id'), Array('from_date' => AppUtils::ConvirtDateToMySqlFormat($this->input->post('from_date')), 'room_id' => $room_id,
            'tenant_id' => $this->input->post('tenant_id'), 'weekly_rate' => $this->input->post('weekly_rate'), 'text' => $this->input->post('text')));
        $is_reopen = $this->input->post('is_reopen');
        if ($is_reopen) {
          $RedirectUrl = $this->config->base_url() . 'admin/room/room_tenant_edit/' . $OkResult . '/property_id/' . $property_id . '/room_id/' . $room_id . $PageParametersWithSort;
        }
        if ($OkResult) {
          $this->session->set_flashdata('editor_message', "Room Tenant from '" . $this->input->post('from_date') . "' was " . ($IsInsert ? "inserted" : "updated"));
          redirect($RedirectUrl);
          return;
        }
      } else {
        $form_status = 'invalid';
        $RoomTenant['id'] = $id;
        $RoomTenant['from_date'] = set_value('from_date');
        $RoomTenant['room_id'] = set_value('room_id');
        $RoomTenant['tenant_id'] = set_value('tenant_id');
        $RoomTenant['weekly_rate'] = set_value('weekly_rate');
        $RoomTenant['text'] = set_value('text');
        $RoomTenant['created_at'] = '';
        $RoomTenant['updated_at'] = '';
      }
    } // if (!empty($_POST)) { // form was submitted

    $data = array('RoomTenant' => $RoomTenant, 'id' => $id, 'room_id' => $room_id, 'property_id' => $property_id, 'PageParametersWithSort' => $PageParametersWithSort, 'TenantsList' => $TenantsList, 'IsInsert' => $IsInsert, 'editor_message' => $editor_message, 'form_status' => $form_status, 'DatePickerSelectionFormat'=> AppUtils::getDatePickerSelectionFormat(), 'validation_errors_text' => validation_errors() );
    $data = $this->appsmarty->AddSystemParameters($data, $this, $this->config, true);
    $this->appsmarty->RunSmartyTemplate('admin/room_tenant_edit.tpl', $data, $this->config,true,true,true);
  }

  public function from_date_valid_date_check($str) {
    if (strlen(trim($str)) == 0) {
      $this->form_validation->set_message('from_date_valid_date_check', "The From Date field is required.");
      return FALSE;
    }
    $IsValid = AppUtils::IsValidDate($str);
    if (!$IsValid) {
      $this->form_validation->set_message('from_date_valid_date_check', "Invalid date '" . $str . "' entered! ");
      return FALSE;
    } else {
      return TRUE;
    }
  }

  public function delete_room_tenant($id = 0) {
    AppAuth::IsLogged($this, 'admin');
    $this->load->model('mroom_tenant', '', true);
    $post_name = $this->input->post('name');
    $UriArray = $this->uri->uri_to_assoc(3);
    $room_tenant_id = $UriArray['delete_room_tenant'];
    $property_id = $UriArray['property_id'];
    $room_id = $UriArray['room_id'];

    if (!empty($room_tenant_id)) {
      $RoomTenant = $this->mroom_tenant->getRowById($id);
      if (empty($RoomTenant)) {
        $this->session->set_flashdata('editor_message', "RoomTenant '" . $room_tenant_id . "' not found");
        echo json_encode(array('ErrorMessage' => '', 'ErrorCode' => 0, 'id' => $id));
        return;
      }
      $RoomTenantName = $RoomTenant['from_date'];
      $OkResult = $this->mroom_tenant->DeleteRoomTenant($room_tenant_id);
      if ($OkResult) {
        $this->session->set_flashdata('editor_message', "Room Tenant '" . $RoomTenantName . "' was deleted");
        echo json_encode(array('ErrorMessage' => '', 'ErrorCode' => 0, 'id' => $id));
        return;
      }
    }
    echo json_encode(array('ErrorMessage' => 'Invalid parameters', 'ErrorCode' => 1, 'id' => 0));
  }

  public function move_room_tenant_to_history($id = 0) {
    AppAuth::IsLogged($this, 'admin');
    $this->load->model('mroom_tenant', '', true);
    $this->load->model('mhistory', '', true);
    $post_name = $this->input->post('name');
    $UriArray = $this->uri->uri_to_assoc(3);
    $room_tenant_id = $UriArray['move_room_tenant_to_history'];
    $property_id = $UriArray['property_id'];
    $room_id = $UriArray['room_id'];
    if (!empty($room_tenant_id)) {
      $RoomTenant = $this->mroom_tenant->getRowById($id);
      if (empty($RoomTenant)) {
        $this->session->set_flashdata('editor_message', "RoomTenant '" . $room_tenant_id . "' not found");
        echo json_encode(array('ErrorMessage' => '', 'ErrorCode' => 0, 'id' => $id));
        return;
      }

      $this->db->trans_begin();
      $RoomTenantName = $RoomTenant['from_date'];
      $NewHistoryOkResult = $this->mhistory->UpdateHistory('', array('from_date' => $RoomTenant['from_date'], 'to_date' => strftime(AppUtils::getDateTimeMySqlFormat(), mktime()), 'room_id' => $RoomTenant['room_id'], 'tenant_id' => $RoomTenant['tenant_id'],
          'weekly_rate' => $RoomTenant['weekly_rate'], 'text' => $RoomTenant['text']));
      $OkResult = $this->mroom_tenant->DeleteRoomTenant($room_tenant_id);
      if ($OkResult) {
        if ($this->db->trans_status() === FALSE) {
          $this->db->trans_rollback();
          $form_status = 'invalid';
          $OkResult = '';
        } else {
          $this->db->trans_commit();
        }
      }
      echo json_encode(array('ErrorMessage' => '', 'ErrorCode' => 0, 'id' => $room_tenant_id));
      return;
    }
    echo json_encode(array('ErrorMessage' => 'Invalid parameters', 'ErrorCode' => 1, 'id' => 0));
  }


  public function is_room_unique() {
    AppUtils::DebToFile( "is_room_unique", true, $FileName= '' );
    AppAuth::IsLogged($this, 'admin');
    $this->load->model('mroom', '', true);
    $UriArray = $this->uri->uri_to_assoc(4);
    AppUtils::DebToFile( print_r($UriArray,true), false, $FileName= '' );
  }
}

// class Room extends CI_Controller {

