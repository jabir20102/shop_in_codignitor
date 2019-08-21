<?php
// CHECKING THE ADMIN IMAGE
    $result = $this->user_model->get_admin($this->session->userdata('admin_email'));
    if($result->image_url == ''){
        $image_src = base_url('uploads/backend/user_image/placeholder.png');
    }
    else{
        $image_src = base_url($result->image_url);
    }
?>

<a href="<?php echo $image_src; ?>" download>Download image</a>
<div class="bg-light rounded">
	<div class="border-bottom">
		<div class="container-fluid">
			<div>
				<h3 class="pt-4 pb-3">Profile Image</h3>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row ">
			<div class="col-md-3 text-center py-3">
				<img class="rounded-circle" src="<?php echo $image_src; ?>" style="width: 150px; height: 150px">
			</div>
			<div class="col-md-8 py-4">
				<div class="name text-center text-lg-left">
					<h3><?php echo $this->session->userdata('admin_name'); ?></h3>
					<form action="<?php echo base_url('admin/change-img'); ?>" method="post" enctype="multipart/form-data">
					    Select image to upload:<br>
					    <input type="file" class="form-control-file my-2 mx-auto mx-lg-0" name="admin_image" required style="width: 180px" >
					    <input type="submit" class="btn btn-primary" value="Change Image" name="submit">
					</form>
					<div class="errors">
			            <div class="<?php echo $this->session->flashdata('class');?>" role="alert">
	 						 <?php print_r($this->session->flashdata('error')); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="bg-light my-4 rounded">
	<div class="border-bottom">
		<div class="container-fluid">
			<div>
				<h3 class="pt-4 pb-3">Change Password</h3>
			</div>
		</div>
	</div>
	<div class="row py-4">
		<div class="col-12">
			<div class="container">
				<div class="<?php echo $this->session->flashdata('pass-class');?>" >
					<?php print_r($this->session->flashdata('pass-error')); ?>
				</div>
				<form action="<?php echo base_url('admin/change-pass'); ?>" method="post">
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

	</div>
</div>