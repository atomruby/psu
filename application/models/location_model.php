<?php
class Location_model extends CI_Model{
	
	public function __construct(){
		parent::__construct();
	}
	
	public function getDisAll(){
		$dis= array();
		$this->db->select('id,lat,lng');
		$query = $this->db->get('locations');
		$res = $query->result_array();
		foreach($res as $r){
			$dis[$r['id']]= $r['lat'].','.$r['lng'];
		}
	return $dis;
	}
	
	public function getPosition(){
		$dis= array();
		$this->db->select('id,lat,lng');
		$query = $this->db->get('locations');
		$res = $query->result_array();
		$n=0;
		foreach($res as $r){
			$pos[$n] = array(
					"id"=>$r['id'],
					"position1"=>$r['lat'],
					"position2"=>$r['lng'],
			);
			$n++;
			//$dis[$r['id']]= $r['lat'].','.$r['lng'];
		}
		return $pos;
	}
	
	public function getLocationByProvince($id){
	
		$query = $this->db->get_where('locations', array('province' => $id));
		
		//print_r($query->result_array());
		//exit();
		
		return $query->result_array();
	}
	
	
	
	public function savematrix($data){
		$this->db->empty_table('minmatrix');
		foreach ($data as $index){
			$arr = array(
					"begin_id" => $index->begin_id,
					"end_id"  => $index->end_id,
					"distance" => $index->distance,
					"begin_latlng" => $index->begin_pos,
					"end_latlng" => $index->end_pos
			);
			$this->db->insert('minmatrix', $arr);
		}
		return $this->db->count_all('minmatrix');
	}

	public function getMinMatrix(){
		$query = $this->db->get('minmatrix');
		return $query->result_array();
	}

}
