

<a href="<?php echo base_url('admin/all_tutorials') ?>" class="btn btn-primary">back</a>	
<div class="mt-3 py-4" style="background-color: #e9e9e9;">
	<div class="container">
		<h1 style="font-weight: lighter; font-size: 2.8rem;">Add  Photos</h1>
	</div>
</div>

<div class="form-group"> 
<div class="col-sm-12">
	
	<div id="photo">
		<?php 
		if($images!=null){
		foreach ($images as $image){
				
			?>
       <div style="float: left;border: 1px solid grey;margin: 5px;">
			<img src="<?php echo base_url($image->url)  ?>" alt="image 1" width="150">
	
	<form method="post" class="delete_form" action="<?php echo base_url('admin/delete_img'); ?>" > 
      <input type="text" name="url" value="<?php  echo $image->url; ?>" hidden />
      <input type="text" name="prod_id" value="<?php  echo $image->product_id; ?>" hidden />
      <button type="submit" class="btn btn-danger">X</button>
     </form>
			</div>
			<?php
      }
  }
	?>		
			 <div style=";float:left">
	<i  style="border:1px solid black;font-size:86px;cursor:pointer;margin: 30px 5px;padding:5px 10px;"   onclick="document.getElementById('file1').click();">+</i>
</div>
	</div>
<form id="uploadform" method="post" action="<?php echo base_url('admin/upload_img'); ?>" enctype="multipart/form-data">
   
	 <input type="file" id="file1" name="image" style="display: none;" />
	 <input type="text" name="prod_id" value="<?php echo $product_id; ?>" hidden>
	
	</form>
	
	</div>

</div>



 
