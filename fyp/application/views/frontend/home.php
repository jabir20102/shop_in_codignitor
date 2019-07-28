<section id="hero-image">
    <div class="container">
        <h1>Increase Your Skills by Learning</h1>
        <h3>
            Laborum quorum quae iudicem multos, est occaecat ne officia, euamet ullamco laborum, legam
            praesentibus litteris esse consequat.
        </h3>
    </div>
</section>


<section class="recommendations">
    <div class="container">
        <h2 class="text-center my-5">Recommended Tutorials</h2>
        
        <?php

        $tutorials = $this->crud_model->get_tutorials('', 'count');

        if(count($tutorials) == 0){
            echo '<p>There are no tutorials </p>';
        }
        $index = 0;
        $rows = count($tutorials);
        for($i=1; $i<=$rows; $i+=4):
        // this loop will run equals to the number of (tutorial fetched)/4 because there will be 4 tutorials in each row and num of rows will be (tutorial fetched)/4.

        $start = $index;
        $end = $index + 4;
        ?>
        <div class="row mb-5">
            <?php 
            for($index = $start; $index < $end; $index++):
                // this loop will run only 4 times and shows 4 tutorials in one row.
                if($index == $rows){ break;} //braek the loop if last tutorial is reached
            ?>
            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <img class="card-img-top" src="<?php echo base_url($tutorials[$index]->thumbnail_url); ?>" alt="Tutorial Thumbnail Image">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $tutorials[$index]->title; ?></h5>
                        <p class="card-text"><?php echo $tutorials[$index]->short_description; ?></p>
                        <div class="my-2">
                            <?php
                                $teacher = $this->user_model->get_teacher_by_id($tutorials[$index]->teacher_id);
                            ?>
                            <span class="card-text d-block"><b>Teacher: </b><?php echo $teacher->name; ?></span>
                            <span class="card-text d-block"><?php echo ucwords($tutorials[$index]->type); ?> Tutorial</span>

                            <?php
                              // getting all the ratings of specific tutorial
                              $ratings = $this->crud_model->get_rating_by_tutorial($tutorials[$index]->id);
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
                            <span class="card-text d-block">Rating: <?php echo $avg_rating; ?></span>
                        </div>
                        <a href="<?php echo base_url('tutorial/'.$tutorials[$index]->slug.'/'.$tutorials[$index]->id);?>" class="btn btn-primary btn-block">View Tutorial</a>
                    </div>
                </div>
            </div>
            <?php endfor ?>
        </div>
        <?php endfor ?>
    </div>
</section>

<section class="get-recommendations">
    <div class="mt-3 py-4 d-flex" style="background-color: #e9e9e9; height: 180px">
        <div class="container text-center align-self-center">
            <a href="<?php echo base_url('preferences'); ?>" class=""><button class="btn btn-success btn-lg">Get Personalized Recommendations</button></a>
        </div>
    </div>
</section>