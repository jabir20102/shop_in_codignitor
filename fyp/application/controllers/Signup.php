<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signup extends CI_Controller{

	public function __construct(){
		parent::__construct();
	}

	public function index(){

		$student = $this->session->userdata('student_login');
		$teacher = $this->session->userdata('teacher_login');

		if($student || $teacher){
			redirect(base_url(), 'refresh');
		}

		$data['page_title'] = 'Signup Page';
		$data['page_name'] = 'signup';

		$this->load->view('frontend/index', $data, FALSE);
	}

	public function add_user(){
		$signupAs = $this->input->post('signup-role');

		if($signupAs == "student"){

			$student_email = $this->input->post('email');
			$student = $this->user_model->get_students($student_email);

			if(isset($student)){
				// if student already exists show error
				$this->session->set_flashdata('error', 'Email is already registered. Login with this email to Continue');
				$this->session->set_flashdata('class', 'alert alert-danger mt-3');
				redirect(base_url('signup'),'refresh');
			}

			$result = $this->user_model->add_student();

			if($result){
				$this->session->set_flashdata('error', 'Signup successful, Now Login to Continue');
				$this->session->set_flashdata('class', 'alert alert-success mt-3');
				redirect(base_url('signup'),'refresh');
			}
			else{
				$this->session->set_flashdata('error', 'Signup failed due to some reason.');
				$this->session->set_flashdata('class', 'alert alert-danger mt-3');
				redirect(base_url('signup'),'refresh');
			}
		}
		else{

			$teacher_email = $this->input->post('email');
			$teacher = $this->user_model->get_teachers($teacher_email);

			if(isset($teacher)){
				// if student already exists
				$this->session->set_flashdata('error', 'Email is already registered. Login with this email to Continue');
				$this->session->set_flashdata('class', 'alert alert-danger mt-3');
				redirect(base_url('signup'),'refresh');
			}

			$result = $this->user_model->add_teacher();

			if($result){
				$this->session->set_flashdata('error', 'Signup successful, Now Login to Continue');
				$this->session->set_flashdata('class', 'alert alert-success mt-3');
				redirect(base_url('signup'),'refresh');
			}
			else{
				$this->session->set_flashdata('error', 'Signup failed due to some reason.');
				$this->session->set_flashdata('class', 'alert alert-danger mt-3');
				redirect(base_url('signup'),'refresh');
			}
		}

	}
}

?>