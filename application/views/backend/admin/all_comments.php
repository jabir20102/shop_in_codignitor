<div class="container">
	<div class="row">
		<div class="col mx-auto bg-light rounded">
			<div class="border-bottom">
				<div class="container-fluid">
					<h3 class="pt-4 pb-3">All Unapproved Comments</h3>
				</div>
			</div>
			
			<div class="table-responsive my-4">

				<table class="table table-bordered">
				  <thead>
				    <tr>
				      <th>Comment</th>
				      <th>Product</th>
				      <th>Posted by</th>
				      <th>Approve</th>
				      <th>Actions</th>
				    </tr>
				  </thead>
				  <tbody>


					<?php
					
				$total_comments=$this->crud_model->get_comments();

					//config for the pagition
			  		$config = array(
			  			'base_url' => base_url('admin/all-comments'),
			  			'total_rows' => count($total_comments),
			  			'per_page' => 10
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

			  		$comments = $this->crud_model->get_comments('','',$config['per_page'],$offset);

			  		
					foreach($comments as $comment)
					{
						$product=$this->crud_model->get_products($comment->product_id);
						

						echo '<tr>';
				    	echo '<td>'.$comment->comment.'</td>';
				    	echo '<td>
				    	<a href="'. base_url('product/'.$product->slug.'/'.$product->id).'" class="fables-main-text-color fables-store-product-title fables-second-hover-color">'.$product->title.'</a>
				    	</td>';
				    	echo '<td>
				    	'.$comment->name.'<br>
				    	<a href="mailto:'.$comment->email.'"> '.$comment->email.'</a>
				    	</td>';
				    	echo '<td><form action="'.base_url('admin/all-comments/edit').'" method="post"><input type="hidden" name="comment-id" value="'.$comment->id.'"><button type="submit" class="btn btn-primary">Approve</button></form></td>';
				    	echo '<td><form action="'.base_url('admin/all-comments/delete').'" method="post"><input type="hidden" name="comment-id" value="'.$comment->id.'"><button type="submit" class="btn btn-danger">Delete</button></form></td>';
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