<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signup extends CI_Controller{

	public function __construct(){
		parent::__construct();
	}

	// FOE LOGIN PAGE
	public function index(){

		$student = $this->session->userdata('student_login');

		if($student){
			redirect(base_url('user/dashboard'), 'refresh');
		}
		else{
			$data['page_title'] = 'Registration Page';
			$data['page_name'] = 'register';
			$data['active'] = '';

			$this->load->view('frontend/index', $data, FALSE);
		}
	}

	public function add_user(){
			

			 $student_email = $this->input->post('email');
			 $pass=$this->input->post('pass');
			 $pass1=$this->input->post('pass1');
			$student = $this->user_model->get_students($student_email);

			if(isset($student)){
				// if student already exists show error
				$this->session->set_flashdata('error', 'Email is already registered. Login with this email to Continue');
				$this->session->set_flashdata('class', 'alert alert-danger mt-3');
				redirect(base_url('signup'),'refresh');
			}
			if(strlen($pass)<6 || $pass!=$pass1){
				$this->session->set_flashdata('error', 'Password is incorrect');
				$this->session->set_flashdata('class', 'alert alert-danger mt-3');
				redirect(base_url('signup'),'refresh');
			}

			$result = $this->user_model->add_student();

			if($result){
				$this->session->set_flashdata('error', 'Signup successful...');
				$this->session->set_flashdata('class', 'alert alert-success mt-3');
				redirect(base_url('login'),'refresh');
			}
			else{
				$this->session->set_flashdata('error', 'Signup failed due to some reason.');
				$this->session->set_flashdata('class', 'alert alert-danger mt-3');
				redirect(base_url('signup'),'refresh');
			}
		

	}
}

?>