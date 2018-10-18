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
        <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>" id="registrationForm">
          <div class="form-group" id="firstNameControl">	
              <label for="registerFirstName">First name</label>	
              <input type="text" id="registerFirstName" name="registerFirstName" class="form-control" >
             
          </div>
          <div class="form-group" id="lastNameControl">	
              <label for="registerLastName">Last name</label>	
              <input type="text" id="registerLastName" name="registerLastName" class="form-control">
          </div>
          <div class="form-group" id="emailControl">	
              <label for="registerEmail">Email</label>	
              <input type="email" id="registerEmail"  name="registerEmail" class="form-control">
              
          </div>
          <div class="form-group" id="passwordControl">	
              <label for="registerPassword">Password</label>	
              <input type="password" id="registerPassword" autocomplete="new-password" name="registerPassword" class="form-control">
              
          </div>
              <div class="form-group form-check">
                  <input type="checkbox" class="form-check-input" id="showPassword" onclick="displayPassword()">
                  <label class="form-check-label" for="showPassword">show password</label>
              </div>
          <div class="form-group" id="phoneControl">	
              <label for="registerPhoneNumber">Phone number</label>	
              <input type="text" id="registerPhoneNumber" name="registerPhoneNumber" class="form-control">
              
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
