<?php
class User extends CI_Controller {

	public function __construct(){
		parent::__construct();
	}
	
	public function index(){
		
		$data['province'] = $this->Option_model->getProvinceOption();
		
		$this->load->view("user/index",$data);
	}
	
	public function getlocation(){
		//echo "==========>>>  ".$_POST['id'];
		$location = $this->Location_model->getLocationByProvince($_POST['id']);
		
		print_r($location);
		return $location;
	}
	
}