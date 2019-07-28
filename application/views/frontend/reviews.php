 <hr>
                      <div class="row">
                          <div class="col-2">
                              <img src="<?php echo base_url('assets/custom/images/avatar.jpg') ?>" alt="" class="img-fluid">
                          </div>
                          <div class="col-10">
                              <p>
                                  <span class="fables-fifth-text-color font-14">Posted By</span>
                                  <a href="" class="fables-second-text-color fables-second-hover-color font-15 bold-font ml-1">Admin</a>
                              </p>
                              <p class="font-14 my-2 fables-main-text-color">
                                  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis iaculis egestas nisl velino in faucibus. Pellentes  
                              </p>
                          </div>
                      </div>
                        
                  <div class="fables-comments">
                      <h2 class="fables-main-text-color fables-light-background-color my-3 my-lg-4 font-15 bold-font py-3 px-4">Comments</h2>
                      <input type="text" id="comment_product_id" value="<?php echo $product->id; ?>" hidden>
                      <div  id="comment_scroll" class="fables-comments" style=" overflow-y: scroll;height: 200px;">
                        <div id="loaded_comments"></div>
                       <div id="load_data_message"></div>
                    
                </div>
                  </div>

                  <div class="fables-blog-form">
                      <h2 class="fables-main-text-color fables-light-background-color my-3 my-lg-4 font-15 bold-font py-3 px-4">Leave a comment ...</h2>
                      <form id="commentForm" class="fables-contact-form mb-0">
                      <div class="form-row">
                          <div class="form-group col-md-6">
                              <input type="text" class="form-control form-control rounded-0 p-3" name="name" placeholder="Name" required>   
                          </div>
                          <div class="form-group col-md-6">
                              <input type="email" class="form-control form-control rounded-0 p-3" name="email" placeholder="Email" required> 
                          </div>
                      </div>                            
                      <div class="form-row"> 
                           <div class="form-group col-md-12">
                               <textarea class="form-control form-control rounded-0 p-3" name="comment" placeholder="Comment" rows="4" required></textarea>
                          </div> 
                      </div>
                      <input type="text" name="product_id" value="<?php echo $product->id ?>" hidden>
                      <div class="form-row">
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn fables-second-background-color rounded-0 text-white font-15 px-4 py-2">Post Comment</button>
                        </div>
                      </div>
                      
                    </form>
                  </div>

          </div>