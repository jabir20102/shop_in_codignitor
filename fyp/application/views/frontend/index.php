<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo ucwords($page_title); ?></title>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link name="favicon" type="image/x-icon" href="<?php echo base_url('assets/favicon.png')?>" rel="shortcut icon" />
    <link rel="stylesheet" href="<?php echo base_url('assets/frontend/lib/font-awsome/css/font-awesome.min.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/frontend/lib/css/bootswatch.min.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/frontend/lib/css/bootswatch.min.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/frontend/lib/bootstrap4-tagsinput/tagsinput.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/frontend/lib/summernote/summernote-lite.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/frontend/lib/codemirror/lib/codemirror.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/frontend/css/style.css')?>">
</head>
<body class="bg-light pt-5">
	
	<?php
		$student = $this->session->userdata('student_login');
		$teacher = $this->session->userdata('teacher_login');

		if($student || $teacher){
			include 'loged_in_header.php';
		}
		else{
			include 'header.php';
		}
		include $page_name.'.php'; 
		include 'footer.php';
	?>

<script src="<?php echo base_url('assets/frontend/lib/js/jquery-3.3.1.min.js')?>"></script>
<script src="<?php echo base_url('assets/frontend/lib/js/bootstrap.bundle.min.js')?>"></script>
<script src="<?php echo base_url('assets/frontend/lib/bootstrap4-tagsinput/tagsinput.js')?>"></script>
<script src="<?php echo base_url('assets/frontend/lib/summernote/summernote-lite.js')?>"></script>
<script src="<?php echo base_url('assets/frontend/lib/codemirror/lib/codemirror.js')?>"></script>
<script src="<?php echo base_url('assets/frontend/lib/codemirror/mode/xml/xml.js')?>"></script>
<script src="<?php echo base_url('assets/frontend/lib/codemirror/mode/javascript/javascript.js')?>"></script>
<script src="<?php echo base_url('assets/frontend/lib/codemirror/mode/css/css.js')?>"></script>
<script src="<?php echo base_url('assets/frontend/lib/codemirror/mode/htmlmixed/htmlmixed.js')?>"></script>
<script src="<?php echo base_url('assets/frontend/js/script.js')?>"></script>

</body>
</html>