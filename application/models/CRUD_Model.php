<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CRUD_Model extends CI_Model{

	public function __construct(){
		parent::__construct();
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

	//  for ajax call

 public function fetch_sub_cat_by_ajax($cat_id)
 {
  $query = $this->db->get_where('sub_categories', array('parent_cat_id' => $cat_id));
  $output = '<option value="">Select State</option>';
  foreach($query->result() as $row)
  {
   $output .= '<option value="'.$row->id.'">'.$row->sub_cat_name.'</option>';
  }
  return $output;
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
	public function add_product(){

		$data = array(
			'title' => $this->input->post('title'),
			'slug' => url_title($this->input->post('title'), 'dash', TRUE),
			'description' => $this->input->post('description'),
			'details' => $this->input->post('details'),
			'price' => $this->input->post('price'),
			'category' => $this->input->post('cat_id'),
			'sub_category' => $this->input->post('sub_cat_id'),
			'tags' => $this->input->post('tags-input'),
			'date_added' => date('Y-m-d')
		);

		// return $data;
		$query = $this->db->insert('product', $data);
		   $insertId = $this->db->insert_id();
		   return  $insertId;
	}

	// GETTING ALL TUTORIALS OR BY TUTORIAL ID  
	public function get_products($prod_id = '', $order_by = '', $limit = '', $offset = '',$keywords=''){
		if($keywords!==''){
			$query = "SELECT * FROM product where ";
			$query .= " title like  '%$keywords%' ";
			$query .= "order by visits desc limit 8 ";
			 
			 return $this->db->query($query)->result();

		}
		if($prod_id !== ''){
			// getting specific tutorial if tutorial id is passed in parameter
			$query = $this->db->get_where('product', array('id' => $prod_id));
			return $query->row();
		}

		else if($order_by !== '' && $limit !== '' ){
			// echo "order by id with limit ";
			$this->db->order_by('id', 'DESC');
			$query = $this->db->limit($limit, $offset)
							  ->get('product');
			return $query->result();
		}
		else if($order_by !== '' && $limit === '' ){
			// echo "order by id" ;
			$this->db->order_by('id', 'DESC');
			$query = $this->db->get('product');
			return $query->result();
		}
		else if($order_by === '' && $limit !== '' ){
			// echo "order by visits";
		$this->db->order_by('visits', 'DESC');
			$query = $this->db->limit($limit, $offset)
							  ->get('product');
			return $query->result();
		}else{
		// getting all tutorials
			// echo "else";
		$query = $this->db->get('product');		
		$this->db->order_by('visits', 'DESC');
		return $query->result();
	}
	}
	// GETTING ALL TUTORIALS OR BY TUTORIAL category  
	public function get_product_by_cat($prod_id = '', $order_by = '', $limit = '', $offset = ''){
		if($prod_id !== '' && $limit===''){
			// getting specific tutorial if tutorial id is passed in parameter
			$query = $this->db->get_where('product', array('category' => $prod_id));
			return $query->result();
		}

		if($order_by !== ''){
			// getting all tutorials ordered by count in descending order
			$query = $this->db->get('product');
			$this->db->order_by($order_by, 'DESC');
			return $query->result();
		}
		if($prod_id !== '' && $limit !== ''){	
		$this->db->order_by('visits', 'DESC');
			$query = $this->db->limit($limit, $offset)
							 ->get_where('product', array('category' => $prod_id));
			return $query->result();
		}
	}
	// filter prodducts
	public function filter_product($cat_id = '', $sub_cat = '',$min='',$max='', $limit = '', $offset = ''){
		if($cat_id !== '' && $min !== '' && $min !== ''  && $limit===''){
			
			
			$query = "SELECT * FROM product where ";
			$query .= "price BETWEEN '".$min."' AND '".$max."' ";
			$query .= " and category = $cat_id ";
			if($sub_cat!=null){
			$sub_cat_filter = implode("','", $sub_cat);
			$query .= "AND sub_category IN('".$sub_cat_filter."') ";
			}
			$query .= "order by visits desc ";
			 
			 return $this->db->query($query)->result();
		}

		if($cat_id !== '' && $min !== '' && $min !== ''  && $limit!==''){
			if($offset=='')$offset=0;

			$query = "SELECT * FROM product where ";
			$query .= "price BETWEEN '".$min."' AND '".$max."' ";
			$query .= " and category = $cat_id ";
			if($sub_cat!=null){
			$sub_cat_filter = implode("','", $sub_cat);
			$query .= "AND sub_category IN('".$sub_cat_filter."') ";
			}			
			$query .= "order by visits desc ";
			$query .= 'LIMIT '.$offset.' ,' . $limit;
			 
			 return $this->db->query($query)->result();
		}
	}
	//  get related prodducts 
	public function get_related_products($cat_id = '',$sub_cat_id='' ){
		if($cat_id !== '' && $sub_cat_id !==''){
			$query = $this->db->limit(4, 0)->order_by('visits','desc')->get_where('product', array('category' => $cat_id,'sub_category'=>$sub_cat_id));


			 
			return $query->result();
		}else{
			$query = $this->db->limit(4, 0)->order_by('visits','desc')->get_where('product', array('category' => $cat_id));
			return $query->result();
		}
	}
	// add offer product
public function add_offer($product_id,$percent){

		$data = array(
			'product_id' => $product_id,
			'percent' => $percent,
			'added_date' => date('Y-m-d')
		);

		// return $data;
		$query = $this->db->insert('offer', $data);
		   return  $query;
	}	
	//  delete expire offers
	public function delete_expire_offers($product_id=''){
		if($product_id!==''){
		$query = $this->db->delete('offer', array('product_id' => $product_id));
		return $query;
		}
		$this->db->query("DELETE FROM offer where added_date < DATE_SUB(NOW(), INTERVAL 7 DAY)");
	}
	// GETTING ALL offer products  
	public function get_offer_products($prod_id='', $limit = '', $offset = ''){
		if($prod_id !== ''){
			$query = $this->db->get_where('offer', array('product_id' => $prod_id));
			return $query->row();
		}
		 if( $limit !== '' ){
			// echo "order by visits";
		$this->db->order_by('id', 'DESC');
			$query = $this->db->limit($limit, $offset)
							  ->get('offer');
			return $query->result();
		}else{
		// getting all offer prodducts
			// echo "else";
		$query = $this->db->get('offer');		
		$this->db->order_by('id', 'DESC');
		return $query->result();
	}
	}

	

// GETTING ALL images  BY product ID  
	public function get_images($tut_id = ''){
		if($tut_id !== ''){
			// getting specific product images  if product id is passed in parameter
			$query = $this->db->get_where('images', array('product_id' => $tut_id));
			return $query->result();
		}
	}
	
	// CHANGE ADMIN IMAGE
	public function add_image($prod_id = '', $image_url = ''){
		$data = array(
		    'url' => $image_url,
		    'product_id'=> $prod_id
		);

		 $query = $this->db->insert('images', $data);
		return $query;
		
	}
// DELETE THE  image
	public function delete_image($url){
		$query = $this->db->delete('images', array('url' => $url));
		return $query;
	}
// GETTING ALL comments  BY product ID  
	public function get_comments($prod_id = '',$isApproved='', $limit = '', $offset = ''){
		if($prod_id !== '' && $isApproved !==''){
			// getting specific product comments  if product id is passed in parameter
			$query = $this->db->get_where('comments', array('product_id' => $prod_id, 'isApproved'=>1));
			$this->db->order_by('id', 'DESC');
			return $query->result();
		}
		if($limit!==''){

			$this->db->limit($limit, $offset);
			$query = $this->db->get_where('comments', array('isApproved'=>0));
			$this->db->order_by('id', 'DESC');
			return $query->result();
		}
		$query = $this->db->get_where('comments', array('isApproved'=>0));
			$this->db->order_by('id', 'DESC');
			return $query->result();
	}
	// Add comment
	public function add_comments(){
		$data = array(
		    'product_id' => $_POST['product_id'],
		    'name'=> $_POST['name'],
		    'email'=> $_POST['email'],
		    'comment'=> $_POST['comment'],
		    'isApproved'=> 0,
			'added_date' => date('Y-m-d') 
		);

		 $query = $this->db->insert('comments', $data);
		return $query;
		
	}
	// DELETE THE SELECTED comment
	public function edit_comment($comment_id){
		$data = array(
			'isApproved' => 1
		);

		$this->db->where('id', $comment_id);
		$query = $this->db->update('comments', $data);
		return $query;
	}
	// DELETE THE SELECTED comment
	public function delete_comment($comment_id){
		$query = $this->db->delete('comments', array('id' => $comment_id));
		return $query;
	}
	// UPDATE SELECTED TUTORIAL
	public function update_tutorial_view_count($tutorial_id, $count){
		$data = array(
			'visits' => $count
		);

		$this->db->where('id', $tutorial_id);
		$query = $this->db->update('product', $data);
		return $query;
	}

	// DELETE THE SELECTED delete_product
	public function delete_product($prod_id){
		$query = $this->db->delete('product', array('id' => $prod_id));
		return $query;
	}

	//   load comments using scrolling
	public function fetch_comments($limit, $start,$product_id)
 {
  $this->db->select("*");
  $this->db->from("comments");
  $this->db->order_by("id", "DESC");
  $this->db->where("product_id", $product_id);
  $this->db->limit($limit, $start);
  $query = $this->db->get();
  return $query;

							  
 }
 //   load messages using 
	public function fetch_messages($student_id)
 {
  $this->db->select("*");
  $this->db->from("comments");
  $this->db->order_by("id", "DESC");
  $this->db->where("product_id", $product_id);
  $this->db->limit($limit, $start);
  $query = $this->db->get();
  return $query;

							  
 }
 // add an order
 public function add_order($user){
 	$data = array(
			'user_id' => $user,
			'added_date' => date('Y-m-d')
		);

		// return $data;
		$query = $this->db->insert('orders', $data);
		   $insertId = $this->db->insert_id();
		   return  $insertId;
 }
 // add an order
 public function add_sells($product_id,$order_id,$offer,$category,$quantity){
 	if($offer=='') $offer=0;
 	$data = array(
			'product_id' => $product_id,
			'order_id'   => $order_id,
			'offer'      => $offer,
			'category'   => $category,
			'quantity'   => $quantity
		);

		// return $data;
		$query = $this->db->insert('sells', $data);
		   return  $query;
 }
 // GETTING ALL order OR BY TUTORIAL ID  
	public function get_orders($user_id = '', $limit = '', $offset = ''){
		if($user_id !== '' && $limit==''){
			// getting specific tutorial if tutorial id is passed in parameter
			$query = $this->db->get_where('orders', array('user_id' => $user_id));
			return $query->result();
		}
		else if($limit !== '' && $user_id!='' ){
			$query = $this->db->order_by("id", "DESC")->limit($limit, $offset)
							  ->get_where('orders', array('user_id' => $user_id));
			return $query->result();
		}
		else if($limit !== '' && $user_id=='' ){
			$query = $this->db->order_by("id", "DESC")->limit($limit, $offset)
							  ->get('orders');

			return $query->result();
		}
		else{
		$query = $this->db->get('orders');	
		return $query->result();
	}
	}
	public function get_sells($order_id){
		$query = $this->db->get_where('sells', array('order_id' => $order_id));
			return $query->result();
	}
 //   load top sells 
public function top_sells($cat_id){

	 $this->db->select('product_id, COUNT(id) as total');
  	 $this->db->from("sells");
	 $this->db->where("category", $cat_id);
	 $this->db->group_by('product_id'); 
	 $this->db->order_by('total', 'desc'); 
	 $this->db->limit(5, 0);
	 $query=$this->db->get();

  		return $query;

							  
 }

	

}

?>