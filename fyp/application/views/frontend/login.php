    <div class="container">
        <form action="<?php echo base_url('login/validate-login'); ?>" method="POST" class="my-5 mx-auto" style="width: 50%">

            <div class="form-group">
              <label for="Email">Email address</label>
              <input type="email" class="form-control" id="Email" name="email" aria-describedby="emailHelp" placeholder="Enter email" required>
            </div>

            <div class="form-group">
              <label for="Password">Password</label>
              <input type="password" class="form-control" id="Password" name="pass" placeholder="Enter Password" required>
            </div>
            
            <div class="form-group">
              <label for="user">Login As</label>
              <select class="form-control" id="user" name="login-role" required>
                <option value="student" selected>Student</option>
                <option value="teacher" >Teacher</option>
              </select>
            </div>

            <button type="submit" class="btn btn-primary">Login</button>

            <div class="<?php echo $this->session->flashdata('class');?>" role="alert">
              <?php echo $this->session->flashdata('error'); ?>
            </div>
        </form>
    </div>