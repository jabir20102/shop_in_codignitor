<!-- Start Header -->
<div class="fables-header fables-after-overlay">
    <div class="container"> 
         <h2 class="fables-page-title fables-second-border-color">Single Product</h2>
    </div>
</div>  
<!-- /End Header -->
   <?php
            $category = $this->crud_model->get_categories($product->category);
            $sub_category = $this->crud_model->get_sub_cat($product->sub_category);
            ?>
<!-- Start Breadcrumbs -->
<div class="fables-light-gary-background">
    <div class="container"> 
        <nav aria-label="breadcrumb">
          <ol class="fables-breadcrumb breadcrumb px-0 py-3">
            <li class="breadcrumb-item"><a href="<?php  echo base_url('/'); ?>" class="fables-second-text-color">Home</a></li>
            <li class="breadcrumb-item common_selector" aria-current="page"><a href="<?php echo base_url('categories/'.url_title($category->cat_name, 'dash', true).'/'.$category->id) ?>"><?php echo $category->cat_name; ?></a></li>  

             <li class="breadcrumb-item active" aria-current="page"><?php if($sub_category!=null) echo $sub_category->sub_cat_name; ?></li>
          </ol>
        </nav> 
    </div>
</div>
<!-- /End Breadcrumbs -->
     
<!-- Start page content -->   
<div class="container"> 
     <div class="row my-4 my-md-5">
          <div class="col-12 col-lg-6">
                 <div class="fables-single-slider store-single-slider">
                  <?php
                   $images = $this->crud_model->get_images($product->id);
                   ?>
                     <div id="sync1" class="owl-carousel owl-theme">
                      <?php
                      foreach($images as $image){
                        ?>
                         <div class="item">
                            <img  src="<?php echo base_url($image->url); ?>" alt="" class="w-100">
                          </div>
                          <?php
                              }     
                          ?>

                        </div>
                     <div id="sync2" class="owl-carousel owl-theme">
                         <?php
                      foreach($images as $image){
                        ?>
                         <div class="item">
                            <img  src="<?php echo base_url($image->url); ?>" alt="" class="w-100">
                          </div>
                          <?php
                              }     
                          ?>
                          

                        </div> 
                 </div>
          </div> 
          <div class="col-12 col-lg-6 col-12 col-lg-6 mt-3 mt-lg-0">
              <h2 class="fables-main-text-color font-20 semi-font"><?php echo $product->title;  ?></h2>
          
              <div class="fables-forth-text-color fables-single-tags mt-3">
                  <span class="fables-fifth-text-color fables-icontags"></span> 
                  <a href="#"><?php echo $category->cat_name;  ?></a>
                  <a href="#"><?php if($sub_category!=null) echo $sub_category->sub_cat_name;  ?></a>
              </div>
              
              <p class="fables-forth-text-color font-15 my-3">
                  <?php echo $product->description;  ?>
              </p>
              
              <div class="row mb-5">
                  <div class="col-5 col-md-3">
                      <span class="fables-fifth-text-color"> COLORS : </span>
                  </div>                          
                  <div class="col-7 col-sm-6">                             
                      <ul class="nav">
                         <li>
                             <label class="fable-product-color">
                                  <input type="checkbox">
                                  <span class="checkmark" style="background-color: #E54D42;"></span>
                              </label> 
                         </li>
                         <li>
                             <label class="fable-product-color">
                                  <input type="checkbox">
                                  <span class="checkmark" style="background-color: #343434;"></span>
                              </label>
                         </li>
                         <li>
                             <label class="fable-product-color">
                                  <input type="checkbox" checked="checked">
                                  <span class="checkmark" style="background-color: #E3C38E;"></span>
                              </label>
                         </li>
                         <li>
                             <label class="fable-product-color">
                                  <input type="checkbox">
                                  <span class="checkmark" style="background-color: #CDCDCD;"></span>
                              </label>
                         </li>

                      </ul>
                  </div>
              </div> 
              <div class="row mb-5">
                  <div class="col-12 col-sm-7 text-center text-md-left"> 
                      <span class="fables-fifth-text-color"><span class="fables-iconprice"></span> Price :</span> 
                      <span class="fables-second-text-color font-20 font-weight-bold">Rs <?php echo $product->price;  ?></span> 
                  </div>
                  <div class="col-9 col-md-4 col-lg-5 mt-3 mt-sm-0 mr-auto ml-auto mr-md-0 ml-md-auto">
                      <div class="fables-calc fables-light-background-color fables-btn-rouned">
                          <span  class="calc-btn minus fables-forth-text-color float-left calc-width mt-2">-</span> 
                          <span class="calc-width">
                              <input type="text" id="input-val" class="form-control d-inline-block border text-center form-circle-input rounded-circle"> 
                          </span>
                          <span  class="calc-btn plus fables-forth-text-color float-right calc-width mt-2">+</span>
                      </div>
                  </div>
              </div> 
            
              <div class="row mb-5">
                  <div class="col-6">
                        

                        <p class="fables-product-info">                       
                            <button type="button" name="add_cart" class="btn fables-second-border-color fables-second-text-color fables-btn-rouned fables-hover-btn-color font-14 p-2 px-2 px-xl-4 add_cart" data-productname="<?php echo $product->title; ?>" data-price="<?php echo $product->price; ?>" data-productid="<?php echo $product->id; ?>" data-url="<?php if(count($images)>0) echo base_url($images[0]->url); ?>" /><span class="fables-iconcart"></span> 
                                    <span class="fables-btn-value">ADD TO CART</span></button></p>

                  </div>
                  <div class="col-6 text-right"> 
                         <a href="" class="btn fables-product-btn text-white fables-forth-background-color rounded-circle fables-second-hover-background-color p-0"><span class="fables-iconcompare"></span></a> 
                        <?php
                        $wishlist=$this->user_model->check_wishlist($product->id);
                                              
                                              if($wishlist==null){

                                              ?>
                                              <a href="<?php echo base_url('user/add-to-wishlist/'.$product->id); ?>" class="btn fables-product-btn text-white fables-forth-background-color rounded-circle fables-second-hover-background-color p-0"><span class="fables-iconheart"></span></a>
                                              <?php
                                            }else{
                                              ?>
                                              <button class="btn fables-product-btn text-white fables-forth-background-color rounded-circle fables-second-hover-background-color p-0"><span class="fa fa-heart"></span></button>
                                              <?php
                                            }
                                            ?>
                       
                  </div>
              </div> 
                 
               <div class="row">
                  <div class="col-6 col-sm-4 col-lg-5 col-xl-4 text-left">
                      <a href="#" class="btn fables-forth-background-color fables-btn-rouned fables-second-hover-background-color white-color px-2 px-md-4 py-2 font-18">
                        <span class="fables-iconshare"></span> 
                        <span class="fables-btn-value">Share on </span></a>
                  </div>
                  <div class="col-6 col-sm-8 col-lg-7 col-xl-8 text-center mt-0 mt-sm-0 pl-0">
                      <ul class="nav fables-single-social mt-2 justify-content-end justify-content-lg-start">
                          <li><a href="#" target="_blank" class="fables-forth-text-color fables-single-link fables-second-hover-color"><i class="fab fa-facebook-f fa-fw"></i></a></li>
                          <li><a href="#" target="_blank" class="fables-forth-text-color fables-single-link fables-second-hover-color"><i class="fab fa-twitter fa-fw"></i></a></li>
                          <li><a href="#" target="_blank" class="fables-forth-text-color fables-single-link fables-second-hover-color"><i class="fab fa-instagram fa-fw"></i></a></li>
                          <li><a href="#" target="_blank" class="fables-forth-text-color fables-single-link fables-second-hover-color"><i class="fab fa-linkedin fa-fw"></i></a></li>
                      </ul>
                  </div>
              </div> 
          </div> 
     </div>
     <div class="row">
        <div class="col-12">
            <nav class="fables-single-nav">
          <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="fables-single-item nav-link fables-forth-text-color fables-second-active fables-second-hover-color fables-forth-after px-3 px-md-5 font-15 semi-font border-0 active rounded-0 py-3" id="nav-desc-tab" data-toggle="tab" href="#nav-desc" role="tab" aria-controls="nav-desc" aria-selected="true">DESCRIPTION</a>
            <a class="fables-single-item nav-link fables-forth-text-color fables-second-active fables-second-hover-color fables-forth-after border-0 px-3 px-md-5 font-15 semi-font rounded-0 py-3" id="nav-info-tab" data-toggle="tab" href="#nav-info" role="tab" aria-controls="nav-info" aria-selected="false">ADDITIONAL INFORMATION</a>
            <a class="fables-single-item nav-link fables-forth-text-color fables-second-active fables-second-hover-color fables-forth-after border-0 px-3 px-md-5 font-15 semi-font rounded-0 py-3" id="nav-review-tab" data-toggle="tab" href="#nav-review" role="tab" aria-controls="nav-review" aria-selected="false">COMMENTS (<?php echo count($this->crud_model->get_comments($product->id,'1')); ?>)</a>
          </div>
        </nav>
            <div class="tab-content" id="nav-tabContent">
          <div class="tab-pane fade show active" id="nav-desc" role="tabpanel" aria-labelledby="nav-desc-tab">
              <p class="fables-single-info mt-4 font-15 fables-fifth-text-color">
                  <?php echo $product->description;  ?>
              </p>
          </div>
          <div class="tab-pane fade" id="nav-info" role="tabpanel" aria-labelledby="nav-info-tab">
              <p class="fables-single-info mt-4 font-15 fables-fifth-text-color">
                 <?php echo $product->details;  ?>
              </p> 
          </div>
          <div class="tab-pane fade" id="nav-review" role="tabpanel" aria-labelledby="nav-review-tab">
              <?php
              include ('reviews.php');
              ?>
          </div>
        </div>
        </div>
     </div>
     <div class="row mb-0 mb-md-5">
           <div class="col-12">
               <h2 class="fables-forth-text-color fables-light-background-color my-3 my-md-5 py-3 text-center font-20 semi-font">Related Products</h2>
           </div>
           <?php
           $sub_category='';
            if($sub_category!=null) 
             $sub_category=$sub_category->id;
           $related_products= $this->crud_model->get_related_products($product->category,$sub_category);
           foreach ($related_products as $product) {
             $images = $this->crud_model->get_images($product->id);
            ?>
     

                   <div class="col-12 col-sm-6 col-md-4 col-lg-3 fables-product-block">
                           <div class="card rounded-0 mb-4">
                               <div class="row">
                                   <div class="fables-product-img col-12">
                                      <img class="card-img-top rounded-0" src="<?php if(count($images)>0) echo base_url($images[0]->url); ?>" alt="dress fashion">
                                      <div class="fables-img-overlay">                                          
                                          <ul class="nav fables-product-btns">
                                              <li><a href="<?php echo base_url('product/'.$product->slug.'/'.$product->id);?>" class="fables-product-btn"><span class="fables-iconeye"></span></a></li>
                                              <li><a href="" class="fables-product-btn"><span class="fables-iconcompare"></span></a></li>
                                              <li><button class="fables-product-btn"><span class="fables-iconheart"></span></button></li>
                                          </ul>
                                      </div>
                                  </div>
                                  <div class="card-body col-12">
                                    <h5 class="card-title mx-xl-3">
                                        <a href="<?php echo base_url('product/'.$product->slug.'/'.$product->id);?>" class="fables-main-text-color fables-store-product-title fables-second-hover-color"><?php echo $product->title; ?></a>
                                    </h5>
                                    <p class="store-card-text fables-fifth-text-color font-15 mx-xl-3"><?php echo $product->description; ?></p>
                                    <p class="font-15 font-weight-bold fables-second-text-color my-2 mx-xl-3">Rs <?php echo $product->price; ?></p>
                                    <input type="text" name="quantity" class="form-control quantity" id="<?php echo $product->id; ?>" value="1" hidden/><br />
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
         ?>
     </div>

</div> 
<!-- /End page content -->