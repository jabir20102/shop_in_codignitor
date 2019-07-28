    <?php //$array = $this->session->userdata(); print_r($array);?>
    <!-- HEADER STARTS HERE -->
    <header>
        <!-- NAVIGATION BAR -->
        <nav class="navbar navbar-expand-lg fixed-top navbar-dark">
            <div class="container">

                <a class="navbar-brand" href="<?php echo base_url(); ?>">TREP</a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle <?php if(isset($active)){if($active == 'categories'){ echo 'active'; }} ?>" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                Categories
                            </a>
                            <!-- MULTILEVEL DROPDOWN MENU -->
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <?php 

                        $categories = $this->crud_model->get_categories();

                        foreach($categories as $cat){
                            
                            $sub_categories = $this->crud_model->get_sub_by_parent_cat($cat->id);

                            echo '<li class="dropdown-submenu">';
                            echo '<a class="dropdown-item dropdown-toggle" href="#">'.$cat->cat_name.'</a>';
                            echo '<ul class="dropdown-menu">';

                            foreach($sub_categories as $sub_cat){
                               echo '<li><a class="dropdown-item" href="'.base_url('categories/'.url_title($sub_cat->sub_cat_name, 'dash', true).'/'.$sub_cat->id).'">'.$sub_cat->sub_cat_name.'</a></li>';
                            }

                            echo '</ul>';
                            echo '</li>';
                        }

                        ?>
                            </ul>

                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if(isset($active)){if($active == 'video'){ echo 'active'; }} ?>" href="<?php echo base_url('tutorials/video'); ?>">Video Tutorials</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if(isset($active)){if($active == 'interactive'){ echo 'active'; }} ?>" href="<?php echo base_url('tutorials/interactive'); ?>">Interactive Tutorials</a>
                        </li>
                    </ul>

                    <form action="<?php echo base_url('search'); ?>" method="GET" class="form-inline d-inline-block my-2 my-lg-0">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search for Tutorials" aria-label="Search" name="s" required style="width: 200px;">
                        <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
                        
                    </form>


                    <?php
                    $student = $this->session->userdata('student_login');
                    $teacher = $this->session->userdata('teacher_login');
                    if($student){
                        // echo 'student loged in';

                        // taking the image
                        $result = $this->user_model->get_students($this->session->userdata('student_email'));
                        
                        if($result->image_url == ''){
                            $image_src = base_url('uploads/frontend/user_images/placeholder.png');
                        }
                        else{
                            $image_src = base_url($result->image_url);
                        }

                    ?>
                        <ul class="navbar-nav"> 
                            <li class="nav-item dropdown">
                                <a href="<?php echo base_url('student/my-tutorials'); ?>" class="nav-link <?php if(isset($active)){if($active == 'my-tutorials'){ echo 'active'; }} ?>">My Tutorials</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a href="" class="nav-link dropdown-toggle <?php if(isset($active)){if($active == 'profile'){echo 'active';}}?>" role="button" data-toggle="dropdown">Profile</a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo base_url('student/edit-profile'); ?>" class="dropdown-item">Edit profile</a></li>
                                    <div class="dropdown-divider"></div>
                                    <li><a href="<?php echo base_url('logout'); ?>" class="dropdown-item">Logout</a></li>
                                </ul>
                            </li>
                            <li class="nav-item" data-toggle="tooltip" data-placement="top" title="<?php echo $this->session->userdata('student_name'); ?>" style="cursor: pointer;"><img src="<?php echo $image_src; ?>" class="rounded-circle" width=45 height=45></li>
                        </ul>
                    <?php
                    }
                    else{
                        // echo 'teacher loged in';
                        $result = $this->user_model->get_teachers($this->session->userdata('teacher_email'));
                        if($result->image_url == ''){
                            $image_src = base_url('uploads/frontend/user_images/placeholder.png');
                        }
                        else{
                            $image_src = base_url($result->image_url);
                        }

                        ?>
                        <ul class="navbar-nav"> 
                            <li class="nav-item dropdown">
                                <a href="" class="nav-link dropdown-toggle <?php if(isset($active)){if($active == 'teacher'){echo 'active';}} ?>" role="button" data-toggle="dropdown">Teacher</a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo base_url('teacher/dashboard'); ?>" class="dropdown-item">Dashboard</a></li>
                                    <div class="dropdown-divider"></div>
                                    <li><a href="<?php echo base_url('teacher/create-tutorial'); ?>" class="dropdown-item">Create Tutorial</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a href="" class="nav-link dropdown-toggle <?php if(isset($active)){if($active == 'profile'){echo 'active';}}?> " role="button" data-toggle="dropdown">Profile</a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo base_url('teacher/edit-profile'); ?>" class="dropdown-item">Edit profile</a></li>
                                    <div class="dropdown-divider"></div>
                                    <li><a href="<?php echo base_url('logout'); ?>" class="dropdown-item">Logout</a></li>
                                </ul>
                            </li>
                            <li class="nav-item" data-toggle="tooltip" data-placement="top" title="<?php echo $this->session->userdata('teacher_name'); ?>" style="cursor: pointer;"><img src="<?php echo $image_src; ?>" class="rounded-circle" width=45 height=45></li>
                        </ul>
                        <?php
                    }

                    ?>
                </div>
            </div>

        </nav>
    </header>