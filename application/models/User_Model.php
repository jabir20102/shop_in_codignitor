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
	public function update_std_profle($email, $name,$address,$city,$country,$zip,$phone){
		$data = array(
  		  'name' => $name,
  		  'address' => $address,
  		  'city' => $city,
  		  'country' => $country,
  		  'zip' => $zip,
  		  'phone' => $phone
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
// GETTING ALL TUTORIALS OR BY TUTORIAL ID  
	public function get_wishlist($student_id = '', $order_by = '', $limit = '', $offset = ''){
		if($student_id !== '' && $limit == ''){
			// getting specific tutorial if tutorial id is passed in parameter
			$this->db->order_by('id', 'DESC');
			$query = $this->db->get_where('wishlist', array('student_id' => $student_id));
			return $query->result();
		} if( $limit !== '' ){
			
		   $this->db->order_by('id', 'DESC');
			$query = $this->db->limit($limit, $offset)
							  ->get_where('wishlist', array('student_id' => $student_id));
			return $query->result();
		}
		// getting all tutorials
			echo "else";
		$query = $this->db->get('wishlist');		
		$this->db->order_by('id', 'DESC');
		return $query->result();
	
	}
	// check THE wishlist
	public function check_wishlist($prod_id = ''){
		$student_id=$this->session->userdata('student_id');
			$query = $this->db->get_where('wishlist', array('student_id' => $student_id,'product_id'=>$prod_id));
			return $query->result();
	}
	// add THE wishlist
	public function add_wishlist($product_id = '',$user_id){
		$data = array(
			'student_id' => $user_id,
			'product_id' => $product_id
		);

		$query = $this->db->insert('wishlist', $data);
		return $query;
	}
	// DELETE THE wishlist
	public function delete_wishlist($cat_id = ''){
		$query = $this->db->delete('wishlist', array('id' => $cat_id));
		return $query;
	}
	
}
	

?>