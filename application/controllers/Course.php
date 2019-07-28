<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Course extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
	}

	
	public function index()
	{

		
			$data['page_title'] = 'Tutorial Page';
			$data['page_name'] = 'tutorial_page';
			
			$this->load->model('tutorial'); 
			$id= $this->input->get('id');
			$data['course_id'] = $id;
			$data['records'] = $this->tutorial->get_reviews($id);
			$student_id= $this->session->userdata('student_id'); 
			$data['user_review'] = $this->tutorial->get_user_review($id,$student_id);
		$this->load->view('frontend/index', $data, FALSE);
      }
      public function addReview()
      {
         	$data['page_title'] = 'Tutorial Page';
			$data['page_name'] = 'tutorial_page';
			$this->load->model('tutorial'); 

		$id= $this->input->post('course_id');
			$data['course_id'] = $id;
		$result = $this->tutorial->add_review();

			if($result){
		redirect(base_url('course?id='.$id),refresh);
			}

			
			
      }
      public function updateReview()
      {
         	$data['page_title'] = 'Tutorial Page';
			$data['page_name'] = 'tutorial_page';
			$this->load->model('tutorial'); 

		$id= $this->input->post('course_id');
			$data['course_id'] = $id;
		$result = $this->tutorial->update_review();

	    if($result){
            redirect(base_url('course?id='.$id),refresh);
          }

			
			
      }
      public function deleteReview()
      {
         	$data['page_title'] = 'Tutorial Page';
			$data['page_name'] = 'tutorial_page';
			$this->load->model('tutorial'); 

		$comment_id= $this->input->post('comment_id');
		$id= $this->input->post('course_id');
			$data['course_id'] = $id;

		$result = $this->tutorial->del_review($comment_id);

			if($result){
		redirect(base_url('course?id='.$id),refresh);
			}

			
			
      }

}
?>