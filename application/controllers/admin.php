<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {	
	public function _construct(){
		if(isset($_SESSION['user_logged'])){		
			$this->session->set-flashdata("error","Please login first!");
			redirect("main/login");
		}
	}
	//fetch booking list
	public function admin_bookingmgmt_view(){
		$this->load->model("Admin_model");
		$data["fetch_booking"] = $this->Admin_model->fetch_booking();
		$this->load->view('admin_bookingmgmt_view',$data);
	}
	
	//view agent list
	public function admin_agentmgmt_view(){
		$this->load->model("Admin_model");
		$data["fetch_agent"] = $this->Admin_model->fetch_agent();
		$this->load->view('admin_agentmgmt_view');
	}

	//view booking status
	public function admin_bookingstatus_view(){
		$this->load->model("Admin_model");
		$data["fetch_booking"] = $this->Admin_model->fetch_booking();
		$this->load->view('admin_bookingstatus_view');
	}
	
	//admin register agent account
	public function form_validation3(){		
		$this->load->library('form_validation');
		$this->form_validation->set_rules("username","Agent Username",'required');
		$this->form_validation->set_rules("password","Agent Password",'required');
		$this->form_validation->set_rules("agent_Name","Agent Full Name",'required');
		$this->form_validation->set_rules("agent_Contact","Agent Contact",'required');
		$this->form_validation->set_rules("agent_Address","Agent Address",'required');
		if($this->form_validation->run()){
			$this->load->model("Admin_model");
			$data = array(
				"username" 			=> $this->input->post("username"),
				"password" 			=> $this->input->post("password"),
				"agent_Name" 		=> $this->input->post("agent_Name"),
				"agent_Contact" 	=> $this->input->post("agent_Contact"),
				"agent_Address" 	=> $this->input->post("agent_Address"),
			);			
				$this->Admin_model->insert_agent($data);
				redirect(base_url()."index.php/admin/inserted3");		
		}else{
			redirect(base_url()."index.php/admin/fail_insert3");
		}	
	}
		
	public function fail_insert3(){
		$this->admin_agentmgmt_view();
	}
	public function inserted3(){
		$this->admin_agentmgmt_view();
	}	
	
	
	public function fail_insert2(){
		$this->admin_bookingmgmt_view();
	}
	public function inserted2(){
		$this->admin_bookingmgmt_view();
	}	
	
	//admin delete agent
	public function delete_agent(){
		$id = $this->uri->segment(3);
		$this->load->model("Admin_model");
		$this->Admin_model->delete_agent($id);
		redirect(base_url()."index.php/admin/admin_agentmgmt_view");
	}	
	public function deleted3(){
		$this->admin_agentmgmt_view();
	}

	//admin delete booking
	public function delete_booking(){
		$id = $this->uri->segment(3);
		$this->load->model("Admin_model");
		$this->Admin_model->delete_booking($id);
		redirect(base_url()."index.php/admin/admin_bookingmgmt_view");
	}	
	public function deleted2(){
		$this->admin_bookingmgmt_view();
	}	
	
	//admin update booking
	public function update_booking($id){
		$this->load->model('Admin_model');
		if(isset($_POST['update'])){
			if($this->Admin_model->update_booking($id)){
				$this->session->set_flashdata('success','Successfully Update Booking');
				redirect(base_url()."index.php/admin/admin_bookingstatus_view");
			}else{
				$this->session->set_flashdata('success','Update Failed');
				redirect(base_url()."index.php/admin/admin_bookingstatus_view");
			}
		}		
		$data['booking'] = $this->Admin_model->getBooking($id);
		$this->load->view('admin_bookingstatus_view',$data);
	}
}