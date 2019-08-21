<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller{

	public function __construct(){
		parent::__construct();
		// date_default_timezone_set('Asia/Karachi');
	}

	// FOE LOGIN PAGE
	public function index(){

		$student = $this->session->userdata('student_login');

		if($student){
			redirect(base_url('user'), 'refresh');
		}
		else{
			$data['page_title'] = 'Login Page';
			$data['page_name'] = 'login';
			$data['active'] = '';

			$this->load->view('frontend/index', $data, FALSE);

			// print_r($_SESSION);
		}
	}

	// AUTHENTICATE THE USER CREDENCIALS
	public function validate_login(){

		$email = $this->input->post('email');
		$pass = $this->input->post('pass');
		


			$result = $this->user_model->get_students($email);

			if($result){
				if($result->password == $pass){
					// echo 'password matched student loged in';
					$this->session->set_userdata('student_id', $result->id);
					$this->session->set_userdata('student_name', $result->name);
					$this->session->set_userdata('student_email', $result->email);
					$this->session->set_userdata('student_login', true);
					// set login details
					$login_details_id=$this->user_model->set_login_details($result->id);
					$this->session->set_userdata('login_details_id', $login_details_id);

					redirect(base_url('user'), 'refresh');
				}
				else{
					$this->session->set_flashdata('error', 'Invalid Email or Password');
					$this->session->set_flashdata('class', 'alert alert-danger mt-3');
					redirect(base_url('login'),'refresh');
				}
			}
			else{
				$this->session->set_flashdata('error', 'User does not exist');
				$this->session->set_flashdata('class', 'alert alert-danger mt-3');
				redirect(base_url('login'),'refresh');
			}
		

	}
	/// it is called from user side 
	public function update_last_activity(){
		  echo $this->user_model->m_update_last_activity();

	}
	
}

?>