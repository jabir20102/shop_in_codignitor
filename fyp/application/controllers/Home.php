<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller{

	public function __construct(){
		parent::__construct();
	}

	// FOR HOME PAGE
	public function index(){

		$data['page_title'] = 'Home';
		$data['page_name'] = 'home';

		$this->load->view('frontend/index', $data, FALSE);
		
		// $this->home();
	}

	// // FOR HOME PAGE
	// public function home(){

	// 	$data['page_title'] = 'Home';
	// 	$data['page_name'] = 'home';

	// 	$this->load->view('frontend/index', $data, FALSE);
	// }

	// FOR SINGAL TUTORIAL
	public function tutorial($slug = '', $id = -1){

		if(empty($slug) || is_numeric($slug)){
			show_404();
		}

		$tutorial = $this->crud_model->get_tutorials($id);

		if($this->session->userdata('student_login')){
			//if student view the tutorial details then view is counted
			$count = $tutorial->count + 1;
			$result = $this->crud_model->update_tutorial_view_count($id, $count);
		}

		$data['page_title'] = 'Tutorial Page';
		$data['page_name'] = 'tutorial_page';
		$data['tutorial'] = $tutorial;

		$this->load->view('frontend/index', $data, FALSE);
	}

	// TO SHOW VIDEO OR INTERACTIVE TUTORIALS
	public function tutorials($type = ''){

		if($type == 'video' OR $type == 'interactive'){
			// if paremeter is video or interactive tutorials

			$tutorials = $this->crud_model->get_tutorials_by_type($type);

			$data['page_title'] = ucwords($type).' Tutorials';
			$data['page_name'] = 'tutorials_type_page';
			$data['tutorials'] = $tutorials;
			$data['active'] = $type;

			$this->load->view('frontend/index', $data, FALSE);
		}
		else{
			show_404();
		}
	}

	// TO SHOW TUTORIALS OF SPECIFIC SUB CATEGORY
	public function categories($slug, $id){

		$tutorials = $this->crud_model->get_tutorials_by_subcat($id);

		$data['page_title'] = 'Tutorials in '.ucwords($slug);
		$data['page_name'] = 'tutorial_category';
		$data['tutorials'] = $tutorials;
		$data['active'] = 'categories';

		$this->load->view('frontend/index', $data, FALSE);
	}

	// TO DISPLAY THE TEACHER PROFILE
	public function user($id = -1){

		if($id == -1){
			show_404();
		}

		$teacher = $this->user_model->get_teacher_by_id($id);

		$data['page_title'] = 'Teacher Information';
		$data['page_name'] = 'teacher_info';
		$data['teacher_info'] = $teacher;

		$this->load->view('frontend/index', $data, FALSE);
	}


	// THIS FUNCTION SEARCH FOR THE TUTORIALS
	public function search(){

		$search_rslt = $this->crud_model->get_search();

		$data['page_title'] = 'Search Tutorial';
		$data['page_name'] = 'search_page';
		$data['search_rslt'] = $search_rslt;

		$this->load->view('frontend/index', $data, FALSE);
	}

	public function preferences($action = ''){

		if($action == ''){
			$data['page_title'] = 'Personalized Recommendations';
			$data['page_name'] = 'enter_preferences';

			$this->load->view('frontend/index', $data, FALSE);
		}
		elseif($action == 'update'){

			$categories_ids = $this->input->post('pref-categories');
			$skill_level = $this->input->post('skill-level');

			// storing the preferences in the JSON format
			$preferences = '{
				"categories": ['.implode(',',$categories_ids).'],
				"skill_level": "'.$skill_level.'"
			}';

			$email = $this->session->userdata('student_email');
			
			$result = $this->user_model->change_student_pref($email, $preferences);

			if($result){
				// if preferences are added in the database
				$this->session->set_flashdata('error', 'Your Preferences has been stored');
				$this->session->set_flashdata('class', 'alert alert-success mt-3');
				redirect(base_url('preferences'),'refresh');
			}
			else{
				// if prerferences are not added in the database for some reason.
				$this->session->set_flashdata('error', 'Cannot store preferences at this time');
				$this->session->set_flashdata('class', 'alert alert-danger mt-3');
				redirect(base_url('preferences'),'refresh');
			}

		}

		
	}

	// to test the summernote wisywig editor
	public function summernote(){
		$data['page_title'] = 'Summernote Test';
		$data['page_name'] = 'summernote';

		$this->load->view('frontend/index', $data, FALSE);
	}
	// to test the summernote wisywig editor
	public function summercode(){
		$code = $this->input->post('summercode');

		echo $code;
	}

	// THIS WILL ONLY LOGOUT THE TEACHER OR STUDENT
	public function logout(){
		$this->sess_destroy();
		redirect(base_url(),'refresh');
	}

	public function sess_destroy(){
		// if student is logged in then destroy student session data on logout
		// else destroy teacher logged in session data
		if($this->session->userdata('student_login')){
			$this->session->unset_userdata('student_id');
			$this->session->unset_userdata('student_name');
			$this->session->unset_userdata('student_email');
			$this->session->unset_userdata('student_login');
		}
		else{
			$this->session->unset_userdata('teacher_id');
			$this->session->unset_userdata('teacher_name');
			$this->session->unset_userdata('teacher_email');
			$this->session->unset_userdata('teacher_login');
		}
		
	}

}

?>