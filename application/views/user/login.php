<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
	<title><?php echo ucwords($page_title); ?></title>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link name="favicon" type="image/x-icon" href="<?php echo base_url().'assets/favicon.png'?>" rel="website icon" />
    <link rel="stylesheet" href="<?php echo base_url('assets/backend/lib/font-awsome/css/font-awesome.min.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/backend/lib/css/bootswatch.min.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/backend/css/style.css')?>">

    <style type="text/css">
    	
    </style>
</head>
<body class="bg-light h-100">
	<div class="container h-100">
		<div class="row h-100">
			<div class="col-md-6 jumbotron mx-auto my-auto">
				
				<h2 class="text-center mb-5">Admin Login</h2>

				<form action="<?php echo base_url('admin/validate-login'); ?>" method="POST" >

		            <div class="form-group">
		              <label for="Email">Email address</label>
		              <input type="email" class="form-control" id="Email" name="email" placeholder="Enter email" required>
		            </div>

		            <div class="form-group">
		              <label for="Password">Password</label>
		              <input type="password" class="form-control" id="Password" name="pass" placeholder="Enter Password" required>
		            </div>

		            <button type="submit" class="btn btn-primary">Submit</button>

		            <div class="<?php echo $this->session->flashdata('class');?>" role="alert">
					  <?php echo $this->session->flashdata('error'); ?>
					</div>
				</form>
			</div>
			
		</div>
	</div>

<script src="<?php echo base_url('assets/backend/lib/js/jquery-3.3.1.min.js')?>"></script>
<script src="<?php echo base_url('assets/backend/lib/js/bootstrap.bundle.min.js')?>"></script>
<script type="text/javascript">

toastr.error("<?php echo $this->session->flashdata('error'); ?>");

</script>

</body>
</html>