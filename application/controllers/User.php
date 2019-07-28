<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller{

	public function __construct(){
		parent::__construct();
	}
// Lto show dashboard page of user
	public function index(){

		if($this->session->userdata('student_login')){
			// if student is logged in
			$data['page_title'] = 'User dashboard';
			$data['page_name'] = 'dashboard';
			$data['active'] = 'dashboard';
			$this->load->view('user/index', $data, FALSE);
		}
		else{
			// if student is not logged in
			redirect(base_url('login'),'refresh');
		}
	
	}
	// SHOWS THE user DASHBOARD
	public function dashboard(){

		if($this->session->userdata('student_login')){
			// if admin is logged in loading the dash view
			$data['page_title'] = 'User Dashboard';
			$data['page_name'] = 'dashboard';
			$data['active'] = 'dashboard';

			$this->load->view('user/index', $data, FALSE);
		}
		else{
			redirect(base_url('user'),'refresh');
		}
	}
	// SHOWS THE user wishlist
	public function wishlist(){

		if($this->session->userdata('student_login')){
			// if admin is logged in loading the dash view
			$data['page_title'] = 'My Wishlist';
			$data['page_name'] = 'wishlist';
			$data['active'] = 'wishlist';

			$this->load->view('user/index', $data, FALSE);
		}
		else{
			redirect(base_url('user'),'refresh');
		}
	}
	// SHOWS THE orders 
	public function orders(){

		if($this->session->userdata('student_login')){
			// if admin is logged in loading the dash view
			$data['page_title'] = 'My Orders';
			$data['page_name'] = 'orders';
			$data['active'] = 'orders';

			$this->load->view('user/index', $data, FALSE);
		}
		else{
			redirect(base_url('user'),'refresh');
		}
	}
public function profile(){

		if($this->session->userdata('student_login')){
			// if admin is logged in loads up the admin profile page
			$data['page_title'] = 'Profile';
			$data['page_name'] = 'profile';
			$data['active'] = 'profile';
			$this->load->view('user/index', $data, FALSE);
		}
		else{
			// if admin is not loggedin
			redirect(base_url('admin'),'refresh');
		}

	}
	// LOADS UP THE EDIT PROFILE PAGE FOR STUDENT
	public function edit_profile(){

		if($this->session->userdata('student_login')){
			// if student is logged in
			$data['page_title'] = 'Edit Student Profile';
			$data['page_name'] = 'edit_student_profile';
			$data['active'] = 'profile';
			$this->load->view('frontend/index', $data, FALSE);
		}
		else{
			// if student is not logged in
			redirect(base_url('login'),'refresh');
		}
		
	}

	// TO CHANGE THE STUDENT NAME
	public function change_name(){
		if($this->session->userdata('student_login')){
			// if student is logged in

			$email = $this->session->userdata('student_email');
			$new_name = $this->input->post('new-name');

			// updating the new student name in student table
			$this->user_model->update_std_profle($email, $new_name);

			// updating student name in session variable
			// because student name is diplayed in view via this session variable
			$this->session->set_userdata('student_name', $new_name);

			$this->session->set_flashdata('profile-error', 'Profile Updated Successfuly');
			$this->session->set_flashdata('profile-class', 'alert alert-success mt-3');
			redirect(base_url('student/edit-profile'),'refresh');

		}
		else{
			// if student is not logged in
			redirect(base_url('login'),'refresh');
		}
	}

	// TO CHANGE THE STUDENT IMAGE
	public function change_img(){

		if($this->session->userdata('student_login')){
			// if student is logged in
            $config['upload_path'] = './uploads/frontend/user_images/students/';
            $config['allowed_types'] = 'jpeg|jpg|png';
            // print_r($config);
            // exit();
            $this->load->library('upload', $config);
            
            if (!$this->upload->do_upload('student_image')){
            	// if cannot upload the image the showing error
            	$error = array('error' => $this->upload->display_errors());
            	$this->session->set_flashdata('error', $error['error']);
				$this->session->set_flashdata('class', 'alert alert-danger mt-3');
				redirect(base_url('user/profile'),'refresh');
            }
            else{
            	// if image is uploaded succesfuly
            	$data = array('upload_data' => $this->upload->data());

            	$email = $this->session->userdata('student_email');
            	// getting the path of uploaded file in a variable
            	$image_url = 'uploads/frontend/user_images/students/'.$data['upload_data']['file_name'];
            	// saving the uploaded image path in the database
            	$result = $this->user_model->change_student_img($email, $image_url);

            	if($result){
            		// if image path is stored in the database
            		$this->session->set_flashdata('img-error', 'Image Uploaded Successfuly');
					$this->session->set_flashdata('img-class', 'alert alert-success mt-3');
            		redirect(base_url('user/profile'),'refresh');
            	}
            	else{
            		// cannot store the image path in database for some reason
            		$error = $this->db->error();
            		$this->session->set_flashdata('error', $error['message']);
					$this->session->set_flashdata('class', 'alert alert-danger mt-3');
					redirect(base_url('user/profile'),'refresh');
            	}
            }
		}
		else{
			// if student is not logged in then redirect it to login page
			redirect(base_url('login'),'refresh');
		}

	}

// TO CHANGE THE STUDNET PASSWORD
	public function change_pass(){
		$email = $this->session->userdata('student_email');
		$oldPass = $this->input->post('old-pass');
		$newPass = $this->input->post('new-pass');
		$confirmPass = $this->input->post('confirm-pass');

		$result = $this->user_model->get_students($email);

		if($newPass !== $confirmPass){
			// if new pass and confirm pass do not match
	        $this->session->set_flashdata('error', 'New Password did not match');
			$this->session->set_flashdata('class', 'alert alert-danger mb-3 w-50');
			redirect(base_url('user/profile'),'refresh');
		} 
		elseif($result->password !== $oldPass){
			// if new pass and old pass do not match
			$this->session->set_flashdata('error', 'Old Password is wrong');
			$this->session->set_flashdata('class', 'alert alert-danger mb-3 w-50');
			redirect(base_url('user/profile'),'refresh');
		}
		else{
			// if every thing is right then change student password
			$this->user_model->change_student_pass($email, $newPass);
			$this->session->set_flashdata('error', 'Password Changed Successfuly');
			$this->session->set_flashdata('class', 'alert alert-success mb-3 w-50');
			redirect(base_url('user/profile'),'refresh');
		}
	}
	public function add_to_wishlist($id){
		if(!is_numeric($id)){
			show_404();
		}
		if($this->session->userdata('student_email')!=null){
		$result = $this->user_model->get_students($this->session->userdata('student_email'));
		$result = $this->user_model->add_wishlist($id,$result->id);

				if($result){
					// if tutorial is successfuly deleted
					$this->session->set_flashdata('error', 'Wishlist added');
					$this->session->set_flashdata('class', 'alert alert-success');
					redirect(base_url(),'refresh');
				}
				else{
					// if cannot delete the tutorial
					$error = $this->db->error();
					$this->session->set_flashdata('error', $error['message']);
					$this->session->set_flashdata('class', 'alert alert-dange');
					redirect(base_url(),'refresh');
				}
		}else{
			$error = $this->db->error();
					$this->session->set_flashdata('error', 'Please login first in order to add wishlist');
					$this->session->set_flashdata('class', 'alert alert-danger');
					redirect(base_url(),'refresh');
		}

		
		
	}
	public function delete_wishlist()
	{
				$tutorial_id = $this->input->post('wishlist-id');

				if(!isset($tutorial_id)){
					// if link is directly accessed
					$this->session->set_flashdata('error', 'Select a Wishlist to delete');
					$this->session->set_flashdata('class', 'alert alert-info mt-3');
					redirect(base_url('user/wishlist'),'refresh');
				}

				$result = $this->user_model->delete_wishlist($tutorial_id);

				if($result){
					// if tutorial is successfuly deleted
					$this->session->set_flashdata('error', 'Wishlist Deleted');
					$this->session->set_flashdata('class', 'alert alert-success');
					redirect(base_url('user/wishlist'),'refresh');
				}
				else{
					// if cannot delete the tutorial
					$error = $this->db->error();
					$this->session->set_flashdata('error', $error['message']);
					$this->session->set_flashdata('class', 'alert alert-dange');
					redirect(base_url('user/wishlist'),'refresh');
				}
	}
	// THIS WILL ONLY LOGOUT THE ADMIN
	public function logout(){
		if($this->session->userdata('student_login')){
			$this->sess_destroy();
			redirect(base_url('user'),'refresh');
		}
		else{
			redirect(base_url('login'),'refresh');
		}
	}

	// TO DESTROY ONLY THE ADMIN'S SESSION
	public function sess_destroy(){
		$this->session->unset_userdata('student_id');
		$this->session->unset_userdata('student_name');
		$this->session->unset_userdata('student_email');
		$this->session->unset_userdata('student_login');
	}
}

	


?>