   <?php //$array = $this->session->userdata(); print_r($array);?>
    <!-- HEADER STARTS HERE -->
    <header >
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

                    <form action="<?php echo base_url('search'); ?>" method="GET" class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search for Tutorials" aria-label="Search" name="s" required style="width: 200px;">
                        <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
                        <a href="<?php echo base_url('signup'); ?>" class="btn btn-outline-light mx-2">Signup</a>
                        <a href="<?php echo base_url('login'); ?>" class="btn btn-outline-light">Login</a>
                    </form>
                </div>
            </div>

        </nav>
    </header>