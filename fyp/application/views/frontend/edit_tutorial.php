<div class="mt-3 pt-4" style="background-color: #e9e9e9;">
	<div class="container">
		<h1 style="font-weight: lighter; font-size: 2.5rem;">Edit Tutorial - <?php echo $tutorial->title; ?></h1>
		<nav class="edit-tut-nav">
			<ul class="nav">
				
				<li class="nav-item <?php if($active_sub == 'basic-information'){echo 'active';} ?>"><a href="<?php echo base_url('teacher/edit-tutorial/'.$tutorial->id); ?>" class="nav-link">Basic Information</a></li>

				<li class="nav-item <?php if($active_sub == 'manage-sections'){echo 'active';} ?>"><a href="<?php echo base_url('teacher/edit-tutorial/'.$tutorial->id.'/manage-sections');?>" class="nav-link">Manege Sections</a></li>

				<li class="nav-item <?php if($active_sub == 'manage-lessons'){echo 'active';} ?>"><a href="<?php echo base_url('teacher/edit-tutorial/'.$tutorial->id.'/manage-lessons');?>" class="nav-link">Manage Lessons</a></li>
			</ul>
		</nav>
	</div>
</div>

<div class="container my-4">
	<div class="col-lg-8">

		<!-- to show thumbnail error -->
		<div class="<?php echo $this->session->flashdata('thumb-class');?>" role="alert">
		  	<?php echo $this->session->flashdata('thumb-error'); ?>
		</div>

		<!-- to show the preview video error -->
		<div class="<?php echo $this->session->flashdata('preview-class');?>" role="alert">
		  	<?php echo $this->session->flashdata('preview-error'); ?>
		</div>

		<!-- to show the common error -->
		<div class="<?php echo $this->session->flashdata('class');?>" role="alert">
		  	<?php echo $this->session->flashdata('error'); ?>
		</div>

		<form action="<?php echo base_url('teacher/tutorial-action/'.$tutorial->id.'/update-basic-info'); ?>" method="post" enctype="multipart/form-data">
		    <div class="form-group">
			    <label for="title">Title</label>
			    <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title of Tutorial" value="<?php echo $tutorial->title; ?>" required>
		    </div>

		    <div class="form-group">
		    	<label for="short-description">Short Description</label>
		        <textarea class="form-control" id="short-description" rows="5" name="short-des" placeholder="Enter one line description of tutorial" required><?php echo $tutorial->short_description; ?></textarea>
		    </div>

		    <div class="form-group">
		    	<label for="long-description">Description</label>
		        <textarea id="long-description" class="form-control" rows="10" name="description" placeholder="Enter Detail Description of Tutorial" required><?php echo $tutorial->description; ?></textarea>
		    </div>

		    <div class="form-group">
			    <label for="tags-input">Tags</label>
			    <input type="text" class="form-control" id="tags-input" name="tags" placeholder="Enter Specific Tags" value="<?php echo $tutorial->tags; ?>" required>
			    <small><strong>Note:-</strong> It is recommended to enter at least 5 keywords</small>
		    </div>

		    <div class="form-group">
			    <label for="categories">Category</label>
			    <select class="form-control" id="categories" name="cat_id">
					<?php
						$categories = $this->crud_model->get_categories();
						// to show all the categories in dropdown
						foreach($categories as $cat){
							$selected = '';
							if($tutorial->cat_id == $cat->id){
								$selected = 'selected';
							}
							echo '<option value="'.$cat->id.'" '.$selected.'>';
							echo $cat->cat_name;
				    		echo '</option>';
						}
					?>
			    </select>
			</div>

		    <div class="form-group">
			    <label for="sub-categories">Sub Category</label>
			    <select class="form-control" id="sub-categories" name="sub_cat_id">
					<?php
						$sub_categories = $this->crud_model->get_sub_cat();
						//  to show all the sub categories
						foreach($sub_categories as $sub_cat){
							$selected = '';
							if($tutorial->sub_cat_id == $sub_cat->id){
								$selected = 'selected';
							}
							echo '<option value="'.$sub_cat->id.'" '.$selected.'>';
							echo $sub_cat->sub_cat_name;
				    		echo '</option>';
						}
					?>
			    </select>
			</div>

		    <div class="form-group">
			    <label for="level">Level</label>
			    <select class="form-control" id="level" name="level">
			    	<?php
			    	$beginer = ''; 
			    	$intermediate = ''; 
			    	$advance = '';
					if($tutorial->level == 'beginner'){
						$beginer = 'selected';
					}
					elseif($tutorial->level == 'intermediate'){
						$intermediate = 'selected';
					}
					else{
						$advance = 'selected';
					}
					?>
			      <option value="beginner" <?php echo $beginer ?>>Beginner</option>
			      <option value="intermediate" <?php echo $intermediate ?>>Intermediate</option>
			      <option value="advance" <?php echo $advance ?>>Advance</option>
			    </select>
			</div>

			<div class="form-group">
			    <label for="tutorial-type">Tutorial Type</label>
			    <select class="form-control" id="tutorial-type" name="tutorial-type">
			    	<?php
			    	$video = ''; 
			    	$interactive = ''; 
					if($tutorial->type == 'video'){
						$video = 'selected';
					}
					elseif($tutorial->type == 'interactive'){
						$interactive = 'selected';
					}
					?>
			      <option value="video" <?php echo $video; ?>>Video</option>
			      <option value="interactive" <?php echo $interactive; ?>>Interactive</option>
			    </select>
			</div>

			<div class="form-group">
			    <label for="tutorial-thumb">Select tutorial thumbnail to upload:</label>
			    <input type="file" class="form-control-file" name="tutorial-thumb" id="tutorial-thumb" required>
			</div>

			<div class="form-group">
			    <label for="preview-video">Select tutorial introductory video to upload</label>
			    <input type="file" class="form-control-file" name="preview-video" id="tutorial-video" required>
			</div>

			<button type="submit" class="btn btn-primary">Update Tutorial</button>
		</form>	
	</div>
</div>