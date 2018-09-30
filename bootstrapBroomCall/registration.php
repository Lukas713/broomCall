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
        <form method="post">
            <div class="form-group">
                <label for="registerFirstName">First name</label>
                <input type="text" class="form-control" id="registerFirstName">
            </div>
            <div class="form-group">
                <label for="registerLastName">Last name</label>
                <input type="text" class="form-control" id="registerLastName">
            </div>
            <div class="form-group">
                <label for="registerEmail">Email</label>
                <input type="text" class="form-control" id="registerEmail">
            </div>
            <div class="form-group">
                <label for="registerPassword">Password</label>
                <input type="password" class="form-control" id="registerPassword" autocomplete="new-password">
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="showPassword" onclick="displayPassword()">
                <label class="form-check-label" for="showPassword">show password</label>
            </div>
            <div class="form-group">
                <label for="registerPhoneNumber">Phone number</label>
                <input type="text" class="form-control" id="registerPhoneNumber" autocomplete="new-password">
            </div>
           <button type="button" class="btn btn-primary" id="submitRegistration" value="submit">Submit</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
