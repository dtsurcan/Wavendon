<?php

class User extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->library("AppUtils");
    $this->load->library("AppAuth");
    //if (AppUtils::isDeveloperComp())   $this->output->enable_profiler(true);
  }

  public function index() {
    AppAuth::IsLogged($this, 'admin');
    $this->load->model('muser', '', true);
    $this->load->model('mproperty', '', true);
    $UriArray = $this->uri->uri_to_assoc(4);
    $editor_message = $this->session->flashdata('editor_message');
    $post_array = $this->input->post();

    $page = AppUtils::getParameter($this, $UriArray, $post_array, 'page', 1);
    $filter_username = AppUtils::getParameter($this, $UriArray, $post_array, 'filter_username');
    $filter_type = AppUtils::getParameter($this, $UriArray, $post_array, 'filter_type');
    $sorting = AppUtils::getParameter($this, $UriArray, $post_array, 'sorting');
    $sort = AppUtils::getParameter($this, $UriArray, $post_array, 'sort');
    $PageParametersWithSort = $this->PreparePageParameters($UriArray, $post_array, true, true);
    $PageParametersWithoutSort = $this->PreparePageParameters($UriArray, $post_array, true, false);

    $this->load->library('pagination');
    $config_array = $this->config->config;
    $config_array['base_url'] = $this->config->base_url() . 'admin/user/index/page/';
    $RowsInTable = $this->muser->getUsersList(true, $page, $filter_username, $filter_type, $sorting, $sort);
    $config_array['total_rows'] = $RowsInTable;
    $this->pagination->initialize($config_array);
    $UsersList = $this->muser->getUsersList(false, $page, $filter_username, $filter_type, $sorting, $sort, '', true);
    $UserTypeValueArray = AppUtils::SetArrayHeader(array(array('key' => '', 'value' => ' -Select Type- ')), $this->muser->getUserTypeValueArray());

    $this->pagination->suffix = $this->PreparePageParameters($UriArray, $post_array, false, true);
    $pagination_links = $this->pagination->create_links();
    $data = array('UsersList' => $UsersList, 'RowsInTable' => $RowsInTable, 'page' => $page, 'PageParametersWithSort' => $PageParametersWithSort, 'PageParametersWithoutSort' => $PageParametersWithoutSort,
    'filter_username' => $filter_username, 'filter_type' => $filter_type, 'sort' => $sort, 'sorting' => $sorting, 'pagination_links' => $pagination_links, 'editor_message' => $editor_message,
    'UserTypeValueArray' => $UserTypeValueArray, 'ControllerRef' => $this);
    $data = $this->appsmarty->AddSystemParameters($data, $this, $this->config, true);
    $this->appsmarty->RunSmartyTemplate('admin/user_list.tpl', $data, $this->config, true, true, true);
  }

  public function edit($id = 0) {
    AppAuth::IsLogged($this, 'admin');
    $post_array = $this->input->post();
    $IsInsert = empty($id);
    $editor_message = $this->session->flashdata('editor_message');
    $this->load->model('muser', '', true);
    $this->load->model('mtenant_guarantor', '', true);
    $this->load->library('form_validation');
    $config_array = $this->config->config;

    if ($IsInsert) {
      $this->form_validation->set_rules('username', 'Username', 'required|is_unique[user.username]');
      $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[user.email]');
      $this->form_validation->set_rules('passport', 'Passport', 'required|is_unique[user.passport]');
      $this->form_validation->set_rules('dln', 'DLN', 'required|is_unique[user.dln]');
    } else {
      $this->form_validation->set_rules('username', 'Username', 'required|is_unique[user.username.id.' . $id . ']');
      $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[user.email.id.' . $id . ']');
      $this->form_validation->set_rules('passport', 'Passport', 'required|is_unique[user.passport.id.' . $id . ']');
      $this->form_validation->set_rules('dln', 'DLN', 'required|is_unique[user.dln.id.' . $id . ']');
    }
    //$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|max_length[12]');
    $this->form_validation->set_rules('type', 'Type', 'required');
    $this->form_validation->set_rules('title', 'Title', '');
    $this->form_validation->set_rules('first_name', 'First Name', 'required');
    $this->form_validation->set_rules('middle_name', 'Middle Name', '');
    $this->form_validation->set_rules('last_name', 'Last Name', 'required');
    // $this->form_validation->set_rules('passport', 'Passport', 'required');
    // $this->form_validation->set_rules('dln', 'DLN', 'required');

    $UriArray = $this->uri->uri_to_assoc(5);
    $PageParametersWithSort = $this->PreparePageParameters($UriArray, $post_array, true, true);
    $User = null;
    $UserTypeValueArray = AppUtils::SetArrayHeader(array(array('key' => '', 'value' => ' -Select Type- ')), $this->muser->getUserTypeValueArray());
    $UserTitleValueArray = AppUtils::SetArrayHeader(array(array('key' => '', 'value' => ' -Select Title- ')), $this->muser->getUserTitleValueArray());

    $PageParametersWithSort = $this->PreparePageParameters($UriArray, null, true, true);
    $RedirectUrl = $this->config->base_url() . 'admin/user/index' . $PageParametersWithSort;
    if (!$IsInsert) {
      $User = $this->muser->getRowById($id);
      if (empty($User)) {
        $this->session->set_flashdata('editor_message', "User '" . $id . "' not found");
        redirect($RedirectUrl);
        return;
      }
    }
    $form_status = 'edit';
    $images_upload_display_errors = '';
    $photo_image_preview_html = $this->PrepareImagePreviewHtml($IsInsert, $User, 'photo', $config_array);
    $copy_passport_image_preview_html = $this->PrepareImagePreviewHtml($IsInsert, $User, 'copy_passport', $config_array);
    $copy_dln_image_preview_html = $this->PrepareImagePreviewHtml($IsInsert, $User, 'copy_dln', $config_array);

    if (!empty($_POST)) { // form was submitted
      $IsInsert = empty($post_array['id']);
      $IsImageUploaded = !empty($_FILES['copy_dln']['name']);
      if (!$IsImageUploaded)
      $IsImageUploaded = !empty($_FILES['copy_passport']['name']);
      if (!$IsImageUploaded)
      $IsImageUploaded = !empty($_FILES['photo']['name']);
      if (!$IsInsert) { // verify if in edit status Row was changed.
        $WasFieldChanged = AppUtils::WasFieldChanged($User, $this->input->post(), array('id', 'updated_at', 'created_at'));
        if ($WasFieldChanged == '' and !$IsImageUploaded
        ) {
          redirect($RedirectUrl);
          return;
        }
      }
      $validation_status = $this->form_validation->run();
      if ($validation_status != FALSE) {
        $this->db->trans_begin();
        $OkResult = $this->muser->UpdateUser($this->input->post('id'), Array('username' => $this->input->post('username'), /* 'password' => $this->input->post('password'), */
        'email' => $this->input->post('email'), 'type' => $this->input->post('type'), 'title' => $this->input->post('title'),
        'first_name' => $this->input->post('first_name'), 'middle_name' => $this->input->post('middle_name'), 'last_name' => $this->input->post('last_name'),
        'passport' => $this->input->post('passport'), 'dln' => $this->input->post('dln')));

        $images_upload_display_errors = $this->muser->UploadUserImages($this, $OkResult, $_FILES, $post_array, $config_array);
        $is_reopen = $this->input->post('is_reopen');
        if ($is_reopen) {
          $RedirectUrl = $this->config->base_url() . 'admin/user/edit/' . $OkResult . $PageParametersWithSort;
        }
        if ($OkResult and empty($images_upload_display_errors)) {
          $this->session->set_flashdata('editor_message', "User '" . $this->input->post('username') . "' was " . ($IsInsert ? "inserted" : "updated"));
          if ($this->input->post('type') != 'tenant' and !$IsInsert) {
            $this->mtenant_guarantor->ClearAllTenants($this->input->post('id'));
          }
          if ($this->input->post('type') != 'guarantor' and !$IsInsert) {
            $this->mtenant_guarantor->ClearAllGuarantors($this->input->post('id'));
          }
          if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
          } else {
            $this->db->trans_commit();
          }
          redirect($RedirectUrl);
          return;
        }
        if (!empty($images_upload_display_errors)) {
          $form_status = 'invalid';
          $User['id'] = $id;
          $User['username'] = set_value('username');
          $User['password']= set_value('password');
          $User['email'] = set_value('email');
          $User['type'] = set_value('type');
          $User['title'] = set_value('title');
          $User['first_name'] = set_value('first_name');
          $User['middle_name'] = set_value('middle_name');
          $User['last_name'] = set_value('last_name');
          $User['passport'] = set_value('passport');
          $User['dln'] = set_value('dln');
          $User['created_at'] = '';
          $User['updated_at'] = '';
        }
      } else {
        $form_status = 'invalid';
        $User['id'] = $id;
        $User['username'] = set_value('username');
        $User['password']= set_value('password');
        $User['email'] = set_value('email');
        $User['type'] = set_value('type');
        $User['title'] = set_value('title');
        $User['first_name'] = set_value('first_name');
        $User['middle_name'] = set_value('middle_name');
        $User['last_name'] = set_value('last_name');
        $User['passport'] = set_value('passport');
        $User['dln'] = set_value('dln');
        $User['created_at'] = '';
        $User['updated_at'] = '';
      }
    } // if (!empty($_POST)) { // form was submitted
    $data = array('User' => $User, 'id' => $id, 'IsInsert' => $IsInsert, 'UserTypeValueArray' => $UserTypeValueArray, 'PageParametersWithSort' => $PageParametersWithSort, 'form_status' => $form_status,
    'editor_message' => $editor_message, 'UserTitleValueArray' => $UserTitleValueArray, 'images_upload_display_errors' => $images_upload_display_errors, 'validation_errors_text' => validation_errors(),
    'photo_image_preview_html' => $photo_image_preview_html, 'copy_passport_image_preview_html' => $copy_passport_image_preview_html, 'copy_dln_image_preview_html' => $copy_dln_image_preview_html);
    $data = $this->appsmarty->AddSystemParameters($data, $this, $this->config, true);
    $this->appsmarty->RunSmartyTemplate('admin/user_edit.tpl', $data, $this->config, true, true, true);
  }

  public function delete($id = 0) {
    AppAuth::IsLogged($this, 'admin');
    $this->load->model('muser', '', true);
    $this->load->model('muser_notes', '', true);
    $this->load->model('mroom_tenant', '', true);
    $this->load->model('mtenant_guarantor', '', true);
    $this->load->model('mhistory', '', true);
    $config_array = $this->config->config;
    if (!empty($id)) {
      $UriArray = $this->uri->uri_to_assoc(5);
      $PageParametersWithSort = $this->PreparePageParameters($UriArray, null, false, true);
      $RedirectUrl = $this->config->base_url() . 'admin/user/index' . $PageParametersWithSort;

      $User = $this->muser->getRowById($id);
      if (empty($User)) {
        $this->session->set_flashdata('editor_message', "User '" . $id . "' not found");
        redirect($RedirectUrl);
        return;
      }
      $UserName = $User['username'];
      $this->db->trans_begin();
      $Res = $this->muser_notes->DeleteUserNotesByUserId($id);
      $Res = $this->mroom_tenant->DeleteRoomTenantsByTenantId($id);
      $Res = $this->mtenant_guarantor->ClearAllTenants($id);
      $Res = $this->mtenant_guarantor->ClearAllGuarantors($id);
      // `wvd_tenant_guarantor
      $Res = $this->mhistory->DeleteHistoryByTenantId($id);
      if ($Res) {
        $OkResult = $this->muser->DeleteUser($id);
        if ($this->db->trans_status() === FALSE) {
          $this->db->trans_rollback();
        } else {
          $this->session->set_flashdata('editor_message', "User '" . $UserName . "' was deleted");
          $this->db->trans_commit();
          $dir_path = $config_array['document_root'] . $config_array['uploads_people_dir'] . '-user-' . $id . DIRECTORY_SEPARATOR;
          AppUtils::DeleteDirectory($dir_path);
        }
        if ($OkResult) {
          $this->session->set_flashdata('editor_message', "User '" . $UserName . "' was deleted");
          redirect($RedirectUrl);
          return;
        }
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
      $filter_username = $this->input->post('filter_username');
      $ResStr.=!empty($filter_username) ? 'filter_username/' . $filter_username . '/' : '';
      $filter_type = $this->input->post('filter_type');
      $ResStr.=!empty($filter_type) ? 'filter_type/' . $filter_type . '/' : '';
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
      $ResStr.=!empty($UriArray['filter_username']) ? 'filter_username/' . $UriArray['filter_username'] . '/' : '';
      $ResStr.=!empty($UriArray['filter_type']) ? 'filter_type/' . $UriArray['filter_type'] . '/' : '';
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

  public function load_linked_guarantors() {
    AppAuth::IsLogged($this, 'admin');
    $this->load->model('muser', '', true);
    $this->load->model('mtenant_guarantor', '', true);
    $UriArray = $this->uri->uri_to_assoc(4);
    $user_id = $UriArray['user_id'];
    $TenantGuarantorsList = array();
    if (!empty($user_id)) {
      $TenantGuarantorsList = $this->mtenant_guarantor->getTenantGuarantorsList(false, '', $user_id, 'username');
    }
    $TempGuarantorsList = AppUtils::SetArrayHeader(array(array('key' => '', 'value' => ' -Select Guarantor- ')), $this->muser->getUsersSelectionList(false, '', '', 'guarantor', 'username'));
    $UsedGuarantorsList = $this->mtenant_guarantor->getUsedGuarantorsList(false);

    $GuarantorsList = array();
    foreach ($TempGuarantorsList as $Guarantor) {
      reset($TenantGuarantorsList);
      $IsSkip = false;
      foreach ($TenantGuarantorsList as $TenantGuarantor) {
        if ($TenantGuarantor['guarantor_id'] == $Guarantor['key']) {
          $IsSkip = true;
          break;
        }
      }
      reset($UsedGuarantorsList);
      foreach ($UsedGuarantorsList as $UsedGuarantor) {
        if ($Guarantor['key'] == $UsedGuarantor['guarantor_id']) {
          $IsSkip = true;
          break;
        }
      }
      if ($IsSkip)
      continue;
      $GuarantorsList[] = array('key' => $Guarantor['key'], 'value' => $Guarantor['value']);
    }
    $data = array('GuarantorsList' => $GuarantorsList, 'TenantGuarantorsList' => $TenantGuarantorsList, 'UsedGuarantorsList' => $UsedGuarantorsList, 'ControllerRef' => $this);
    $data = $this->appsmarty->AddSystemParameters($data, $this, $this->config, true);
    $this->appsmarty->RunSmartyTemplate('admin/loaded_tenant_guarantor_list.tpl', $data, $this->config, true, false, false);
  }

  public function load_linked_tenants() {
    AppAuth::IsLogged($this, 'admin');
    $this->load->model('muser', '', true);
    $this->load->model('mtenant_guarantor', '', true);
    $UriArray = $this->uri->uri_to_assoc(4);
    $user_id = $UriArray['user_id'];
    $TenantGuarantorsList = array();
    if (!empty($user_id)) {
      $TenantGuarantorsList = $this->mtenant_guarantor->getTenantGuarantorsList(false, '', $user_id, 'username');
    }
    $GuarantorsList = AppUtils::SetArrayHeader(array(array('key' => ' -Select Guarantor- ', 'value' => ' -Select Guarantor- ')), $this->muser->getUsersSelectionList(false, '', '', 'guarantor', 'username'));
    $data = array('GuarantorsList' => $GuarantorsList, 'TenantGuarantorsList' => $TenantGuarantorsList, 'ControllerRef' => $this);
    $data = array('GuarantorsList' => $GuarantorsList, 'TenantGuarantorsList' => $TenantGuarantorsList/* , 'UsedGuarantorsList' => $UsedGuarantorsList */, 'ControllerRef' => $this);
    $data = $this->appsmarty->AddSystemParameters($data, $this, $this->config, true);
    $this->appsmarty->RunSmartyTemplate('admin/loaded_tenant_guarantor_list.tpl', $data, $this->config, true, false, false);
  }

  public function save_linked_guarantor() {
    AppAuth::IsLogged($this, 'admin');
    $this->load->model('muser', '', true);
    $this->load->model('mtenant_guarantor', '', true);
    $UriArray = $this->uri->uri_to_assoc(4);
    $tenant_id = $UriArray['tenant_id'];
    $guarantor_id = $UriArray['guarantor_id'];
    if (!empty($tenant_id) and !empty($guarantor_id)) {
      $OkResult = $this->mtenant_guarantor->AddTenantGuarantor(Array('tenant_id' => $tenant_id, 'guarantor_id' => $guarantor_id));
      echo json_encode(array('ErrorMessage' => '', 'ErrorCode' => 0, 'id' => $OkResult));
      return;
    }
    echo json_encode(array('ErrorMessage' => 'Invalid Parameters', 'ErrorCode' => 1, 'id' => 0));
  }

  public function delete_linked_guarantor() {
    AppAuth::IsLogged($this, 'admin');
    $this->load->model('muser', '', true);
    $this->load->model('mtenant_guarantor', '', true);
    $UriArray = $this->uri->uri_to_assoc(4);
    $id = $UriArray['id'];
    if (!empty($id)) {
      $OkResult = $this->mtenant_guarantor->DeleteTenantGuarantor($id);
      echo json_encode(array('ErrorMessage' => '', 'ErrorCode' => 0, 'id' => $id));
      return;
    }
    echo json_encode(array('ErrorMessage' => 'Invalid Parameters', 'ErrorCode' => 1, 'id' => 0));
  }

  public function load_user_notes() {
    AppAuth::IsLogged($this, 'admin');
    $this->load->model('muser', '', true);
    $this->load->model('muser_notes', '', true);
    $UriArray = $this->uri->uri_to_assoc(4);
    $user_id = $UriArray['user_id'];
    $UserNotesList = $this->muser_notes->getUserNotesList(false, '', $user_id, 'created_at');
    $data = array('UserNotesList' => $UserNotesList, 'ControllerRef' => $this);
    $data = $this->appsmarty->AddSystemParameters($data, $this, $this->config, true);
    $this->appsmarty->RunSmartyTemplate('admin/loaded_user_notes_list.tpl', $data, $this->config, true, false, false);
  }

  public function save_new_user_notes() {
    AppAuth::IsLogged($this, 'admin');
    $this->load->model('muser', '', true);
    $this->load->model('muser_notes', '', true);
    $UriArray = $this->uri->uri_to_assoc(4);
    $post_array = $this->input->post();
    $user_id = AppUtils::getParameter($this, $UriArray, $post_array, 'user_id');
    $notes = AppUtils::getParameter($this, $UriArray, $post_array, 'notes');
    if (!empty($user_id) and !empty($notes)) {
      $OkResult = $this->muser_notes->AddUserNotes(Array('user_id' => $user_id, 'notes' => urldecode($notes)));
      echo json_encode(array('ErrorMessage' => '', 'ErrorCode' => 0, 'id' => $OkResult));
      return;
    }
    echo json_encode(array('ErrorMessage' => 'Invalid Parameters', 'ErrorCode' => 1, 'id' => 0));
  }

  public function show_usernotes() {
    AppAuth::IsLogged($this, 'admin');
    $this->load->model('muser', '', true);
    $this->load->model('muser_notes', '', true);
    $UriArray = $this->uri->uri_to_assoc(4);
    $id = $UriArray['id'];
    $UserNotes = $this->muser_notes->getRowById($id);
    $data = array('UserNotes' => str_replace("\n", "<br>", $UserNotes['notes']), 'ControllerRef' => $this);
    $data = $this->appsmarty->AddSystemParameters($data, $this, $this->config, true);
    $this->appsmarty->RunSmartyTemplate('admin/show_usernotes.tpl', $data, $this->config, true, false, false);
  }

  public function delete_user_notes() {
    AppAuth::IsLogged($this, 'admin');
    $this->load->model('muser', '', true);
    $this->load->model('muser_notes', '', true);
    $UriArray = $this->uri->uri_to_assoc(4);
    $id = $UriArray['id'];
    if (!empty($id)) {
      $OkResult = $this->muser_notes->DeleteUserNotes($id);
      echo json_encode(array('ErrorMessage' => '', 'ErrorCode' => 0, 'id' => $id));
      return;
    }
    echo json_encode(array('ErrorMessage' => 'Invalid Parameters', 'ErrorCode' => 1, 'id' => 0));
  }

  private function PrepareImagePreviewHtml($IsInsert, $User, $FieldName, $config_array) {
    if ($IsInsert)
    return '';
    $ImageValue = $User[$FieldName];
    if (!empty($ImageValue)) {
      $filename_path = $config_array['document_root'] . $config_array['uploads_people_dir'] . '-user-' . $User['id'] . DIRECTORY_SEPARATOR . $ImageValue;
      $filename_url = $config_array['base_root_url'] . $config_array['uploads_people_dir'] . '-user-' . $User['id'] . DIRECTORY_SEPARATOR . $ImageValue;
      $orig_filename_path = $filename_path;
      if (file_exists($filename_path)) {
        $Filesize = filesize($filename_path);
        $filename_url = AppUtils::tbUrlEncode($filename_url);
        return '<a class="thickbox" href="' . $config_array['base_url'] . "/admin/admin/show_image/image/" . $filename_url . '?width=850&height=800' . '">View</a>&nbsp;&nbsp;&nbsp;&nbsp;' .
        basename($orig_filename_path) . ',&nbsp;&nbsp;' . AppUtils::getFileSizeAsString($Filesize);
      }
    }
  }

  //
  public function recreate_password() {
    AppAuth::IsLogged($this, 'admin');
    $this->load->model('muser', '', true);
    $UriArray = $this->uri->uri_to_assoc(4);
    //AppUtils::deb($UriArray, '$UriArray::');
    $id = $UriArray['id'];
    if (!empty($id)) {
      $lUser= $this->muser->getRowById($id);
      //AppUtils::deb( $lUser, '$lUser::' );
      if ( empty($lUser) ) {
        echo json_encode(array('ErrorMessage' => 'User not found ', 'ErrorCode' => 1, 'id' => $id));
        return;
      }
      $GeneratePassword = AppUtils::GeneratePassword($this);
      //AppUtils::deb($GeneratePassword, 'GeneratePassword::');

      $OkResult = $this->muser->UpdateUser($id, Array('password' => md5($GeneratePassword)));
      //AppUtils::deb($OkResult, '$OkResult::');

      $config_array = $this->config->config;
      $SubjectText= 'Your password at wavendon.com site was generated';
      $MessageText= 'Dear '.$lUser['username'] .', at site wavendon.com new password for you was generated. Password : ' . $GeneratePassword.'


'.$config_array['Support_Signature'];
      //AppUtils::deb( $SubjectText, '$SubjectText::' );
      //AppUtils::deb( $MessageText, '$MessageText::' );

      $this->load->library('email');
      $this->email->from( $config_array['NoAnswer_Email'], $config_array['Support_Name'] );
      $this->email->to( $lUser['email'] );
      $this->email->subject($SubjectText);
      $this->email->message( $MessageText );

      $SendResult= $this->email->send();
      if ( $SendResult ) {
        echo json_encode(array('ErrorMessage' => '', 'ErrorCode' => 0, 'id' => $id, 'message'=>'New password was generated and sent at '. $lUser['email'] .' email' ) );
      } else {
        echo json_encode(array('ErrorMessage' => '', 'ErrorCode' => 1, 'id' => $id, 'message'=>'Error sending email at '. $lUser['email'] ) );
      }
      //AppUtils::deb( $SendResult, '$SendResult::' );
      //die("-1 DIE");
    }
  }

}

