<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

public function __construct(){
	parent::__construct();
}

	public function index(){
		$sql = "Select*from locations";
		$rs=$this->db->query($sql);

		$data['province'] = $this->Option_model->getProvinceOption();

		$data['rs']=$rs->result_array();

		$this->load->view('admin/index',$data);
	
	}

	public function addLocation(){

		if($this->input->post("btnadd")!=null)
		{
			$data=array(
				"name"=>$this->input->post("name"),
				"lat"=>$this->input->post("lat"),
				"lng"=>$this->input->post("lng"),
				"address"=>$this->input->post("address"),
				"city"=>$this->input->post("city"),
				"province"=>$this->input->post("province")
			);
		//print_r($_POST);
		//exit();
			$this->db->insert("locations",$data);
			redirect("admin","refresh");
		}
	}

	public function edit($id){

		if($this->input->post("btnsave")!=null)
		{
			$data=array(
				"name"=>$this->input->post("name"),
				"lat"=>$this->input->post("lat"),
				"lng"=>$this->input->post("lng"),
				"address"=>$this->input->post("address"),
				"city"=>$this->input->post("city"),
				"province"=>$this->input->post("province")
			);
			$this->db->where("id",$id);
			$this->db->update("locations",$data);
			redirect("admin","refresh");
		}
		$query = $this->db->get_where('locations', array('id' => $id));

		if($query->num_rows()==0)
		{
			$data['rs']=array();
		}
		else
		{
			$data['rs']=$query->row_array();
		}

		$data['province'] = $this->Option_model->getProvinceOption();

		$this->load->view('admin/edit',$data);
	}

	public function del($id){
	
		$this->db->delete('locations', array('id' => $id)); 
		redirect("admin","refresh");
	}
	
	public function getDistance(){
		
		$data['dis']= $this->Location_model->getDisAll();
		$this->load->view('admin/distance',$data);
		
		json_encode($data['dis']);
		
	}
	public function getDistance2(){
		$data = $this->Location_model->getPosition();
		echo json_encode($data);
	
	}

	public function saveDistance(){	
		$data = json_decode(stripslashes($_POST['data']));
		$ele = json_decode(stripslashes($_POST['ele']));
		
		print_r($ele);
		exit();
		
		$checkdata = $this->Location_model->savematrix($data);

		if ($checkdata !== 0){
			return 0;
		}else{
			return 1;
		}
		
	}

	public function getMinMatrix(){
		$data["matrix"] = $this->Location_model->getminmatrix();
		$this->load->view('admin/minmatrix',$data);
	}

	public function getElevation(){

		$this->load->view('admin/elevationtest');
	}
	
	public function getPositionForElevation(){
		$data = $this->Location_model->getPosition();
			$a =0;
			// Start Prosition
			for ($i=0; $i < sizeof($data); $i++) {
				$start_id = $data[$i]['id'];
				$stratlat = $data[$i]['position1'];
				$startlng = $data[$i]['position2'];

				// End Prosition
				for ($j=0; $j <sizeof($data) ; $j++) { 
					//create array for 2nd position
					if ($i!=$j) {
					$end_id = $data[$j]['id'];
					$endlat = $data[$j]['position1'];
					$endlng = $data[$j]['position2'];
					
					$arrPos[$a] = array(	'start_id'  	=> $start_id,
											'start_lat' 	=> $stratlat,
											'start_lng' 	=> $startlng,
											'end_id'  	=> $end_id,
											'end_lat'	=> $endlat,
											'end_lng'	=> $endlng,
									);
					
					$a++;
					}
				}
			}

		echo json_encode($arrPos);
	}
	

}