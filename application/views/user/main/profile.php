<?php
// CHECKING THE user IMAGE
    $user = $this->user_model->get_students($this->session->userdata('student_email'));
    if($user->image_url == ''){
        $image_src = base_url('uploads/backend/user_image/placeholder.png');
    }
    else{
        $image_src = base_url($user->image_url);
    }
?>

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
					<h3><?php echo $user->name; ?></h3>
					<form action="<?php echo base_url('user/change-img'); ?>" method="post" enctype="multipart/form-data">
					    Select image to upload:<br>
					    <input type="file" class="form-control-file my-2 mx-auto mx-lg-0" name="student_image" required style="width: 180px" >
					    <input type="submit" class="btn btn-primary" value="Change Image" name="submit">
					</form>
					
				</div>
			</div>
		</div>
	</div>
</div>

<div class="bg-light my-4 rounded">
	
	<div class="row py-4">
		<div class="col-12 col-sm-6 col-lg-5">
			<div class="border-bottom">
		<div class="container-fluid">
			<div>
				<h3 class="pt-4 pb-3">Change Password</h3>
			</div>
		</div>
	</div>
			<div class="container">
				
				<form action="<?php echo base_url('user/change-pass'); ?>" method="post">
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
		<!-- address -->
		<div class="col-12 col-sm-6 col-lg-5">
			<div class="border-bottom">
		<div class="container-fluid">
			<div>
				<h3 class="pt-4 pb-3">Additional Information</h3>
			</div>
		</div>
	</div>
			<div class="container">
				
				<form action="<?php echo base_url('user/change-info'); ?>" method="post">
					<div class="form-group">
		              <label for="name">Full Name</label>
		              <input type="text" class="form-control" id="name" name="name" value="<?php echo $user->name; ?>"  placeholder="Enter full name" required>
		            </div>
		            <div class="form-group">
		              <label for="address">Address</label>
		              <input type="text" class="form-control" id="address" name="address" value="<?php echo $user->address; ?>"  placeholder="Enter complete address" required>
		            </div>

		            <div class="form-group">
		              <label for="city">City</label>
		              <input type="text" class="form-control" id="city" name="city" value="<?php echo $user->city; ?>"  placeholder="Enter city name" required>
		            </div>
		            <div class="form-group">
		              <label for="country">Country</label>
		              <input type="text" class="form-control" id="country" name="country" value="<?php echo $user->country; ?>"  placeholder="Enter country name" required>
		            </div>
		            <div class="form-group">
		              <label for="zip">Zip</label>
		              <input type="number" class="form-control" id="zip" name="zip" value="<?php echo $user->zip; ?>"  placeholder="Enter zip no" required>
		            </div>
		            <div class="form-group">
		              <label for="phone">Phone No</label>
		              <input type="number" class="form-control" id="phone" name="phone" value="<?php echo $user->phone; ?>" placeholder="Enter phone No" required>
		            </div>

		            <button type="submit" class="btn btn-primary">Save</button>		
				</form>

			</div>
			
		</div>


	</div>
</div>