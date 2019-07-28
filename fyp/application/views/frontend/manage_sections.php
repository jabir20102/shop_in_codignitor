<div class="mt-3 pt-4" style="background-color: #e9e9e9;">
	<div class="container">
		<h1 style="font-weight: lighter; font-size: 2.5rem;">Manage Sections - <?php echo $tutorial->title; ?></h1>
		<nav class="edit-tut-nav">
			<ul class="nav">

				<li class="nav-item <?php if($active_sub == 'basic-information'){echo 'active';} ?>"><a href="<?php echo base_url('teacher/edit-tutorial/'.$tutorial->id); ?>" class="nav-link">Basic Information</a></li>

				<li class="nav-item <?php if($active_sub == 'manage-sections'){echo 'active';} ?>"><a href="<?php echo base_url('teacher/edit-tutorial/'.$tutorial->id.'/manage-sections');?>" class="nav-link">Manege Sections</a></li>

				<li class="nav-item <?php if($active_sub == 'manage-lessons'){echo 'active';} ?>"><a href="<?php echo base_url('teacher/edit-tutorial/'.$tutorial->id.'/manage-lessons');?>" class="nav-link">Manage Lessons</a></li>
			</ul>
		</nav>
	</div>
</div>

<div class="container py-4">
	<div class="row">
		<div class="col-md-5">
			<div class="<?php echo $this->session->flashdata('class');?>" role="alert">
		  		<?php echo $this->session->flashdata('error'); ?>
			</div>
			<?php if($action2 === ''){ ?>

				<form action="<?php echo base_url('teacher/sections/add'); ?>" method="post">
					<div class="form-group">
						<label for="section-title">Enter Section title</label>
						<input type="text" class="form-control" id="section-title" name="section-title">
						<input type="hidden" name="tutorial-id" value="<?php echo $tutorial->id; ?>">
					</div>
					<button type="submt" class="btn btn-primary">Add Section</button>
				</form>

			<?php } elseif($action2 === 'edit'){ ?>

				<form action="<?php echo base_url('teacher/sections/update'); ?>" method="post">
					<div class="form-group">
						<label for="section-title">Update Section title</label>
						<input type="text" class="form-control" id="section-title" name="section-title" value="<?php echo $this->input->post('sec-title'); ?>">
						<input type="hidden" name="section-id" value="<?php echo $this->input->post('sec-id'); ?>">
						<input type="hidden" name="tutorial-id" value="<?php echo $tutorial->id; ?>">
					</div>
					<button type="submt" class="btn btn-primary">Update Section</button>
				</form>
			
			<?php } else{ 
				redirect(base_url('teacher/edit-tutorial/'.$tutorial->id.'/manage-sections'),'refresh');
			}
			?>
		</div>
		<div class="col-md-7">
			<table class="table table-bordered section-table">
				<thead>
					<tr>
						<th>Title</th>
						<th>Lessons</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$sections = $this->crud_model->get_section_by_tut_id($tutorial->id);

						foreach($sections as $sec){

							if($tutorial->type == 'video'){
								$lessons = $this->crud_model->get_vlesson_by_sec_id($sec->id);
							}
							else{
								$lessons = $this->crud_model->get_ilesson_by_sec_id($sec->id);
							}
							
							echo '<tr>';
							echo '<td>'.$sec->title.'</td>';
							echo '<td><ul>';

							foreach($lessons as $les){
								echo '<li>'.$les->title.'</li>';
							}

							echo '</ul></td>';

							echo '<td>';

							echo '<form action="'.base_url('teacher/edit-tutorial/'.$tutorial->id.'/manage-sections/edit').'" method="post"><input type="hidden" name="sec-id" value="'.$sec->id.'"><input type="hidden" name="sec-title" value="'.$sec->title.'"><button type="submit" class="btn btn-link text-capitalize">Edit</button></form>';

							echo '<form action="'.base_url('teacher/sections/delete').'" method="post"><input type="hidden" name="sec-id" value="'.$sec->id.'"><input type="hidden" name="tutorial-id" value="'.$tutorial->id.'"><button type="submit" class="btn btn-link text-capitalize">Delete</button></form>';

							echo '</td>';

							echo '</tr>';
						}
					?>

				</tbody>
			</table>
		</div>
	</div>
</div>