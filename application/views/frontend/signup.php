<div class="container">
    <form action="<?php echo base_url('signup/add-user'); ?>" method="POST" class="my-5 mx-auto w-50">
        <div class="form-group">
            <label for="fullName">Full Name</label>
            <input type="text" class="form-control" id="fullName" name="fullName" placeholder="Enter Full Name" required>
          </div>

        <div class="form-group">
          <label for="email">Email address</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
        </div>

        <div class="form-group">
          <label for="Password">Password</label>
          <input type="password" class="form-control" id="Password" name="pass" placeholder="Password" required>
        </div>
       

        <button type="submit" class="btn btn-primary">Submit</button>


        <div class="<?php echo $this->session->flashdata('class');?>" role="alert">
          <?php echo $this->session->flashdata('error'); ?>
        </div>
    </form>
</div>