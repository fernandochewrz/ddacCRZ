<?php  
 class Agent_model extends CI_Model  
 {  	
	function insert_booking($data){
		$this->db->insert("booking",$data);
	}	
 }