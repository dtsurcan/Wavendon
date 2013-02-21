<?php

class Block extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->library("AppUtils");
    $this->load->library("AppAuth");
    //if (AppUtils::isDeveloperComp()) $this->output->enable_profiler(true);
  }

  public function index() {
    AppAuth::IsLogged($this, 'admin');
    $this->load->model('mblock', '', true);
    $this->load->model('mproperty', '', true);

    $UriArray = $this->uri->uri_to_assoc(4);
    $editor_message = $this->session->flashdata('editor_message');
    $post_array = $this->input->post();
    $page = AppUtils::getParameter($this, $UriArray, $post_array, 'page', 1); //$this->input->post('page',1);
    $filter_name = AppUtils::getParameter($this, $UriArray, $post_array, 'filter_name');
    $sorting = AppUtils::getParameter($this, $UriArray, $post_array, 'sorting');
    $sort = AppUtils::getParameter($this, $UriArray, $post_array, 'sort');

    $PageParametersWithSort = $this->PreparePageParameters($UriArray, $post_array, true, true);
    $PageParametersWithoutSort = $this->PreparePageParameters($UriArray, $post_array, true, false);
    $this->load->library('pagination');
    $config_array = $this->config->config;
    $config_array['base_url'] = $this->config->base_url() . 'admin/block/index/page/';

    $RowsInTable = $this->mblock->getBlocksList(true, $page, $filter_name, $sorting, $sort);
    $config_array['total_rows'] = $RowsInTable;
    $this->pagination->initialize($config_array);
    $BlocksList = $this->mblock->getBlocksList(false, $page, $filter_name, $sorting, $sort, '', true);

    $this->pagination->suffix = $this->PreparePageParameters($UriArray, $post_array, false, true);
    $pagination_links = $this->pagination->create_links();
    $data = array('BlocksList' => $BlocksList, 'RowsInTable' => $RowsInTable, 'PageParametersWithSort' => $PageParametersWithSort, 'PageParametersWithoutSort' => $PageParametersWithoutSort,
        'page' => $page, 'filter_name' => $filter_name, 'sorting' => $sorting, 'sort' => $sort, 'editor_message' => $editor_message, 'pagination_links' => $pagination_links, 'ControllerRef' => $this);
    $data = $this->appsmarty->AddSystemParameters($data, $this, $this->config, true);
    $this->appsmarty->RunSmartyTemplate('admin/block_list.tpl', $data, $this->config, true, true, true);
  }

  public function edit($id = 0) {
    AppAuth::IsLogged($this, 'admin');
    $post_array = $this->input->post();
    $editor_message = $this->session->flashdata('editor_message');
    $IsInsert = empty($id);

    $this->load->model('mblock', '', true);
    $this->load->library('form_validation');
    if ($IsInsert) {
      $this->form_validation->set_rules('name', 'Block name', 'required|min_length[3]|max_length[50]|is_unique[block.name]');
    } else {
      $this->form_validation->set_rules('name', 'Block name', 'required|min_length[3]|max_length[50]|is_unique[block.name.id.' . $id . ']');
    }
    $this->form_validation->set_rules('description', 'Description', '');

    $UriArray = $this->uri->uri_to_assoc(5);
    $PageParametersWithSort = $this->PreparePageParameters($UriArray, $post_array, true, true);
    $RedirectUrl = $this->config->base_url() . 'admin/block/index' . $PageParametersWithSort;
    $Block = null;
    if (!$IsInsert) {
      $Block = $this->mblock->getRowById($id);
      if (empty($Block)) {
        $this->session->set_flashdata('editor_message', "Block '" . $id . "' not found");
        redirect($RedirectUrl);
        return;
      }
    }
    $form_status = 'edit';
    if (!empty($_POST)) { // form was submitted
      $IsInsert = empty($post_array ['id']);
      $PageParametersWithSort = $this->PreparePageParameters($UriArray, null, true, true);
      if (!$IsInsert) { // verify if in edit status Row was changed.
        if (trim($Block['name']) == trim($this->input->post('name')) and trim($Block['description']) == trim($this->input->post('description'))) {
          redirect($RedirectUrl);
          return;
        }
      }
      $validation_status = $this->form_validation->run();
      if ($validation_status != FALSE) {
        $OkResult = $this->mblock->UpdateBlock($this->input->post('id'), Array('name' => $this->input->post('name'), 'description' => $this->input->post('description')));
        $is_reopen = $this->input->post('is_reopen');
        if ($is_reopen) {
          $RedirectUrl = $this->config->base_url() . 'admin/block/edit/' . $OkResult . $PageParametersWithSort;
        }
        if ($OkResult) {
          $this->session->set_flashdata('editor_message', "Block '" . $this->input->post('name') . "' was " . ($IsInsert ? "inserted" : "updated"));
          // if (!empty( $this->config->config['sql_queries_to_file'] ) ) $this->output->_display(); //To View debugging Info
          redirect($RedirectUrl);
          return;
        }
      } else {
        $form_status = 'invalid';
        $Block['id'] = $id;
        $Block['name'] = set_value('name');
        $Block['description'] = set_value('description');
        $Block['created_at'] = '';
      }
    } // if (!empty($_POST)) { // form was submitted

    $data = array('Block' => $Block, 'id' => $id, 'PageParametersWithSort' => $PageParametersWithSort, 'IsInsert' => $IsInsert, 'editor_message' => $editor_message, 'form_status' => $form_status, 'validation_errors_text' => validation_errors());
    $data = $this->appsmarty->AddSystemParameters($data, $this, $this->config, true);
    $this->appsmarty->RunSmartyTemplate('admin/block_edit.tpl', $data, $this->config, true, true, true);
  }

  public function delete($id = 0) {
    AppAuth::IsLogged($this, 'admin');
    $this->load->model('mblock', '', true);
    $this->load->model('mproperty', '', true);
    $post_name = $this->input->post('name');
    $UriArray = $this->uri->uri_to_assoc(3);

    if (!empty($id)) {
      $PageParametersWithSort = $this->PreparePageParameters($UriArray, null, false, true);
      $RedirectUrl = $this->config->base_url() . 'admin/block/index' . $PageParametersWithSort;
      $Block = $this->mblock->getRowById($id);
      if (empty($Block)) {
        $this->session->set_flashdata('editor_message', "Block '" . $id . "' not found");
        redirect($RedirectUrl);
        return;
      }
      $BlockName = $Block['name'];
      $OkResult = $this->mproperty->ClearBlockOfProperty($id);
      if ($OkResult) {
        $OkResult = $this->mblock->DeleteBlock($id);
        $UriArray = $this->uri->uri_to_assoc(5);
        if ($OkResult) {
          $this->session->set_flashdata('editor_message', "Block '" . $BlockName . "' was deleted");
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
      $filter_name = $this->input->post('filter_name');
      $ResStr.=!empty($filter_name) ? 'filter_name/' . $filter_name . '/' : '';
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
      $ResStr.=!empty($UriArray['filter_name']) ? 'filter_name/' . $UriArray['filter_name'] . '/' : '';
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

  public function load_block_properties() {
    AppAuth::IsLogged($this, 'admin');
    $this->load->model('mblock', '', true);
    $this->load->model('mproperty', '', true);
    $UriArray = $this->uri->uri_to_assoc(4);
    $PageParametersWithoutSort = '';
    $PageParametersWithSort = '';
    $pagination_links = '';
    $sorting = '';
    $sort = '';
    $block_id = $UriArray['block_id'];

    $UsedBlocksInPropertysList = $this->mproperty->getPropertysUsedInBlocksList(false);
    $PropertysList = $this->mproperty->getPropertysList(false, '', '', $block_id);
    $CommonPropertysList = array(array('id' => '', 'address' => ' -Select Property- '));
    $AList = $this->mproperty->getPropertysList(false);
    foreach ($AList as $CommonProperty) {
      reset($PropertysList);
      reset($UsedBlocksInPropertysList);
      $IsSkip = false;
      foreach ($UsedBlocksInPropertysList as $UsedBlocksInPropertyId) {
        if (empty($UsedBlocksInPropertyId['block_id']))
          continue;
        if ((int) $CommonProperty['block_id'] == (int) $UsedBlocksInPropertyId['block_id']) {
          $IsSkip = true;
          break;
        }
      }
      if ($IsSkip)
        continue;
      $CommonPropertysList[] = $CommonProperty;
    }
    $data = array('UsedBlocksInPropertysList' => $UsedBlocksInPropertysList, 'CommonPropertysList' => $CommonPropertysList, 'PropertysList' => $PropertysList, 'sorting' => $sorting, 'sort' => $sort, 'pagination_links' => $pagination_links, 'block_id' => $block_id);
    $data = $this->appsmarty->AddSystemParameters($data, $this, $this->config, true);
    $this->appsmarty->RunSmartyTemplate('admin/loaded_block_propertys_list.tpl', $data, $this->config, true, false, false);
  }

  public function save_block_property() {
    AppAuth::IsLogged($this, 'admin');
    $this->load->model('mblock', '', true);
    $this->load->model('mproperty', '', true);
    $UriArray = $this->uri->uri_to_assoc(4);
    $block_id = $UriArray['block_id'];
    $property_id = $UriArray['property_id'];
    if (!empty($block_id) and !empty($property_id)) {
      $OkResult = $this->mproperty->UpdateProperty($property_id, Array('block_id' => $block_id));
      if ($OkResult) {
        echo json_encode(array('ErrorMessage' => '', 'ErrorCode' => 0, 'id' => $property_id));
        return;
      }
    }
    echo json_encode(array('ErrorMessage' => 'Invalid Parameters', 'ErrorCode' => 1, 'id' => 0));
  }

  public function delete_block_property() {
    AppAuth::IsLogged($this, 'admin');
    $this->load->model('mblock', '', true);
    $this->load->model('mproperty', '', true);
    $UriArray = $this->uri->uri_to_assoc(4);
    $property_id = $UriArray['property_id'];
    if (!empty($property_id)) {
      $OkResult = $this->mproperty->UpdateProperty($property_id, Array('block_id' => null));
      if ($OkResult) {
        echo json_encode(array('ErrorMessage' => '', 'ErrorCode' => 0, 'id' => $property_id));
        return;
      }
    }
    echo json_encode(array('ErrorMessage' => 'Invalid Parameters', 'ErrorCode' => 1, 'id' => 0));
  }

}
