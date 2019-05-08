<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Kedai Maksih | Log in</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="<?=ASSETS_URL?>bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?=ASSETS_URL?>dist/css/AdminLTE.css" rel="stylesheet" type="text/css" />

  </head>
  <body class="login-page">
    <div class="login-box">
      <div class="login-logo">
        <!--<a href="#"><b>Bit</b>CMS</a>-->
        <img src="<?php echo base_url("assets/img/kedaimaksih1.png")?>"  style="font-weight: bold; height: 130px; margin: -17px -14px; width: 150px;"><br>
       <font size="5"> Sistem Informasi Peramalan </font>
        <br>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg" id="msg-box">Sign in to start your session</p>
        <form action="#" method="post">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" name="email" placeholder="Email"/>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name="password" placeholder="Password"/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">  
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" name="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div><!-- /.col -->
          </div>
        </form>
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
    
    <!-- alert -->
    <?php
      
      if(isset($alert) && !empty($alert)):
      
        $message = $alert['message'];
        $status = ucwords($alert['status']);
        $class_status = ($alert['status'] == "success") ? 'success' : 'danger';
        $icon = ($alert['status'] == "success") ? 'check' : 'ban';
    ?>
    <div class="modal modal-<?php echo $class_status ?> fade" id="myModal" >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
            <h4 class="modal-title"><span class="icon fa fa-<?php echo $icon ?>"></span> <?php echo $status?></h4>
          </div>
          <div class="modal-body">
            <p><?php echo $message ?></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline" data-dismiss="modal">OK</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    
    <?php endif; ?>

    <!-- jQuery 2.1.3 -->
    <script src="<?=ASSETS_URL?>plugins/jQuery/jQuery-2.1.3.min.js"></script>
<!-- Bootstrap 3.3.2 JS -->
    <script src="<?=ASSETS_URL?>bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?=ASSETS_URL?>js/form/login.js"></script>
  </body>
</html>