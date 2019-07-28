<?php
	
	$lesson = $this->crud_model->get_interactive_lessons($lesson_id);
?>

<form action="<?php echo base_url('teacher/interactive-lessons/update'); ?>" method="post">

	<div class="form-group">
		<label for="lesson-title">Enter Lesson Title</label>
		<input type="text" class="form-control" id="lesson-title" name="lesson-title" value="<?php echo $lesson->title; ?>" required>
	</div>

	<div class="form-group">
		<label for="sections">Select Section</label>
		<select class="form-control" id="sections" name="section" required>
		<?php
			$sections = $this->crud_model->get_section_by_tut_id($tutorial->id);
			
			foreach($sections as $sec){

				$selected = '';
				if($lesson->section_id == $sec->id){
					$selected = 'selected';
				}
				echo '<option value="'.$sec->id.'" '.$selected.'>'.$sec->title.'</option>';
			}
		?>
		</select>
	</div>

	<div class="form-group">
		<label for="instructions">Enter Instructions for lessons</label>
		<textarea id="instructions" class="form-control" name="instructions"><?php echo $lesson->instructions; ?></textarea>
	</div>
	
	<input type="hidden" name="tut-id" value="<?php echo $tutorial->id ?>">
	<input type="hidden" name="les-id" value="<?php echo $lesson_id ?>">

	<button type="submit" class="btn btn-primary">Update Lesson</button>
</form>