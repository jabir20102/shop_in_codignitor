<div class="container">
	<div class="row">
		<div class="col mx-auto bg-light rounded">
			<div class="border-bottom">
				<div class="container-fluid">
					<h3 class="pt-4 pb-3">Orders</h3>
				</div>
			</div>
			
			<div class="table-responsive my-4">

				<table class="table table-bordered">
				  <thead>
				    <tr>
				      <th>S. No</th>
				      <th>User</th>
				      <th>Date</th>
				      <th>Products</th>
				    </tr>
				  </thead>
				  <tbody>


					<?php
					$orders = $this->crud_model->get_orders();

					//config for the pagition
			  		$config = array(
			  			'base_url' => base_url('admin/orders'),
			  			'total_rows' => count($orders),
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

			  		$orders = $this->crud_model->get_orders('',$config['per_page'],$offset);
			  		$i=0;
					foreach($orders as $order){
						$i++;
						$sells = $this->crud_model->get_sells($order->id);

						echo '<tr>';
				    	echo '<td>'.($i+$offset).'</td>';
				    	echo '
				    	<td><a href="'.base_url('admin/viewUser/'.$order->user_id).'" class="btn btn-success btn-sm" >View User</td>
				    	';
				    	echo '<td>'.$order->added_date.'</td>';
				    	$prod='<td><table class="table table-bordered"">';
				    	foreach ($sells as $sell) {
				    		$product=$this->crud_model->get_products($sell->product_id);
				    		$category=$this->crud_model->get_categories($sell->category);
				    		$prod.='<tr>
				    		<td><a href="'.base_url('product/'.$product->slug.'/'.$product->id).'" >'. $product->title.'</a></td>
				    		<td>'.$category->cat_name.'</td>
				    		<td>Rs '.$product->price.'</td>
				    		</td>
				    		<td>Qty '.$sell->quantity.'</td>
				    		<td>Off '.($sell->offer*100).'%</td>
				    		</tr>
				    		';
				    	}
				    	$prod.='</table></td>';
				    	
				    	echo $prod;
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