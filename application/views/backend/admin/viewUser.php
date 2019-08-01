<?php
// CHECKING THE user IMAGE
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
            <div class="col-md-3 py-4">
                <div class="name text-lg-left">
                    <h3><?php echo $user->name; ?></h3>
                    
                    
                </div>
            </div>
            <div class="col-md-3  py-3">
                <img class="rounded-circle" src="<?php echo $image_src; ?>" style="width: 150px; height: 150px">
            </div>
            
        </div>
    </div>
</div>

<div class="bg-light my-4 rounded">
    
    <div class="row py-4">
       
        <div class="col-12 col-sm-12 col-lg-6">
           
        <div class="container-fluid">
            <div>
                <h3 class="pt-4 pb-3">Additional Information</h3>
            </div>
        </div>
  
            <div class="container">
                
                <table class="table table-bordered">
                    <tr><td><b>Full Name</b></td>   <td><?php echo $user->name; ?></td></tr>
                    <tr><td><b>Address</b></td>     <td><?php echo $user->address; ?></td></tr>
                    <tr><td><b>City</b></td>        <td><?php echo $user->city; ?></td></tr>
                    <tr><td><b>Country</b></td>     <td><?php echo $user->country; ?></td></tr>
                    <tr><td><b>Zip</b></td>         <td><?php echo $user->zip; ?></td></tr>
                    <tr><td><b>Phone No.</b> </td>  <td><?php echo $user->phone; ?></td></tr>
                       
                </table>

            </div>
            
        </div>


    </div>
</div>