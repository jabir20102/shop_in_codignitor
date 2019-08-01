<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller{

	public function __construct(){
		parent::__construct();	

		$this->crud_model->delete_expire_offers();
	}

	// FOR HOME PAGE
	public function index(){


		$data['page_title'] = 'Home';
		$data['page_name'] = 'home';
		$data['active'] = 'home';

		$this->load->view('frontend/index', $data, FALSE);
		
	}
	public function comments()
 {
  $output = '';
  $data = $this->crud_model->fetch_comments($this->input->post('limit'), $this->input->post('start'), $this->input->post('product_id'));
  if($data->num_rows() > 0)
  {
   foreach($data->result() as $comment)
   {
    $output .= '
    <div class="fables-comments">
      <p>
          <span class="fables-fifth-text-color font-14">Posted By</span>
          <a href="" class="fables-forth-text-color fables-second-hover-color font-15 bold-font ml-1">'. $comment->name.'</a>
          <span class="fables-forth-text-color float-right font-14">'.$comment->added_date.'</span>
      </p>
      <p class="font-14 fables-fifth-text-color">
         '.$comment->comment.' 
      </p>
  </div>
  <hr>
    ';
   }
  }
  echo $output;
 }

	

	// FOR SINGAL product
	public function product($slug = '', $id = -1){

		if(empty($slug) || is_numeric($slug)){
			show_404();
		}

		   $product = $this->crud_model->get_products($id);
		   if($product==null){
		   	show_404();
		   }
			//if student view the tutorial details then view is counted
			$count = $product->visits + 1;
			$result = $this->crud_model->update_tutorial_view_count($id, $count);

			$isOffer=$this->crud_model->get_offer_products($product->id);
			
		 $category=$this->crud_model->get_categories($product->category);

		$data['page_title'] = $product->title;
		$data['page_name'] = 'single_product';
		$data['product'] = $product;
		$data['isOffer'] = $isOffer;
		$data['active'] = url_title($category->cat_name, 'dash', TRUE);
		

		$this->load->view('frontend/index', $data, FALSE);
	}

	

	// TO SHOW products OF SPECIFIC  CATEGORY
	public function categories($slug, $id){

		$sub_categories = $this->crud_model->get_sub_by_parent_cat($id);

		$products = $this->crud_model->get_product_by_cat($id);
                  
          //config for the pagition
            $config = array(
              'base_url' => base_url('categories/'.$slug.'/'.$id),
              'total_rows' => count($products),
              'per_page' => 6
            );

            $this->pagination->initialize($config);

            $page = $this->input->get('page');
            if(!isset($page)){
              // offset for the first page will be zero
              $offset = $this->input->get('page');
            }
            else{
              // offset for the other than first page
              $offset = $this->input->get('page')*$config['per_page']-$config['per_page'];
            }

            $products = $this->crud_model->get_product_by_cat($id,'',$config['per_page'],$offset);


		$data['page_title'] = ''.ucwords($slug).' Products';
		$data['page_name'] = 'store';
		$data['category'] = $id;
		$data['category_name'] = ucwords($slug);
		$data['sub_categories'] = $sub_categories;
		$data['products'] = $products;
		$data['offer'] = false;
		$data['active'] = $slug;
		
		$this->load->view('frontend/index', $data, FALSE);
	}
	// TO SHOW products OF SPECIFIC sub CATEGORY
	public function sub_categories(){
		 $id=$_GET['category'];			//  $id is for category

		 $sub_category=array();
		 if(!empty($_GET['sub_category'])){
		 $sub_category=$_GET['sub_category'];
		}
		 $minPrice=$_GET['min-price'];
		 $maxPrice=$_GET['max-price'];


		$sub_categories = $this->crud_model->get_sub_by_parent_cat($id);

		$products = $this->crud_model->filter_product($id,$sub_category,$minPrice,$maxPrice,'','');

		 $arg="?min-price=$minPrice&max-price=$maxPrice&category=$id";
		 foreach ($sub_category as $sub_cat) {
		 	$arg.="&sub_category[]=".$sub_cat;
		 }
		
                  
          //config for the pagition
            $config = array(
              'base_url' => base_url('sub_categories'.$arg),
              'total_rows' => count($products),
              'per_page' => 6
            );

            $this->pagination->initialize($config);

            $page = $this->input->get('page');
            if(!isset($page)){
              // offset for the first page will be zero
              $offset = $this->input->get('page');
            }
            else{
              // offset for the other than first page
              $offset = $this->input->get('page')*$config['per_page']-$config['per_page'];
            }

            $products = $this->crud_model->filter_product($id,$sub_category,$minPrice,$maxPrice,$config['per_page'],$offset);
            $category=$this->crud_model->get_categories($id);

		$data['page_title'] = $category->cat_name.' Products';
		$data['page_name'] = 'store';
		$data['category'] = $id;
		$data['category_name']=$category->cat_name;
		$data['sub_categories'] = $sub_categories;
		$data['products'] = $products;
		$data['offer'] = false;
		$data['active'] = url_title($category->cat_name, 'dash', TRUE);
		
		$this->load->view('frontend/index', $data, FALSE);
	}
	// TO SHOW offer products
	public function offer_products(){
		$offers = $this->crud_model->get_offer_products();
		//config for the pagition
            $config = array(
              'base_url' => base_url('offer-products'),
              'total_rows' => count($offers),
              'per_page' => 6
            );

            $this->pagination->initialize($config);

            $page = $this->input->get('page');
            if(!isset($page)){
              // offset for the first page will be zero
              $offset = $this->input->get('page');
            }
            else{
              // offset for the other than first page
              $offset = $this->input->get('page')*$config['per_page']-$config['per_page'];
            }

            $products = $this->crud_model->get_offer_products('',$config['per_page'],$offset);

		

		$data['page_title'] = "Offer Products ";
		$data['page_name'] = 'store';
		$data['category'] = 1;
		$data['category_name']='Offers';
		$data['sub_categories']  = array();
		$data['products'] = $products;
		$data['offer'] = true;
		$data['active'] = 'home';
		
		$this->load->view('frontend/index', $data, FALSE);
	}
// TO SHOW Contact us page
	public function contactUs(){

		// $tutorials = $this->crud_model->get_tutorials_by_subcat($id);

		$data['page_title'] = 'Contact Us';
		$data['page_name'] = 'contactUs';
		// $data['tutorials'] = $tutorials;
		$data['active'] = 'contactUs';
		
		$this->load->view('frontend/index', $data, FALSE);
	}
	// contact us
	public function contact(){
			 $name=$this->input->post('name');
			 $email=$this->input->post('email');
			 $subject=$this->input->post('subject');
			 $msg='  From:-'.$name.'<br><br>'.$this->input->post('msg');
			$config = Array(
		         'protocol'  => 'smtp',
		         'smtp_host' => 'smtp.googlemail.com',
		         'smtp_port' => 465,
		         'smtp_user' => '', // your gmail username and pass
		         'smtp_pass' => '', 
		         'mailtype'  => 'html',
		         'charset'  => 'iso-8859-1',
		         'smtp_crypto'   => 'ssl',
		         'wordwrap'  => TRUE
		      );
		       	$this->load->library('email');
			    $this->email->initialize($config);
			    $this->email->set_newline("\r\n");
			    $this->email->from($email);
			    $this->email->to("pakcricket131@gmail.com");
			    $this->email->subject($subject);
			    $this->email->message($msg);

			  
			    
        if($this->email->send()) {
			    $this->session->set_flashdata('error', 'Thank you for your suggestion....');
				$this->session->set_flashdata('class', 'alert-success alert mt-3');
				redirect(base_url('contactUs'),'refresh');
        }else{
				$this->session->set_flashdata('error', 'An error accured while sending your suggestion...');
				$this->session->set_flashdata('class', 'alert-danger alert mt-3');
				redirect(base_url('contactUs'),'refresh');
        }
	}
// TO SHOW about us page
	public function about(){

		// $tutorials = $this->crud_model->get_tutorials_by_subcat($id);

		$data['page_title'] = 'About Us';
		$data['page_name'] = 'about';
		// $data['tutorials'] = $tutorials;
		$data['active'] = 'about';
		
		$this->load->view('frontend/index', $data, FALSE);
	}
	// TO SHOW checkout page
	public function checkout(){

		// $tutorials = $this->crud_model->get_tutorials_by_subcat($id);

		$data['page_title'] = 'Check out';
		$data['page_name'] = 'checkout';
		// $data['tutorials'] = $tutorials;
		$data['active'] = 'checkout';
		
		$this->load->view('frontend/index', $data, FALSE);
	}

	//  return sub_categories
	public function fetch_sub_category() {
		  if($this->input->post('categories'))
		  {
		   echo $this->crud_model->fetch_sub_cat_by_ajax($this->input->post('categories'));
		  }
		 }
	//   add comment
	public function add_comment(){
		$result = $this->crud_model->add_comments();
		if($result){
					// if new tutorial is created
            		echo "Your comment is added";
				}
				else{
					// cannot add the tutorial to database
            	echo $error = $this->db->error();
				}
		
		}
		//  add_to_cart
		function add_to_cart()
 {
 	$id=$_POST["product_id"];
 	$product=$this->crud_model->get_products($id);
 	$isOffer=$this->crud_model->get_offer_products($id);
 	
 	if($isOffer!=null){
 		$percent=$isOffer->percent;
 		$price=$product->price*(1-$percent); 
	 	$offer=true;
	 }else{
 		$price=$product->price;
 		$offer=false;
 		$percent='';

	 }
  $this->load->library("cart");
  $data = array(
   "id"  => $id,
   "url" => $_POST["url"],
   "name"  => $product->title,
   "qty"  => $_POST["quantity"],
   "price"  => $price,
   "offer"  => $percent
  );
  $this->cart->insert($data); //return rowid 
  echo $this->view_cart();
 }

 function load_cart()
 {
  echo $this->view_cart();
 }

 function remove_from_cart()
 {
  $this->load->library("cart");
  $row_id = $_POST["row_id"];
  $data = array(
   'rowid'  => $row_id,
   'qty'  => 0
  );
  $this->cart->update($data);
  echo $this->view_cart();
 }

 function clear_cart()
 {
  $this->load->library("cart");
  $this->cart->destroy();
  echo $this->view_cart();
 }
 
 function view_cart()
 {
  $this->load->library("cart");
  $output = '';
  $output .= '
  <p class="fables-second-text-color semi-font mb-4 font-17">('.count($this->cart->contents()).') Items in my cart</p>
  ';
  $count = 0;
  foreach($this->cart->contents() as $items)
  {
  	$offers='';
  	if($items["offer"]!=''){
  		$offers= '<span  class="sale fables-second-background-color text-center">
                                        '.($items["offer"]*100).'% Off</span>';
  	}
   $count++;
   $output .= '
   <div class="row mx-0 mb-3">
                                                 <div class="col-4 p-0">
                                                     <a href="'. base_url('product/'.url_title($items["name"], 'dash', TRUE).'/'.$items["id"]).'">'.$offers.'<img src="'. $items["url"].'" alt="" class="w-100"></a>
                                                                                                      </div>
                                                 <div class="col-8">
                                                     <h2><a href="'. base_url('product/'.url_title($items["name"], 'dash', TRUE).'/'.$items["id"]).'" class="fables-main-text-color font-13 d-block fables-main-hover-color">'.$items["name"].'</a></h2>
                                                     <p class="fables-second-text-color font-weight-bold">Rs '.$items["subtotal"].'</p>
                                                     <p class="fables-forth-text-color">QTY : '.$items["qty"].'
                                                     <p style="color:red;cursor:pointer;" class=" remove_inventory" id="'.$items["rowid"].'">Remove</p>
                                                     </p>


                                                 </div>
                                             </div>
   ';
  }
  $output .= '
  

  </div>
  <span class="font-16 semi-font fables-main-text-color">TOTAL</span>
                                             <span class="font-14 semi-font fables-second-text-color float-right">Rs '.$this->cart->total().'</span>
                                             <hr>
                                             <div class="text-center">
                                                 <button type="button" id="clear_cart" class="fables-second-background-color fables-btn-rounded  text-center white-color py-2 px-3 font-14 bg-hover-transparent border fables-second-border-color fables-second-hover-color">Clear Cart</button>
                                                <a href="'.base_url('Home/checkout').'" class="fables-second-text-color border fables-second-border-color fables-btn-rounded text-center white-color p-2 px-4 font-14 fables-second-hover-background-color">Checkout</a>
                                             </div>
  ';

  if($count == 0)
  {
   $output = '<p align="center">Cart is Empty</p>';
  }
  return $output;
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