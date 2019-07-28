<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller{

	public function __construct(){
		parent::__construct();
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
            	$this->session->set_flashdata('img-error', $error['error']);
				$this->session->set_flashdata('img-class', 'alert alert-danger mt-3');
				redirect(base_url('student/edit-profile'),'refresh');
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
            		redirect(base_url('student/edit-profile'),'refresh');
            	}
            	else{
            		// cannot store the image path in database for some reason
            		$error = $this->db->error();
            		$this->session->set_flashdata('error', $error['message']);
					$this->session->set_flashdata('class', 'alert alert-danger mt-3');
					redirect(base_url('student/edit-profile'),'refresh');
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
	        $this->session->set_flashdata('pass-error', 'New Password did not match');
			$this->session->set_flashdata('pass-class', 'alert alert-danger mb-3 w-50');
			redirect(base_url('student/edit-profile'),'refresh');
		} 
		elseif($result->password !== $oldPass){
			// if new pass and old pass do not match
			$this->session->set_flashdata('pass-error', 'Old Password is wrong');
			$this->session->set_flashdata('pass-class', 'alert alert-danger mb-3 w-50');
			redirect(base_url('student/edit-profile'),'refresh');
		}
		else{
			// if every thing is right then change student password
			$this->user_model->change_student_pass($email, $newPass);
			$this->session->set_flashdata('pass-error', 'Password Changed Successfuly');
			$this->session->set_flashdata('pass-class', 'alert alert-success mb-3 w-50');
			redirect(base_url('student/edit-profile'),'refresh');
		}
	}

	// LOADS UP THE STUDENTS TAKEN TUTORIALS
	public function my_tutorials(){
		if($this->session->userdata('student_login')){
			// if studnet is logged in
			$data['page_title'] = "My Tutotrials";
			$data['page_name'] = 'my_tutorial_page';
			$data['active'] = 'my-tutorials';
			$this->load->view('frontend/index', $data, FALSE);
		}
		else{
			// if student is not logged in
			redirect(base_url('login'),'refresh');
		}

	}

	// TO ENROLL THE STUDENT IN TUTORIAL
	public function tutorial_enrolment(){
		if($this->session->userdata('student_login')){
			// if student is logged in
			$student_id = $this->session->userdata('student_id');
			$tutorial_id = $this->input->post('tut-id');

			if(!isset($tutorial_id)){
				// if tutorial-enrollment link is directly accessed
				$this->session->set_flashdata('error', 'Select tutorial to enrol and start learning');
				$this->session->set_flashdata('class', 'alert alert-info mt-3');
				redirect(base_url('student/my-tutorials'),'refresh');
			}

			$enroled = $this->crud_model->get_specific_enrolment($student_id, $tutorial_id);

			if(isset($enroled)){
				// if student is already enrolled in this tutorials
				$this->session->set_flashdata('error', 'You are alredy enrolled in this tutorial');
				$this->session->set_flashdata('class', 'alert alert-info mt-3');
				redirect(base_url('student/my-tutorials'),'refresh');
			}

			$result = $this->crud_model->add_enrolment($student_id, $tutorial_id);

			if($result){
				// if enrolment data is added to the database
				$this->session->set_flashdata('error', 'Successfuly enroled in tutorial');
				$this->session->set_flashdata('class', 'alert alert-success mt-3');
				redirect(base_url('student/my-tutorials'),'refresh');
			}
			else{
				// idf cannot add the enrolment data to the database
				$this->session->set_flashdata('error', 'Cannot enrol in tutorial');
				$this->session->set_flashdata('class', 'alert alert-danger mt-3');
				redirect(base_url('student/my-tutorials'),'refresh');
			}
		}
		else{
			// icf student is not logged in 
			redirect(base_url('login'),'refresh');
		}
	}

	public function learn($tutorial_id = -1, $lesson_id = ''){
		if($this->session->userdata('student_login')){
			// if student is logged in

			if($tutorial_id === -1 OR !is_numeric($tutorial_id)){
				// if tutorial_id parametor is not passed or string is passed in tutorial_id parameter
				show_404();
			}

			$student_id = $this->session->userdata('student_id');
			$enrolment = $this->crud_model->get_specific_enrolment($student_id, $tutorial_id);

			if(!isset($enrolment)){
				// checking this condition if direct url is accessed instead of my tutorials page
				// if enrolled student and logged in student is not same then redirect
				// this prevents one student from acccessing the taken tutorials of other students by direct url.
				$this->session->set_flashdata('error', 'Please select tutorial to start learning');
				$this->session->set_flashdata('class', 'alert alert-info mt-3');
				redirect(base_url('student/my-tutorials'),'refresh');
			}

			$tutorial = $this->crud_model->get_tutorials($tutorial_id);

			if($tutorial->type == 'video'){
				// if tutorial type is video
				$data['page_title'] = 'Learn By Video Tutorial';
				$data['page_name'] = 'learn_video_tutorial';
				$data['tutorial'] = $tutorial;
				$data['lesson_id'] = $lesson_id;
				// $data['active'] = 'my-tutorials';
				$this->load->view('frontend/index', $data, FALSE);
			}
			else{
				// if tutorial type is interactive
				$data['page_title'] = 'Learn By Interactive Tutorial';
				$data['page_name'] = 'learn_interactive_tutorial';
				$data['tutorial'] = $tutorial;
				// $data['active'] = 'my-tutorials';
				$this->load->view('frontend/index', $data, FALSE);
			}
		}
		else{
			// if student is not logged in
			redirect(base_url('login'),'refresh');
		}

	}

	public function interactive_lesson($lesson_id = -1){
		if($this->session->userdata('student_login')){
			// if student is logged in

			if($lesson_id === -1 OR !is_numeric($lesson_id)){
				// if lesson_id parametor is not passed or string is passed in tutorial_id parameter
				show_404();
			}

			$student_id = $this->session->userdata('student_id');
			$lesson = $this->crud_model->get_interactive_lessons($lesson_id);
			$enrolment = $this->crud_model->get_specific_enrolment($student_id, $lesson->tutorial_id);

			if(!isset($enrolment)){
				// checking this condition if direct url is accessed instead of my tutorials page
				// if enrolled student and logged in student is not same then redirect
				// this prevents one student from acccessing the taken tutorials of other students by direct url.
				$this->session->set_flashdata('error', 'Please select tutorial to start learning');
				$this->session->set_flashdata('class', 'alert alert-info mt-3');
				redirect(base_url('student/my-tutorials'),'refresh');
			}

			$data['page_title'] = 'Learn By Interactive Tutorial';
			$data['page_name'] = 'interactive_editor';
			$data['lesson'] = $lesson;
			// $data['active'] = 'my-tutorials';
			$this->load->view('frontend/index', $data, FALSE);



		}
		else{
			// if student is not logged in
			redirect(base_url('login'),'refresh');
		}
	}

	// THIS FUNCTION IS RO REPORT A TUTORIAL
	public function report_tutorial($tutorial_id = -1,  $action = ''){

		if($this->session->userdata('student_login')){
			// if student is logged in

			if($tutorial_id === -1 OR !is_numeric($tutorial_id)){
				// if tutorial_id parametor is not passed or string is passed in tutorial_id parameter
				show_404();
			}

			$student_id = $this->session->userdata('student_id');
			$enrolment = $this->crud_model->get_specific_enrolment($student_id, $tutorial_id);

			if(!isset($enrolment)){
				// checking this condition if direct url is accessed instead of tutorial overview page
				// if enrolled student and logged in student is not same then redirect
				// this prevents a student from reporting a tutorial which he has nor taken.
				$this->session->set_flashdata('error', 'Please select tutorial to report');
				$this->session->set_flashdata('class', 'alert alert-info mt-3');
				redirect(base_url('student/my-tutorials'),'refresh');
			}

			if($action == ''){
				$data['page_title'] = 'Report Tutorial';
				$data['page_name'] = 'report_tutorial';

				$tutorial = $this->crud_model->get_tutorials($tutorial_id);

				$data['tutorial'] = $tutorial;
				$this->load->view('frontend/index', $data, FALSE);
			}
			elseif($action == 'submit'){

				$reason = $this->input->post('report');

				if(!isset($reason)){
					$this->session->set_flashdata('error', 'Report Reason field cannot be empty');
					$this->session->set_flashdata('class', 'alert alert-info mt-3');
					redirect(base_url('student/report_tutorial/'.$tutorial_id),'refresh');
				}

				$submitted = $this->crud_model->get_specific_report($student_id, $tutorial_id);

				if(isset($submitted)){
					$this->session->set_flashdata('error', 'You have already reported this tutorial');
					$this->session->set_flashdata('class', 'alert alert-info mt-3');
					redirect(base_url('student/report_tutorial/'.$tutorial_id),'refresh');
				}

				$result = $this->crud_model->add_report($student_id, $tutorial_id, $reason);

				if($result){
					// if report is added in the database
					$this->session->set_flashdata('error', 'Report has been submitted successfully');
					$this->session->set_flashdata('class', 'alert alert-success mt-3');
					redirect(base_url('student/report_tutorial/'.$tutorial_id),'refresh');
				}
				else{
					// if report is not added in the database for some reason.
					$this->session->set_flashdata('error', 'Cannot submit a report at this time');
					$this->session->set_flashdata('class', 'alert alert-danger mt-3');
					redirect(base_url('student/report_tutorial/'.$tutorial_id),'refresh');
				}
			}
			else{
				// if action is neither empty nor submit
				redirect(base_url('student/report_tutorial/'.$tutorial_id),'refresh');
			}
		}
		else{
			// if student is not logged in
			redirect(base_url('login'),'refresh');
		}
	}

	// THIS FUNCTION IS TO RATE A TUTORIAL
	public function rate_tutorial($tutorial_id = -1,  $action = ''){

		if($this->session->userdata('student_login')){
			// if student is logged in

			if($tutorial_id === -1 OR !is_numeric($tutorial_id)){
				// if tutorial_id parametor is not passed or string is passed in tutorial_id parameter
				show_404();
			}

			$student_id = $this->session->userdata('student_id');
			$enrolment = $this->crud_model->get_specific_enrolment($student_id, $tutorial_id);

			if(!isset($enrolment)){
				// checking this condition if direct url is accessed instead of tutorial overview page
				// if enrolled student and logged in student is not same then redirect
				// this prevents a student from reporting a tutorial which he has nor taken.
				$this->session->set_flashdata('error', 'Please select tutorial to rate');
				$this->session->set_flashdata('class', 'alert alert-info mt-3');
				redirect(base_url('student/my-tutorials'),'refresh');
			}

			if($action == ''){
				$tutorial = $this->crud_model->get_tutorials($tutorial_id);
				$student_id = $this->session->userdata('student_id');
				$rated = $this->crud_model->get_rating_by_student($tutorial->id, $student_id);

				$data['page_title'] = 'Rate a Tutorial';
				$data['page_name'] = 'rate_tutorial';
				$data['tutorial'] = $tutorial;
				$data['rated'] = $rated;

				print_r($data['rated']);

				$this->load->view('frontend/index', $data, FALSE);
			}
			elseif($action == 'add'){				
				// if add review button is clicked
				$rating_star = $this->input->post('star');

				if(!isset($rating_star)){
					// if rating stars are not selected
					$this->session->set_flashdata('error', 'rating star cannot be empty');
					$this->session->set_flashdata('class', 'alert alert-danger mt-3');
					redirect(base_url('student/rate-tutorial/'.$tutorial_id),'refresh');
				}

				$result = $this->crud_model->add_rating($tutorial_id, $rating_star);

				if($result){
					// if report is added in the database
					$this->session->set_flashdata('error', 'Review has been submitted successfully');
					$this->session->set_flashdata('class', 'alert alert-success mt-3');
					redirect(base_url('student/rate-tutorial/'.$tutorial_id),'refresh');
				}
				else{
					// if report is not added in the database for some reason.
					$this->session->set_flashdata('error', 'Cannot submit a Review');
					$this->session->set_flashdata('class', 'alert alert-danger mt-3');
					redirect(base_url('student/rate-tutorial/'.$tutorial_id),'refresh');
				}
			}
			elseif($action == 'update'){

				$rating_id = $this->input->post('rating-id');

				if(!isset($rating_id)){
					// if link is directly accessed
					redirect(base_url('student/rate-tutorial/'.$tutorial_id), 'refresh');
				}

				$result = $this->crud_model->update_rating($rating_id);

				if($result){
					// if report is added in the database
					$this->session->set_flashdata('error', 'Review has been updated successfuly');
					$this->session->set_flashdata('class', 'alert alert-success mt-3');
					redirect(base_url('student/rate-tutorial/'.$tutorial_id),'refresh');
				}
				else{
					// if report is not added in the database for some reason.
					$this->session->set_flashdata('error', 'Cannot update Review');
					$this->session->set_flashdata('class', 'alert alert-danger mt-3');
					redirect(base_url('student/rate-tutorial/'.$tutorial_id),'refresh');
				}
			}
			elseif($action == 'delete'){
				$rating_id = $this->input->post('rating-id');

				if(!isset($rating_id)){
					// if link is deirectly accessed
					redirect(base_url('student/rate-tutorial/'.$tutorial_id), 'refresh');
				}

				$result = $this->crud_model->delete_rating($rating_id);

				if($result){
					// if report is added in the database
					$this->session->set_flashdata('error', 'Review has been deleted successfuly');
					$this->session->set_flashdata('class', 'alert alert-success mt-3');
					redirect(base_url('student/rate-tutorial/'.$tutorial_id),'refresh');
				}
				else{
					// if report is not added in the database for some reason.
					$this->session->set_flashdata('error', 'Cannot delete Review');
					$this->session->set_flashdata('class', 'alert alert-danger mt-3');
					redirect(base_url('student/rate-tutorial/'.$tutorial_id),'refresh');
				}

			}
			else{
				// if action is neither empty nor submit
				redirect(base_url('student/rate-tutorial/'.$tutorial_id),'refresh');
			}
		}
		else{
			// if student is not logged in
			redirect(base_url('login'),'refresh');
		}
	}

}


?>