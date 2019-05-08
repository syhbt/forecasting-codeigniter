<form method="POST" enctype="multipart/form-data" action="<?=$form_post_url?>" id="form_user">
  <?=$form_user_id?>
  <div class="form-group">
      <label>User Name</label>
      <?=$form_user_login?>
  </div>
  <?php
    if(!empty($form_user_pass)) :
  ?>
  <div class="form-group">
      <label>Password</label>
      <?=$form_user_pass?>
  </div>
  <div class="form-group">
      <label>Re-Enter Password</label>
      <?=$form_user_pass2?>
  </div>
  <?php
  else :
  ?>
  <div class="form-group">
  <a href="<?=$url_change_password?>"  class="btn btn-info">Change Password</a>
  </div>
  <?php
  endif;
  ?>
  <div class="form-group">
      <label>Status</label>
      <?=$form_user_level?>
  </div>
  <div class="box-footer">
      <button type="submit" id="submit_user" name="submit_user" class="btn btn-primary">Submit</button>
  </div>
</form>