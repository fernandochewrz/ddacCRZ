<?php  
 class Admin_model extends CI_Model  
 {  
	function insert_agent($data){
		$this->db->insert("agent",$data);
	}
	function insert_booking($data){
		$this->db->insert("booking",$data);
	}

	
	function fetch_data(){
		$query = $this->db->get("admin");
		return $query;
	}
	function fetch_agent(){
		$query = $this->db->get("agent");
		return $query;
	}
	function fetch_booking(){
		$query = $this->db->get("booking");
		return $query;
	}		
	
	
	function delete_agent($id){
		$this->db->where("agent_ID",$id);
		$this->db->delete("agent");
	}
	function delete_booking($id){
		$this->db->where("booking_ID",$id);
		$this->db->delete("booking");
	}	
	

	function getAgent($id){
		$this->db->select('*');
		$this->db->where('agent_ID', $id);
		$this->db->from('agent');
		$query = $this->db->get();
		return $query->row();
	}
	function getBooking($id){
		$this->db->select('*');
		$this->db->where('booking_ID', $id);
		$this->db->from('booking');
		$query = $this->db->get();
		return $query->row();
	}	


	function update_booking($id){
		$data = array(
			"booking_ID" 	=> $this->input->post("booking_ID"),
			"status" 		=> $this->input->post("status"),			
		);	
		$this->db->where('booking_ID',$id);
		$this->db->update('booking',$data);
		return $id;
	}	
 }  