<!--Advanced Search  Form-->
<form method="post" id="advancedsearchform">
  <div class="modal" id="advancedsearchModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button class="close" data-dismiss="modal">
              &times;
            </button>
            <h4 id="myModalLabel">
              Advanced Search
            </h4>
        </div>
        <div class="modal-body">

            <!--Advanced Search message from PHP file-->
            <div id="signupmessage"></div>

            <div class="form-group">
                <label for="username" class="sr-only">Username:</label>
                <input class="form-control" type="text" name="username" id="username" placeholder="Username" maxlength="30">
            </div>
            <div class="form-group">
                <label for="email" class="sr-only">Email:</label>
                <input class="form-control" type="email" name="email" id="email" placeholder="Email Address" maxlength="50">
            </div>
            <div class="form-group">
                <label for="password" class="sr-only">Choose a password:</label>
                <input class="form-control" type="password" name="password" id="password" placeholder="Choose a password" maxlength="30">
            </div>
            <div class="form-group">
                <label for="password2" class="sr-only">Confirm password</label>
                <input class="form-control" type="password" name="password2" id="password2" placeholder="Confirm password" maxlength="30">
            </div>
        </div>
        <div class="modal-footer">
            <input class="btn green" name="signup" type="submit" value="Sign up">
          <button type="button" class="btn btn-default" data-dismiss="modal">
            Cancel
          </button>
        </div>
    </div>
</div>
</div>
</form>
