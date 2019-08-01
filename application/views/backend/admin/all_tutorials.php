<div class="container">
	<div class="row">
		<div class="col mx-auto bg-light rounded">
			<div class="border-bottom">
				<div class="container-fluid">
					<h3 class="pt-4 pb-3">All Tutorials</h3>
				</div>
			</div>
			
			<div class="table-responsive my-4">

				<table class="table table-bordered">
				  <thead>
				    <tr>
				      <th>Title</th>
				      <th>Price</th>
				      <th>Category</th>
				      <th>Photos</th>
				      <th>Offer</th>
				      <th>Actions</th>
				    </tr>
				  </thead>
				  <tbody>


					<?php
					$products = $this->crud_model->get_products('','id');

					//config for the pagition
			  		$config = array(
			  			'base_url' => base_url('admin/all-tutorials'),
			  			'total_rows' => count($products),
			  			'per_page' => 3
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

			  		$products = $this->crud_model->get_products('','id',$config['per_page'],$offset);

					foreach($products as $product){
						$offer=$this->crud_model->get_offer_products($product->id);
						 if($offer==null){
				         $checkbox=  '<input class="offerCheckbox" data-id="'.$product->id.'" type="checkbox">';
				        }else{
				    $checkbox= '<input class="offerCheckbox" data-id="'.$product->id.'" type="checkbox" checked >';
				        }

						$cat = $this->crud_model->get_categories($product->category);
						 // /'.$tutorials[$index]->slug.'/'.$tutorials[$index]->id);
						echo '<tr>';
				    	echo '<td><a href="'. base_url('product/'.$product->slug.'/'.$product->id).'" class="fables-main-text-color fables-store-product-title fables-second-hover-color">'.$product->title.'</a></td>';
				    	echo '<td>'.$product->price.'</td>';
				    	echo '<td>'.$cat->cat_name.'</td>';
				    	echo '<td>  

				    	<!-- <form action="'.base_url('admin/all-tutorials/photos').'" method="post"><input type="hidden" name="tut-id" value="'.$product->id.'"><button type="submit" class="btn btn-primary">Photos</button></form>  -->
				    	<a class="btn btn-primary" href="'.base_url('admin/all-tutorials/photos/?product-id='.$product->id).'">Photos</a>
				    	</td>';
				    	echo '
				    	<td>'.$checkbox.'</td>';
				    	echo '<td><form action="'.base_url('admin/all-tutorials/delete').'" method="post"><input type="hidden" name="tut-id" value="'.$product->id.'"><button type="submit" class="btn btn-danger">Delete</button></form></td>';
					}

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