<?php
class Feature extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->library("AppUtils");
    $this->load->library("AppAuth");
    // if (AppUtils::isDeveloperComp()) $this->output->enable_profiler(true);
  }

  public function index() {
    AppAuth::IsLogged( $this, 'admin');
    $this->load->model('mfeature', '', true);
    $this->load->model('mproperty_feature', '', true);
    $this->load->model('mroom_feature', '', true);

    $UriArray =$this->uri->uri_to_assoc(4) ;
    $editor_message= $this->session->flashdata('editor_message');
    $post_array= $this->input->post();
    $page = AppUtils::getParameter( $this, $UriArray, $post_array, 'page',1 ); //$this->input->post('page',1);
    $filter_name = AppUtils::getParameter( $this, $UriArray, $post_array, 'filter_name' );
    $filter_type = AppUtils::getParameter( $this, $UriArray, $post_array, 'filter_type' );
    $sorting = AppUtils::getParameter( $this, $UriArray, $post_array, 'sorting');
    $sort = AppUtils::getParameter( $this, $UriArray, $post_array, 'sort');
    $PageParametersWithSort= $this->PreparePageParameters( $UriArray, $post_array, true, true );
    $PageParametersWithoutSort= $this->PreparePageParameters( $UriArray, $post_array, true, false );

    $this->load->library('pagination');
    $config_array= $this->config->config;
    $config_array['base_url'] = $this->config->base_url() . 'admin/feature/index/page/';
    $RowsInTable = $this->mfeature->getFeaturesList( true, $page, $filter_name, $filter_type, $sorting, $sort, false );
    $config_array['total_rows'] = $RowsInTable;
    $this->pagination->initialize($config_array);
    $FeaturesList = $this->mfeature->getFeaturesList(false, $page, $filter_name, $filter_type, $sorting, $sort, true );

    $this->pagination->suffix= $this->PreparePageParameters( $UriArray, $post_array, false, true );
    $pagination_links= $this->pagination->create_links();
    $data = array('FeaturesList' => $FeaturesList, 'RowsInTable' => $RowsInTable, 'PageParametersWithSort'=> $PageParametersWithSort, 'PageParametersWithoutSort'=> $PageParametersWithoutSort,
        'page' => $page, 'filter_name' => $filter_name, 'filter_type' => $filter_type, 'sorting' => $sorting, 'sort' => $sort, 'editor_message'=> $editor_message, 'pagination_links'=> $pagination_links, 'ControllerRef'=> $this );
    $data= $this->appsmarty->AddSystemParameters( $data, $this, $this->config, true );
    $this->appsmarty->RunSmartyTemplate('admin/feature_list.tpl', $data, $this->config,true,true,true );
  }

  public function edit($id = 0) {
    AppAuth::IsLogged( $this, 'admin');
    $post_array= $this->input->post();
    $editor_message= $this->session->flashdata('editor_message');
    $IsInsert= empty($id) ;
    $this->load->model('mfeature', '', true);
    $this->load->library('form_validation');
    if ( $IsInsert ) {
      $this->form_validation->set_rules('name', 'Feature name', 'required|min_length[3]|max_length[50]|is_unique[feature.name]');
    } else {
      $this->form_validation->set_rules('name', 'Feature name', 'required|min_length[3]|max_length[50]|is_unique[feature.name.id.'.$id.']');
    }
    $this->form_validation->set_rules('type', 'Type', 'required');

    $UriArray =$this->uri->uri_to_assoc(5) ;
    $PageParametersWithSort= $this->PreparePageParameters( $UriArray, $post_array, true, true );
    $RedirectUrl = $this->config->base_url() . 'admin/feature/index' . $PageParametersWithSort;
    $Feature = null;
    if ( !$IsInsert ) {
      $Feature = $this->mfeature->getRowById($id);
      if (empty($Feature)) {
        $this->session->set_flashdata( 'editor_message', "Feature '" . $id . "' not found" );
        redirect( $RedirectUrl );
        return;
      }
    }
    $form_status= 'edit';
    $FeatureTypeValueArray = AppUtils::SetArrayHeader(array(array('key'=>'',  'value'=>' -Select Type- ')), $this->mfeature->getFeatureTypeValueArray());

    if (!empty($_POST)) { // form was submitted
      $IsInsert= empty( $post_array ['id'] );
      $PageParametersWithSort= $this->PreparePageParameters( $UriArray, null, true, true );
      if ( !$IsInsert ) { // verify if in edit status Row was changed.
        if ( trim($Feature['name']) == trim($this->input->post('name') ) and trim($Feature['type']) == trim($this->input->post('type') )  ) {
          redirect( $RedirectUrl );
          return;
        }
      }
      $validation_status = $this->form_validation->run();
      if ($validation_status != FALSE) {
        $OkResult = $this->mfeature->UpdateFeature(  $this->input->post('id'), Array( 'name' => $this->input->post('name'), 'type' => $this->input->post('type') )  );
        $is_reopen = $this->input->post('is_reopen');
        if ( $is_reopen ) {
          $RedirectUrl = $this->config->base_url() . 'admin/feature/edit/' . $OkResult . $PageParametersWithSort;
        }
        if ($OkResult) {
          $this->session->set_flashdata( 'editor_message', "Feature '" . $this->input->post('name') . "' was " . ($IsInsert?"inserted":"updated") );
          redirect( $RedirectUrl );
          return;
        }
      } else {
        $form_status= 'invalid';
        $Feature['id']= $id;
        $Feature['name']= set_value('name');
        $Feature['type']= set_value('type');
        $Feature['created_at']= '';
      }
    } // if (!empty($_POST)) { // form was submitted
    $data = array( 'Feature' => $Feature, 'id' => $id, 'PageParametersWithSort'=> $PageParametersWithSort, 'IsInsert'=> $IsInsert, 'editor_message'=> $editor_message, 'form_status'=>$form_status, 'FeatureTypeValueArray'=> $FeatureTypeValueArray, 'validation_errors_text'=>validation_errors() );
    $data= $this->appsmarty->AddSystemParameters( $data, $this, $this->config, true );
    $this->appsmarty->RunSmartyTemplate('admin/feature_edit.tpl', $data, $this->config,true,true,true );
  }

  public function delete($id = 0) {
    AppAuth::IsLogged( $this, 'admin');
    $this->load->model('mfeature', '', true);
    $post_name = $this->input->post('name');
    $UriArray =$this->uri->uri_to_assoc(5) ;

    if (!empty($id)) {
      $PageParametersWithSort= $this->PreparePageParameters( $UriArray, null, false, true );
      $RedirectUrl = $this->config->base_url() . 'admin/feature/index' . $PageParametersWithSort;
      $Feature = $this->mfeature->getRowById($id);
      if ( empty($Feature) ) {
        $this->session->set_flashdata( 'editor_message', "Feature '" . $id . "' not found" );
        redirect( $RedirectUrl );
        return;
      }
      $FeatureName= $Feature['name'];
      $OkResult = $this->mfeature->DeleteFeature($id);
      if ($OkResult) {
        $this->session->set_flashdata( 'editor_message', "Feature '" . $FeatureName . "' was deleted" );
        redirect( $RedirectUrl );
        return;
      }
    }
  }

  private function PreparePageParameters( $UriArray, $_post_array, $WithPage, $WithSort ) {
    $ResStr= '';
    if (!empty($_post_array)) { // form was submitted
      if ($WithPage) {
        $page= $this->input->post('page');
        $ResStr.= !empty($page) ? 'page/'.$page.'/' : 'page/1/';
      }
      $filter_name = $this->input->post('filter_name');
      $ResStr.= !empty($filter_name) ? 'filter_name/'.$filter_name.'/' : '';
      $filter_type = $this->input->post('filter_type');
      $ResStr.= !empty($filter_type) ? 'filter_type/'.$filter_type.'/' : '';
      if ( $WithSort ) {
        $sorting = $this->input->post('sorting');
        $ResStr.= !empty($sorting) ? 'sorting/'.$sorting.'/' : '';
        $sort = $this->input->post('sort');
        $ResStr.= !empty($sort) ? 'sort/'.$sort.'/' : '';
      }
    } else {
      if ($WithPage) {
        $ResStr.= !empty($UriArray['page']) ? 'page/'.$UriArray['page'].'/' : 'page/1/';
      }
      $ResStr.= !empty($UriArray['filter_name']) ?  'filter_name/'.$UriArray['filter_name'].'/' : '';
      $ResStr.= !empty($UriArray['filter_type']) ?  'filter_type/'.$UriArray['filter_type'].'/' : '';
      if ( $WithSort ) {
        $ResStr.= !empty($UriArray['sorting']) ? 'sorting/' . $UriArray['sorting'].'/' : '';
        $ResStr.= !empty($UriArray['sort']) ? 'sort/' . $UriArray['sort'].'/' : '';
      }
    }
    if ( substr($ResStr, strlen($ResStr)-1, 1) == '/') {
      $ResStr= substr($ResStr, 0, strlen($ResStr)-1);
    }
    return '/'.$ResStr;

  }

}