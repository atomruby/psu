<?php
class Option_model extends CI_Model{
	
	public function __construct(){
		parent::__construct();
	}

Public function getProvinceOption()
	{
		$return = array();
		
		$this->db->select('*');
		$this->db->from('th_province');

		$query = $this->db->get();
		$res = $query->result_array();

		if( is_array( $res ) && count( $res ) > 0 )
		{
			$return[''] = 'Select Province';
			foreach($res as $row)
			{
				$return[$row['id']] = $row['pro_name_th'];
			}
		}
		return $return;
	}

}