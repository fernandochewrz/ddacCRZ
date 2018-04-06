<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agent extends CI_Controller {	
	public function _construct(){
		if(isset($_SESSION['user_logged'])){		
			$this->session->set-flashdata("error","Please login before browsing this page.");
			redirect("main/login");
		}
	}
	public function agent_addbooking_view(){
		$this->load->view('agent_addbooking_view');
	}
	public function agent_bookingstatus_view(){
		$this->load->view('agent_bookingstatus_view');
	}
	//agent add booking
	public function form_validation(){		
		$this->load->library('form_validation');
		$this->form_validation->set_rules("item_Name","Item Name",'required');
		$this->form_validation->set_rules("item_Weight","Item Weight",'required');
		$this->form_validation->set_rules("item_Quantity","Item Quantity",'required');
		$this->form_validation->set_rules("item_Desc","Item Description",'required');
		
		$this->form_validation->set_rules("customer_Name","Customer Name",'required');
		$this->form_validation->set_rules("customer_Contact","Customer Contact",'required');
		$this->form_validation->set_rules("customer_Email","Customer Email",'required');
		$this->form_validation->set_rules("customer_Address","Customer Address",'required');
		$this->form_validation->set_rules("register_Agent","Register Agent",'required');
		
		$this->form_validation->set_rules("vessel","vessel",'required');
		$this->form_validation->set_rules("harbor","harbor",'required');
		$this->form_validation->set_rules("terminal","terminal",'required');
		$this->form_validation->set_rules("schedule","schedule",'required');
		
		$this->form_validation->set_rules("status","status",'required');

		if($this->form_validation->run()){
			$this->load->model("Agent_model");
			$data = array(
				"item_Name" 	=> $this->input->post("item_Name"),
				"item_Weight" 	=> $this->input->post("item_Weight"),
				"item_Quantity" => $this->input->post("item_Quantity"),
				"item_Desc" 	=> $this->input->post("item_Desc"),
				
				"customer_Name" 	=> $this->input->post("customer_Name"),
				"customer_Contact" 	=> $this->input->post("customer_Contact"),
				"customer_Email" 	=> $this->input->post("customer_Email"),
				"customer_Address" 	=> $this->input->post("customer_Address"),
				"register_Agent" 	=> $this->input->post("register_Agent"),
				
				"vessel" 	=> $this->input->post("vessel"),
				"harbor" 	=> $this->input->post("harbor"),
				"terminal" 	=> $this->input->post("terminal"),
				"schedule" 	=> $this->input->post("schedule"),
				
				"status" 	=> $this->input->post("status"),
			);			
				$this->Agent_model->insert_booking($data);
				redirect(base_url()."agent/inserted");		
		}else{
			redirect(base_url()."agent/fail_insert");
		}	
	}
	public function fail_insert(){
		$this->agent_addbooking_view();
	}
	public function inserted(){
		$this->agent_addbooking_view();
	}
}