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
	// ADD login details
	public function set_login_details($user_id){
		$data = array(
			'user_id' => $user_id
		);

		$query = $this->db->insert('login_details', $data);
		return $this->db->insert_id();
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
	// Updates update_last_activity 
	public function m_update_last_activity(){ 
		$data = array(
  		  'last_activity' => date('Y-m-d h:i:s', time())
		);

		$this->db->where('login_details_id', $this->session->userdata('login_details_id'));
		$query = $this->db->update('login_details', $data);
		return $query;
	}
	//   it is called from admin side ajax call
	public function fetch_user_last_activity($user_id){
		$this->db->order_by('login_details_id ', 'DESC');
			$query = $this->db->limit(1);
		$query = $this->db->get_where('login_details ', array('user_id '=>$user_id ));
			return $query->result();
	}
public function minsert_chat(){
	$_to=$this->input->post('to_user_id');
	$_from=$this->input->post('from_user_id');
    $msg=$this->input->post('chat_message');
 $query = "
INSERT INTO chat_message 
(to_user_id, from_user_id, chat_message, status) 
VALUES ('$_to', '$_from', '$msg','-1')
";
return $this->db->query($query)->result();

}
// for the all chat history
public function mclear_chat(){
	$_to=$this->input->post('to_user_id');
	 $_from=$this->input->post('from_user_id');

 $where = "(to_user_id=$_to or from_user_id=$_to) and status!=-1 and status!=$_from";
// status!=$_from_user_id"  means if user again clear chat then it should not delte chat
	  $this->db->where($where);
      $this->db->delete('chat_message'); 
  return $this->db->affected_rows() ;
 
}
public function mclear_chat1(){
	 $_to=$this->input->post('to_user_id');
	 $_from=$this->input->post('from_user_id');
  $query = "
UPDATE `chat_message` SET `status`=$_from WHERE to_user_id=$_to or from_user_id=$_to and status=-1
 ";
 $result=$this->db->query($query)->result();
}
//   for the single message
public function mdel_msg(){
	$_chat_message_id=$this->input->post('chat_message_id');
	 $_from=$this->input->post('from_user_id');

  $where = "chat_message_id=$_chat_message_id  and status!=-1 and status!=$_from";
// status!=$_from_user_id"  means if user again clear chat then it should not delte chat
	  $this->db->where($where);
      $this->db->delete('chat_message'); 
  return $this->db->affected_rows() ;
 
}
public function mdel_msg1(){
	 $_chat_message_id=$this->input->post('chat_message_id');
	 $_from=$this->input->post('from_user_id');
  $query = "
UPDATE `chat_message` SET `status`=$_from WHERE chat_message_id=$_chat_message_id  and status=-1
 ";
 $result=$this->db->query($query)->result();
}
//  fetching all messages
public function mfetch_user_chat_history($to,$from){
 $query = "
 SELECT * FROM chat_message 
 WHERE (to_user_id = '".$to."' or from_user_id = '".$to."') and status!='".$from."'
 ORDER BY timestamp DESC
 ";
 $result=$this->db->query($query)->result();
 $output = '';
 foreach($result as $row)
 {
  $user_name = '';
  

  if($row->from_user_id == $from)
  {
     $img= '';
        $output .= '
  <div class="d-flex justify-content-end mb-4">
								
								

								<div id="msg_'.$row->chat_message_id.'" class="msg_cotainer_send" style="min-width:100px;">
									'.$row->chat_message.'
									<span class="msg_time_send">'.$row->timestamp.'</span>
								</div>
								<div class="img_cont_msg my_img">
								
							<img src="" class="rounded-circle user_img_msg">
							</div>
							 <i style="color:white;font-size:18px;" onclick="del_msg('.$row->chat_message_id.')" class="fa fa-trash-o"></i>

								
								
							</div>
  ';
  }
  else
  {
   $output .= '
  <div class="d-flex justify-content-start mb-4">
 			<div class="img_cont_msg user_img">
								
							<img src="" class="rounded-circle user_img_msg">
							</div>
							 <i style="color:white;font-size:18px;" onclick="del_msg('.$row->chat_message_id.')" class="fa fa-trash-o"></i>
								
								<div id="msg_'.$row->chat_message_id.'" class="msg_cotainer" style="min-width:100px;">
									'.$row->chat_message.'
									<span class="msg_time">'.$row->timestamp.'</span>
								</div>
								
								
							</div>
  ';
  }
  
 }
 // $output .= '</ul>';
 return $output;
}

public function get_user_name($user_id)
{
	if($user_id==0){
		return "Admin";
	}
 $query = "SELECT name FROM student WHERE id = '$user_id'";
 $result=$this->db->query($query)->result();
 foreach($result as $row)
 {
  return $row['name'];
 }
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
	// GETTING ALL get_messages OR BY student ID  
	public function get_messages($student_id = ''){
		if($student_id !== ''){
			$query = "SELECT * FROM chat where ";
			$query .= "_from=$student_id or _to = $student_id ";
			$query .= "order by id desc ";
			 
			 return $this->db->query($query)->result();
		}

		
	
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