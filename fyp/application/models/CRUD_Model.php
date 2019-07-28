<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CRUD_Model extends CI_Model{

	public function __construct(){
		parent::__construct();
	}

	// searching tutorials where keyword matches the title or short description
	public function get_search() {
		$keyword = $this->input->get('s');
		$this->db->like('title',$keyword);
		$this->db->or_like('short_description',$keyword);
		$query = $this->db->get('tutorials');
		return $query->result();
	}

	// GET ALL CATEGORIES OR BY SPECIFIC CATEGORY ID
	public function get_categories($cat_id = ''){
		if($cat_id !== ''){
			// getting specific category if category id is passed in parameter
			$query = $this->db->get_where('categories', array('id' => $cat_id));
			return $query->row();
		}
		// getting all categories
		$query = $this->db->get('categories');
		return $query->result();
	}

	// GET ALL SUB CATEGORIES OR BY SPECIFIC SUB CAT ID 
	public function get_sub_cat($sub_cat_id = ''){
		if($sub_cat_id !== ''){
			// getting specific sub category if sub category id is passed in parameter
			$query = $this->db->get_where('sub_categories', array('id' => $sub_cat_id));
			return $query->row();
		}
		// getting all sub categories
		$query = $this->db->get('sub_categories');
		return $query->result();
	}

	// GET SUB CATEGORY USING SPECIFIC PARENT CATEGORY
	public function get_sub_by_parent_cat($parent_id = ''){
		$query = $this->db->get_where('sub_categories', array('	parent_cat_id' => $parent_id));
		return $query->result();
	}

	// ADD A NEW CATEGORY
	public function add_category($name = ''){
		$query = $this->db->insert('categories', array('cat_name'=>$name));
		return $query;
	}

	// UPDATE EXISTING CATEGORY
	public function update_category($name = '', $cat_id = ''){
		$data = array(
		    'cat_name' => $name
		);

		$this->db->where('id', $cat_id);
		$query = $this->db->update('categories', $data);
		return $query;
	}

	// DELETE THE CATEGORY
	public function delete_category($cat_id = ''){
		$query = $this->db->delete('categories', array('id' => $cat_id));
		return $query;
	}

	// ADD A NEW SUB CATEGORY
	public function add_sub_cat($name = '', $parent_cat_id){
		$data = array(
			'sub_cat_name' => $name,
			'parent_cat_id' => $parent_cat_id
		);

		$query = $this->db->insert('sub_categories', $data);
		return $query;
	}

	// UPDATE EXISTING SUB CATEGORY
	public function update_sub_cat($name = '', $sub_cat_id = '', $parent_cat_id){
		$data = array(
		    'sub_cat_name' => $name,
		    'parent_cat_id' => $parent_cat_id
		);

		$this->db->where('id', $sub_cat_id);
		$query = $this->db->update('sub_categories', $data);
		return $query;
	}

	// DELETE THE SUB CATEGORY
	public function delete_sub_cat($sub_cat_id = ''){
		$query = $this->db->delete('sub_categories', array('id' => $sub_cat_id));
		return $query;
	}

	// ADD NEW TUTORIAL
	public function add_tutorial($thumbnail = '', $preview = ''){

		$data = array(
			'title' => $this->input->post('title'),
			'slug' => url_title($this->input->post('title'), 'dash', TRUE),
			'short_description' => $this->input->post('short-des'),
			'description' => $this->input->post('description'),
			'cat_id' => $this->input->post('cat_id'),
			'sub_cat_id' => $this->input->post('sub_cat_id'),
			'teacher_id' => $this->session->userdata('teacher_id'),
			'type' => $this->input->post('tutorial-type'),
			'level' => $this->input->post('level'),
			'thumbnail_url' => $thumbnail,
			'preview_url' => $preview,
			'tags' => $this->input->post('tags'),
			'date_added' => date('Y-m-d')
		);

		// return $data;
		$query = $this->db->insert('tutorials', $data);
		return $query;
	}

	// GETTING ALL TUTORIALS OR BY TUTORIAL ID  
	public function get_tutorials($tut_id = '', $order_by = '', $limit = '', $offset = ''){
		if($tut_id !== ''){
			// getting specific tutorial if tutorial id is passed in parameter
			$query = $this->db->get_where('tutorials', array('id' => $tut_id));
			return $query->row();
		}

		if($order_by !== ''){
			// getting all tutorials ordered by count in descending order
			$this->db->order_by($order_by, 'DESC');
			$query = $this->db->get('tutorials');
			return $query->result();
		}
		if($limit !== ''){
			$query = $this->db->limit($limit, $offset)
							  ->get('tutorials');
			return $query->result();
		}
		// getting all tutorials
		$query = $this->db->get('tutorials');
		return $query->result();
	}



	// GETTING ALL TUTORIALS OF THE SPECIFIC TEACHER 
	public function get_tutorials_by_teacher($teacehr_id){
		$query = $this->db->get_where('tutorials', array('teacher_id' => $teacehr_id));
		return $query->result();
	}

	

		

	// UPDATE SELECTED TUTORIAL
	public function update_tutorial($tutorial_id, $thumbnail = '', $preview = ''){

		$data = array(
			'title' => $this->input->post('title'),
			'slug' => url_title($this->input->post('title'), 'dash', TRUE),
			'short_description' => $this->input->post('short-des'),
			'description' => $this->input->post('description'),
			'cat_id' => $this->input->post('cat_id'),
			'sub_cat_id' => $this->input->post('sub_cat_id'),
			'teacher_id' => $this->session->userdata('teacher_id'),
			'type' => $this->input->post('tutorial-type'),
			'level' => $this->input->post('level'),
			'thumbnail_url' => $thumbnail,
			'preview_url' => $preview,
			'tags' => $this->input->post('tags')
		);

		$this->db->where('id', $tutorial_id);
		$query = $this->db->update('tutorials', $data);
		return $query;
	}

	// UPDATE SELECTED TUTORIAL
	public function update_tutorial_view_count($tutorial_id, $count){
		$data = array(
			'count' => $count
		);

		$this->db->where('id', $tutorial_id);
		$query = $this->db->update('tutorials', $data);
		return $query;
	}

	// DELETE THE SELECTED TUTORIAL
	public function delete_tutorial($tutorial_id){
		$query = $this->db->delete('tutorials', array('id' => $tutorial_id));
		return $query;
	}

	// ADD A NEW SECTION IN TUTORIAL
	public function add_section($tutorial_id, $title){

		$data = array(
			'title' => $title,
			'tutorial_id' => $tutorial_id
		);

		$query = $this->db->insert('sections', $data);
		return $query;
	}

	// UPDATE EXISTING SECTION NAME
	public function update_section($sec_id = '', $title = ''){
		$data = array(
		    'title' => $title
		);

		$this->db->where('id', $sec_id);
		$query = $this->db->update('sections', $data);
		return $query;
	}

	// GETTING ALL SECTIONS OR BY SECTIONS ID  
	public function get_section($sec_id = ''){
		if($sec_id !== ''){
			// getting specific section if section id is passed in parameter
			$query = $this->db->get_where('sections', array('id' => $sec_id));
			return $query->row();
		}
		// getting all sections
		$query = $this->db->get('sections');
		return $query->result();
	}

	// 	GETTING ALL THE SECTIONS OF THE SPECIFIC TUTORIAL
	public function get_section_by_tut_id($tutorial_id = ''){
		$query = $this->db->get_where('sections', array('tutorial_id' => $tutorial_id));
		return $query->result();
	}

	// DELETE THE SPECIFIC SECTION
	public function delete_section($sec_id){
		$query = $this->db->delete('sections', array('id' => $sec_id));
		return $query;
	}

	// ADD NEW VIDEO LESSON
	public function add_video_lesson($lesson_video){

		$data = array(
			'title' => $this->input->post('lesson-title'),
			'duration' => $this->input->post('duration'),
			'section_id' => $this->input->post('section'),
			'tutorial_id' => $this->input->post('tut-id'),
			'video_url' => $lesson_video,
			'date_added' => date('Y-m-d')
		);

		// return $data;
		$query = $this->db->insert('video_lessons', $data);
		return $query;
	}

	// GETTING ALL VIDEO LESSONS OR BY VIDEO LESSON ID  
	public function get_video_lessons($les_id = ''){
		if($les_id !== ''){
			// getting specific video lesson if lesson id is passed in parameter
			$query = $this->db->get_where('video_lessons', array('id' => $les_id));
			return $query->row();
		}
		// getting all video lessons
		$query = $this->db->get('video_lessons');
		return $query->result();
	}

		// UPDATE EXISTING VIDEO LESSON
	public function update_video_lesson($les_id, $lesson_video){

		$data = array(
			'title' => $this->input->post('lesson-title'),
			'duration' => $this->input->post('duration'),
			'section_id' => $this->input->post('section'),
			'video_url' => $lesson_video,
		);

		$this->db->where('id', $les_id);
		$query = $this->db->update('video_lessons', $data);
		return $query;
	}

	// 	GETTING ALL THE VIDEO LESSONS OF THE SPECIFIC TUTORIAL
	public function get_vlesson_by_tut_id($tutorial_id = ''){
		$query = $this->db->get_where('video_lessons', array('tutorial_id' => $tutorial_id));
		return $query->result();
	}

	// 	GETTING ALL THE VIDEO LESSONS OF THE SPECIFIC SECTION
	public function get_vlesson_by_sec_id($section_id = ''){
		$query = $this->db->get_where('video_lessons', array('section_id' => $section_id));
		return $query->result();
	}

	// DELETE THE SPECIFIC VIDEO LESSON
	public function delete_video_lesson($les_id){
		$query = $this->db->delete('video_lessons', array('id' => $les_id));
		return $query;
	}


	// ADD NEW INTERACTIVE LESSON
	public function add_interactive_lesson(){

		$data = array(
			'title' => $this->input->post('lesson-title'),
			'instructions' => $this->input->post('instructions'),
			'section_id' => $this->input->post('section'),
			'tutorial_id' => $this->input->post('tut-id'),
			'date_added' => date('Y-m-d')
		);

		// return $data;
		$query = $this->db->insert('interactive_lessons', $data);
		return $query;
	}

	// GETTING ALL INTERACTIVE LESSONS OR BY LESSON ID  
	public function get_interactive_lessons($les_id = ''){
		if($les_id !== ''){
			// getting specific interactive lesson if lesson id is passed in parameter
			$query = $this->db->get_where('interactive_lessons', array('id' => $les_id));
			return $query->row();
		}
		// getting all interactive lessons
		$query = $this->db->get('interactive_lessons');
		return $query->result();
	}

	// UPDATE EXISTING INTERACTIVE LESSON
	public function update_interactive_lesson($les_id){

		$data = array(
			'title' => $this->input->post('lesson-title'),
			'instructions' => $this->input->post('instructions'),
			'section_id' => $this->input->post('section')
		);

		$this->db->where('id', $les_id);
		$query = $this->db->update('interactive_lessons', $data);
		return $query;
	}

	// 	GETTING ALL THE INTERACTIVE LESSONS OF THE SPECIFIC TUTORIAL
	public function get_ilesson_by_tut_id($tutorial_id = ''){
		$query = $this->db->get_where('interactive_lessons', array('tutorial_id' => $tutorial_id));
		return $query->result();
	}

	// 	GETTING ALL THE LESSONS OF THE SPECIFIC SECTION
	public function get_ilesson_by_sec_id($section_id = ''){
		$query = $this->db->get_where('interactive_lessons', array('section_id' => $section_id));
		return $query->result();
	}

	// DELETE THE SPECIFIC INTERACTIVE LESSON
	public function delete_interactive_lesson($les_id){
		$query = $this->db->delete('interactive_lessons', array('id' => $les_id));
		return $query;
	}

	// ENROL NEW STUDENT TO TUTORIAL
	public function add_enrolment($student_id, $tutorial_id){

		$data = array(
			'student_id' => $student_id,
			'tutorial_id' => $tutorial_id,
			'date_added' => date('Y-m-d')
		);

		$query = $this->db->insert('enrollment', $data);
		return $query;
	}

	// GETTING ALL ENROLMETS OR BY ENROLMENT ID  
	public function get_enrolments($enrol_id = ''){
		if($enrol_id !== ''){
			// getting specific enrolment if enrolment id is passed in parameter
			$query = $this->db->get_where('enrollment', array('id' => $enrol_id));
			return $query->row();
		}
		// getting all enrolments
		$query = $this->db->get('enrollment');
		return $query->result();
	}

	// GETTING ALL ENROLMENTS OF THE SPECIFIC STUDENT 
	public function get_enrolments_by_student($student_id){
		$query = $this->db->get_where('enrollment', array('student_id' => $student_id));
		return $query->result();
	}

	// GETTING ALL ENROLMENTS OF THE SPECIFIC TUTORIAL
	public function get_enrolments_by_tutorial($tutorial_id){
		$query = $this->db->get_where('enrollment', array('tutorial_id' => $tutorial_id));
		return $query->result();
	}

	// GETTING SPECIFIC ENROLMENT BY STUDENT AND TUTORIAL
	public function get_specific_enrolment($student_id, $tutorial_id){
		$this->db->where('student_id', $student_id);
		$this->db->where('tutorial_id', $tutorial_id);
		$query = $this->db->get('enrollment');
		return $query->row();
	}

	// ADD NEW REPORTED TUTORIAL
	public function add_report($student_id, $tutorial_id, $reason){

		$data = array(
			'student_id' => $student_id,
			'tutorial_id' => $tutorial_id,
			'report_reason' => $reason,
			'date_added' => date('Y-m-d')
		);

		$query = $this->db->insert('reported_tutorials', $data);
		return $query;
	}

	// GETTING ALL Reported tutorials OR BY Report ID  
	public function get_reports($report_id = '', $limit = '', $offset = ''){
		if($report_id !== ''){
			// getting specific reported tutorial if report id is passed in parameter
			$query = $this->db->get_where('reported_tutorials', array('id' => $report_id));
			return $query->row();
		}
		if($limit !== ''){
			// getting records for pagination
			$query = $this->db->limit($limit, $offset)
							  ->get('reported_tutorials');
			return $query->result();
		}
		// getting all reported tutorials
		$query = $this->db->get('reported_tutorials');
		return $query->result();
	}

	// GETTING SPECIFIC REPORTED TUTORIAL BY STUDENT AND TUTORIAL
	public function get_specific_report($student_id, $tutorial_id){
		$this->db->where('student_id', $student_id);
		$this->db->where('tutorial_id', $tutorial_id);
		$query = $this->db->get('reported_tutorials');
		return $query->row();
	}

	// DELETE THE SPECIFIC REPORT
	public function delete_report($rep_id){
		$query = $this->db->delete('reported_tutorials', array('id' => $rep_id));
		return $query;
	}

	// ADD NEW RATING OF THE TUTORIAL
	public function add_rating($tutorial_id, $rating_star){

		$data = array(
			'student_id' => $this->session->userdata('student_id'),
			'tutorial_id' => $tutorial_id,
			'rating' => $rating_star,
			'review' => $this->input->post('review'),
			'date_added' => date('Y-m-d'),
			'last_modified' => date('Y-m-d')
		);

		$query = $this->db->insert('ratings', $data);
		return $query;
	}

	// UPDATE EXISTING SECTION NAME
	public function update_rating($rating_id){
		$data = array(
			'rating' => $this->input->post('upd_star'),
	        'review' => $this->input->post('review'),
			'last_modified' => date('Y-m-d')
		);

		$this->db->where('id', $rating_id);
		$query = $this->db->update('ratings', $data);
		return $query;
	}

	// GETTING ALL SECTIONS OR BY SECTIONS ID  
	public function get_ratings($rating_id = ''){
		if($rating_id !== ''){
			// getting specific rating if rating id is passed in parameter
			$query = $this->db->get_where('ratings', array('id' => $rating_id));
			return $query->row();
		}
		// getting all sections
		$query = $this->db->get('ratings');
		return $query->result();
	}

	// GET RATINGS OF SPECIFIC TUTORIAL
	public function get_rating_by_tutorial($id){
		$this->db->order_by("id", "desc");
		$query = $this->db->get_where('ratings', array('tutorial_id' => $id));
		return $query->result();
	}

	// GET RATINGS OF SPECIFIC USER ON SPECIFIC TUTORIAL
	public function get_rating_by_student($tutorial_id, $student_id){
		$data = array(
			'tutorial_id' => $tutorial_id,
			'student_id' => $student_id
		);

		$query = $this->db->get_where('ratings', $data);
		return $query->row();
	}

	// DELETE THE SPECIFIC RATING
	public function delete_rating($rating_id){
		$query = $this->db->delete('ratings', array('id' => $rating_id));
		return $query;
	}
}

?>