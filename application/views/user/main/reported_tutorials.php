<div class="container">
	<div class="row">
		<div class="col mx-auto bg-light rounded">
			<div class="border-bottom">
				<div class="container-fluid">
					<h3 class="pt-4 pb-3">Reported Tutorials</h3>
				</div>
			</div>
			<div class="table my-4">

				<table class="table table-bordered">
				  <thead>
				    <tr>
				      <th>Tutorial Title</th>
				      <th>Category</th>
				      <th>Teacher</th>
				      <th>Reported By</th>
				      <th>Report Reason</th>
				      <th>Action</th>
				    </tr>
				  </thead>
				  <tbody>

				  	<?php
					$reported_tuts = $this->crud_model->get_reports();

					if(empty($reported_tuts)){
						echo '<tr>';
						echo '<td colspan="6">No data for the reported tutorials</td>';
						echo '</tr>';
					}

					//config for the pagition
			  		$config = array(
			  			'base_url' => base_url('admin/reported-tutorials'),
			  			'total_rows' => count($reported_tuts),
			  			'per_page' => 10
			  		);

			  		$this->pagination->initialize($config);

			  		$page = $this->input->get('page');
			  		if(!isset($page)){
			  			// offset for the first page will be zero
			  			$offset = $this->input->get('page');
			  		}
			  		else{
			  			// offset for the other than first page
			  			$offset = $this->input->get('page')*$config['per_page']-$config['per_page'];
			  		}

			  		$reported_tuts = $this->crud_model->get_reports('',$config['per_page'],$offset);

					foreach($reported_tuts as $reported_tut){

						$tutorial = $this->crud_model->get_tutorials($reported_tut->tutorial_id);

						$cat = $this->crud_model->get_categories($tutorial->cat_id);

						$teacher = $this->user_model->get_teacher_by_id($tutorial->teacher_id);

						$student = $this->user_model->get_students('', $reported_tut->student_id);
						
						echo '<tr>';
				    	echo '<td>'.$tutorial->title.'</td>';
				    	echo '<td>'.$cat->cat_name.'</td>';
				    	echo '<td>'.$teacher->name.'</td>';
				    	echo '<td>'.$student->name.'</td>';
				    	echo '<td>'.$reported_tut->report_reason.'</td>';
				    	echo '<td><form action="'.base_url('admin/reported-tutorials/delete-report').'" method="post"><input type="hidden" name="report-id" value="'.$reported_tut->id.'"><button type="submit" class="btn btn-danger">Delete</button></form></td>';
				    	echo '</tr>';
					}

					?>
				    
				  </tbody>
				</table> <!-- end table -->

				<div>
				  <?php echo $this->pagination->create_links(); ?>
				</div> <!-- end pagition -->
			</div> <!-- end table div -->
		</div><!-- end col -->
	</div> <!-- end row -->
</div> <!-- end container -->