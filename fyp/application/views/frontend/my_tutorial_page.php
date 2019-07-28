<div class="mt-3 py-4" style="background-color: #e9e9e9;">
	<div class="container">
		<h1 style="font-weight: lighter; font-size: 2.8rem;">My Tutorials</h1>
	</div>
</div>


<div class="container">

	<div class="<?php echo $this->session->flashdata('class');?>" role="alert">
	  	<?php echo $this->session->flashdata('error'); ?>
	</div>

	<h2 class="my-4">Your Enroled Tutorials</h2>
	<?php
	$enrolments = $this->crud_model->get_enrolments_by_student($this->session->userdata('student_id'));
	// print_r($enrolments);
	// echo count($enrolments);
	// exit();
	if(count($enrolments) == 0){
		echo '<p>You have not enrolled in any tutorials. Please take any tutorial first then visit this page.</p>';
		echo '<p>You can take Video tutorials, Interactive tutorials or can search specific tutorial.</p>';
	}
	$index = 0;
	$rows = count($enrolments);
	for($i=1; $i<=$rows; $i+=4):
	// this loop will run equals to the number of enroled (tutorial fetched)/4 because there will be 4 tutorials in each row and num of rows will be enroled (tutorial fetched)/4.

	$start = $index;
	$end = $index + 4;
	?>
	<div class="row mb-5">
		<?php 
		for($index = $start; $index < $end; $index++):
			// this loop will run only 4 times and shows 4 enroled tutorials in one row.
			if($index == $rows){ break;} //braek the loop if last tutorial is reached

			// getting the enrolled tutorial details
			$tutorial = $this->crud_model->get_tutorials($enrolments[$index]->tutorial_id);
		?>
	    <div class="col-sm-6 col-lg-3">
	        <div class="card">
	            <img class="card-img-top" src="<?php echo base_url($tutorial->thumbnail_url); ?>" alt="Tutorial Thumbnail Image">
	            <div class="card-body">
	                <h5 class="card-title"><?php echo $tutorial->title; ?></h5>
	                <p class="card-text"><?php echo $tutorial->short_description; ?></p>
	                <div class="my-2">
	                	<?php
	                		$teacher = $this->user_model->get_teacher_by_id($tutorial->teacher_id);
	                	?>
	                    <span class="card-text d-block"><b>Teacher: </b><?php echo $teacher->name; ?></span>
	                    <span class="card-text d-block"><?php echo ucwords($tutorial->type); ?> Tutorial</span>

	                    <?php
	                      // getting all the ratings of specific tutorial
	                      $ratings = $this->crud_model->get_rating_by_tutorial($tutorial->id);
	                      // sgettng the average of all the ratings
	                      $count = count($ratings);
	                      $sum=0;
	                      foreach($ratings as $row){
	                        $sum+=$row->rating;
	                      }
	                      if($count == 0){
	                        $avg_rating = 'No Ratings Yet';
	                      }else{
	                        $avg_rating = round($sum / $count, 1);
	                      }
                    	?>
	                    <span class="card-text d-block">Rating: <?php echo $avg_rating; ?></span>
	                </div>
	                <a href="<?php echo base_url('tutorial/'.$tutorial->slug.'/'.$tutorial->id);?>" class="btn btn-primary btn-block">View Detail</a>
	                <a href="<?php echo base_url('student/learn/'.$tutorial->id); ?>" class="btn btn-primary btn-block">Start Learning</a>

	            </div>
	        </div>
    	</div>
		<?php endfor ?>
	</div>
	<?php endfor ?>
</div>