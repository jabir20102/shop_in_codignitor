<?php
// CHECKING THE STUDNET IMAGE
    $result = $this->user_model->get_students($this->session->userdata('student_email'));
    if($result->image_url == ''){
        $image_src = base_url('uploads/backend/user_image/placeholder.png');
    }
    else{
        $image_src = base_url($result->image_url);
    }
?>

<div class="mt-3 py-4" style="background-color: #e9e9e9;">
	<div class="container">
		<h1 style="font-weight: lighter; font-size: 2.8rem;">Edit Your Profile</h1>
	</div>
</div>

<?php //print_r($this->session->userdata()); ?>
<div class="container">
	<div class="row">
		<div class="col-lg-6">
			<div class="bg-light my-4 rounded border container">
				<div class="border-bottom">
					<div class="container">
						<div>
							<h3 class="pt-4 pb-3">Update Profile</h3>
						</div>
					</div>
				</div>

				<div class="container py-4">
					
					<form action="<?php echo base_url('student/change-name'); ?>" method="post">
			            <div class="form-group">
			              <label for="new-name">Update Name</label>
			              <input type="text" class="form-control" id="new-name" name="new-name"  placeholder="Enter New Name" required>
			            </div>

			            <button type="submit" class="btn btn-primary">Update Profile</button>		
					</form>
					<div class="<?php echo $this->session->flashdata('profile-class');?>" >
						<?php print_r($this->session->flashdata('profile-error')); ?>
					</div>
				</div>
			</div>
		</div> <!-- column ends -->
		<div class="col-lg-6">
			<div class="rounded border container my-4">
				<div class="border-bottom">
					<div class="container">
						<h3 class="pt-4 pb-3">Update Profile Image</h3>
					</div>
				</div>

				<div class="row container">
					<div class="col-sm-5 text-center py-3">
						<img class="rounded-circle" src="<?php echo $image_src; ?>" style="width: 140px; height: 140px">
					</div>
					<div class="col-sm-7 py-4">
						<div class="name text-center text-md-left">
							<h3><?php echo $this->session->userdata('student_name'); ?></h3>
							<form action="<?php echo base_url('student/change-img'); ?>" method="post" enctype="multipart/form-data">
							    Select image to upload:<br>
							    <input type="file" class="form-control-file my-2 mx-auto mx-md-0" name="student_image" required style="width: 180px" >
							    <input type="submit" class="btn btn-primary" value="Change Image" name="submit">
							</form>
							<div class="errors">
					            <div class="<?php echo $this->session->flashdata('img-class');?>" role="alert">
			 						 <?php print_r($this->session->flashdata('img-error')); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div> <!-- column ends -->
	</div> <!-- row ends -->
</div> <!-- container ends -->

<div class="container my-4">
	<div class="row">
		<div class="col-12">
			<div class="bg-light rounded border container">
				<div class="border-bottom">
					<div class="container">
						<div>
							<h3 class="pt-4 pb-3">Update Password</h3>
						</div>
					</div>
				</div>
				<div class="container py-4">
					<div class="<?php echo $this->session->flashdata('pass-class');?>" >
						<?php print_r($this->session->flashdata('pass-error')); ?>
					</div>
					<form action="<?php echo base_url('student/change-pass'); ?>" method="post">
			            <div class="form-group">
			              <label for="old-pass">Old Password</label>
			              <input type="password" class="form-control" id="old-pass" name="old-pass"  placeholder="Enter Old Password" required>
			            </div>

			            <div class="form-group">
			              <label for="new-pass">New Password</label>
			              <input type="password" class="form-control" id="new-pass" name="new-pass" placeholder="Enter New Password" required>
			            </div>
			            
			            <div class="form-group">
			              <label for="confirm-pass">Confirm New Password</label>
			              <input type="password" class="form-control" id="confirm-pass" name="confirm-pass" placeholder="Enter New Password Again" required>
			            </div>

			            <button type="submit" class="btn btn-primary">Change Password</button>		
					</form>

				</div>
			</div>
		</div> <!-- column ends -->
	</div> <!-- row ends -->
</div> <!-- container ends -->

