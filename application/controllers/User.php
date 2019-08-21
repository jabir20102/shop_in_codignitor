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
	// SHOWS THE user wishlist
	public function chat(){

		if($this->session->userdata('student_login')){
			// if admin is logged in loading the dash view
			$user = $this->user_model->get_students($this->session->userdata('student_email'));
    if($user->image_url == ''){
        $image_src = base_url('uploads/backend/user_image/placeholder.png');
    }
    else{
        $image_src = base_url($user->image_url);
    }
     $result = $this->user_model->get_admin('sheraz5006@gmail.com');
    if($result->image_url == ''){
        $user_src = base_url('uploads/backend/user_image/placeholder.png');
    }
    else{
        $user_src = base_url($result->image_url);
    }

			$data['id']=$this->session->userdata('student_id');

			$data['user_src']=$user_src;
			$data['img_src']=$image_src;
			$data['page_title'] = 'Chat with Admin';
			$data['page_name'] = 'chat_box';
			$data['active'] = 'chat';

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

	// TO CHANGE THE STUDENT info
	public function change_info(){
		if($this->session->userdata('student_login')){
			// if student is logged in

			$email = $this->session->userdata('student_email');
			$name = $this->input->post('name');
			$address = $this->input->post('address');
			$city = $this->input->post('city');
			$country = $this->input->post('country');
			$zip = $this->input->post('zip');
			$phone = $this->input->post('phone');

			// updating the new student name in student table
			$this->user_model->update_std_profle($email, $name,$address,$city,$country,$zip,$phone);

			// updating student name in session variable
			// because student name is diplayed in view via this session variable
			$this->session->set_userdata('student_name', $name);

			$this->session->set_flashdata('error', 'Profile Updated Successfuly');
			$this->session->set_flashdata('class', 'alert alert-success mt-3');
			redirect(base_url('user/profile'),'refresh');

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
	//  chatting user
	public function fetch_user(){
		$users=$this->user_model->get_students();
		$output = '
		<hr>
<table class="table table-bordered table-striped">
<h3 class="">Online Users</h3>
 <tr>
  <th><span class="dot"></span></th>
  <th>Username</th>
  <th>Action</th>
 </tr>
';

foreach($users as $row)
{
 $status = '';
 $current_timestamp = strtotime(date("Y-m-d h:i:s") . '- 10 second');
 $current_timestamp = date('Y-m-d h:i:s', $current_timestamp);
 $user_last_activity = $this->user_model->fetch_user_last_activity($row->id);
 $userTime=1;

 foreach($user_last_activity as $r)
 {
 $userTime=   $r->last_activity;
 }
 if($userTime > $current_timestamp)
 {
  $output .= '
 <tr>

  <td><span class="dot"></span></td>
  <td>'.$row->email.'</td>

  <td><button type="button" class="btn btn-info btn-xs start_chat" data-touserid="'.$row->id.'" data-tousername="'.$row->email.'">Start Chat</button></td>
 </tr>

 ';
}
}

$output .= '</table>';

echo $output;
	}

public function insert_chat(){
 $result=$this->user_model->minsert_chat();
}

public function fetch_user_chat_history(){
	echo  $this->user_model->mfetch_user_chat_history($this->input->post('to'),$this->input->post('from'));
}

public function clear_chat(){
	  $effected_rows=$this->user_model->mclear_chat();
	 if($effected_rows==0) {	     	//  means when no record is deleted ten update status
	 	$result1=$this->user_model->mclear_chat1();
	 	}else{
	 		$elsess="else";// awehe
	 	}
}
public function del_msg(){
	 $effected_rows=$this->user_model->mdel_msg();
	if($effected_rows==0) {	     	//  means when no record is deleted ten update status
	 	$result1=$this->user_model->mdel_msg1();
	 	}else{
	 		$elsess="else";// awehe
	 	}
}

	
}

?>