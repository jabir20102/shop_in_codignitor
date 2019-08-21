
<!-- Start Header -->
<div class="fables-header fables-after-overlay">
    <div class="container"> 
         <h2 class="fables-page-title fables-second-border-color">Results for <?php echo $keywords ?></h2>
    </div>
</div>  
<!-- /End Header -->
<!--Start Breadcrumbs -->
<div class="fables-light-gary-background">
    <div class="container"> 
        <nav aria-label="breadcrumb">
          <ol class="fables-breadcrumb breadcrumb px-0 py-3">
            <li class="breadcrumb-item"><a href="<?php  echo base_url(''); ?>" class="fables-second-text-color">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Search Results</li>
          </ol>
        </nav> 
    </div>
</div>
<!-- /End Breadcrumbs -->

     <div class="container">
      <?php
         include('flash.php');
      ?> 
    </div>
<!-- Start page content --> 
<div class="container">
     <div class="row my-4 my-md-5">
           
           <div class="col-12 col-md-12 col-lg-12"> 
                   <div class="row mb-4">
                       <div class="col-12 col-lg-4">
                           <form> 
                              <div class="form-group mb-0"> 
                                <select class="form-control rounded-0">
                                  <option value="" selected>default sorting</option>
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
                                        <a href="<?php echo base_url('product/'.$product->slug.'/'.$product->id);?>" class="fables-main-text-color fables-store-product-title fables-second-hover-color"><?php  echo  str_ireplace($keywords,"<span style='color:red;'>".$keywords."</span>",$product->title);
                                        ?></a>
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
            echo '<div class="container"><h2>No Results found for '.$keywords.'</h2></div>';
        }

          ?>  
          
                   </div> 
              

                <?php
include('hot-deal.php');
 ?>

           </div>
     </div>

</div> 
<!-- /End page content  -->
