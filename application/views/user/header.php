    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar" class="bg-dark">
            <div class="sidebar-header">
                <a class="navbar-brand pl-0" href="<?php echo base_url(); ?>"><img src="<?php echo base_url('assets/custom/images/fables-logo.png') ?>" alt="Fables Template" class="fables-logo"></a>
            </div>

            <ul class="list-unstyled components">
                <p>User Panel</p>
                <li class="<?php if($active == 'dashboard'){echo 'active';} ?>">
                    <a href="<?php echo base_url('user/dashboard'); ?>">Dashboard</a>
                </li>
                <li class="<?php if($active == 'wishlist'){echo 'active';} ?>">
                    <a href="<?php echo base_url('user/wishlist'); ?>">My Wishlist</a>
                </li>
                
                <li class="<?php if($active == 'orders'){echo 'active';} ?>">
                    <a href="<?php echo base_url('user/orders'); ?>">Orders</a>
                </li>               

                <li class="<?php if($active == 'profile'){echo 'active';} ?>">
                    <a href="<?php echo base_url('user/profile'); ?>">Profile</a>
                </li>
                <li>
                    <a href="<?php echo base_url('user/logout'); ?>">Log Out</a>
                </li>
            </ul>
        </nav>

<?php
// CHECKING THE ADMIN IMAGE
    $result = $this->user_model->get_students($this->session->userdata('student_email'));
    
    if($result->image_url == ''){
        $image_src = base_url('uploads/backend/user_image/placeholder.png');
    }
    else{
        $image_src = base_url($result->image_url);
    }
?>

        <!-- Page Content  -->
        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-dark bg-dark rounded">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-primary">
                        <i class="fa fa-bars"></i>
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa fa-bars"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">

                            <img src="<?php echo $image_src; ?>" class="rounded-circle" width=45 height=45>

                            <li class="nav-item my-auto ml-2">
                                <?php echo $this->session->userdata('admin_name'); ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div  class="<?php echo $this->session->flashdata('class');?>" role="alert">
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                <strong><?php print_r($this->session->flashdata('error')); ?></strong>
            </div>