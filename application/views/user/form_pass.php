<form method="POST" enctype="multipart/form-data" action="<?=$form_post_url?>" id="form_pass">
    <?=$form_user_id?>
  <div class="form-group">
      <label>Old Password</label>
      <?=$form_user_pass_old?>
  </div>
  <div class="form-group">
      <label>Password</label>
      <?=$form_user_pass?>
  </div>
  <div class="form-group">
      <label>Re-Enter Password</label>
      <?=$form_user_pass2?>
  </div>
  <div class="box-footer">
      <button type="submit" id="submit_pass" name="submit_pass" class="btn btn-primary">Submit</button>
  </div>
</form>