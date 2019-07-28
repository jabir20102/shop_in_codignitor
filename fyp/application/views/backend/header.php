    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar" class="bg-dark">
            <div class="sidebar-header">
                <h3 class="text-center"><a href="<?php echo base_url(); ?>">TREP</a></h3>
            </div>

            <ul class="list-unstyled components">
                <p>Admin Panel</p>
                <li class="<?php if($active == 'dashboard'){echo 'active';} ?>">
                    <a href="<?php echo base_url('admin/dashboard'); ?>">Dashboard</a>
                </li>
                <li class="<?php if($active == 'categories'){echo 'active';} ?>" >
                    <a href="<?php echo base_url('admin/categories'); ?>">Categories</a>
                </li>
                <li class="<?php if($active == 'students'){echo 'active';} ?>">
                    <a href="<?php echo base_url('admin/students'); ?>">Students</a>
                </li>
                <li class="<?php if($active == 'teachers'){echo 'active';} ?>">
                    <a href="<?php echo base_url('admin/teachers'); ?>">Teachers</a>
                </li>
                <li class="<?php if($active == 'all-tutorials'){echo 'active';} ?>">
                    <a href="<?php echo base_url('admin/all-tutorials'); ?>">All Tutorials</a>
                </li>
                <li class="<?php if($active == 'reported-tutorials'){echo 'active';} ?>">
                    <a href="<?php echo base_url('admin/reported-tutorials'); ?>">Reported Tutorials</a>
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