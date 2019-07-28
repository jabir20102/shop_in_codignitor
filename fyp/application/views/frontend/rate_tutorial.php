<div class="mt-3 py-4" style="background-color: #e9e9e9;">
	<div class="container">
		<h1 style="font-weight: lighter; font-size: 2.8rem;">Rate and Review - <?php echo $tutorial->title; ?></h1>
	</div>
</div>

<div class="container my-5">

  <div class="<?php echo $this->session->flashdata('class');?>" role="alert">
    <?php echo $this->session->flashdata('error'); ?>
  </div>

	<?php
		if(isset($rated)){
		// var_dump($rated);
		// exit();
	?>
	<!--Show student Rating and Review -->
        <div id="review" class="card mb-3 pb-3">
            <div class="card-header font-weight-bold">
            	Your Submitted Review
            </div>
            
            <?php
              $star = "ratings".$rated->rating.".png";
            ?>
			

            <div class="border p-2 mx-3 mt-3">
              <div class="d-inline">
                <table>
                  <?php

                    $student = $this->user_model->get_students('',$rated->student_id);

                    if($student->image_url == ''){
                        $image_src = base_url('uploads/frontend/user_images/placeholder.png');
                    }else{
                        $image_src = base_url($student->image_url);
                    }
                  ?>
                  <tr>
                  <td><img class="rounded-circle" width="50" height="50" src="<?php echo $image_src ?>" ></td>
                    <td style="padding-left: 10px;">
                      <div style="font-weight: bold;">
                        <h4 class="m-0"><?php echo $student->name; ?></h4>
                      </div>
                      <div class="d-inline" >
                        <img height="20" src="<?php echo base_url('assets/frontend/images/'.$star); ?>">
                        <span style="color: grey;">
                          <?php
                            $date1 = $rated->date_added;                 // "2007-03-24";
                            $date2 = date('Y-m-d') ;             //  "2007-03-26";

                            $diff = abs(strtotime($date2) - strtotime($date1)); // returin in seconds

                            $months = floor($diff  / (30*24*60*60));
                            $days = floor(($diff  - $months*30*24*60*60)/ (60*60*24));

                            if($months==0){
                              echo $days." days ago";
                            }else{
                              echo $months." month ago";
                            }
                          ?>
                        </span>
                     
                      </div>
                    </td>

                  </tr>
                </table>

              </div>
              <div style="margin-left: 60px; ">
                <?php echo $rated->review;?>
              </div>
            </div>
            <div class="actions mt-3 mx-3">
            	<button id="editbtn" class="btn btn-primary">Edit Review</button>
            	<form action="<?php echo base_url('student/rate-tutorial/'.$tutorial->id.'/delete'); ?>" method="post" class="d-inline-block">
            		<input type="hidden" name="rating-id" value="<?php echo $rated->id; ?>">
            		<button type="submit" class="btn btn-danger">Delete Review</button>
            	</form>
            </div>
        </div>
        <!-- Show student Ratings and Reviews ends -->

        	  <!-- update form -->
  	<div id="editForm" style="display:none;">
	  	<form action="<?php echo base_url('student/rate-tutorial/'.$tutorial->id.'/update'); ?>" method="post">
			<div class="row">
	        <input type="hidden" name="rating-id" value="<?php echo $rated->id; ?>">

	        	<!-- rating bar starts -->

	        <input class="upd_star upd_star-5" id="upd_star-5" type="radio" name="upd_star" value="5" <?php  if($rated->rating==5){ ?>checked <?php  } ?> />
	    		<label class="upd_star upd_star-5" for="upd_star-5"></label>

	    		<input class="upd_star upd_star-4" id="upd_star-4" type="radio" name="upd_star" value="4" <?php  if($rated->rating==4){ ?>checked <?php  } ?> />
			    <label class="upd_star upd_star-4" for="upd_star-4"></label>

			    <input class="upd_star upd_star-3" id="upd_star-3" type="radio" name="upd_star" value="3"  <?php  if($rated->rating==3){ ?>checked <?php  } ?> />
			    <label class="upd_star upd_star-3" for="upd_star-3"></label>

			    <input class="upd_star upd_star-2" id="upd_star-2" type="radio" name="upd_star" value="2" <?php  if($rated->rating==2){ ?>checked <?php  } ?> />
			    <label class="upd_star upd_star-2" for="upd_star-2"></label>

	        <input class="upd_star upd_star-1" id="upd_star-1" type="radio" name="upd_star" value="1" <?php  if($rated->rating==1){ ?>checked <?php  } ?> />
			    <label class="upd_star upd_star-1" for="upd_star-1"></label>
	    		 
				<!-- rating bar ends -->
	     	</div>
	     	<div class="form-group">
	     		<textarea class="form-control"  name="review" placeholder="Comment" rows="5"> <?php echo $rated->review;?></textarea>
	     	</div>
	        <button class="btn btn-primary" type="submit">Update</button>
	    </form>
  	</div>
  <!-- update form div ends -->
	<?php
    } else {
  ?>
      <!--add new review-->
      <form action="<?php echo base_url('student/rate-tutorial/'.$tutorial->id.'/add'); ?>" method="post">
      <div class="row">
        <!-- rating bar starts -->
        <input class="star star-5" id="star-5" type="radio" name="star" value="5" required />
        <label class="star star-5" for="star-5"></label>
        <input class="star star-4" id="star-4" type="radio" name="star" value="4" required/>
        <label class="star star-4" for="star-4"></label>
        <input class="star star-3" id="star-3" type="radio" name="star" value="3" required/>
        <label class="star star-3" for="star-3"></label>
        <input class="star star-2" id="star-2" type="radio" name="star" value="2" required/>
        <label class="star star-2" for="star-2"></label>
        <input class="star star-1" id="star-1" type="radio" name="star" value="1" required/>
        <label class="star star-1" for="star-1"></label>
        <!-- rating bar ends -->
      </div>
      <div class="form-group">
          <textarea class="form-control"  name="review" placeholder="Write a detailed review" rows="5"></textarea>
        </div>
          <button class="btn btn-primary" type="submit">Add Review</button>
    </form>
  <?php
  } 
  ?>
	
</div>