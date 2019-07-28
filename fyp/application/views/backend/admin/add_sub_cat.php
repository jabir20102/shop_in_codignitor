<div class="col-md-8 mx-auto bg-light rounded">
	<div class="container-fluid border-bottom">
		<div>
			<a href="<?php echo base_url('admin/sub-categories'); ?>"><button class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i></button></a>
			<h3 class="pt-4 pb-3 ml-3 d-inline-block">Add Sub Category</h3>
		</div>
	</div>

	<div class="container py-3">
		<div class="mx-auto">
			<form action="<?php echo base_url('admin/change_sub_cat/add'); ?>" method="POST" >
		        <div class="form-group">
		          <label for="sub-cat-name">Sub Category Name</label>
		          <input type="text" class="form-control" id="sub-cat-name" name="sub-cat-name" placeholder="Enter Sub Category Name" required>
		        </div>

				<div class="form-group">
			    	<label for="select-category">Select Main Category</label>
				    <select class="form-control" name="select-category" id="select-category">
				    	<?php 
				    	$categories = $this->crud_model->get_categories();

						// display all main categories in select option
				    	foreach($categories as $cat){
				    		echo '<option value="'.$cat->id.'" >';
				    		echo $cat->cat_name;
				    		echo '</option>';
				    	}
				    	?>
				    </select>
			    </div>

		        <button type="submit" class="btn btn-primary">Add Sub Category</button>
				
		        <div class="<?php echo $this->session->flashdata('class');?>" role="alert">
				  <?php echo $this->session->flashdata('error'); ?>
				</div>
			</form>

		</div>
		
	</div>
</div>
