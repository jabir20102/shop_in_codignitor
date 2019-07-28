<div class="container">
	<div class="row">
		<div class="col mx-auto bg-light rounded">
			<div class="border-bottom">
				<div class="container-fluid">
					<h3 class="pt-4 pb-3">Teachers</h3>
				</div>
			</div>
			<div class="<?php echo $this->session->flashdata('class');?>" role="alert">
	 			<?php echo $this->session->flashdata('error'); ?>
			</div>
			<div class="table my-4">

				<table class="table table-bordered">
				  <thead>
				    <tr>
				      <th>Image</th>
				      <th>Teacher Name</th>
				      <th>Email</th>
				      <th>Actions</th>
				    </tr>
				  </thead>
				  <tbody>

				  	<?php
				  		$teachers = $this->user_model->get_teachers();

				  		//config for the pagition
				  		$config = array(
				  			'base_url' => base_url('admin/teachers'),
				  			'total_rows' => count($teachers),
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

				  		$teachers = $this->user_model->get_teachers('', $config['per_page'],$offset);

				  		foreach($teachers as $teacher){
				  			if($teacher->image_url == ''){
						        $image_src = base_url('uploads/backend/user_image/placeholder.png');
						    }
						    else{
						        $image_src = base_url($teacher->image_url);
						    }

				  			echo '<tr>';
				  			echo '<td><img class="rounded-circle" src="'.$image_src.'" width="45"></td>';
				  			echo '<td>'.$teacher->name.'</td>';
				  			echo '<td>'.$teacher->email.'</td>';
				  			echo '<td><form action="'.base_url('admin/teachers/delete').'" method="post"><input type="hidden" name="teacher-id" value="'.$teacher->id.'"><button type="submit" class="btn btn-danger">Delete</button></form></td>';
				  			echo '</tr>';
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