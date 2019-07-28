<section class="teacher-detail">
	<div class="mt-3 py-4" style="background-color: #e9e9e9;">
		<div class="container">
			<h1 style="font-weight: lighter; font-size: 2.8rem;"><?php echo $teacher_info->name; ?></h1>
		</div>
	</div>
	<div class="container">
		<?php
			if($teacher_info->image_url == ''){
                $image_src = base_url('uploads/frontend/user_images/placeholder.png');
            }
            else{
                $image_src = base_url($teacher_info->image_url);
            }
		?>
		<div class="row py-4">
            <div class="col-md-4">
                <div class="teacher-image text-center">
                    <img class="rounded-circle" src="<?php echo $image_src; ?>" width=220 height=220>
                </div>
            </div>
            <div class="col-md-8">
                <div class="teacher-bio pt-2">
                    <p><?php echo $teacher_info->bio; ?></p>
                </div>
                <div class="teacher-stats">
                	<?php
                		$tutorials = $this->crud_model->get_tutorials_by_teacher($teacher_info->id);
                	?>
					<ul class="list-group list-group-horizontal">
						<li class="list-group-item">
							<div class="small">Total Tutorials</div>
							<div class="num"><?php echo count($tutorials); ?></div>
						</li>
					</ul>
				</div>
            </div>
        </div>
	
	</div>
</section>