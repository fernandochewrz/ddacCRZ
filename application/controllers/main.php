<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
	public function login(){		
		$this->form_validation->set_rules('username','Username','required');
		$this->form_validation->set_rules('password','Password','required');		
			if($this->form_validation->run() == TRUE){
				$username = $_POST['username'];
				$password = $_POST['password'];
				
				//admin account
				$this->db->select('*');
				$this->db->from('admin');
				$this->db->where(array('username' => $username, 'password' => $password));
				$query = $this->db->get();				
				$admin = $query->row();
				
				//agent account
				$this->db->select('*');
				$this->db->from('agent');
				$this->db->where(array('username' => $username, 'password' => $password));
				$query1 = $this->db->get();				
				$agent = $query1->row();
				
				//admin
				if($admin->username){					
					$this->session->set_flashdata("success","Login Successful!");				
					$_SESSION['user_logged'] = TRUE;
					$_SESSION['username'] = $admin->username;				
					redirect(base_url()."admin/admin_agentmgmt_view","refresh");
				}
				
				//agent
				else if($agent->username){
					$this->session->set_flashdata("success","Login Successful!");				
					$_SESSION['user_logged'] = TRUE;
					$_SESSION['username'] = $agent->username;
					$_SESSION['agent_Name'] = $agent->agent_Name;						
					redirect(base_url()."agent/agent_addbooking_view","refresh");
				}
				
				else{
					$this->session->set_flashdata("error","Invalid username or password, please try again");
					redirect(base_url()."main/login","refresh");
				}
			}		
		$this->load->view('login');
	}
	
	public function logout(){
		unset($_SESSION);
		redirect(base_url()."main/login","refresh");
	}
}