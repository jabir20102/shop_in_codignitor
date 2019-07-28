<div class="container py-4">
	<div class="row">
		<div class="col-md-5">
			<div class="<?php echo $this->session->flashdata('class');?>" role="alert">
		  		<?php echo $this->session->flashdata('error'); ?>
			</div>
			<?php if($action2 == ''){ ?>
			<form action="<?php echo base_url('teacher/video-lessons/add'); ?>" method="post" enctype='multipart/form-data'>

				<div class="form-group">
					<label for="lesson-title">Enter Lesson Title</label>
					<input type="text" class="form-control" id="lesson-title" name="lesson-title" required>
				</div>

				<div class="form-group">
					<label for="sections">Select Section</label>
					<select class="form-control" id="sections" name="section" required>
					<?php
						$sections = $this->crud_model->get_section_by_tut_id($tutorial->id);
						
						foreach($sections as $sec){
							echo '<option value="'.$sec->id.'">'.$sec->title.'</option>';
						}
					?>
					</select>
				</div>

				<div class="form-group">
				    <label for="lesson-video">Select lesson video to upload:</label>
				    <input type="file" class="form-control-file" name="lesson-video" id="lesson-video" required>
				</div>	

				<div class="form-group">
					<label for="duration">Duration</label>
					<input type="number" class="form-control" id="duration" name="duration" min="1" required>
					<small>Note:- Please enter duration only in minutes</small>
				</div>
				
				<input type="hidden" name="tut-id" value="<?php echo $tutorial->id ?>">

				<button type="submit" class="btn btn-primary">Add Lesson</button>
			</form>

		<?php 
			}
			elseif($action2 == 'edit'){
				include 'edit_video_lessons.php';
			}
			else{
				redirect(base_url('teacher/edit-tutorial/'.$tutorial->id.'/manage-lessons'),'refresh');
			}
		?>
		</div>
		<div class="col-md-7">
			<table class="table table-bordered section-table">
				<thead>
					<tr>
						<th>Title</th>
						<th>Section</th>
						<th>Duration</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$lessons = $this->crud_model->get_vlesson_by_tut_id($tutorial->id);

						foreach($lessons as $les){

							$section = $this->crud_model->get_section($les->section_id);

							echo '<tr>';
							echo '<td>'.$les->title.'</td>';
							echo '<td>'.$section->title.'</td>';
							echo '<td>'.$les->duration.' min</td>';

							echo '<td>';

							echo '<form action="'.base_url('teacher/edit-tutorial/'.$tutorial->id.'/manage-lessons/edit').'" method="post"><input type="hidden" name="les-id" value="'.$les->id.'"><button type="submit" class="btn btn-link text-capitalize">Edit</button></form>';

							echo '<form action="'.base_url('teacher/video_lessons/delete').'" method="post"><input type="hidden" name="les-id" value="'.$les->id.'"><input type="hidden" name="tutorial-id" value="'.$tutorial->id.'"><button type="submit" class="btn btn-link text-capitalize">Delete</button></form>';

							echo '</td>';

							echo '</tr>';
						}
						
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>