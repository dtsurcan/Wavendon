<?php
class Main extends CI_Controller {


  public function __construct()
  {

    parent::__construct();
    $this->load->library("AppUtils");
    //AppUtils::deb(  ' parent::__construct();::' );
//    echo '<pre>$request::'.print_r( $request, true ).'</pre><br>';
    // if (AppUtils::isDeveloperComp()) $this->output->enable_profiler(true);
  }

	public function index()
	{
    $this->load->model('mproperty', '', true);
    $this->load->model('muser', '', true);
    $UriArray = $this->uri->uri_to_assoc(4);
    //AppUtils::deb(  'Main Index::' );
    $page= 1;
    $filter_landlord_id= '';
    $filter_block_id= '';
    $filter_address= '';
    $filter_type= '';
    $sorting= '';
    $sort= '';
    $PageParametersWithSort = $this->PreparePageParameters($UriArray, $_POST, true, true);
    $PageParametersWithoutSort = $this->PreparePageParameters($UriArray, $_POST, true, false);
    $PageParametersWithSortWithoutPage = $this->PreparePageParameters($UriArray, $_POST, false, true);
    $this->load->library('pagination');
    $config_array = $this->config->config;
    $LoggedUserName= '';

    $PropertyTypeValueArray = AppUtils::SetArrayHeader(array(array('key' => '', 'value' => ' -Select Type- ')), $this->mproperty->getPropertyTypeValueArray());

    $RowsInTable = $this->mproperty->getPropertysList(true, $page, $filter_landlord_id, $filter_block_id, $filter_address, $filter_type, $sorting, $sort);
   // $config_array['total_rows'] = $RowsInTable;

    $PropertysList = $this->mproperty->getPropertysList(false, $page, $filter_landlord_id, $filter_block_id, $filter_address, $filter_type, $sorting, $sort);
    //AppUtils::deb(  $PropertysList, '$PropertysList::' );
    $this->pagination->initialize($config_array);
    $this->pagination->suffix = $PageParametersWithSortWithoutPage;
    $pagination_links = $this->pagination->create_links();

    $data = $this->appsmarty->AddSystemParameters( array( 'PropertysList'=> $PropertysList, 'RowsInTable' => $RowsInTable, 'PageParametersWithSort' => $PageParametersWithSort,
        'PageParametersWithoutSort' => $PageParametersWithoutSort,  'page' => $page, 'filter_block_id' => $filter_block_id, 'filter_landlord_id' => $filter_landlord_id, 'filter_address' => $filter_address,
        'filter_type' => $filter_type,  'sorting' => $sorting, 'sort' => $sort, 'LoggedUserName'=> $LoggedUserName,
        'pagination_links' => $pagination_links, 'PropertyTypeValueArray' => $PropertyTypeValueArray, 'ControllerRef' => $this ), $this, $this->config, false  );
    //AppUtils::deb( $data, '$data::' );
    $this->appsmarty->RunSmartyTemplate('main.tpl', $data, $this->config, false, true, true );

	}


  public function details($id = 0) {
    $IsInsert = empty($id); //or empty( $_POST['id'] );
    //$editor_message = $this->session->flashdata('editor_message');
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
    $this->form_validation->set_rules('rooms_number', 'Rooms Number', 'required|integer');
    $this->form_validation->set_rules('rooms_vacant', 'Vacant', '');
    $this->form_validation->set_rules('tenants_currently_in', 'Tenants Currently In', 'required|integer');
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
    $RedirectUrl = $this->config->base_url() . 'main/index' . $PageParametersWithSort;

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
        //$this->session->set_flashdata('editor_message', "Property '" . $id . "' not found");
        redirect($RedirectUrl);
        return;
      }
    }
    $data = array('Property' => $Property, 'id' => $id, 'PageParametersWithSort' => $PageParametersWithSort, 'IsInsert' => $IsInsert, 'PropertyTypeValueArray' => $PropertyTypeValueArray, 'ControllerRef' => $this,
        'PropertyLandlordValueArray' => $PropertyLandlordValueArray,
        'BlockArray' => $BlockArray, 'active_tab' => $active_tab,
        'AvailableRoomsCount' => $AvailableRoomsCount, 'RoomsCount' => $RoomsCount, 'ControllerRef' => $this, 'validation_errors_text' => validation_errors(), 'AvailableRoomsTabHTML' => $AvailableRoomsTabHTML);
    $data = $this->appsmarty->AddSystemParameters($data, $this, $this->config, false);
    $this->appsmarty->RunSmartyTemplate('property_details.tpl', $data, $this->config, false, true, true);

  }

  public function show_map() {
    $UriArray = $this->uri->uri_to_assoc(3);
    $addr = $UriArray['addr'];
    $lat = $UriArray['lat'];
    $lng = $UriArray['lng'];
    $data = array('addr' => urldecode($addr), 'lat' => $lat, 'lng' => $lng);
    $data = $this->appsmarty->AddSystemParameters($data, $this, $this->config, false);
    $this->appsmarty->RunSmartyTemplate('google_large_map.tpl', $data, $this->config, false, true, true);
  }


  private function PreparePageParameters($UriArray, $_post_array, $WithPage, $WithSort) {
    return '';
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

  public function load_property_features() {
    $this->load->model('mfeature', '', true);
    $this->load->model('mproperty_feature', '', true);
    $UriArray = $this->uri->uri_to_assoc(3);
    // AppUtils::deb( $UriArray, '$UriArray::' );
    $PropertyFeaturesList = array();
    if (!empty($UriArray['property_id'])) {
      $PropertyFeaturesList = $this->mproperty_feature->getPropertyFeaturesList(false, $UriArray['property_id']);
      // AppUtils::deb( $PropertyFeaturesList, '$PropertyFeaturesList::' );
    }

    $data = array( 'PropertyFeaturesList' => $PropertyFeaturesList, 'ControllerRef' => $this );
    $data = $this->appsmarty->AddSystemParameters($data, $this, $this->config, false);
    $this->appsmarty->RunSmartyTemplate('loaded_property_feature_list.tpl', $data, $this->config, false, false, false);
  }

  public function load_property_rooms() {
    $this->load->model('mroom_photo', '', true);
    $this->load->model('mroom_tenant', '', true);
    $this->load->model('mroom', '', true);
    $UriArray = $this->uri->uri_to_assoc(3);
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
    $data = $this->appsmarty->AddSystemParameters($data, $this, $this->config, false);
    $this->appsmarty->RunSmartyTemplate('loaded_property_room_list.tpl', $data, $this->config, false, false, false);
  }

  /*
              <li><a href="{$base_url}about">About</a></li>
            <li class="Support"><a href="{$base_url}support">Support</a></li>
            <li><a href="{$base_url}contact_us">Contact Us</a></li>
            <li class="last"><a href="{$base_url}sponsors">Sponsors</a></li>
*/
	public function about()
	{
    $UriArray = $this->uri->uri_to_assoc(4);
    $data = $this->appsmarty->AddSystemParameters( array( 'ControllerRef' => $this ), $this, $this->config, false  );
    $this->appsmarty->RunSmartyTemplate('about.tpl', $data, $this->config, false, true, true );
	}

	public function support()
	{
    $UriArray = $this->uri->uri_to_assoc(4);
    $data = $this->appsmarty->AddSystemParameters( array( 'ControllerRef' => $this ), $this, $this->config, false  );
    $this->appsmarty->RunSmartyTemplate('support.tpl', $data, $this->config, false, true, true );
	}

	public function contact_us()
	{
    $UriArray = $this->uri->uri_to_assoc(4);
    $data = $this->appsmarty->AddSystemParameters( array( 'ControllerRef' => $this ), $this, $this->config, false  );
    $this->appsmarty->RunSmartyTemplate('contact_us.tpl', $data, $this->config, false, true, true );
	}

	public function sponsors()
	{
    $UriArray = $this->uri->uri_to_assoc(4);
    $data = $this->appsmarty->AddSystemParameters( array( 'ControllerRef' => $this ), $this, $this->config, false  );
    $this->appsmarty->RunSmartyTemplate('sponsors.tpl', $data, $this->config, false, true, true );
	}

}
