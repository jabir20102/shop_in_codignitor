<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class User_Model extends CI_Model{

	public function __construct(){
		parent::__construct();
	}

/*====================================================================														ADMIN FUNCTIONS
====================================================================*/

	// GET ADMIN WITH GIVEN DETAIL
	public function get_admin($email = ''){
		$query = $this->db->get_where('admin', array('email'=>$email));
		return $query->row();
	}


	// CHANGE ADMIN IMAGE
	public function change_admin_img($email = '', $image_url = ''){
		$data = array(
		    'image_url' => $image_url
		);

		$this->db->where('email', $email);
		$query = $this->db->update('admin', $data);
		return $query;
	}


	// CHANGE ADMIN PASSWORD
	public function change_admin_pass($email = '', $newpass = ''){
		$data = array(
		    'password' => $newpass
		);

		$this->db->where('email', $email);
		$query = $this->db->update('admin', $data);
		return $query;
	}

/*====================================================================														STUDENT FUNCTIONS
====================================================================*/

	// ADD NEW STUDENT
	public function add_student(){
		$data = array(
			'name' => $this->input->post('fullName'),
			'email' => $this->input->post('email'),
			'password' => $this->input->post('pass'),
			'image_url' => '',
			'preferences' => '',
			'date_added' => date('Y-m-d')
		);

		$query = $this->db->insert('student', $data);
		return $query;
	}


	// GET STUDENTS WITH GIVEN DETAIL
	public function get_students($email = '', $id = '', $limit = '', $offset = ''){
		if($email !== ''){
			// getting by specific email
			$query = $this->db->get_where('student', array('email'=>$email));
			return $query->row();
		}
		if($id !== ''){
			$query = $this->db->get_where('student', array('id'=>$id));
			return $query->row();
		}
		if($limit !== ''){
			$query = $this->db->limit($limit, $offset)
							  ->get('student');
			return $query->result();
		}
		else{
			$query = $this->db->get('student');
			return $query->result();
		}
	}


	// DELETE THE STUDENT
	public function delete_student($stdnt_id = ''){
		$query = $this->db->delete('student', array('id' => $stdnt_id));
		return $query;
	}


	// Updates Student Profile
	public function update_std_profle($email = '', $std_name = ''){
		$data = array(
  		  'name' => $std_name
		);

		$this->db->where('email', $email);
		$query = $this->db->update('student', $data);
		return $query;
	}

	// CHANGE STUDENT IMAGE
	public function change_student_img($email = '', $image_url = ''){
		$data = array(
		    'image_url' => $image_url
		);

		$this->db->where('email', $email);
		$query = $this->db->update('student', $data);
		return $query;
	}

	// CHANGE STUDENT PASSWORD
	public function change_student_pass($email = '', $newpass = ''){
		$data = array(
		    'password' => $newpass
		);

		$this->db->where('email', $email);
		$query = $this->db->update('student', $data);
		return $query;
	}

	// CHANGE STUDENT PREFERENCES
	public function change_student_pref($email, $preferences){
		$data = array(
		    'preferences' => $preferences
		);

		$this->db->where('email', $email);
		$query = $this->db->update('student', $data);
		return $query;
	}

/*====================================================================														TEACHER FUNCTIONS
====================================================================*/

	// ADD NEW TEACHER
	public function add_teacher(){
		$data = array(
			'name' => $this->input->post('fullName'),
			'email' => $this->input->post('email'),
			'password' => $this->input->post('pass'),
			'image_url' => '',
			'bio' => '',
			'date_added' => date('Y-m-d')
		);

		$query = $this->db->insert('teacher', $data);
		return $query;
	}


	// GET TEACHERS WITH GIVEN DETAIL
	public function get_teachers($email = '', $limit = '', $offset = ''){

		if($email !== ''){
			$query = $this->db->get_where('teacher', array('email'=>$email));
			return $query->row();
		}
		if($limit !== ''){
			$query = $this->db->limit($limit, $offset)
							  ->get('teacher');
			return $query->result();
		}
		else{
			$query = $this->db->get('teacher');
			return $query->result();
		}
	}

	// GET TEACHERS WITH GIVEN DETAIL
	public function get_teacher_by_id($id){
		$query = $this->db->get_where('teacher', array('id'=>$id));
		return $query->row();
	}


	// DELETE THE TEACHER
	public function delete_teacher($teacher_id = ''){
		$query = $this->db->delete('teacher', array('id' => $teacher_id));
		return $query;
	}


	// UPDATES TEACHER PROFILE
	public function update_tchr_profle($email = '', $std_name = '', $bio = ''){
		$data = array(
  		  'name' => $std_name,
  		  'bio' => $bio
		);

		$this->db->where('email', $email);
		$query = $this->db->update('teacher', $data);
		return $query;
	}

	// CHANGE TEACHER IMAGE
	public function change_teacher_img($email = '', $image_url = ''){
		$data = array(
		    'image_url' => $image_url
		);

		$this->db->where('email', $email);
		$query = $this->db->update('teacher', $data);
		return $query;
	}

	// CHANGE TEACHER PASSWORD
	public function change_teacher_pass($email = '', $newpass = ''){
		$data = array(
		    'password' => $newpass
		);

		$this->db->where('email', $email);
		$query = $this->db->update('teacher', $data);
		return $query;
	}
}

?>