<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title><?=$meta_title?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="<?=ASSETS_URL?>bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?=ASSETS_URL?>dist/css/AdminLTE.css" rel="stylesheet" type="text/css" />
    
    <link href="<?=ASSETS_URL?>plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="<?=ASSETS_URL?>dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=ASSETS_URL?>plugins/morris/morris.css" rel="stylesheet" type="text/css" />
    <link href="<?=ASSETS_URL?>plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
    <link href="<?=ASSETS_URL?>custom/css/global.css" rel="stylesheet" type="text/css" />
    <!-- new post -->
    <!-- date and time picker -->
    <!-- Bootstrap datetime Picker -->
    <script>
      var global_url = '<?=base_url();?>';
    </script>
    <?php
      echo $custom_css;
    ?>
  </head>
  <body class="skin-red sidebar-collapse fixed">
    <div class="wrapper">
    <?=$head_navbar?>
    
      <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper clearfix">
    <!-- Content Header (Page header) -->
    <?=$main_content?>
  </div><!-- /.content-wrapper -->
  <?=$main_footer?>
  </div><!-- ./wrapper -->
    <!-- jQuery 2.1.3 -->
<script src="<?=ASSETS_URL?>plugins/jQuery/jquery-1.11.3.min.js"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="<?=ASSETS_URL?>bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<!-- Slimscroll -->
<script src="<?=ASSETS_URL?>plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<!-- FastClick -->
<script src='<?=ASSETS_URL?>plugins/fastclick/fastclick.min.js'></script>
<script src='<?=ASSETS_URL?>plugins/morris/morris.min.js'></script>
<script src='<?=ASSETS_URL?>plugins/datepicker/bootstrap-datepicker.js'></script>
<!-- bootbox-->
<script src='<?=ASSETS_URL?>plugins/bootbox/bootbox.js'></script>
<!-- DataTables -->
<script src='<?=ASSETS_URL?>plugins/datatables/jquery.dataTables.min.js'></script>
<script src='<?=ASSETS_URL?>plugins/datatables/dataTables.bootstrap.min.js'></script>

<!-- AdminLTE App -->
<script src="<?=ASSETS_URL?>dist/js/app.min.js" type="text/javascript"></script>
<?=$custom_js?>
  </body>
</html>
