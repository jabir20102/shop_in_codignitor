<div class="container">
	<div class="row">
		<div class="col mx-auto bg-light rounded">
			<div class="border-bottom">
				<div class="container-fluid">
					<h3 class="pt-4 pb-3">All Tutorials</h3>
				</div>
			</div>
			<div class="<?php echo $this->session->flashdata('class');?>" role="alert">
	 			<?php print_r($this->session->flashdata('error')); ?>
			</div>
			<div class="table-responsive my-4">

				<table class="table table-bordered">
				  <thead>
				    <tr>
				      <th>Title</th>
				      <th>Category</th>
				      <th>Teacher</th>
				      <th>Number of sections</th>
				      <th>Number of lessons</th>
				      <th>Number of students enrolled</th>
				      <th>Actions</th>
				    </tr>
				  </thead>
				  <tbody>


					<?php
					$tutorials = $this->crud_model->get_tutorials();

					//config for the pagition
			  		$config = array(
			  			'base_url' => base_url('admin/all-tutorials'),
			  			'total_rows' => count($tutorials),
			  			'per_page' => 5
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

			  		$tutorials = $this->crud_model->get_tutorials('','',$config['per_page'],$offset);

					foreach($tutorials as $tutorial){

						$cat = $this->crud_model->get_categories($tutorial->cat_id);

						$teacher = $this->user_model->get_teacher_by_id($tutorial->teacher_id);

						$sections = $this->crud_model->get_section_by_tut_id($tutorial->id);

						if($tutorial->type == 'video'){
							$lessons = $this->crud_model->get_vlesson_by_tut_id($tutorial->id);
						}
						else{
							$lessons = $this->crud_model->get_ilesson_by_tut_id($tutorial->id);
						}

						$enrolments = $this->crud_model->get_enrolments_by_tutorial($tutorial->id);
						
						echo '<tr>';
				    	echo '<td>'.$tutorial->title.'</td>';
				    	echo '<td>'.$cat->cat_name.'</td>';
				    	echo '<td>'.$teacher->name.'</td>';
				    	echo '<td>'.count($sections).'</td>';
				    	echo '<td>'.count($lessons).'</td>';
				    	echo '<td>'.count($enrolments).'</td>';
				    	echo '<td><form action="'.base_url('admin/all-tutorials/delete').'" method="post"><input type="hidden" name="tut-id" value="'.$tutorial->id.'"><button type="submit" class="btn btn-danger">Delete</button></form></td>';
					}

					?>

				  </tbody>
				</table> <!-- end table -->

				<div>
				  <?php
					echo $this->pagination->create_links();
				  ?>
				</div> <!-- end pagition -->
			</div> <!-- end table div -->
		</div><!-- end col -->
	</div> <!-- end row -->
</div> <!-- end container -->