<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
          <div class="form-group">	
              <label for="registerFirstName">First name</label>	
              <input type="text" id="registerFirstName" name="registerFirstName" <?php echo empty($error["registerFirstName"]) ?  'class="form-control"' : ' class="form-control is-invalid" ' ;?>>
              <?php echo empty($error["registerFirstName"])? "" : ' <div class="invalid-feedback"> '.$error["registerFirstName"].'</div>' ;?>
          </div>
          <div class="form-group">	
              <label for="registerLastName">Last name</label>	
              <input type="text" id="registerLastName" name="registerLastName" <?php echo empty($error["registerLastName"]) ?  'class="form-control"' : ' class="form-control is-invalid" ' ;?>>
              <?php echo empty($error["registerLastName"])? "" : ' <div class="invalid-feedback"> '.$error["registerLastName"].'</div>' ;?>
          </div>
          <div class="form-group">	
              <label for="registerEmail">Email</label>	
              <input type="email" id="registerEmail" name="registerEmail" <?php echo empty($error["registerEmail"]) ?  'class="form-control"' : ' class="form-control is-invalid" ' ;?>>
              <?php echo empty($error["registerEmail"])? "" : ' <div class="invalid-feedback"> '.$error["registerEmail"].'</div>' ;?>
          </div>
          <div class="form-group">	
              <label for="registerPassword">Password</label>	
              <input type="password" id="registerPassword" name="registerPassword" <?php echo empty($error["registerPassword"]) ?  'class="form-control"' : ' class="form-control is-invalid" ' ;?>>
              <?php echo empty($error["registerPassword"])? "" : ' <div class="invalid-feedback"> '.$error["registerPassword"].'</div>' ;?>
          </div>
              <div class="form-group form-check">
                  <input type="checkbox" class="form-check-input" id="showPassword" onclick="displayPassword()">
                  <label class="form-check-label" for="showPassword">show password</label>
              </div>
              <div class="form-group">	
              <label for="registerPhoneNumber">Phone number</label>	
              <input type="text" id="registerPhoneNumber" name="registerPhoneNumber" <?php echo empty($error["registerPhoneNumber"]) ?  'class="form-control"' : ' class="form-control is-invalid" ' ;?>>
              <?php echo empty($error["registerPhoneNumber"])? "" : ' <div class="invalid-feedback"> '.$error["registerPhoneNumber"].'</div>' ;?>
          </div>
           <input type="submit" class="btn btn-primary" name="registrationSubmit" value="Submit">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
