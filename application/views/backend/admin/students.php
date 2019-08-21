<div class="container">
	<div class="row">
		<div class="col mx-auto bg-light rounded">
					<h3>Students</h3>
			
			
			<div class="table my-4">

				<table class="table table-bordered">
				  <thead>
				    <tr>
				      <th>Image</th>
				      <th>Student Name</th>
				      <th>Email</th>
				      <th>Status</th>
				      <th>Actions</th>
				    </tr>
				  </thead>
				  <tbody>

				  	<?php

				  		$students = $this->user_model->get_students();

				  		//config for the pagition
				  		$config = array(
				  			'base_url' => base_url('admin/students'),
				  			'total_rows' => count($students),
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

				  		$students = $this->user_model->get_students('','',$config['per_page'],$offset);

				  		foreach($students as $student){
				  			if($student->image_url == ''){
						        $image_src = base_url('uploads/backend/user_image/placeholder.png');
						    }
						    else{
						        $image_src = base_url($student->image_url);
						    }

				  			echo '<tr>';
				  			echo '<td><img class="rounded-circle" src="'.$image_src.'" width="45"></td>';
				  			echo '<td><a href="'.base_url('admin/viewUser/'.$student->id).'" >'.$student->name.'</td>';
				  			echo '<td>'.$student->email.'</td>';
				  			echo '<td><button type="button" class="btn btn-info btn-xs start_chat" data-touserid="'.$student->id.'" data-tousername="'.$student->name.'">Start Chat</button></td>';
				  			echo '<td><form action="'.base_url('admin/students/delete').'" method="post"><input type="hidden" name="student-id" value="'.$student->id.'"><button type="submit" class="btn btn-danger">Delete</button></form></td>';
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
			<div id="user_details">
			</div>
		</div><!-- end col -->

	</div> <!-- end row -->
</div> <!-- end container -->

<script type="text/javascript">
	setInterval(function(){
  fetch_user();
 }, 3000);

 function fetch_user(){
  $.ajax({
   url:"<?php echo base_url(); ?>User/fetch_user",
   method:"POST",
   success:function(data){    
    $('#user_details').html(data);
   }
  });
 }
</script>