<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo ucwords($page_title); ?></title>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link name="favicon" type="image/x-icon" href="<?php echo base_url('assets/favicon.png')?>" rel="website icon" />
    <link rel="stylesheet" href="<?php echo base_url('assets/backend/lib/font-awsome/css/font-awesome.min.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/backend/lib/css/bootswatch.min.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/backend/css/style.css')?>">
    
</head>
<body>
	
	<?php 
		include 'header.php';
		include 'admin/'.$page_name.'.php'; 
		include 'footer.php';

    include 'offer.php';
    
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

 $('.offerCheckbox').click(function(){
    
  var product_id = $(this).data("id");

            if($(this).prop("checked") == true){
                $('#discountModale').modal('show');
                $('#discount_form')[0].reset();
                $('#product_id').val(product_id);               

            }

            else if($(this).prop("checked") == false){
                $.ajax({
    // url:"{{ route('shopping_cart.removeOffer')}}",
    url:"<?php echo base_url(); ?>/admin/removeOffer",
    method:"POST",
    data:{id:product_id},
    success:function(data)
    {
        // alert(data);
     alert("Product removed from Offer ");
    },
    error: function(data){
        alert("fail" + ' ' + this.data)
    }
   });

            }

  $('#discount_form').on('submit', function(event){
        event.preventDefault();
        var form_data = $(this).serialize();
        $.ajax({
            url:"<?php echo base_url(); ?>/admin/setOffer",
            method:"POST",
            data:form_data,
            dataType:"json",
            success:function(data)
            {
                
            }
        })
    });
  

 });

    });
</script>
</body>
</html>