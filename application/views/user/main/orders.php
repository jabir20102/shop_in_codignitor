<div class="container">
	<div class="row">
		<div class="col mx-auto bg-light rounded">
			<div class="border-bottom">
				<div class="container-fluid">
					<h3 class="pt-4 pb-3">My Orders</h3>
				</div>
			</div>
			
			<div class="table-responsive my-4">

				<table class="table table-bordered">
				  <thead>
				    <tr>
				      <th>Title</th>
				      <th>Category</th>
				      <th>Photos</th>
				      <th>Actions</th>
				    </tr>
				  </thead>
				  <tbody>


					<?php
					// $products = $this->crud_model->get_products('','id');

					// //config for the pagition
			  // 		$config = array(
			  // 			'base_url' => base_url('user/orders'),
			  // 			'total_rows' => count($products),
			  // 			'per_page' => 3
			  // 		);

			  // 		$this->pagination->initialize($config);

			  // 		$page = $this->input->get('page');
			  // 		if(!isset($page)){
			  // 			// offset for the first page will be zero
			  // 			$offset = $this->input->get('page');
			  // 		}
			  // 		else{
			  // 			// offset for the other than first page
			  // 			$offset = $this->input->get('page')*$config['per_page']-$config['per_page'];
			  // 		}

			  // 		$products = $this->crud_model->get_products('','id',$config['per_page'],$offset);

					// foreach($products as $product){

					// 	$cat = $this->crud_model->get_categories($product->category);
					// 	 // /'.$tutorials[$index]->slug.'/'.$tutorials[$index]->id);
					// 	echo '<tr>';
				 //    	echo '<td>'.$product->title.'</td>';
				 //    	echo '<td>'.$cat->cat_name.'</td>';
				 //    	echo '<td>  

				 //    	<!-- <form action="'.base_url('admin/all-tutorials/photos').'" method="post"><input type="hidden" name="tut-id" value="'.$product->id.'"><button type="submit" class="btn btn-primary">Photos</button></form>  -->
				 //    	<a class="btn btn-primary" href="'.base_url('admin/all-tutorials/photos/?product-id='.$product->id).'">Photos</a>
				 //    	</td>';
				 //    	echo '<td><form action="'.base_url('admin/all-tutorials/delete').'" method="post"><input type="hidden" name="tut-id" value="'.$product->id.'"><button type="submit" class="btn btn-danger">Delete</button></form></td>';
					// }

					?>

				  </tbody>
				</table> <!-- end table -->

				<div>
				  <?php
					echo $this->pagination->create_links();
				  ?>
				</div> <!-- end pagition -->
			</div> <!-- end table div -->
		</div><!-- end col -->
	</div> <!-- end row -->
</div> <!-- end container -->