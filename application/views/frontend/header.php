
<div class="search-section">
    <a class="close-search" href="#"></a>
    <div class="d-flex justify-content-center align-items-center h-100">
        <form method="post" action="#" class="w-50">
            <div class="row">
                <div class="col-10">
                    <input type="search" value="" class="form-control palce bg-transparent border-0 search-input" placeholder="Search Here ..." /> 
                </div>
                <div class="col-2 mt-3">
                     <button type="submit" class="btn bg-transparent text-white"> <i class="fas fa-search"></i> </button>
                </div>
            </div>
        </form>
    </div>
         
</div>
    
<!-- Loading Screen -->
<div id="ju-loading-screen">
  <div class="sk-double-bounce">
    <div class="sk-child sk-double-bounce1"></div>
    <div class="sk-child sk-double-bounce2"></div>
  </div>
</div>

    
<!-- Start Top Header -->
<div class="fables-forth-background-color fables-top-header-signin">
    <div class="container">
        <div class="row" id="top-row">
            <div class="col-12 col-sm-2 col-lg-5">
                <div class="dropdown">
                  <button class="btn btn-secondary dropdown-toggle border-0 bg-transparent font-13 lang-dropdown-btn pl-0" type="button" id="dropdownLangButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                   language
                  </button>
                  <div class="dropdown-menu p-0 fables-forth-background-color rounded-0 m-0 border-0 lang-dropdown" aria-labelledby="dropdownLangButton">
                        <a class="dropdown-item white-color font-13 fables-second-hover-color" href="#">
                        <img src="<?php echo base_url('assets/custom/images/england.png') ?>" alt="england flag" class="mr-1"> English</a>
                        <a class="dropdown-item white-color font-13 fables-second-hover-color" href="#">
                        <img src="<?php echo base_url('assets/custom/images/France.png') ?>" alt="england flag" class="mr-1"> French</a> 
                  </div>
                </div>
                
            </div>
            <div class="col-12 col-sm-5 col-lg-4 text-right">
                <p class="fables-third-text-color font-13"><span class="fables-iconphone"></span> Phone :  (888) 6000 6000 - (888) 6000 6000</p>
            </div>
            <div class="col-12 col-sm-5 col-lg-3 text-right">
                <p class="fables-third-text-color font-13"><span class="fables-iconemail"></span> Email: Design@domain.com</p>
            </div>
            
        </div>
    </div>
</div>
 
<!-- /End Top Header -->

<!-- Start Fables Navigation -->
<div class="fables-navigation fables-main-background-color py-3 py-lg-0">
    <div class="container">
               <div class="row">
                   <div class="col-12 col-md-10 col-lg-9 pr-md-0">                       
                       <nav class="navbar navbar-expand-md btco-hover-menu py-lg-2">
         
                            <a class="navbar-brand pl-0" href="<?php echo base_url(); ?>"><img src="<?php echo base_url('assets/custom/images/fables-logo.png') ?>" alt="Fables Template" class="fables-logo"></a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#fablesNavDropdown" aria-controls="fablesNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="fables-iconmenu-icon text-white font-16"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="fablesNavDropdown"> 

                                <ul class="navbar-nav mx-auto fables-nav">
                                <li class="nav-item <?php if ($active=='home'){echo 'active';} ?>">
                                        <a class="nav-link" href="<?php echo base_url('/'); ?>">
                                            Home
                                        </a>
                                    </li>  
                                      <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="sub-nav1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Categories
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="sub-nav1">
                                            
                                           
                                           <?php 

                        $categories = $this->crud_model->get_categories();

                        foreach($categories as $cat){
                          if ($active==url_title($cat->cat_name, 'dash', true))
                                      {
                                        $activeClass= 'active';
                                      }else{
                                        $activeClass= '';
                                      }
                            echo '<li class="'.$activeClass.' common_selector">
                                        <a class="dropdown-item" href="'.base_url('categories/'.url_title($cat->cat_name, 'dash', true).'/'.$cat->id).'">
                                            '.$cat->cat_name.'
                                        </a>
                                    </li>';
                        
                        }

                        ?>
                                        </ul>
                                    </li>
                                     
                              <li class="nav-item <?php if ($active=='about'){echo 'active';} ?>">
                                        <a class="nav-link" href="<?php echo base_url('about'); ?>">
                                            About
                                        </a>
                                    </li> 
                                    <li class="nav-item <?php if ($active=='contactUs'){echo 'active';} ?>">
                                        <a class="nav-link" href="<?php echo base_url('contactUs'); ?>">
                                            Contact Us
                                        </a>
                                    </li>     

                                   
                                </ul> 

                    </div>
                </nav>
                   </div>
                   <div class="col-12 col-md-2 col-lg-3 pr-md-0 icons-header-mobile">
                       
                    <div class="fables-header-icons">
                        <div class="dropdown"> 
                                  <a href="#_" class="fables-third-text-color dropdown-toggle right px-3 px-md-2 px-lg-4 fables-second-hover-color top-header-link max-line-height position-relative" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                       <span class="fables-iconcart-icon font-20"></span>
                                       <span class="fables-cart-number fables-second-background-color text-center">
                                        <?php echo count($this->cart->contents());?></span>
                                    </a>
 
                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                     <div class="p-3 cart-block" id="cart_details">
                                    <p align="center">Cart is Empty</p>
                                             
                                             
                                             
                                        </div>
                                  </div>
                         </div>
                         <a href="#" class="open-search fables-third-text-color right  top-header-link px-3 px-md-2 px-lg-4 fables-second-hover-color border-0 max-line-height">
                            <span class="fables-iconsearch-icon"></span>
                        </a>
                         <a href="<?php echo base_url('login');  ?>" class="fables-third-text-color fables-second-hover-color font-13 top-header-link px-3 px-md-2 px-lg-4 max-line-height active"><span class="fables-iconuser"></span></a>
                         
                         
                         
                    </div>
                   </div>
               </div>
               
    </div>
</div> 
<!-- /End Fables Navigation --> 

<!-- Start Header -->
<!-- <div class="fables-header fables-after-overlay">
    <div class="container"> 
         <h2 class="fables-page-title fables-second-border-color">Store Grid List</h2>
    </div>
</div>  --> 
<!-- /End Header -->


  
 
