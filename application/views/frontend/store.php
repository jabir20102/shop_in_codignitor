<!-- Start Header -->
<div class="fables-header fables-after-overlay">
    <div class="container"> 
         <h2 class="fables-page-title fables-second-border-color"><?php echo $category_name; ?></h2>
    </div>
</div>  
<!--Start Breadcrumbs -->
<div class="fables-light-gary-background">
    <div class="container"> 
        <nav aria-label="breadcrumb">
          <ol class="fables-breadcrumb breadcrumb px-0 py-3">
            <li class="breadcrumb-item"><a href="<?php  echo base_url(''); ?>" class="fables-second-text-color">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo $category_name; ?></li>
          </ol>
        </nav> 
    </div>
</div>
<!-- /End Breadcrumbs -->
     
<!-- Start page content --> 
<div class="container">
     <div class="row my-4 my-md-5">
           <div class="col-12 col-md-4 col-lg-3">
               <div class="fables-store-search mb-4">
                   <form> 
                         <div class="input-icon">
                             <span class="fables-iconsearch-icon fables-input-icon"></span>
                             <input type="text" class="form-control rounded-0 form-control rounded-0 font-14 fables-store-input pl-5 py-2"  placeholder="Search Product">
                         </div>
 
                  </form>
               </div>
               <form action="<?php  echo base_url('sub_categories'); ?>" method="get"> 
               <div class="rage-slider">
                    <h2 class="font-16 semi-font fables-forth-text-color fables-light-gary-background  p-3 mb-4">Filter by price</h2>
                    
                    <?php
                    if(isset($_GET['min-price']) && isset($_GET['max-price'])){
                    $min=$_GET['min-price'];
                    $max=$_GET['max-price'];
                  }else{$min=0;$max=10000;}
                    ?>
                    
                         <div class="range-slider fables-forth-text-color" id="facet-price-range-slider" data-options='{"output":{"prefix":""},"maxSymbol":"+"}'>
                             <input name="min-price" value="<?php echo $min;  ?>" min="0" max="10000" step="100" type="range">
                             <input name="max-price" value="<?php echo $max;  ?>" min="0" max="10000" step="100" type="range">
                         </div> 
                        
               </div>
               <div id="slider"></div>
                <input type="hidden"  value="<?php echo $category;  ?>" name="category">
               <h2 class="font-16 semi-font fables-forth-text-color fables-light-gary-background  p-3 mb-4">Sub Categories</h2>
               <ul class="nav fables-forth-text-color fables-forth-before fables-store-left-list">
                <?php 
                $sub_category=array();
                if(!empty($_GET['sub_category'])){
                        $sub_category=$_GET['sub_category'];
                      } 
                     foreach($sub_categories as $sub_cat)
                    {
                        if (in_array($sub_cat->id, $sub_category)){
                          $checked="checked";
                        }else{$checked="";}
                    ?>
                    <li class="list-group-item checkbox">
                        <label><input name="sub_category[]" type="checkbox" class="common_selector brand" value="<?php echo $sub_cat->id; ?>" <?php echo $checked; ?>> <?php echo $sub_cat->sub_cat_name; ?></label>
                    </li>
                    <?php
                    }
                   ?>
               </ul>
                  <button type="submit" class="btn btn-block fables-second-background-color rounded-0 white-color white-color-hover p-2 font-15 mb-4" <?php if($offer==true) echo "disabled"; ?> >Filter</button>
                </form>

               <h2 class="font-16 semi-font fables-forth-text-color fables-light-gary-background  p-3 my-4">Top Sells</h2>
               <?php  
               $top_sells=$this->crud_model->top_sells($category);
               foreach ($top_sells->result() as $sell) {
                  $product = $this->crud_model->get_products($sell->product_id);
                  $images = $this->crud_model->get_images($product->id);
                

               ?> 
               <div class="row mb-3">
                   <div class="col-4 pr-0">
                       <a href="#"><img src="<?php if(count($images)>0) echo base_url($images[0]->url); ?>" alt="" class="w-100"></a>
                   </div>
                   <div class="col-8">
                       <a href="<?php echo base_url('product/'.$product->slug.'/'.$product->id);?>" class="fables-main-text-color font-14 semi-font fables-second-hover-color store-card-text"> <?php echo $product->title; ?> </a>
                       <p class="font-weight-bold fables-second-text-color ">Rs <?php echo $product->price; ?></p>
                   </div>
               </div>  
               <?php  
             }

               ?> 
           </div>
           <div class="col-12 col-md-8 col-lg-9"> 
                   <div class="row mb-4">
                       <div class="col-12 col-lg-4">
                           <form> 
                              <div class="form-group mb-0"> 
                                <select class="form-control rounded-0">
                                  <option value="" selected>default sorting</option>
                                  <option>2</option>
                                  <option>3</option>
                                  <option>4</option>
                                  <option>5</option>
                                </select>
                              </div> 
                            </form>
                       </div>
                       <div class="col-4 col-md-6 col-lg-2 offset-lg-6 text-center pl-0 d-none d-lg-block">
                           <span class="fables-iconlist fa-fw fables-view-btn fables-list-btn fables-third-border-color fables-third-text-color"></span>
                           <span class="fables-icongrid active fa-fw fables-view-btn fables-grid-btn fables-third-border-color fables-third-text-color"></span>
                       </div>
                   </div>
                   <div class="row">
                   <?php    
                    
            
                
                 
                foreach($products as $product){
                   if($offer==true){
                    $product=$this->crud_model->get_products($product->product_id);
                  }
            $images = $this->crud_model->get_images($product->id);
             $wishlist=$this->user_model->check_wishlist($product->id);
             $isOffer=$this->crud_model->get_offer_products($product->id);
                
            ?>
     

                   <div class=" col-sm-6 col-md-4 col-lg-3 fables-product-block">
                           <div class="card rounded-0 mb-4">
                               <div class="row"> 
                                   <div class="fables-product-img col-12">
                                    <?php  if($isOffer!=null){
                                          echo '<span  class="sale fables-second-background-color text-center">
                                        '.($isOffer->percent*100).'% Off</span>';
                                       }  ?>
                                      <img class="card-img-top rounded-0" src="<?php if(count($images)>0) echo base_url($images[0]->url); ?>" alt="dress fashion">
                                      <div class="fables-img-overlay">                                          
                                          <ul class="nav fables-product-btns">
                                              <li><a href="<?php echo base_url('product/'.$product->slug.'/'.$product->id);?>" class="fables-product-btn"><span class="fables-iconeye"></span></a></li>
                                              <li><a href="" class="fables-product-btn"><span class="fables-iconcompare"></span></a></li>
                                              <?php
                                              
                                              if($wishlist==null){

                                              ?>
                                              <li><a href="<?php echo base_url('user/add-to-wishlist/'.$product->id); ?>" class="fables-product-btn"><span class="fables-iconheart"></span></a></li>
                                              <?php
                                            }else{
                                              ?>
                                              <li><button class="fables-product-btn"><span class="fa fa-heart"></span></button></li>
                                              <?php
                                            }
                                            ?>
                                          </ul>
                                      </div>
                                  </div>
                                  <div class="card-body col-12">
                                    <h5 class="card-title mx-xl-3">
                                        <a href="<?php echo base_url('product/'.$product->slug.'/'.$product->id);?>" class="fables-main-text-color fables-store-product-title fables-second-hover-color"><?php echo $product->title; ?></a>
                                    </h5>
                                    <p class="store-card-text fables-fifth-text-color font-15 mx-xl-3"><?php echo $product->description; ?></p>
                                    <p class="font-15 font-weight-bold fables-second-text-color my-2 mx-xl-3">
                                      Rs <?php  
                                      if($isOffer!=null){
                                       echo '<del>'.$product->price.'</del>  '.($product->price*(1-$isOffer->percent)); 
                                       }else{
                                        echo $product->price;
                                       }
                                         ?>
                                         </p>
                                    
                                <p class="fables-product-info">                       
                            <button type="button" name="add_cart" class="btn fables-second-border-color fables-second-text-color fables-btn-rouned fables-hover-btn-color font-14 p-2 px-2 px-xl-4 add_cart" data-productname="<?php echo $product->title; ?>" data-price="<?php echo $product->price; ?>" data-productid="<?php echo $product->id; ?>" data-url="<?php if(count($images)>0) echo base_url($images[0]->url); ?>" /><span class="fables-iconcart"></span> 
                                    <span class="fables-btn-value">ADD TO CART</span></button></p>
                                  </div>
                               </div>
                            </div>
                       </div>   
                       <!-- product ends -->
                     <?php
            }
            if(count($products)==0){
              echo '<h4>No result found</h4>';
            }

          ?>  
          
                   </div> 
                    <?php
          echo $this->pagination->create_links();
          ?>
              

                  

           </div>
     </div>
 <?php
include('hot-deal.php');
 ?>
</div> 
<!-- /End page content -->
