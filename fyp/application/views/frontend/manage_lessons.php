<div class="mt-3 pt-4" style="background-color: #e9e9e9;">
	<div class="container">
		<h1 style="font-weight: lighter; font-size: 2.5rem;">Manage Lessons - <?php echo $tutorial->title; ?></h1>
		<nav class="edit-tut-nav">
			<ul class="nav">
				
				<li class="nav-item <?php if($active_sub == 'basic-information'){echo 'active';} ?>"><a href="<?php echo base_url('teacher/edit-tutorial/'.$tutorial->id); ?>" class="nav-link">Basic Information</a></li>

				<li class="nav-item <?php if($active_sub == 'manage-sections'){echo 'active';} ?>"><a href="<?php echo base_url('teacher/edit-tutorial/'.$tutorial->id.'/manage-sections');?>" class="nav-link">Manege Sections</a></li>

				<li class="nav-item <?php if($active_sub == 'manage-lessons'){echo 'active';} ?>"><a href="<?php echo base_url('teacher/edit-tutorial/'.$tutorial->id.'/manage-lessons');?>" class="nav-link">Manage Lessons</a></li>
			</ul>
		</nav>
	</div>
</div>

<?php
	if($tutorial->type == 'video'){
		include 'manage_video_lessons.php';
	}
	else{
		include 'manage_interactive_lessons.php';
	}

?>