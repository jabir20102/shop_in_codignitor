    <section class="tutorial-info">
        <div class="wraper">
            <div class="container">
                <div class="row py-4">
                    <div class="col-md-5">
                      <div class="embed-responsive embed-responsive-16by9">
                        <video class="embed-responsive-item mt-3" controls poster="<?php echo base_url($tutorial->thumbnail_url); ?>">
                          <source src="<?php echo base_url($tutorial->preview_url); ?>" type="video/mp4">
                        Your browser does not support the video tag.
                        </video>
                      </div>
                    </div>
                    <?php
                      // getting all the ratings of specific tutorial
                      $ratings = $this->crud_model->get_rating_by_tutorial($tutorial->id);
                      // sgettng the average of all the ratings
                      $count = count($ratings);
                      $sum=0;
                      foreach($ratings as $row){
                        $sum+=$row->rating;
                      }
                      if($count == 0){
                        $avg_rating = 'No Ratings Yet';
                      }else{
                        $avg_rating = round($sum / $count, 1);
                      }
                    ?>
                    <div class="col-md-7">
                        <h1 style="font-size: 32px"><?php echo $tutorial->title; ?></h1>
                        <h2 style="font-size: 1.5rem; font-weight: 300;"><?php echo $tutorial->short_description; ?></h2>

                        <?php
                        // geting the number of students enroled
                        $enrolments = $this->crud_model->get_enrolments_by_tutorial($tutorial->id);?>
                        <div class="mb-2">
                          <span class="col-2">Rating: <?php echo $avg_rating; ?></span>
                          <span class="col-2"><?php echo count($enrolments); ?> Student Learning</span>
                        </div>
                        <h5 class="col-12"><?php echo ucwords($tutorial->type).' Tutorial'; ?></h5>
                        <?php $teacher = $this->user_model->get_teacher_by_id($tutorial->teacher_id); ?>
                        <h5 class="my-2 col-12" style="font-size: 16px"><strong>Teacher:</strong> <?php echo $teacher->name ?></h5>

                        <?php
                        if($this->session->userdata('teacher_login')){
                            echo '<span data-toggle="tooltip" data-placement="right" title="Please login as student to learn from this tutorial."><button class="btn btn-outline-primary px-5" disabled style="pointer-events: none;">Start Learning</button></span>';
                        }
                        else{
                            echo '<form action="'.base_url('student/tutorial-enrolment').'" method="post" >';
                            echo '<input type="hidden" name="tut-id" value="'.$tutorial->id.'">';
                            echo '<button class="btn btn-outline-primary px-5" type="submit">Start Learning</button>';
                            echo '</form>';
                        }

                        ?>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>

<section class="tutorial-detail pt-4" style="min-height: 500px;">
  <div class="container">

    <ul class="nav nav-tabs nav-fill">
      <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#description">Description</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#syllabus">Syllabus</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#reviews">Reviews</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#teacher">Teacher</a>
      </li>
    </ul>
    <div id="TabContent" class="tab-content py-3">
      <div class="tab-pane fade active show" id="description">
        <p><?php echo $tutorial->description; ?></p>
      </div>

      <div class="tab-pane fade" id="syllabus">
        <div id="accordion">
          <?php
            $sections = $this->crud_model->get_section_by_tut_id($tutorial->id);

            foreach($sections as $sec):
          ?>
          <div class="card my-2">
            <div class="card-header">
              <a class="card-link" data-toggle="collapse" href="#<?php echo 'sec'.$sec->id; ?>">
                <?php echo $sec->title; ?>
              </a>
            </div>
            <div id="<?php echo 'sec'.$sec->id; ?>" class="collapse show" data-parent="#accordion">
              <div class="card-body">
                <?php
                    if($tutorial->type === 'video'){
                      $lessons = $this->crud_model->get_vlesson_by_sec_id($sec->id);
                    }
                    else{
                      $lessons = $this->crud_model->get_ilesson_by_sec_id($sec->id);
                    }
                    // var_dump($lessons);
                    echo '<ul class="list-group">';
                    foreach($lessons as $les){
                      echo '<li class="list-group-item">'.$les->title.'</li>';
                    }
                    echo '</ul>';
                ?>
              </div>
            </div>
          </div>  <!-- accordion acrd ends -->
          <?php endforeach; ?>
        </div> <!-- accordion ends -->
      </div> <!-- syllabus div ends -->

      <div class="tab-pane fade" id="reviews">
          <!-- Ratings and Reviews -->
        <div class="card card-comments mb-3 pb-3" style="max-height: 600px; overflow-y: auto;">
            <div class="card-header font-weight-bold">
             <?php echo $count.' Reviews'; ?> 
            </div>
            
            <?php
              foreach($ratings as $rating):
              $star = "ratings".$rating->rating.".png";
            ?>

            <div class="border p-2 mx-3 mt-3">
              <div class="d-inline">
                <table>
                  <?php
                    $student = $this->user_model->get_students('',$rating->student_id);

                    if($student->image_url == ''){
                        $image_src = base_url('uploads/frontend/user_images/placeholder.png');
                    }
                    else{
                        $image_src = base_url($teacher->image_url);
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
                            $date1 = $rating->date_added;                 // "2007-03-24";
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
                <?php echo $rating->review;?>
              </div>
            </div>

            <?php
              endforeach;
            ?>
        </div>
        <!-- Ratings and Reviews ends -->
      </div>

      <div class="tab-pane fade" id="teacher">
      <div class="container">
        <?php
            $teacher = $this->user_model->get_teacher_by_id($tutorial->teacher_id);
            if($teacher->image_url == ''){
                $image_src = base_url('uploads/frontend/user_images/placeholder.png');
            }
            else{
                $image_src = base_url($teacher->image_url);
            }
        ?>
            <div class="row">
                <div class="col-lg-4">
                    <div class="teacher-image text-center">
                        <img class="rounded-circle" src="<?php echo $image_src; ?>" width=220 height=220>
                        </img>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="teacher-bio pt-2">
                        <p><?php echo $teacher->bio; ?></p>
                    </div>
                    <a href="<?php echo base_url('user/'.$teacher->id); ?>">View Profile</a>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="related-tutorials">
  <div class="container">
    <h2>Related tutorials</h2>
    <?php include 'course-row.php'; ?>
  </div>
</section>