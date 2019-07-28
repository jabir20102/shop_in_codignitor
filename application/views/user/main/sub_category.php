<div class="container">
	<div class="row">
		<div class="col-md-8 mx-auto bg-light rounded">
			<div class="border-bottom">
				<div class="container-fluid">
					<a href="<?php echo base_url('admin/categories'); ?>"><button class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i></button></a>
					<h3 class="pt-4 pb-3 ml-3 d-inline-block">Sub Categories</h3>
				</div>
			</div>
			<div class="border-bottom">
				<div class="container mt-4 mb-3">

					<form action="<?php echo base_url('admin/sub-categories'); ?>" method="post" class="d-inline-block w-100">
						<div class="form-group">
					    	<label for="select-category">Select Main Category</label>
						    <select class="form-control" name="select-category" id="select-category">
						    	<?php 
						    	$categories = $this->crud_model->get_categories();
						    	$var = $this->input->post('select-category');
						    	
								if(isset($var)){
									$cat_id = $var;
								}
								else{
									$cat_id = $categories['0']->id;
								}

								// display all main categories in select option
						    	foreach($categories as $cat){
						    		$selected = "";
						    		if($cat_id == $cat->id){
										$selected = "selected";
									}
							
						    		echo '<option value="'.$cat->id.'" '.$selected.'>';
						    		echo $cat->cat_name;
						    		echo '</option>';
						    	}
						    	?>
						    </select>
					    </div>
					   
						<button type="submit" name="submit" class="btn btn-primary mr-2">Show Sub Categories</button>
						<a href="<?php echo base_url('admin/sub-categories/add-sub-category'); ?>" class="btn btn-primary" style="color: white;">Add Sub Category</a>
					</form>
					
				</div>
			</div>
			<div class="<?php echo $this->session->flashdata('class');?>" role="alert">
				  <?php echo $this->session->flashdata('error'); ?>
			</div>
			<div class="table my-2 container">

				<table class="table table-bordered">
				  <thead>
				    <tr>
				      <th>Sub Categories</th>
				      <th colspan="2">Actions</th>
				    </tr>
				  </thead>
				  <tbody>

					<?php  
						$sub_categories = $this->crud_model->get_sub_by_parent_cat($cat_id);

						foreach($sub_categories as $sub_cat){
							echo '<tr>';
							echo '<td>'.$sub_cat->sub_cat_name.'</td>';

							echo '<td><form action="'.base_url('admin/sub-categories/edit-sub-category').'" method="post"><input type="hidden" name="sub-cat-id" value="'.$sub_cat->id.'"><button type="submit" class="btn btn-primary">Edit</button></form></td>';

							echo '<td><form action="'.base_url('admin/change_sub_cat/delete').'" method="post"><input type="hidden" name="sub-cat-id" value="'.$sub_cat->id.'"><button type="submit" class="btn btn-danger">Delete</button></form></td>';
							echo '</tr>';
						}
					?>

				  </tbody>
				</table> <!-- end table -->

				<div>
				  <ul class="pagination pagination-sm">
				    <li class="page-item disabled">
				      <a class="page-link" href="#">&laquo;</a>
				    </li>
				    <li class="page-item active">
				      <a class="page-link" href="#">1</a>
				    </li>
				    <li class="page-item">
				      <a class="page-link" href="#">2</a>
				    </li>
				    <li class="page-item">
				      <a class="page-link" href="#">&raquo;</a>
				    </li>
				  </ul>
				</div> <!-- end pagition -->
			</div> <!-- end table div -->
		</div><!-- end col -->
	</div> <!-- end row -->
</div> <!-- end container -->