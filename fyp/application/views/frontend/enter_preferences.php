<div class="mt-3 py-4" style="background-color: #e9e9e9;">
	<div class="container">
		<h1 style="font-weight: lighter; font-size: 2.8rem;"><?php echo $page_title; ?></h1>
	</div>
</div>

<div class="container">
	<?php
	if($this->session->userdata('student_login')):
	?>
	<h2 class="mt-4">Set Your Preferences for Recommendations</h2>

	<div class="<?php echo $this->session->flashdata('class');?>" role="alert">
	  	<?php echo $this->session->flashdata('error'); ?>
	</div>
	<form action="<?php echo base_url('preferences/update'); ?>" method="post" class="my-4">
		
		<?php
			$student = $this->user_model->get_students($this->session->userdata('student_email'));

			if($student->preferences == ''):

			// preferences are not set then run this code to set preferences
		?>
		<p>Select Upto 3 Categories of Your Interest</p>
		<div class="ml-2">
			<div class="form-group">

				<?php
				$categories = $this->crud_model->get_categories();
				$fst_cat_id = $categories[0]->id;

				foreach($categories as $cat):
					$cat_name = $cat->cat_name;
					$cat_id = $cat->id;

				?>
				    <div class="custom-control custom-checkbox">
				      <input type="checkbox" class="custom-control-input" id="<?php echo $cat_name ?>" name="pref-categories[]" value="<?php echo $cat_id ?>">
				      <label class="custom-control-label" for="<?php echo $cat_name ?>"><?php echo $cat_name ?></label>
				    </div>
				<?php endforeach ?>
			    
		    </div>
		</div>

		<p>Select Your Skill Level</p>
		<div class="form-group">
			<div class="ml-2">
			    <div class="custom-control custom-radio">
			      <input type="radio" id="Beginner" name="skill-level" class="custom-control-input" value="beginner" required>
			      <label class="custom-control-label" for="Beginner">Beginner Level</label>
			    </div>
			    <div class="custom-control custom-radio">
			      <input type="radio" id="Intermediate" name="skill-level" class="custom-control-input" value="intermediate">
			      <label class="custom-control-label" for="Intermediate">Intermediate Level</label>
			    </div>
			    <div class="custom-control custom-radio">
			      <input type="radio" id="Advance" name="skill-level" class="custom-control-input" value="advance">
			      <label class="custom-control-label" for="Advance">Advance Level</label>
			    </div>
			    <div class="custom-control custom-radio">
			      <input type="radio" id="All" name="skill-level" class="custom-control-input" value="all">
			      <label class="custom-control-label" for="All">All Skill Level</label>
			    </div>
		    </div>
		</div>

		<button type="submit" id="Pref-Btn" class="btn btn-primary">Get Started</button>
		
		<?php 
		else:

			// if the preference are aleady stored then run this code to update prefrences
		?>
		<p>Select Upto 3 Categories of Your Interest</p>
		<div class="ml-2">
			<div class="form-group">

				<?php

				$preferences = json_decode($student->preferences);
				// var_dump($preferences);
				// exit();
				$categories = $this->crud_model->get_categories();
				$fst_cat_id = $categories[0]->id;

				foreach($categories as $cat):
					$cat_name = $cat->cat_name;
					$cat_id = $cat->id;

				?>
				    <div class="custom-control custom-checkbox">

				      <input type="checkbox" class="custom-control-input" id="<?php echo $cat_name ?>" name="pref-categories[]" value="<?php echo $cat_id ?>" 
				      <?php 
				      	foreach($preferences->categories as $selected){
				      		if($selected == $cat_id){
				      			echo 'checked';
				      		}
				      	} 
				      	?>> <!-- input ends here -->

				      <label class="custom-control-label" for="<?php echo $cat_name ?>"><?php echo $cat_name ?></label>
				    </div>
				<?php endforeach ?>
			    
		    </div>
		</div>

		<p>Select Your Skill Level</p>
		<div class="form-group">
			<div class="ml-2">
			    <div class="custom-control custom-radio">
			      <input type="radio" id="Beginner" name="skill-level" class="custom-control-input" value="beginner" required <?php if($preferences->skill_level == 'beginner'){echo 'checked';} ?>>
			      <label class="custom-control-label" for="Beginner">Beginner Level</label>
			    </div>
			    <div class="custom-control custom-radio">
			      <input type="radio" id="Intermediate" name="skill-level" class="custom-control-input" value="intermediate" <?php if($preferences->skill_level == 'intermediate'){echo 'checked';} ?>>
			      <label class="custom-control-label" for="Intermediate">Intermediate Level</label>
			    </div>
			    <div class="custom-control custom-radio">
			      <input type="radio" id="Advance" name="skill-level" class="custom-control-input" value="advance" <?php if($preferences->skill_level == 'advance'){echo 'checked';} ?>>
			      <label class="custom-control-label" for="Advance">Advance Level</label>
			    </div>
			    <div class="custom-control custom-radio">
			      <input type="radio" id="All" name="skill-level" class="custom-control-input" value="all" <?php if($preferences->skill_level == 'all'){echo 'checked';} ?>>
			      <label class="custom-control-label" for="All">All Skill Level</label>
			    </div>
		    </div>
		</div>

		<button type="submit" id="Pref-Btn" class="btn btn-primary">Update Preferences</button>

		<?php 
		endif 
		?>
	</form>
	<?php 
		else:
		// if user is not a student
		echo '<h4 class="my-4">Please Login As a Student to get Recommendations</h4>';

	 	endif 
	 ?>
</div>