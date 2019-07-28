<div class="container">
	<div class="row">
		<div class="col-md-8 mx-auto bg-light rounded">
			<div class="border-bottom">
				<div class="container-fluid">
					<h3 class="pt-4 pb-3">Categories</h3>
				</div>
			</div>
			<div class="border-bottom">
				<div class="container mt-4 mb-3">
					<a href="<?php echo base_url('admin/categories/add-category'); ?>"><button class="btn btn-primary mr-2">Add Category</button></a>
					<a href="<?php echo base_url('admin/sub-categories'); ?>"><button class="btn btn-primary">Manage Sub Category</button></a>
				</div>
			</div>
			<div class="<?php echo $this->session->flashdata('class');?>" role="alert">
				  <?php echo $this->session->flashdata('error'); ?>
			</div>
			<div class="table my-2">

				<table class="table table-bordered">
				  <thead>
				    <tr>
				      <th>Categories</th>
				      <th>Sub Categories</th>
				      <th colspan="2">Actions</th>
				    </tr>
				  </thead>
				  <tbody>

					<?php 

						$categories = $this->crud_model->get_categories();

						foreach($categories as $cat){

							$sub_categories = $this->crud_model->get_sub_by_parent_cat($cat->id);

							echo '<tr>';
							echo '<td>'.$cat->cat_name.'</td>';
							echo '<td><ul>';

							foreach($sub_categories as $sub_cat){
								echo '<li>'.$sub_cat->sub_cat_name.'</li>';
							}

							echo '</ul></td>';

							echo '<td><form action="'.base_url('admin/categories/edit-category').'" method="post"><input type="hidden" name="cat-id" value="'.$cat->id.'"><button type="submit" class="btn btn-primary">Edit</button></form></td>';

				      		echo '<td><form action="'.base_url('admin/change-category/delete').'" method="post"><input type="hidden" name="cat-id" value="'.$cat->id.'"><button type="submit" class="btn btn-danger">Delete</button></form></td>';

				      		echo '</tr>';
						}
					?>

				  </tbody>
				</table> <!-- end table -->

				<div>
				  <!-- <ul class="pagination pagination-sm">
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
				  </ul> -->
				</div> <!-- end pagition -->
			</div> <!-- end table div -->
		</div><!-- end col -->
	</div> <!-- end row -->
</div> <!-- end container -->