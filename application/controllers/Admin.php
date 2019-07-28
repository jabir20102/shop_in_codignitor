<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller{

	public function __construct(){
		parent::__construct();
	}

	// LOADS ADMIN LOGIN PAGE
	public function index(){

		if($this->session->userdata('admin_login')){
			// if admin is already logged in redirect it to the dashboard
			redirect(base_url('admin/dashboard'),'refresh');
		}
		// if admin is not loagged in load the admin view
		$data['page_title'] = 'Admin Login';
		$this->load->view('backend/login', $data, FALSE);

	}

	// AUTHENTICATE THE ADMIN CREDENCIALS
	public function validate_login(){

		$email = $this->input->post('email');
		$pass = $this->input->post('pass');

		$result = $this->user_model->get_admin($email);

		if($result){
			if($result->password == $pass){
				// if password is matched then setting the session data for admin
				$this->session->set_userdata('admin_id', $result->id);
				$this->session->set_userdata('admin_name', $result->name);
				$this->session->set_userdata('admin_email', $result->email);
				$this->session->set_userdata('admin_login', true);

				redirect(base_url('admin/dashboard'), 'refresh');
			}
			else{
				// if password is not matched
				$this->session->set_flashdata('error', 'Invalid Email or Password');
				$this->session->set_flashdata('class', 'alert alert-danger mt-3');
				redirect(base_url('admin'),'refresh');
			}
		}
		else{
			// if we get 0 result from data base that means email is not registed
			$this->session->set_flashdata('error', 'Email does not exist');
			$this->session->set_flashdata('class', 'alert alert-danger mt-3');
			redirect(base_url('admin'),'refresh');
		}

	}

	// SHOWS THE ADMIN DASHBOARD
	public function dashboard(){

		if($this->session->userdata('admin_login')){
			// if admin is logged in loading the dash view
			$data['page_title'] = 'Admin Dashboard';
			$data['page_name'] = 'dashboard';
			$data['active'] = 'dashboard';

			$this->load->view('backend/index', $data, FALSE);
		}
		else{
			redirect(base_url('admin'),'refresh');
		}
	}
	//  add new album
	// SHOWS THE ADMIN DASHBOARD
	public function addAlbum(){

		if($this->session->userdata('admin_login')){
			// if admin is logged in loading the dash view
			$data['page_title'] = 'Admin Dashboard';
			$data['page_name'] = 'addAlbum';
			$data['active'] = 'addAlbum';

			$this->load->view('backend/index', $data, FALSE);
		}
		else{
			redirect(base_url('admin'),'refresh');
		}
	}

	/*	
	*	Loads the Main category page.
	*	Loads the Add Category or Edit Category Page based on action parameter
	*/
	public function categories($action = ""){

		if($this->session->userdata('admin_login')){
			//  if admn is logged in
			if($action == "add-category"){
				// loads view for adding new category
				$data['page_title'] = 'Add New Category';
				$data['page_name'] = 'add_Category';
				$data['active'] = 'categories';

				$this->load->view('backend/index', $data, FALSE);
			}
			elseif($action == "edit-category"){
				// loads view for editing selected category
				$data['page_title'] = 'Edit Category';
				$data['page_name'] = 'edit_category';
				$data['active'] = 'categories';

				$this->load->view('backend/index', $data, FALSE);
			}
			elseif($action == ""){
				// if no action is selected then load up the categories view
				$data['page_title'] = 'Categories';
				$data['page_name'] = 'categories';
				$data['active'] = 'categories';

				$this->load->view('backend/index', $data, FALSE);
			}
			else{
				// if something elese passed to the parameter other than the selected actions
				redirect(base_url('admin/categories'),'refresh');
			}
		}
		else{
			// if admin is not logged in
			redirect(base_url('admin'),'refresh');
		}
	}

	/*
	* 	This method add, update or delete the main category depending
	*	on the action parametor
	*
	*/
	public function change_category($action = ''){

		if($this->session->userdata('admin_login')){
			// if admin is logged in
			if($action == "add"){
				// for adding new category into database
				$cat_name = $this->input->post('cat-name');
				$result = $this->crud_model->add_category($cat_name);
				$error = $this->db->error();

				if($result){
					// if category successfuly added into data base
					$this->session->set_flashdata('error', 'New Category Added');
					$this->session->set_flashdata('class', 'alert alert-success mt-3');
					redirect(base_url('admin/categories/add-category'),'refresh');
				}
				else{
					// if category cannot be added into data base
					$this->session->set_flashdata('error', $error['message']);
					$this->session->set_flashdata('class', 'alert alert-danger mt-3');
					redirect(base_url('admin/categories/add-category'),'refresh');
				}
			}
			elseif($action == "update"){
				// for updating the existing category
				$cat_name = $this->input->post('cat-name');
				$cat_id = $this->input->post('cat-id');
				$result = $this->crud_model->update_category($cat_name, $cat_id);
				$error = $this->db->error();

				if($result){
					// if category name successfully updated
					$this->session->set_flashdata('cat-id', $cat_id);
					$this->session->set_flashdata('error', 'Category Updated');
					$this->session->set_flashdata('class', 'alert alert-success mt-3');
					redirect(base_url('admin/categories/edit-category'),'refresh');
				}
				else{
					// if cannot update the category name
					$this->session->set_flashdata('error', $error['message']);
					$this->session->set_flashdata('class', 'alert alert-danger mt-3');
					redirect(base_url('admin/categories/edit-category'),'refresh');
				}
			}
			elseif($action == "delete"){
				// for deleting the selected category
				$cat_id = $this->input->post('cat-id');
				$result = $this->crud_model->delete_category($cat_id);
				$error = $this->db->error();

				if($result){
					// if category suuccesfyly deleted
					$this->session->set_flashdata('error', 'Category Deleted');
					$this->session->set_flashdata('class', 'alert alert-success mt-3');
					redirect(base_url('admin/categories'),'refresh');
				}
				else{
					// if cannot delete the selected category
					$this->session->set_flashdata('error', $error['message']);
					$this->session->set_flashdata('class', 'alert alert-danger mt-3');
					redirect(base_url('admin/categories'),'refresh');
				}
			}
			else{
				// if slected action is other than defined actions
				redirect(base_url('admin/categories'),'refresh');
			}
		}
		else{
			// if admin is not logged in
			redirect(base_url('admin'),'refresh');
		}
	}

	/*	
	*	Loads the Sub category page.
	*	Loads the Add sub Category or Edit sub Category Page based on action parameter
	*/
	public function sub_categories($action = ""){

		if($this->session->userdata('admin_login')){
			// if andmin is logged in
			if($action == "add-sub-category"){
				// loads view for adding new sub category
				$data['page_title'] = 'Add Sub Category';
				$data['page_name'] = 'add_sub_cat';
				$data['active'] = 'categories';

				$this->load->view('backend/index', $data, FALSE);
			}
			elseif($action == "edit-sub-category"){
				// loads view for edditing selected sub category
				$data['page_title'] = 'Edit Sub Category';
				$data['page_name'] = 'edit_sub_cat';
				$data['active'] = 'categories';

				$this->load->view('backend/index', $data, FALSE);
			}
			elseif($action == ""){
				// if no action is selected then load up the sub categories view
				$data['page_title'] = 'Sub Categories';
				$data['page_name'] = 'sub_category';
				$data['active'] = 'categories';
				$this->load->view('backend/index', $data, FALSE);
			}
			else{
				// if something elese passed to the parameter other than the selected actions
				redirect(base_url('admin/sub-categories'),'refresh');
			}
		}
		else{
			// if admin is not logged in
			redirect(base_url('admin'),'refresh');
		}
	}

	/*
	* 	This method add, update or delete the main category depending
	*	on the action parametor
	*
	*/
	public function change_sub_cat($action = ''){

		if($this->session->userdata('admin_login')){
			// if admin is logged in
			if($action == "add"){
				// for adding new sub category into database
				$cat_name = $this->input->post('sub-cat-name');
				$parant_cat_id = $this->input->post('select-category');
				$result = $this->crud_model->add_sub_cat($cat_name, $parant_cat_id);
				$error = $this->db->error();

				if($result){
					// if successful added new sub category into database
					$this->session->set_flashdata('error', 'Sub Category Added');
					$this->session->set_flashdata('class', 'alert alert-success mt-3');
					redirect(base_url('admin/sub-categories/add-sub-category'),'refresh');
				}
				else{
					// if cannot add new category into database
					$this->session->set_flashdata('error', $error['message']);
					$this->session->set_flashdata('class', 'alert alert-danger mt-3');
					redirect(base_url('admin/sub-categories/add-sub-category'),'refresh');
				}
			}
			elseif($action == "update"){
				// for updating the existing sub category name
				$sub_cat_name = $this->input->post('sub-cat-name');
				$parent_cat_id = $this->input->post('select-category');
				$sub_cat_id = $this->input->post('sub-cat-id');

				$result = $this->crud_model->update_sub_cat($sub_cat_name, $sub_cat_id, $parent_cat_id);
				$error = $this->db->error();

				if($result){
					// if sub category name successfully updated
					$this->session->set_flashdata('sub-cat-id', $sub_cat_id);
					$this->session->set_flashdata('error', 'Sub Category Updated');
					$this->session->set_flashdata('class', 'alert alert-success mt-3');
					redirect(base_url('admin/sub-categories/edit-sub-category'),'refresh');
				}
				else{
					// if cannot update the sub category name
					$this->session->set_flashdata('error', $error['message']);
					$this->session->set_flashdata('class', 'alert alert-danger mt-3');
					redirect(base_url('admin/sub-categories/edit-sub-category'),'refresh');
				}
			}
			elseif($action == "delete"){
				// for deleting the selected sub category
				$sub_cat_id = $this->input->post('sub-cat-id');
				$result = $this->crud_model->delete_sub_cat($sub_cat_id);
				$error = $this->db->error();

				if($result){
				// if sub category successfyly deleted
					$this->session->set_flashdata('sub-cat-id', $sub_cat_id);
					$this->session->set_flashdata('error', 'Sub Category Deleted');
					$this->session->set_flashdata('class', 'alert alert-success mt-3');
					redirect(base_url('admin/sub-categories'),'refresh');
				}
				else{
				// if cannot delete the selected sub category
					$this->session->set_flashdata('error', $error['message']);
					$this->session->set_flashdata('class', 'alert alert-danger mt-3');
					redirect(base_url('admin/sub-categories'),'refresh');
				}
			}
			else{
				// if slected action is other than defined actions
				redirect(base_url('admin/sub-categories'),'refresh');
			}
		}
		else{
			// if admin is not logged in
			redirect(base_url('admin'),'refresh');
		}
	}

	public function students($action = ''){

		if($this->session->userdata('admin_login')){
			// if admion is logged in
			if($action == "delete"){
				// for deleting the selected student
				$stdnt_id = $this->input->post('student-id');
				$result = $this->user_model->delete_student($stdnt_id);
				$error = $this->db->error();

				if($result){
					// if student is successfuly deleted
					$this->session->set_flashdata('error', 'Student Deleted');
					$this->session->set_flashdata('class', 'alert alert-success mt-3');
					redirect(base_url('admin/students'),'refresh');
				}
				else{
					// if cannot delete the student
					$this->session->set_flashdata('error', $error['message']);
					$this->session->set_flashdata('class', 'alert alert-danger mt-3');
					redirect(base_url('admin/students'),'refresh');
				}
			}
			else{
				// if delete action is not selected then loads the students view show the registered students
				$data['page_title'] = 'Students';
				$data['page_name'] = 'students';
				$data['active'] = 'students';
				$this->load->view('backend/index', $data, FALSE);
			}
			
		}
		else{
			// if admin is not logged in
			redirect(base_url('admin'),'refresh');
		}

	}

	
	public function all_tutorials($action = ''){

		if($this->session->userdata('admin_login')){
			// if admin is logged in loads up the all tutorial view

			if($action == ''){
				$data['page_title'] = 'All Tutorials';
				$data['page_name'] = 'all_tutorials';
				$data['active'] = 'all-tutorials';
				$this->load->view('backend/index', $data, FALSE);
			}
			elseif($action == 'delete'){
				$tutorial_id = $this->input->post('tut-id');

				if(!isset($tutorial_id)){
					// if link is directly accessed
					$this->session->set_flashdata('error', 'Select a Tutorial to delete');
					$this->session->set_flashdata('class', 'alert alert-info mt-3');
					redirect(base_url('admin/all-tutorials'),'refresh');
				}

				$result = $this->crud_model->delete_product($tutorial_id);

				if($result){
					// if tutorial is successfuly deleted
					$this->session->set_flashdata('error', 'Tutorial Deleted');
					$this->session->set_flashdata('class', 'alert alert-success');
					redirect(base_url('admin/all-tutorials'),'refresh');
				}
				else{
					// if cannot delete the tutorial
					$error = $this->db->error();
					$this->session->set_flashdata('error', $error['message']);
					$this->session->set_flashdata('class', 'alert alert-dange');
					redirect(base_url('admin/all-tutorials'),'refresh');
				}
			}
			elseif($action == 'photos'){
				$prod_id = $this->input->get('product-id');

				if(!isset($prod_id)){
					// if link is directly accessed
					$this->session->set_flashdata('error', 'Select a tutorial for photos');
					$this->session->set_flashdata('class', 'alert alert-info mt-3');
					redirect(base_url('admin/all-tutorials'),'refresh');
				}
				$images=$this->crud_model->get_images($prod_id);


				$data['images'] = $images;
				$data['product_id']=$prod_id;
				$data['page_title'] = 'Photos';
				$data['page_name'] = 'photos';
				$data['active'] = 'all-tutorials';


				$this->load->view('backend/index', $data, FALSE);
				
			}
			else{
				// if action is not empty and other than delete
				redirect(base_url('admin/all-tutorials'),'refresh');
			}
			
		}
		else{
			// uf admin is not logged in
			redirect(base_url('admin'),'refresh');
		}
	}
//  all comments
	public function all_comments($action = ''){

		if($this->session->userdata('admin_login')){
			// if admin is logged in loads up the all tutorial view

			if($action == ''){

				$data['page_title'] = 'All Comments';
				$data['page_name'] = 'all_comments';
				$data['active'] = 'all-comments';

				$this->load->view('backend/index', $data, FALSE);
			}
			elseif($action == 'delete'){
				$tutorial_id = $this->input->post('comment-id');

				if(!isset($tutorial_id)){
					// if link is directly accessed
					$this->session->set_flashdata('error', 'Select a comment to delete');
					$this->session->set_flashdata('class', 'alert alert-info mt-3');
					redirect(base_url('admin/all-comments'),'refresh');
				}

				$result = $this->crud_model->delete_comment($tutorial_id);

				if($result){
					// if tutorial is successfuly deleted
					$this->session->set_flashdata('error', 'Comment Deleted');
					$this->session->set_flashdata('class', 'alert alert-success mt-3');
					redirect(base_url('admin/all-comments'),'refresh');
				}
				else{
					// if cannot delete the tutorial
					$error = $this->db->error();
					$this->session->set_flashdata('error', $error['message']);
					$this->session->set_flashdata('class', 'alert alert-danger mt-3');
					redirect(base_url('admin/all-comments'),'refresh');
				}
			}
			elseif($action == 'edit'){
				 $comment_id = $this->input->post('comment-id');

				if(!isset($comment_id)){
					// if link is directly accessed
					$this->session->set_flashdata('error', 'Select a comment to approve');
					$this->session->set_flashdata('class', 'alert alert-info mt-3');
					redirect(base_url('admin/all-comments'),'refresh');
				}

				$result = $this->crud_model->edit_comment($comment_id);

				if($result){
					// if tutorial is successfuly deleted
					$this->session->set_flashdata('error', 'Comment Approved');
					$this->session->set_flashdata('class', 'alert alert-success mt-3');
					redirect(base_url('admin/all-comments'),'refresh');
				}
				else{
					// if cannot delete the tutorial
					$error = $this->db->error();
					$this->session->set_flashdata('error', $error['message']);
					$this->session->set_flashdata('class', 'alert alert-danger mt-3');
					redirect(base_url('admin/all-comments'),'refresh');
				}
			}
			else{
				// if action is not empty and other than delete
				redirect(base_url('admin/all-comments'),'refresh');
			}
			
		}
		else{
			// uf admin is not logged in
			redirect(base_url('admin'),'refresh');
		}
	}
	

	public function profile(){

		if($this->session->userdata('admin_login')){
			// if admin is logged in loads up the admin profile page
			$data['page_title'] = 'Profile';
			$data['page_name'] = 'profile';
			$data['active'] = 'profile';
			$this->load->view('backend/index', $data, FALSE);
		}
		else{
			// if admin is not loggedin
			redirect(base_url('admin'),'refresh');
		}

	}

	// TO CHANGE THE ADMIN IMAGE
	public function change_img(){

		if($this->session->userdata('admin_login')){
			// if admin is logged in 

			// setting the image upload path and tupe setting
            $config['upload_path'] = './uploads/backend/user_image/';
            $config['allowed_types'] = 'jpeg|jpg|png';

            $this->load->library('upload', $config);
            
            if (!$this->upload->do_upload('admin_image')){
            	// if cannot upload the image due to any reason
            	$error = array('error' => $this->upload->display_errors());
            	$this->session->set_flashdata('error', $error['error']);
				$this->session->set_flashdata('class', 'alert alert-danger mt-3');
				redirect(base_url('admin/profile'),'refresh');
            }
            else{
            	// if image is uploaded to server successfuly
            	$data = array('upload_data' => $this->upload->data());

            	$email = $this->session->userdata('admin_email');

            	// creating the exact path to the uploaded imaged to store in database
            	$image_url = 'uploads/backend/user_image/'.$data['upload_data']['file_name'];
            	$result = $this->user_model->change_admin_img($email, $image_url);

            	if($result){
            		// if uploaded image path is stored in database successfuly
            		redirect(base_url('admin/profile'),'refresh');
            	}
            	else{
            		// if cannot store the path in the database
            		$error = $this->db->error();
            		$this->session->set_flashdata('error', $error['message']);
					$this->session->set_flashdata('class', 'alert alert-danger mt-3');
					redirect(base_url('admin/profile'),'refresh');
            	}
            }
		}
		else{
			// if admin is not logged in
			redirect(base_url('admin'),'refresh');
		}

	}

// TO CHANGE THE ADMIN PASSWORD
	public function change_pass(){
		$email = $this->session->userdata('admin_email');
		$oldPass = $this->input->post('old-pass');
		$newPass = $this->input->post('new-pass');
		$confirmPass = $this->input->post('confirm-pass');

		$result = $this->user_model->get_admin($email);

		// CHEK IF NEW ENTERED PASS MATCHED
		if($newPass !== $confirmPass){
	        $this->session->set_flashdata('pass-error', 'New Password did not match');
			$this->session->set_flashdata('pass-class', 'alert alert-danger mb-3 w-50');
			redirect(base_url('admin/profile'),'refresh');
		} 
		// CHECK IF OLD PASS MATCHED
		elseif($result->password !== $oldPass){
			$this->session->set_flashdata('pass-error', 'Old Password is wrong');
			$this->session->set_flashdata('pass-class', 'alert alert-danger mb-3 w-50');
			redirect(base_url('admin/profile'),'refresh');
		}
		else{
			$this->user_model->change_admin_pass($email, $newPass);
			$this->session->set_flashdata('pass-error', 'Password Changed Successfuly');
			$this->session->set_flashdata('pass-class', 'alert alert-success mb-3 w-50');
			redirect(base_url('admin/profile'),'refresh');
		}
	}
	// TO upload THE product IMAGE
	public function upload_img(){

		if($this->session->userdata('admin_login')){
			$prod_id = $this->input->post('prod_id');
			// if admin is logged in 

			// setting the image upload path and tupe setting
            $config['upload_path'] = './uploads/products/images/';
            $config['allowed_types'] = 'jpeg|jpg|png';

            $this->load->library('upload', $config);
            
            if (!$this->upload->do_upload('image')){
            	// if cannot upload the image due to any reason
            	$error = array('error' => $this->upload->display_errors());
            	$this->session->set_flashdata('error', $error['error']);
				$this->session->set_flashdata('class', 'alert alert-danger mt-3');
				redirect(base_url('admin/all-tutorials/photos/?product-id='.$prod_id),'refresh');
            }
            else{
            	// if image is uploaded to server successfuly
            	$data = array('upload_data' => $this->upload->data());

            	$data = $this->upload->data();  
                     $config['image_library'] = 'gd2';  
                     $config['source_image'] = './uploads/products/images//'.$data["file_name"];  
                     $config['create_thumb'] = FALSE;  
                     $config['maintain_ratio'] = true;  
                     $config['quality'] = '100%';  
                     $config['width'] = 200;  
                     $config['height'] = 200;  
                     $config['new_image'] = './uploads/products/images/'.$data["file_name"];  
                     $this->load->library('image_lib', $config);  
                     $this->image_lib->resize();  


            	
            	
            	// creating the exact path to the uploaded imaged to store in database
            	// $image_url = 'uploads/products/images/'.$data['upload_data']['file_name'];
            	$image_url = 'uploads/products/images/'.$data["file_name"] ;
            	$result = $this->crud_model->add_image($prod_id, $image_url);

            	$images=$this->crud_model->get_images($prod_id);


				$data['images'] = $images;
				$data['product_id']=$prod_id;
				$data['page_title'] = 'Photos';
				$data['page_name'] = 'photos';
				$data['active'] = 'all-tutorials';


            	if($result){
            		// if uploaded image path is stored in database successfuly
				$this->load->view('backend/index', $data, FALSE);
            	}
            	else{
            		// if cannot store the path in the database
            		$error = $this->db->error();
            		$this->session->set_flashdata('error', $error['message']);
					$this->session->set_flashdata('class', 'alert-danger alert mt-3');
					$this->load->view('backend/index', $data, FALSE);
            	}
            }
		}
		else{
			// if admin is not logged in
			redirect(base_url('admin'),'refresh');
		}

	}
	// TO upload THE product IMAGE
	public function delete_img(){

		if($this->session->userdata('admin_login')){
			$image_url = $this->input->post('url');
			$prod_id = $this->input->post('prod_id');
			// if admin is logged in 
			
			
            	$result = $this->crud_model->delete_image($image_url);

            	$images=$this->crud_model->get_images($prod_id);


				$data['images'] = $images;
				$data['product_id']=$prod_id;
				$data['page_title'] = 'Photos';
				$data['page_name'] = 'photos';
				$data['active'] = 'all-tutorials';


            	if($result){
            		// if uploaded image path is deleted in database successfuly
            		if(unlink($image_url)){
            			$this->load->view('backend/index', $data, FALSE);
            		}				
            	}
            	else{
            		// if cannot store the path in the database
            		$error = $this->db->error();
            		$this->session->set_flashdata('error', $error['message']);
					$this->session->set_flashdata('class', 'alert alert-danger mt-3');
					$this->load->view('backend/index', $data, FALSE);
            	}
            
		}
		else{
			// if admin is not logged in
			redirect(base_url('admin'),'refresh');
		}

	}

	// THIS WILL ONLY LOGOUT THE ADMIN
	public function logout(){
		if($this->session->userdata('admin_login')){
			$this->sess_destroy();
			redirect(base_url('admin'),'refresh');
		}
		else{
			redirect(base_url('admin'),'refresh');
		}
	}

	// TO DESTROY ONLY THE ADMIN'S SESSION
	public function sess_destroy(){
		$this->session->unset_userdata('admin_id');
		$this->session->unset_userdata('admin_name');
		$this->session->unset_userdata('admin_email');
		$this->session->unset_userdata('admin_login');
	}
}

?>