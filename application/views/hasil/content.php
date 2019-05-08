<section class="content-header">
      <h1>
        Sistem Peramalan
        <small>Double Exponential Smoothing</small>
      </h1>
    </section>
<section class="content">
    <div class="col-md-12">
        <div class="box box-success clearfix">
                <div class="box-header">
                  <h3 class="box-title" id="form-head">Filter Hasil Peramalan</h3>
                </div>
                <form action="" class="form-horizontal">
                <div class="box-body">
                    
                    <div class="form-group">
                        <label class="col-sm-3 control-label form-label">Tanggal</label>
                        <div class="col-sm-3">
                            <div class="input-group date">
                                
                                <input value="2017-08-02" type="text" name="date1" class="form-control datepicker pull-right" id="datepicker1">
                            </div>
                        </div>
                        <div class="col-sm-1">
                            <label class="control-label form-label">s.d.</label>
                        </div>
                        <div class="col-sm-3">
                            <div class="input-group date">
                                <input value="<?=date('Y-m-d')?>" type="text" name="date2" class="form-control datepicker pull-left" id="datepicker2">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9 col-md-offset-3" style="margin-bottom:10px;">
                        <?=form_button("btnCheckData" , "Cari" , 'class="btn btn-primary" id="btnCheckData"')?>
                    </div>
                </div><!-- /.box-body -->
                </form>
            </div>
    </div>

    <div class="col-md-12">
        <div class="box box-success">
                <div class="box-header">
                  <h3 class="box-title" id="form-head">Data Hasil Peramalan</h3>
                  <div class="box-tools">
                    <?=form_button("btnCetak" , "Cetak Hasil" , 'id="btnCetak" class="btn btn-default"')?>
                  </div>
                </div>
                <div class="box-body">
                    <table class="table" id="table-hasil-forecasting">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Peramalan</th>
                                <th>Nama Peramalan</th>
                                <th>Hasil Peramalan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div>
    </div>
</section>
      