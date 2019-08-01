<div class="container">
	<div class="row">
		<div class="col mx-auto bg-light rounded">
			<div class="border-bottom">
				<div class="container-fluid">
					<h3 class="pt-4 pb-3">My Wishlist</h3>
				</div>
			</div>
			
			<div class="table-responsive my-4">

				<table class="table table-bordered">
				  <thead>
				    <tr>
				      <th>Title</th>
				      <th>Category</th>
				      <th>Actions</th>
				    </tr>
				  </thead>
				  <tbody>


					<?php
		    	   $student_id	= $this->session->userdata('student_id');
    				
					$wishlists = $this->user_model->get_wishlist($student_id);

					//config for the pagition
			  		$config = array(
			  			'base_url' => base_url('user/wishlist'),
			  			'total_rows' => count($wishlists),
			  			'per_page' => 5
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

			  		$wishlists = $this->user_model->get_wishlist($student_id,'',$config['per_page'],$offset);

			  		
					
					foreach($wishlists as $wishlist){
						$product= $this->crud_model->get_products($wishlist->product_id);

						$cat = $this->crud_model->get_categories($product->category);

						echo '<tr>';
				    	echo '<td><a href="'. base_url('product/'.$product->slug.'/'.$product->id).'" class="fables-main-text-color fables-store-product-title fables-second-hover-color">'.$product->title.'</a></td>';
				    	echo '<td>'.$cat->cat_name.'</td>';

				    	echo '<td><form action="'.base_url('user/delete-wishlist').'" method="post"><input type="hidden" name="wishlist-id" value="'.$wishlist->id.'"><button type="submit" class="btn btn-danger">Delete</button></form></td>';
					}


					?>

				  </tbody>
				</table> <!-- end table -->


				<div>
				  <?php
				  if(count($wishlists )==0){
						echo "<p>No wishlist found</p>";
					}
					echo $this->pagination->create_links();
				  ?>
				</div> <!-- end pagition -->
			</div> <!-- end table div -->
		</div><!-- end col -->
	</div> <!-- end row -->
</div> <!-- end container -->