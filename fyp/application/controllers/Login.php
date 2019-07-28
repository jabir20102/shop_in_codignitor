<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller{

	public function __construct(){
		parent::__construct();
	}

	// FOE LOGIN PAGE
	public function index(){

		$student = $this->session->userdata('student_login');
		$teacher = $this->session->userdata('teacher_login');

		if($student || $teacher){
			redirect(base_url(), 'refresh');
		}
		else{
			$data['page_title'] = 'Login Page';
			$data['page_name'] = 'login';

			$this->load->view('frontend/index', $data, FALSE);

			// print_r($_SESSION);
		}
	}

	// AUTHENTICATE THE USER CREDENCIALS
	public function validate_login(){

		$email = $this->input->post('email');
		$pass = $this->input->post('pass');
		$loginAs = $this->input->post('login-role');

		if($loginAs == 'student'){

			$result = $this->user_model->get_students($email);

			if($result){
				if($result->password == $pass){
					// echo 'password matched student loged in';
					$this->session->set_userdata('student_id', $result->id);
					$this->session->set_userdata('student_name', $result->name);
					$this->session->set_userdata('student_email', $result->email);
					$this->session->set_userdata('student_login', true);
					redirect(base_url(), 'refresh');
				}
				else{
					$this->session->set_flashdata('error', 'Invalid Email or Password');
					$this->session->set_flashdata('class', 'alert alert-danger mt-3');
					redirect(base_url('login'),'refresh');
				}
			}
			else{
				$this->session->set_flashdata('error', 'Student does not exist');
				$this->session->set_flashdata('class', 'alert alert-danger mt-3');
				redirect(base_url('login'),'refresh');
			}
		}
		else{
			$result = $this->user_model->get_teachers($email);

			if($result){
				if($result->password == $pass){
					// echo 'password matched teacher loged in';
					$this->session->set_userdata('teacher_id', $result->id);
					$this->session->set_userdata('teacher_name', $result->name);
					$this->session->set_userdata('teacher_email', $result->email);
					$this->session->set_userdata('teacher_login', true);
					redirect(base_url(), 'refresh');
				}
				else{
					$this->session->set_flashdata('error', 'Invalid Email or Password');
					$this->session->set_flashdata('class', 'alert alert-danger mt-3');
					redirect(base_url('login'),'refresh');
				}
			}
			else{
				$this->session->set_flashdata('error', 'Teacher does not exist');
				$this->session->set_flashdata('class', 'alert alert-danger mt-3');
				redirect(base_url('login'),'refresh');
			}
		}

	}
}

?>