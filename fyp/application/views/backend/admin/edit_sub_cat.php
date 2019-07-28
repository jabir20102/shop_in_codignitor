<div class="col-md-8 mx-auto bg-light rounded">
	<div class="container-fluid border-bottom">
		<div>
			<a href="<?php echo base_url('admin/sub-categories'); ?>"><button class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i></button></a><h3 class="pt-4 pb-3 ml-3 d-inline-block">Edit Sub Category</h3>
		</div>
	</div>

	<div class="container py-3">
		<div class="mx-auto">
			<form action="<?php echo base_url('admin/change_sub_cat/update'); ?>" method="POST" >
			    <?php
					$var = $this->input->post('sub-cat-id');
					if(isset($var)){
						$cat_id = $this->input->post('sub-cat-id');
					}
					else{
						$cat_id = $this->session->flashdata('sub-cat-id');
					}

					$sub_cat = $this->crud_model->get_sub_cat($cat_id);
				?>

				<h4 class="pb-3">Current Sub Category: <?php echo $sub_cat->sub_cat_name; ?></h4>

		        <div class="form-group">
		          <label for="sub-cat-name">Rename Sub Category</label>
		          <input type="text" class="form-control" id="sub-cat-name" name="sub-cat-name" placeholder="Enter Sub Category Name" required>
		        </div>

				<div class="form-group">
			    	<label for="select-category">Change Main Category</label>
				    <select class="form-control" name="select-category" id="select-category">
				    	<?php 
				    	$categories = $this->crud_model->get_categories();

						// display all main categories in select option
				    	foreach($categories as $cat){
				    		echo '<option value="'.$cat->id.'" '.$selected.'>';
				    		echo $cat->cat_name;
				    		echo '</option>';
				    	}
				    	?>
				    </select>
			    </div>

				<input type="hidden" name="sub-cat-id" value="<?php echo $cat_id; ?>">

		        <button type="submit" class="btn btn-primary">Update Sub Category</button>

		        <div class="<?php echo $this->session->flashdata('class');?>" role="alert">
				  <?php echo $this->session->flashdata('error'); ?>
				</div>
			</form>
		</div>
		
	</div>
</div>
