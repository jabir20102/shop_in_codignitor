<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo ucwords($page_title); ?></title>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="shortcut icon" href="<?php echo base_url('assets/custom/images/shortcut.png') ?>">
  
    <link rel="stylesheet" href="<?php echo base_url('assets/backend/lib/font-awsome/css/font-awesome.min.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/backend/lib/css/bootswatch.min.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/backend/css/style.css')?>">
    
</head>
<body>
	<?php
// echo 'Current PHP version: ' . phpversion();
?>
	<?php 
		include 'header.php';
		include 'main/'.$page_name.'.php'; 
		include 'footer.php';
	?>

<script src="<?php echo base_url('assets/backend/lib/js/jquery-3.3.1.min.js')?>"></script>
<script src="<?php echo base_url('assets/backend/lib/js/bootstrap.bundle.min.js')?>"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
        });
  $('#file1').on('change', function(){
    $('#uploadform').submit();
  });

 $('#categories').change(function(){
  var categories = $('#categories').val();
  
  if(categories != '')
  {
   $.ajax({
    url:"<?php echo base_url(); ?>Home/fetch_sub_category",
    method:"POST",
    data:{categories:categories},
    success:function(data)
    {
    $('#sub-categories').html(data);
    }
   });
  }
  else
  {
   $('#sub-categories').html('<option value="">Select State</option>');
  }
 });

    });
</script>
</body>
</html>