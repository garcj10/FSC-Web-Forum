<?php include('includes/register.php'); ?>

    <div class="row">
      <div class="col-md-4 col-md-offset-4">
          <p class=""><a class="pull-right" href="index.php"> Login</a></p><br>
      </div>
      <div class="col-md-4 col-md-offset-4">
        <form class="form-horizontal" role="form" method="post" action="register_account.php" enctype="multipart/form-data">
         <!-- First Name -->
          <div class="form-group">
            <label class="control-label col-sm-2" for="firstName"></label>
            <div class="col-sm-10">
              <input type="firstName" name="firstName" class="form-control" id="firstName" placeholder="Enter First Name" required>
            </div>
          </div>
          <!-- Last Name -->
          <div class="form-group">
              <label class="control-label col-sm-2" for="lastName"></label>
             <div class="col-sm-10">
              <input type="lastName" name="lastName" class="form-control" id="lastName" placeholder="Enter Last Name" required>
            </div>
            </div>
          <!-- Email -->
          <div class="form-group">
            <label class="control-label col-sm-2" for="email"></label>
            <div class="col-sm-10">
              <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email" required>
            </div>
          </div>
          <!-- Password -->
          <div class="form-group">
            <label class="control-label col-sm-2" for="pwd"></label>
            <div class="col-sm-10"> 
              <input type="password" name="password" class="form-control" id="pwd" placeholder="Enter Password" required>
            </div>
          </div>
          <div class="form-group"> 
            <div class="col-sm-offset-2 col-sm-10">
              <div class="checkbox">
                <label><input type="checkbox" required> Accept </label>
              </div>
            </div>
          </div>
         <!-- Register/Cancel Buttons -->
          <div class="form-group"> 
            <div class="col-sm-offset-2 col-sm-10 text-center">
              <button type="submit" class="btn btn-primary pull-right" name="submit_registry">Register</button>
              <a class="pull-left btn btn-danger" href="index.php"> Cancel</a>
            </div>
          </div>
</form> 
  </div>
</div>