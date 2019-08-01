<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo ucwords($page_title); ?></title>

	  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Fables">
    <meta name="author" content="Enterprise Development">
    <link rel="shortcut icon" href="<?php echo base_url('assets/custom/images/shortcut.png') ?>">

    <title> Store Grid List </title>
    <style>
</style>
    
    <!-- animate.css-->  
    <link href="<?php echo base_url('assets/vendor/animate.css-master/animate.min.css')?>" rel="stylesheet">
    <!-- Load Screen -->
    <link href="<?php echo base_url('assets/vendor/loadscreen/css/spinkit.css')?>" rel="stylesheet">
    <!-- GOOGLE FONT -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
    <!-- Font Awesome 5 -->
    <link href="<?php echo base_url('assets/vendor/fontawesome/css/fontawesome-all.min.css')?>" rel="stylesheet">
    <!-- Fables Icons -->
    <link href="<?php echo base_url('assets/custom/css/fables-icons.css')?>" rel="stylesheet"> 
    <!-- Bootstrap CSS --> 
    <link href="<?php echo base_url('assets/vendor/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/vendor/bootstrap/css/bootstrap-4-navbar.css')?>" rel="stylesheet">
    <!-- portfolio filter gallery -->
    <link href="<?php echo base_url('assets/vendor/portfolio-filter-gallery/portfolio-filter-gallery.css')?>" rel="stylesheet">
    <!-- FANCY BOX -->
    <link href="<?php echo base_url('assets/vendor/fancybox-master/jquery.fancybox.min.cs')?>" rel="stylesheet"> 
    <!-- RANGE SLIDER -->
    <link href="<?php echo base_url('assets/vendor/range-slider/range-slider.css')?>" rel="stylesheet">
    <!-- OWL CAROUSEL  --> 
    <link href="<?php echo base_url('assets/vendor/owlcarousel/owl.carousel.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/vendor/owlcarousel/owl.theme.default.min.css')?>" rel="stylesheet">
    <!-- FABLES CUSTOM CSS FILE -->
    <link href="<?php echo base_url('assets/custom/css/custom.css')?>" rel="stylesheet">
   
    <!-- electro CUSTOM CSS RESPONSIVE FILE -->
    <link href="<?php echo base_url('assets/custom/css/style.css')?>" rel="stylesheet">

    <!-- FABLES CUSTOM CSS RESPONSIVE FILE -->
    <link href="<?php echo base_url('assets/custom/css/custom-responsive.css')?>" rel="stylesheet">
    
    
    <style type="text/css">
      .sale{
        position: relative;padding: inherit;margin: inherit;color: white;
      }
    </style>
	

</head>

<body>
	<?php
		$student = $this->session->userdata('student_login');

		include('header.php');
		include $page_name.'.php'; 
		include 'footer.php';
	?>


<script src="<?php echo base_url('assets/vendor/jquery/jquery-3.3.1.min.js')?>"></script>
<script src="<?php echo base_url('assets/vendor/jquery-circle-progress/circle-progress.min.js')?>"></script>
<script src="<?php echo base_url('assets/vendor/popper/popper.min.js')?>"></script>
<script src="<?php echo base_url('assets/vendor/WOW-master/dist/wow.min.js')?>"></script>
<script src="<?php echo base_url('assets/vendor/loadscreen/js/ju-loading-screen.js')?>"></script>
<script src="<?php echo base_url('assets/vendor/range-slider/range-slider.js')?>"></script>
<script src="<?php echo base_url('assets/vendor/bootstrap/js/bootstrap.min.js')?>"></script>
<script src="<?php echo base_url('assets/vendor/bootstrap/js/bootstrap-4-navbar.js')?>"></script>
<script src="<?php echo base_url('assets/vendor/timeline/jquery.timelify.js')?>"></script>
<script src="<?php echo base_url('assets/vendor/owlcarousel/owl.carousel.min.js')?>"></script> 
<script src="<?php echo base_url('assets/custom/js/custom.js')?>"></script> 

<script type="text/javascript">
    <!-- var myVar = setInterval(timer, 1000); -->
    function timer(){
         var d = new Date();
  var day = d.getDay();
  var hour = d.getHours();
  var min=d.getMinutes();
  var secs=d.getSeconds();
  document.getElementById("days").innerHTML = 6-day;
  document.getElementById("hours").innerHTML = 24-hour;
  document.getElementById("mints").innerHTML = 60-min;
  document.getElementById("secs").innerHTML = 60-secs;
    }
   
</script>


<script type="text/javascript">
    $(document).ready(function () {
 

   $('#commentForm').on('submit', function(e){
         e.preventDefault();
  

   $.ajax({
    url:"<?php echo base_url(); ?>Home/add_comment",
    method:"POST",
    data: $('#commentForm').serialize(),
    success:function(data)
    {
    alert(data);
    $('#commentForm')[0].reset();

    }
   });  //  ajax for comment add close

    });
//  comments loading
    var limit = 3;
    var start = 0;
    var action = 'inactive';
    var product_id=$('#comment_product_id').val();
    lazzy_loader(limit);
     function lazzy_loader(limit)
    {
      var output = '';
      
        output += '<div class="post_data">';
        output += '<p>loading more comments....</p>';
        output += '</div>';
      
      $('#load_data_message').html(output);
    }
    if(action == 'inactive')
    {
      action = 'active';
      load_data(limit, start,product_id);
    }
    $('#comment_scroll').scroll(function(){
      if($('#comment_scroll').scrollTop() + $('#comment_scroll').height() > $("#loaded_comments").height() && action == 'inactive')
      {
        lazzy_loader(limit);
        action = 'active';
        start = start + limit;
        setTimeout(function(){
          load_data(limit, start,product_id);
        }, 1000);
      }
    });

    function load_data(limit, start,product_id)
    {
      $.ajax({
        url:"<?php echo base_url(); ?>Home/comments",
        method:"POST",
        data:{limit:limit, start:start,product_id:product_id},
        cache: false,
        success:function(data)
          {
            if(data == '')
          {
            $('#load_data_message').html('<p>No More Comments Found</p>');
            action = 'active';
          }
          else
          {
            $('#loaded_comments').append(data);
            $('#load_data_message').html("");
            action = 'inactive';
          }
          }
        });
  }
  //   cart operation
   $('.add_cart').click(function(){
  var product_id = $(this).data("productid");
  // var product_name = $(this).data("productname");
  // var product_price = $(this).data("price");
  var url = $(this).data("url");
  var quantity = $('#' + product_id).val();
// alert(product_id);
  var quantity = $('#input-val').val();
  if(quantity==null){
    quantity=1;
}
 
   $.ajax({
    url:"<?php echo base_url(); ?>Home/add_to_cart",
    method:"POST",
    // data:{product_id:product_id, product_name:product_name, product_price:product_price, quantity:quantity,url:url},
    data:{product_id:product_id, quantity:quantity,url:url},
    success:function(data)
    {
      // alert(data);
     alert("Product Added into Cart");
     $('#cart_details').html(data);
     // $('#' + product_id).val('');
    }
   });
 
 });

 $('#cart_details').load("<?php echo base_url(); ?>Home/load_cart");

 $(document).on('click', '.remove_inventory', function(){
  var row_id = $(this).attr("id");
  if(confirm("Are you sure you want to remove this?"))
  {
   $.ajax({
    url:"<?php echo base_url(); ?>Home/remove_from_cart",
    method:"POST",
    data:{row_id:row_id},
    success:function(data)
    {
     alert("Product removed from Cart");
     $('#cart_details').html(data);
    }
   });
  }
  else
  {
   return false;
  }
 });

 $(document).on('click', '#clear_cart', function(){
  if(confirm("Are you sure you want to clear cart?"))
  {
   $.ajax({
    url:"<?php echo base_url(); ?>Home/clear_cart",
    success:function(data)
    {
     alert("Your cart has been clear...");
     $('#cart_details').html(data);
    }
   });
  }
  else
  {
   return false;
  }
 });

   


    });
</script>

</body>
</html>