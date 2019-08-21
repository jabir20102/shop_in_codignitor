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
    <!-- for chat box styles -->
    <link rel="stylesheet" href="<?php echo base_url('assets/custom/chat_box.css')?>">

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>


.light {
  border: 2px solid #dedede;
  background-color: #f1f1f1;
  border-radius: 5px;
  padding: 10px;
  margin: 10px 0;
}

.darker {
  border-color: #ccc;
  background-color: #ddd;
}

.light::after {
  content: "";
  clear: both;
  display: table;
}

.light img {
  float: left;
  max-width: 60px;
  width: 100%;
  margin-right: 20px;
  border-radius: 50%;
}

.light img.right {
  float: right;
  margin-left: 20px;
  margin-right:0;
}

.time-right {
  float: right;
  color: #aaa;
}

.time-left {
  float: left;
  color: #999;
}
</style>
</head>
<body>
	<?php
// echo 'Current PHP version: ' . phpversion();
?>
<div id="test"></div>
	<?php 
		include 'header.php';
		include 'main/'.$page_name.'.php'; 
		include 'footer.php';
	?>

<script src="<?php echo base_url('assets/backend/lib/js/jquery-3.3.1.min.js')?>"></script>
<script src="<?php echo base_url('assets/backend/lib/js/bootstrap.bundle.min.js')?>"></script>
<script type="text/javascript">
    $(document).ready(function () {
      $('#action_menu_btn').click(function(){
    $('.action_menu').toggle();
});
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
//  messages loading
    var student_id=$('#student_id').val();
   // var timeout= setTimeout(function(){
   //        load_data(student);
   //      }, 1000);
setInterval(load_data, 1000); 
    function load_data()
    {
      $.ajax({
        url:"<?php echo base_url(); ?>Home/fetch_messages",
        method:"POST",
        data:{student_id:student_id},
        cache: false,
        success:function(data)
          {
            if(data == '')
          {
            $('#load_data_message').html('<p>No Message Found</p>');
          }
          else
          {
            $('#loaded_comments').html(data);
            $('#load_data_message').html("");
          }
          }
        });
  }



    });
</script>
</body>
</html>