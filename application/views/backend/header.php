    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar" class="bg-dark">
             <div class="sidebar-header">
                <a class="navbar-brand pl-0" href="<?php echo base_url(); ?>"><img src="<?php echo base_url('assets/custom/images/fables-logo.png') ?>" alt="Fables Template" class="fables-logo"></a>
            </div>

            <ul class="list-unstyled components">
                <p>Admin Panel</p>
                <li class="<?php if($active == 'dashboard'){echo 'active';} ?>">
                    <a href="<?php echo base_url('admin/dashboard'); ?>">Dashboard</a>
                </li>
                <li class="<?php if($active == 'addAlbum'){echo 'active';} ?>">
                    <a href="<?php echo base_url('admin/addAlbum'); ?>">Add new Product</a>
                </li>
                <li class="<?php if($active == 'categories'){echo 'active';} ?>" >
                    <a href="<?php echo base_url('admin/categories'); ?>">Categories</a>
                </li>
                <li class="<?php if($active == 'students'){echo 'active';} ?>">
                    <a href="<?php echo base_url('admin/students'); ?>">Registered User</a>
                </li>
                
                <li class="<?php if($active == 'all-tutorials'){echo 'active';} ?>">
                    <a href="<?php echo base_url('admin/all-tutorials'); ?>">All Tutorials</a>
                </li>
                 <li class="<?php if($active == 'orders'){echo 'active';} ?>">
                    <a href="<?php echo base_url('admin/orders'); ?>">Orders</a>
                </li>
                <li class="<?php if($active == 'all-comments'){echo 'active';} ?>">
                    <a href="<?php echo base_url('admin/all-comments'); ?>">All Comments</a>
                </li>
               
               

                <li class="<?php if($active == 'profile'){echo 'active';} ?>">
                    <a href="<?php echo base_url('admin/profile'); ?>">Profile</a>
                </li>
                <li>
                    <a href="<?php echo base_url('admin/logout'); ?>">Log Out</a>
                </li>
            </ul>
        </nav>

<?php
// CHECKING THE ADMIN IMAGE
    $result = $this->user_model->get_admin($this->session->userdata('admin_email'));
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

                    <button type="button" id="sidebarCollapse" class="btn btn-dark">
                        <i class="fa fa-bars"></i>
                    </button>
                    <button class="btn btn-primary d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
<?php if($this->session->flashdata('error')){ ?>
            <div  class="<?php echo $this->session->flashdata('class');?>" role="alert">
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                <strong><?php print_r($this->session->flashdata('error')); ?></strong>
            </div>
            <?php
        }
            ?>