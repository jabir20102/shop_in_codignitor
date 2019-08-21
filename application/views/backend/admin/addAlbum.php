
<div class="mt-3 py-4" style="background-color: #e9e9e9;">
	<div class="container">
		<h1 style="font-weight: lighter; font-size: 2.8rem;">Create New Product</h1>
	</div>
</div>

<div class="container my-4">
	<div class="col-lg-8">
	

		<form action="<?php echo base_url('teacher/create-tutorial/new'); ?>" method="post" enctype="multipart/form-data">
		    <div class="form-group">
			    <label for="title">Title</label>
			    <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title of Tutorial" required>
		    </div>

		    <div class="form-group">
		    	<label for="short-description">Short Description</label>
		        <textarea class="form-control" id="short-description" rows="5" name="description" placeholder="Enter one line description of tutorial" required></textarea>
		    </div>

		    <div class="form-group">
		    	<label for="long-description">Details</label>
		        <textarea id="long-description" class="form-control" rows="10" name="details" placeholder="Enter Detail Description of Tutorial" required></textarea>
		    </div>
		    <div class="form-group">
		    	<label for="price">Price</label>
		        <input type="number" class="form-control" id="price" name="price" placeholder="Enter price of Product" required>
		    </div>

		    <div class="form-group">
			    <label for="tags-input">Tags</label>
			    <br>
			    <div class="tags-input" data-name="tags-input">
                </div>
			    <span class="form-text text-muted"><strong>Note:-</strong> It is recommended to enter at least 5 keywords</span>
		    </div>

		    

		    <div class="form-group">
			    <label for="categories">Category</label>
			    <select class="form-control" id="categories" name="cat_id">
			    	<option value="">Select State</option>
					<?php
						$categories = $this->crud_model->get_categories();
						// to show all the categories in dropdown
						foreach($categories as $cat){
							echo '<option value="'.$cat->id.'">';
							echo $cat->cat_name;
				    		echo '</option>';
						}
					?>
			    </select>
			</div>

		    <div class="form-group">
			    <label for="sub-categories">Sub Category</label>
			    <select class="form-control" id="sub-categories" name="sub_cat_id">
					<option value="">Select Sub Category</option>
			    </select>
			</div>

		    

			<button type="submit" class="btn btn-primary">Submit</button>
		</form>	
	</div>
</div>