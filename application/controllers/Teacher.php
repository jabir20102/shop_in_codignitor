<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teacher extends CI_Controller{

	public function __construct(){
		parent::__construct();
	}

	// LOADS UP THE EDIT PROFILE PAGE FOR TEACHER
	public function edit_profile(){

		if($this->session->userdata('teacher_login')){
			// if teacher is logged in
			$data['page_title'] = 'Edit Teacher Profile';
			$data['page_name'] = 'edit_teacher_profile';
			$data['active'] = 'profile';
			$this->load->view('frontend/index', $data, FALSE);
		}
		else{
			// if teacher is not logged in
			redirect(base_url('login'),'refresh');
		}
		
	}

	// TO CHANGE THE TEACHER NAME
	public function change_name(){
		if($this->session->userdata('teacher_login')){
			// if teacher is logged in

			$email = $this->session->userdata('teacher_email');
			$new_name = $this->input->post('new-name');
			$bio = $this->input->post('bio');

			// updating the new teacher name in teacher table
			$this->user_model->update_tchr_profle($email, $new_name, $bio);

			// updating teacher name in session variable
			// because teacher name is diplayed in view via this session variable
			$this->session->set_userdata('teacher_name', $new_name);

			$this->session->set_flashdata('profile-error', 'Profile Updated Successfuly');
			$this->session->set_flashdata('profile-class', 'alert alert-success mt-3');
			redirect(base_url('teacher/edit-profile'),'refresh');
		}
		else{
			// if teacher is not logged in
			redirect(base_url('login'),'refresh');
		}
	}

	// TO CHANGE THE teacher IMAGE
	public function change_img(){

		if($this->session->userdata('teacher_login')){
			// if teacher is logged in
            $config['upload_path'] = './uploads/frontend/user_images/teachers/';
            $config['allowed_types'] = 'jpeg|jpg|png';
            // print_r($config);
            // exit();
            $this->load->library('upload', $config);
            
            if (!$this->upload->do_upload('teacher_image')){
            	// if cannot upload the image the showing error
            	$error = array('error' => $this->upload->display_errors());
            	$this->session->set_flashdata('img-error', $error['error']);
				$this->session->set_flashdata('img-class', 'alert alert-danger mt-3');
				redirect(base_url('teacher/edit-profile'),'refresh');
            }
            else{
            	// if image is uploaded succesfuly
            	$data = array('upload_data' => $this->upload->data());
            	// print_r($data['upload_data']);
            	// exit();
            	$email = $this->session->userdata('teacher_email');
            	// getting the path of uploaded file in a variable
            	$image_url = 'uploads/frontend/user_images/teachers/'.$data['upload_data']['file_name'];
            	// saving the uploaded image path in the database
            	$result = $this->user_model->change_teacher_img($email, $image_url);

            	if($result){
            		// if image path is stored in the database
            		$this->session->set_flashdata('img-error', 'Image Uploaded Successfuly');
					$this->session->set_flashdata('img-class', 'alert alert-success mt-3');
            		redirect(base_url('teacher/edit-profile'),'refresh');
            	}
            	else{
            		// cannot store the image path in database for some reason
            		$error = $this->db->error();
            		$this->session->set_flashdata('error', $error['message']);
					$this->session->set_flashdata('class', 'alert alert-danger mt-3');
					redirect(base_url('teacher/edit-profile'),'refresh');
            	}
            }
		}
		else{
			// if teacher is not logged in then redirect it to login page
			redirect(base_url('login'),'refresh');
		}

	}

// TO CHANGE THE TEACHER PASSWORD
	public function change_pass(){
		if($this->session->userdata('teacher_login')){
			// if teachet is logged in

			$email = $this->session->userdata('teacher_email');
			$oldPass = $this->input->post('old-pass');
			$newPass = $this->input->post('new-pass');
			$confirmPass = $this->input->post('confirm-pass');

			$result = $this->user_model->get_teachers($email);

			if($newPass !== $confirmPass){
				// if new pass and confirm pass do not match
		        $this->session->set_flashdata('pass-error', 'New Password did not match');
				$this->session->set_flashdata('pass-class', 'alert alert-danger mb-3 w-50');
				redirect(base_url('teacher/edit-profile'),'refresh');
			} 
			elseif($result->password !== $oldPass){
				// if new pass and old pass do not match
				$this->session->set_flashdata('pass-error', 'Old Password is wrong');
				$this->session->set_flashdata('pass-class', 'alert alert-danger mb-3 w-50');
				redirect(base_url('teacher/edit-profile'),'refresh');
			}
			else{
				// if every thing is right update teacher password
				$this->user_model->change_teacher_pass($email, $newPass);
				$this->session->set_flashdata('pass-error', 'Password Changed Successfuly');
				$this->session->set_flashdata('pass-class', 'alert alert-success mb-3 w-50');
				redirect(base_url('teacher/edit-profile'),'refresh');
			}
		}
		else{
			// if teacher is not logged in then redirect it to login page
			redirect(base_url('login'),'refresh');
		}
		
	}

	// LOADS UP THE TEACHER DASHBOARD
	public function dashboard(){
		if($this->session->userdata('teacher_login')){
			// if teacher is logged in
			$data['page_title'] = "Teacher's Dashboard";
			$data['page_name'] = 'teacher_dash';
			$data['active'] = 'teacher';
			$this->load->view('frontend/index', $data, FALSE);
		}
		else{
			// if teacher is not logged in
			redirect(base_url('login'),'refresh');
		}

	}

	// to upload the thubnail of the new tutorial
	function upload_thumbnail(){
		$config = array();
		$config['upload_path'] = './uploads/tutorials/thumbnails/';
        $config['allowed_types'] = 'jpeg|jpg|png';

        $this->load->library('upload', $config, 'upload_thumbnail');
        
        if (!$this->upload_thumbnail->do_upload('tutorial-thumb')){
        	// if cannot upload the image the showing error
        	$error = array('error' => $this->upload->display_errors());
        	$this->session->set_flashdata('thumb-error', $error['error']);
			$this->session->set_flashdata('thumb-class', 'alert alert-danger mt-3');
			redirect(base_url('teacher/create-tutorial'),'refresh');
        }
        else{
        	// if image is uploaded succesfuly
        	$data = array('upload_data' => $this->upload_thumbnail->data());
        	// print_r($data['upload_data']);
        	// exit();

        	// getting the path of uploaded file in a variable
        	$image_url = 'uploads/tutorials/thumbnails/'.$data['upload_data']['file_name'];
        	return $image_url;
		}
	}

	// to upload the preview video of the new tutorial
	function upload_preview(){
		$config = array();
		$config['upload_path'] = './uploads/tutorials/preview/';
        $config['allowed_types'] = 'mp4';

        $this->load->library('upload', $config, 'upload_preview');
        
        if (!$this->upload_preview->do_upload('preview-video')){
        	// if cannot upload the video then showing error
        	$error = array('error' => $this->upload_preview->display_errors());
        	$this->session->set_flashdata('preview-error', $error['error']);
			$this->session->set_flashdata('preview-class', 'alert alert-danger mt-3');
			redirect(base_url('teacher/create-tutorial'),'refresh');
        }
        else{
        	// if video is uploaded succesfuly
        	$data = array('upload_data' => $this->upload_preview->data());

        	// getting the path of uploaded file in a variable
        	$image_url = 'uploads/tutorials/preview/'.$data['upload_data']['file_name'];
        	return $image_url;
		}
	}

	// TO CREATE A NEW TUTORIAL
	public function create_tutorial($action = ''){
			if($action == 'new'){
			// if create tutorial form is submitted

				
				$prod_id = $this->crud_model->add_product();
					$this->session->set_flashdata('error', 'Product uploaded Successfuly');
					$this->session->set_flashdata('class', 'alert alert-success mt-3');
            		redirect(base_url('admin/all-tutorials/photos/?product-id='.$prod_id),'refresh');
				// if($result){
				// 	// 'admin/all-tutorials/photos/?product-id='.$product->id).'
				// 	// if new tutorial is created
    //         		$this->session->set_flashdata('error', 'Product uploaded Successfuly');
				// 	$this->session->set_flashdata('class', 'alert alert-success mt-3');
    //         		redirect(base_url('admin/all_tutorials'),'refresh');
				// }
				// else{
				// 	// cannot add the tutorial to database
    //         		$error = $this->db->error();
    //         		$this->session->set_flashdata('error', $error['message']);
				// 	$this->session->set_flashdata('class', 'alert alert-danger mt-3');
				// 	redirect(base_url('admin/addAlbum'),'refresh');
				// }
			}
			else{
				// if new action is not selected then loads the create tutorial page
				$data['page_title'] = 'Create Tutorial';
				$data['page_name'] = 'create_tutorial';
				$data['active'] = 'teacher';
				$this->load->view('frontend/index', $data, FALSE);
			}
		
	}

	// TO EDIT A CREATED TUTORIAL
	public function edit_tutorial($id = -1, $action = '', $action2 = ''){
		if($this->session->userdata('teacher_login')){
			// if teacher is logged in

			if($id === -1 OR !is_numeric($id)){
				// if id parametor is not passed or string is passed in id parameter
				show_404();
			}

			$tutorial = $this->crud_model->get_tutorials($id);

			if($tutorial->teacher_id !== $this->session->userdata('teacher_id')){
				// if tutorial teacher id and logged in teacher id is not matched then redirect
				// this prevents one teacher from editing and accessing other teachers tutorials
				// via url.

				redirect(base_url('teacher/dashboard'),'refresh');
			}

			if($action == 'manage-sections'){
				$data['page_title'] = 'Manage Sections';
				$data['page_name'] = 'manage_sections';
				$data['tutorial'] = $tutorial;
				$data['action2'] = $action2;
				$data['active'] = 'teacher';
				$data['active_sub'] = 'manage-sections';
				$this->load->view('frontend/index', $data, FALSE);
			}
			elseif($action == 'manage-lessons'){
				$data['page_title'] = 'Manage Lessons';
				$data['page_name'] = 'manage_lessons';
				$data['tutorial'] = $tutorial;
				$data['action2'] = $action2;
				$data['active'] = 'teacher';
				$data['active_sub'] = 'manage-lessons';
				$this->load->view('frontend/index', $data, FALSE);
			}
			elseif($action == ''){
				$data['page_title'] = 'Edit Tutorial';
				$data['page_name'] = 'edit_tutorial';
				$data['tutorial'] = $tutorial;
				$data['active'] = 'teacher';
				$data['active_sub'] = 'basic-information';
				$this->load->view('frontend/index', $data, FALSE);
			}
			else{
				redirect(base_url('teacher/dashboard'),'refresh');
			}
		}
		else{
			// if teacher is not logged in
			redirect(base_url('login'),'refresh');
		}
	}


	// TO UPDATE AND DELETE THE TUTORIAL
	public function tutorial_action($id = -1, $action = ''){

		if($this->session->userdata('teacher_login')){
			// if teacher is logged in

			if($id === -1 OR !is_numeric($id)){
				show_404();
			}

			if($action == 'update-basic-info'){
				// if basic info updated button is submitted
				$cat_id = $this->input->post('cat_id');
				$sub_cat = $this->crud_model->get_sub_cat($this->input->post('sub_cat_id'));
				
				// macthing if sub category belongs to the valid parent category
				if($sub_cat->parent_cat_id !== $cat_id){
					// if sub category do not belong to the valid parent category
					$this->session->set_flashdata('error', 'Please Select Sub Category According to Parent Category');
					$this->session->set_flashdata('class', 'alert alert-danger mt-3');
					redirect(base_url('teacher/edit-tutorial/'.$id),'refresh');
				}

				// getting the uploaded thumbnail path in this variuable
				$thumbnail = $this->upload_thumbnail();

				// getting the uploaded thumbnail path in this variuable
				$preview = $this->upload_preview();

				// calling model to update selected tutorial information in database
				$result = $this->crud_model->update_tutorial($id, $thumbnail, $preview);

				if($result){
					// if tutorial is updated
            		$this->session->set_flashdata('error', 'Tutorial Updated Successfuly');
					$this->session->set_flashdata('class', 'alert alert-success mt-3');
            		redirect(base_url('teacher/edit-tutorial/'.$id),'refresh');
				}
				else{
					// cannot update the tutorial to database
            		$error = $this->db->error();
            		$this->session->set_flashdata('error', $error['message']);
					$this->session->set_flashdata('class', 'alert alert-danger mt-3');
					redirect(base_url('teacher/edit-tutorial/'.$id),'refresh');
				}
			}
			elseif($action == 'delete'){
				// calling model to update selected tutorial information in database
				$result = $this->crud_model->delete_tutorial($id);

				if($result){
					// if tutorial is deleted
            		$this->session->set_flashdata('error', 'Tutorial Deleted Successfuly');
					$this->session->set_flashdata('class', 'alert alert-success mt-3');
            		redirect(base_url('teacher/dashboard'),'refresh');
				}
				else{
					// cannot update the tutorial to database
            		$error = $this->db->error();
            		$this->session->set_flashdata('error', $error['message']);
					$this->session->set_flashdata('class', 'alert alert-danger mt-3');
					redirect(base_url('teacher/dashboard'),'refresh');
				}
			}
			else{
				// if action is other than update basic info or delete
				redirect(base_url('teacher/dashboard'),'refresh');
			}
		}
		else{
			// if teacher is not logged in
			redirect(base_url('login'),'refresh');
		}

	}

	// to add, update or delete sections from database 
	public function sections($action = ''){

		if($this->session->userdata('teacher_login')){
			// if teacher is logged in

			if($action == 'add'){
				// if add section button is clicked
				$tutorial_id = $this->input->post('tutorial-id');
				$title = $this->input->post('section-title');
				
				$result = $this->crud_model->add_section($tutorial_id, $title);

				if($result){
					// if new section is added
            		$this->session->set_flashdata('error', 'Section Added Successfuly');
					$this->session->set_flashdata('class', 'alert alert-success mt-3');
            		redirect(base_url('teacher/edit-tutorial/'.$tutorial_id.'/manage-sections'),'refresh');
				}
				else{
					// cannot add the section to database
            		$error = $this->db->error();
            		$this->session->set_flashdata('error', $error['message']);
					$this->session->set_flashdata('class', 'alert alert-danger mt-3');
					redirect(base_url('teacher/edit-tutorial/'.$tutorial_id.'/manage-sections'),'refresh');
				}
			}
			elseif($action == 'update'){
				// if update section button is clicked
				$tutorial_id = $this->input->post('tutorial-id');
				$section_id = $this->input->post('section-id');
				$title = $this->input->post('section-title');
				
				$result = $this->crud_model->update_section($section_id, $title);

				if($result){
					// if section is updated successfuly
            		$this->session->set_flashdata('error', 'Section Updated Successfuly');
					$this->session->set_flashdata('class', 'alert alert-success mt-3');
            		redirect(base_url('teacher/edit-tutorial/'.$tutorial_id.'/manage-sections'),'refresh');
				}
				else{
					// cannot update the section to database
            		$error = $this->db->error();
            		$this->session->set_flashdata('error', $error['message']);
					$this->session->set_flashdata('class', 'alert alert-danger mt-3');
					redirect(base_url('teacher/edit-tutorial/'.$tutorial_id.'/manage-sections'),'refresh');
				}

			}
			elseif($action == 'delete'){
				// if update section button is clicked
				$tutorial_id = $this->input->post('tutorial-id');
				$section_id = $this->input->post('sec-id');
				
				$result = $this->crud_model->delete_section($section_id);

				if($result){
					// if section is deleted successfuly
            		$this->session->set_flashdata('error', 'Section Deleted Successfuly');
					$this->session->set_flashdata('class', 'alert alert-success mt-3');
            		redirect(base_url('teacher/edit-tutorial/'.$tutorial_id.'/manage-sections'),'refresh');
				}
				else{
					// cannot delete the section from database
            		$error = $this->db->error();
            		$this->session->set_flashdata('error', $error['message']);
					$this->session->set_flashdata('class', 'alert alert-danger mt-3');
					redirect(base_url('teacher/edit-tutorial/'.$tutorial_id.'/manage-sections'),'refresh');
				}
			}
			else{
				// if action is other than any specified action
				redirect(base_url('teacher/dashboard'),'refresh');
			}
		}
		else{
			// if teacher is not logged in
			redirect(base_url('login'),'refresh');
		}
	}

	// to upload the video lesson
	function upload_video_lesson($tutorial_id){
		$config = array();
		$config['upload_path'] = './uploads/tutorials/lessons/';
        $config['allowed_types'] = 'mp4';

        $this->load->library('upload', $config, 'upload_video_lesson');
        
        if (!$this->upload_video_lesson->do_upload('lesson-video')){
        	// if cannot upload the video then showing error
        	$error = array('error' => $this->upload_video_lesson->display_errors());
        	$this->session->set_flashdata('error', $error['error']);
			$this->session->set_flashdata('class', 'alert alert-danger mt-3');
			redirect(base_url('teacher/edit-tutorial/'.$tutorial_id.'/manage-lessons'),'refresh');
        }
        else{
        	// if video is uploaded succesfuly
        	$data = array('upload_data' => $this->upload_video_lesson->data());

        	// getting the path of uploaded file in a variable
        	$image_url = 'uploads/tutorials/lessons/'.$data['upload_data']['file_name'];
        	return $image_url;
		}
	}

	// to add, update or delete video lesson details from database 
	public function video_lessons($action = ''){

		if($this->session->userdata('teacher_login')){
			// if teacher is logged in

			if($action == 'add'){
				// if add video lesson button is clicked

				$tutorial_id = $this->input->post('tut-id');
				$video_url = $this->upload_video_lesson($tutorial_id);

				$result = $this->crud_model->add_video_lesson($video_url);

				if($result){
					// if new video lesson is added
            		$this->session->set_flashdata('error', 'Lesson Added Successfuly');
					$this->session->set_flashdata('class', 'alert alert-success mt-3');
            		redirect(base_url('teacher/edit-tutorial/'.$tutorial_id.'/manage-lessons'),'refresh');
				}
				else{
					// cannot add the video lesson to database
            		$error = $this->db->error();
            		$this->session->set_flashdata('error', $error['message']);
					$this->session->set_flashdata('class', 'alert alert-danger mt-3');
					redirect(base_url('teacher/edit-tutorial/'.$tutorial_id.'/manage-lessons'),'refresh');
				}
			}
			elseif($action == 'update'){
				// if update video lesson button is clicked
				$les_id = $this->input->post('les-id');
				$tutorial_id = $this->input->post('tut-id');
				$video_url = $this->upload_video_lesson($tutorial_id);

				$result = $this->crud_model->update_video_lesson($les_id ,$video_url);

				if($result){
					// if new lesson is added
            		$this->session->set_flashdata('error', 'Lesson Updated Successfuly');
					$this->session->set_flashdata('class', 'alert alert-success mt-3');
            		redirect(base_url('teacher/edit-tutorial/'.$tutorial_id.'/manage-lessons'),'refresh');
				}
				else{
					// cannot add the lesson to database
            		$error = $this->db->error();
            		$this->session->set_flashdata('error', $error['message']);
					$this->session->set_flashdata('class', 'alert alert-danger mt-3');
					redirect(base_url('teacher/edit-tutorial/'.$tutorial_id.'/manage-lessons'),'refresh');
				}

			}
			elseif($action == 'delete'){
				// if update section button is clicked
				$tutorial_id = $this->input->post('tutorial-id');
				$lesson_id = $this->input->post('les-id');
				
				$result = $this->crud_model->delete_video_lesson($lesson_id);

				if($result){
					// if section is deleted successfuly
            		$this->session->set_flashdata('error', 'Lesson Deleted Successfuly');
					$this->session->set_flashdata('class', 'alert alert-success mt-3');
            		redirect(base_url('teacher/edit-tutorial/'.$tutorial_id.'/manage-lessons'),'refresh');
				}
				else{
					// cannot delete the section from database
            		$error = $this->db->error();
            		$this->session->set_flashdata('error', $error['message']);
					$this->session->set_flashdata('class', 'alert alert-danger mt-3');
					redirect(base_url('teacher/edit-tutorial/'.$tutorial_id.'/manage-lessons'),'refresh');
				}
			}
			else{
				// if action is other than any specified action
				redirect(base_url('teacher/dashboard'),'refresh');
			}
		}
		else{
			// if teacher is not logged in
			redirect(base_url('login'),'refresh');
		}
	}


	// to add, update or delete interactive lessons details from database 
	public function interactive_lessons($action = ''){

		if($this->session->userdata('teacher_login')){
			// if teacher is logged in

			if($action == 'add'){
				// if add lesson button is clicked

				$tutorial_id = $this->input->post('tut-id');

				$result = $this->crud_model->add_interactive_lesson();

				if($result){
					// if new lesson is added
            		$this->session->set_flashdata('error', 'Lesson Added Successfuly');
					$this->session->set_flashdata('class', 'alert alert-success mt-3');
            		redirect(base_url('teacher/edit-tutorial/'.$tutorial_id.'/manage-lessons'),'refresh');
				}
				else{
					// cannot add the lesson to database
            		$error = $this->db->error();
            		$this->session->set_flashdata('error', $error['message']);
					$this->session->set_flashdata('class', 'alert alert-danger mt-3');
					redirect(base_url('teacher/edit-tutorial/'.$tutorial_id.'/manage-lessons'),'refresh');
				}
			}
			elseif($action == 'update'){
				// if update section button is clicked
				$les_id = $this->input->post('les-id');
				$tutorial_id = $this->input->post('tut-id');

				$result = $this->crud_model->update_interactive_lesson($les_id);

				if($result){
					// if new interactive lesson is added
            		$this->session->set_flashdata('error', 'Lesson Updated Successfuly');
					$this->session->set_flashdata('class', 'alert alert-success mt-3');
            		redirect(base_url('teacher/edit-tutorial/'.$tutorial_id.'/manage-lessons'),'refresh');
				}
				else{
					// cannot add the interactive lesson to database
            		$error = $this->db->error();
            		$this->session->set_flashdata('error', $error['message']);
					$this->session->set_flashdata('class', 'alert alert-danger mt-3');
					redirect(base_url('teacher/edit-tutorial/'.$tutorial_id.'/manage-lessons'),'refresh');
				}

			}
			elseif($action == 'delete'){
				// if update section button is clicked
				$tutorial_id = $this->input->post('tutorial-id');
				$lesson_id = $this->input->post('les-id');
				
				$result = $this->crud_model->delete_interactive_lesson($lesson_id);

				if($result){
					// if section is deleted successfuly
            		$this->session->set_flashdata('error', 'Lesson Deleted Successfuly');
					$this->session->set_flashdata('class', 'alert alert-success mt-3');
            		redirect(base_url('teacher/edit-tutorial/'.$tutorial_id.'/manage-lessons'),'refresh');
				}
				else{
					// cannot delete the section from database
            		$error = $this->db->error();
            		$this->session->set_flashdata('error', $error['message']);
					$this->session->set_flashdata('class', 'alert alert-danger mt-3');
					redirect(base_url('teacher/edit-tutorial/'.$tutorial_id.'/manage-lessons'),'refresh');
				}
			}
			else{
				// if action is other than any specified action
				redirect(base_url('teacher/dashboard'),'refresh');
			}
		}
		else{
			// if teacher is not logged in
			redirect(base_url('login'),'refresh');
		}
	}

}


?>