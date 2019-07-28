<div class="mt-3 py-4" style="background-color: #e9e9e9;">
	<div class="container">
		<h1 style="font-weight: lighter; font-size: 2.8rem;"><?php echo $tutorial->title; ?></h1>
	</div>
</div>



<div class="container">
	<div class="row">
		<div class="col-md-9 mx-auto mt-3">
			<div class="embed-responsive embed-responsive-16by9">
				<video class="embed-responsive-item" poster="<?php echo base_url($tutorial->thumbnail_url); ?>" controls>
					<source src="<?php echo base_url($tutorial->preview_url); ?>" type="video/mp4">
                    Your browser does not support the video tag.
				</video>
			</div>
		</div>
	</div>
		
	<div class="row">
		<div class="col-md-9 mx-auto mb-5">

			<h4 class="my-4 py-2">Syllabus of this <?php echo $tutorial->type; ?> tutorial:</h4>

			<div class="syllabus">
		        <div id="accordion">
		          <?php
		            $sections = $this->crud_model->get_section_by_tut_id($tutorial->id);

		            foreach($sections as $sec):
		          ?>
		          <div class="card my-2">
		            <div class="card-header">
		              <a class="card-link" data-toggle="collapse" href="#<?php echo 'sec'.$sec->id; ?>">
		                <?php echo $sec->title; ?>
		              </a>
		            </div>
		            <div id="<?php echo 'sec'.$sec->id; ?>" class="collapse" data-parent="#accordion">
		              <div class="card-body">
		                <?php

		                      $lessons = $this->crud_model->get_ilesson_by_sec_id($sec->id);
		                    // var_dump($lessons);
		                    echo '<ul class="list-group">';
		                    foreach($lessons as $les){
		                      echo '<li class="list-group-item"><a href="'.base_url('student/interactive-lesson/'.$les->id).'">'.$les->title.'</a></li>';
		                    }
		                    echo '</ul>';
		                ?>
		              </div>
		            </div>
		          </div>  <!-- accordion acrd ends -->
		          <?php endforeach; ?>
		        </div> <!-- accordion ends -->
		      </div> <!-- syllabus div ends -->
		      <div class="mt-3">
		      	<a href="<?php echo base_url('student/rate-tutorial/'.$tutorial->id); ?>" class="btn btn-success">Rate a Tutorial</a>
		      	<a href="<?php echo base_url('student/report-tutorial/'.$tutorial->id); ?>" class="btn btn-danger float-right">Report Tutorial</a>
		      </div>
		</div>
	</div>
</div>
