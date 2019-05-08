    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <!--<?=$title?>-->
        Admin
        <a href="<?=$insert_link?>" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-pencil"></span> Tambah Admin Baru</a>
      </h1>
      <?php echo $breadcrumbs;?>
      <?=$breadcrumbs?>
      
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
            <div class="box box-warning">
                <div class="box-header">
                  <h3 class="box-title">Data Admin</h3>
                    <div class="box-tools">
                        <div class="input-group">
                            <form method="GET" action="?">
                            <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
                            <input type="text" name="search" class="form-control pull-right input-sm" style="width: 200px;" placeholder="Search">
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="box-body table-responsive ">
                    <table class="table table-hover table-striped">
                        <tbody><tr>
                            <th>Name</th>
                            <th>Level</th>
                        </tr>
                        <?php foreach($data as $d):?>
                        <tr>
                            <td><?=$d->user_name?></td>
                            <td><?php echo ($d->status_user == 1) ? 'Aktif' : 'Tidak Aktif' ?></td>
                        </tr>
                        <?php endforeach ?>
                    </tbody></table>
                </div>
                
                <div class="box-footer clearfix">
                    <?=$pagination?>
                </div>
            </div>
        </div>
      </div>
    </section><!-- /.content -->

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