<div class="col-md-8 mx-auto bg-light rounded">
	<div class="container-fluid border-bottom">
		<div>
			<a href="<?php echo base_url('admin/categories'); ?>"><button class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i></button></a>
			<h3 class="pt-4 pb-3 ml-3 d-inline-block">Edit Category</h3>
		</div>
	</div>

	<div class="container py-3">
		<div class="w-50 mx-auto">
			<form action="<?php echo base_url('admin/change_category/update'); ?>" method="POST" >
				<?php
					$var = $this->input->post('cat-id');
					if(isset($var)){
						$cat_id = $this->input->post('cat-id');
					}
					else{
						$cat_id = $this->session->flashdata('cat-id');
					}
				?>
		        <div class="form-group">
		          <label for="cat-name">Category Name</label>
		          <input type="text" class="form-control" id="cat-name" name="cat-name" placeholder="Rename Category" required>
		          <input type="hidden" name="cat-id" value="<?php echo $cat_id; ?>">
		        </div>

		        <button type="submit" class="btn btn-primary">Update Category</button>

		        <div class="<?php echo $this->session->flashdata('class');?>" role="alert">
				  <?php echo $this->session->flashdata('error'); ?>
				</div>
			</form>
		</div>
		
	</div>
</div>

