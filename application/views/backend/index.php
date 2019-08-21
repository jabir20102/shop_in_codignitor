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
<!-- for the tags styles -->
    <link rel="stylesheet" href="<?php echo base_url('assets/custom/tags.css')?>">
    <!-- for chat box styles -->
    <link rel="stylesheet" href="<?php echo base_url('assets/custom/chat_box.css')?>">

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <style type="text/css">
     .dot { 
        /*for the online do*/
  height: 10px;
  width: 10px;
  background-color: green;
  border-radius: 50%;
  display: inline-block;
} 


    </style>
</head>
<body>
	
	<?php 
		include 'header.php';
		include 'admin/'.$page_name.'.php'; 
		include 'footer.php';

    include 'offer.php';
    
	?>
<script type="text/javascript">


  // for tags
  [].forEach.call(document.getElementsByClassName('tags-input'), function (el) {
    let hiddenInput = document.createElement('input'),
        mainInput = document.createElement('input'),
        tags = [];
    
    hiddenInput.setAttribute('type', 'hidden');
    hiddenInput.setAttribute('name', el.getAttribute('data-name'));

    mainInput.setAttribute('type', 'text');

    mainInput.setAttribute('class', 'form-control');
    mainInput.setAttribute('placeholder', '   Use comma for split');
    mainInput.classList.add('main-input');
    mainInput.addEventListener('input', function () {
        let enteredTags = mainInput.value.split(',');
        if (enteredTags.length > 1) {
            enteredTags.forEach(function (t) {
                let filteredTag = filterTag(t);
                if (filteredTag.length > 0)
                    addTag(filteredTag);
            });
            mainInput.value = '';
        }
    });

    mainInput.addEventListener('keydown', function (e) {
        let keyCode = e.which || e.keyCode;
        if (keyCode === 8 && mainInput.value.length === 0 && tags.length > 0) {
            removeTag(tags.length - 1);
        }
    });

    el.appendChild(mainInput);
    el.appendChild(hiddenInput);

    // addTag('hello!');

    function addTag (text) {
        let tag = {
            text: text,
            element: document.createElement('span'),
        };

        tag.element.classList.add('tag');
        tag.element.textContent = tag.text;

        let closeBtn = document.createElement('span');
        closeBtn.classList.add('close');
        closeBtn.addEventListener('click', function () {
            removeTag(tags.indexOf(tag));
        });
        tag.element.appendChild(closeBtn);

        tags.push(tag);

        el.insertBefore(tag.element, mainInput);

        refreshTags();
    }

    function removeTag (index) {
        let tag = tags[index];
        tags.splice(index, 1);
        el.removeChild(tag.element);
        refreshTags();
    }

    function refreshTags () {
        let tagsList = [];
        tags.forEach(function (t) {
            tagsList.push(t.text);
        });
        hiddenInput.value = tagsList.join(',');
    }

    function filterTag (tag) {
        return tag.replace(/[^\w -]/g, '').trim().replace(/\W+/g, '-');
    }
});
</script>
<script src="<?php echo base_url('assets/backend/lib/js/jquery-3.3.1.min.js')?>"></script>
<script src="<?php echo base_url('assets/backend/lib/js/bootstrap.bundle.min.js')?>"></script>

<script type="text/javascript">
    $(document).ready(function () {
$('#action_menu_btn').click(function(){
    $('.action_menu').toggle();
});
$('#fileUpload').on('change',function ()
        {
            var filePath = this.files[0].mozFullPath;
            // alert(filePath);
        });
$('input[type=file]').change(function () {
    console.log( URL.createObjectURL(event.target.files[0]));
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
 

 $(document).on('click', '.start_chat', function(){
  var to_user_id = $(this).data('touserid');
  var to_user_name = $(this).data('tousername');

  window.location.href = "<?php echo base_url('Admin/chat_box');?>?id="+to_user_id+"&user_name="+to_user_name;
 });
 

 

 $(document).on('click', '.ui-button-icon', function(){
  $('.user_dialog').dialog('destroy').remove();
 });



    });
</script>
</body>
</html>