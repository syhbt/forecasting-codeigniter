<section class="content-header">
      <h1>
        Sistem Peramalan
        <small>Metode Double Exponential Smoothing</small>
      </h1>
    </section>
<section class="content">
      
      <div class="row">
        <div class="col-md-9">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"></h3>
              <div class="box-tools">
                <div class="input-group input-group-sm" >
                  <a href="#" class="btn btn-success" id="add-forecast">Tambah Data</a>
                  <a href="#" class="btn btn-danger" onclick="truncateTable()" id="clear-forecast">Bersihkan Data</a>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="boox-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody id="list_exspo_1">
                  <tr>
                  <th>Periode</th>
                  <th>Penjualan Produk</th>
                  <th>At</th>
                  <th>A't</th>
                  <th>at</th>
                  <th>bt</th>
                  <th>Forecasting</th>
                  <th>P</th>
                </tr>
                <?php
                  foreach($data_transaction as $rowTrans) :
                  $periode = $rowTrans['periode'];
                  $year = substr($periode,0,4);
                  $month = substr($periode,4,2);
                  $week = substr($periode,6,1);
                  $monthString = $arrMonth[$month];
                ?>
                <tr>
                  <td><?=$year." - ".$monthString ." (".$week . ")"?></td>
                  <td><?=$rowTrans['x_value']?></td>
                  <td><?=$rowTrans['a_value']?></td>
                  <td><?=$rowTrans['aa_value']?></td>
                  <td><?=$rowTrans['at_value']?></td>
                  <td><?=$rowTrans['bt_value']?></td>
                  <td><?=$rowTrans['forecasting']?></td>
                  <td>1</td>
                </tr>
                <?php
                endforeach;
                ?>
              </tbody></table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <div class="col-md-3">
            <div class="box box-success">
                <div class="box-header">
                  <h3 class="box-title" id="form-head">Properti Peramalan</h3>
                </div>
                <div class="box-body">
                  <form method="post" id="frm-eksponensial">
                   <div class="form-group">
                        <label>Alfa</label>
                        <?php $readonly = $alfaValue!="" ? " readonly " : "";?>
                        <input type="text" class="form-control" <?=$readonly?> placeholder="Nilai Alfa Peramalan" name="nilai_alfa" id="nilai_alfa" required="required" value="<?=$alfaValue?>">
                        <p class="help-block">Masukan Nilai Alfa Peramalan (0-1)</p>
                    </div>
                   <div class="form-group">
                        <label>Periode Peramalan</label>
                        <?=$frm_periode_list?>
                        <p class="help-block">Pilih Jumlah Periode Peramalan (1-60)</p>
                    </div>
                    <div class="box-footer">
                        <button type="button" id="btnHitung" class="btn btn-primary">Hitung</button>
                    </div>
                  </form>
                </div><!-- /.box-body -->
            </div>
        </div>
      </div>
      <div class="row">
            <div class="col-md-6" id="result_box_ekspo1" style="display: none;">
                  <div class="box box-success">
                        <div class="box-header">
                        <h3 class="box-title">Forecast Trend</h3>
                        <div class="box-tools pull-right">
                          <button class="btn btn-default" id="btnSimpanForecast">
                            Simpan
                          </button>
                        </div>
                        </div>
                        
            <div class="box-body table-responsive no-padding">
            <form action="" id="frm-forecast-list-result">
              <table class="table table-hover">
                <thead>
                <tr>
                  <th>Periode</th>
                  <th>Peramalan</th>
                  <th>P</th>
                </tr>
                </thead>
                <tbody id="result_exspo_1"> 
                </tbody>
                </table>
                </form>
            </div>
                  </div>
            </div>
            
            <div class="col-md-6" id="result_graph_ekspo1" style="display: none;">
                  <div class="box box-success">
                  <div class="box-header">
                  <h3 class="box-title">Forecasting Error</h3>
                  </div>
                  <div class="box-body table-responsive no-padding">
                  <form action="" id="frm-forecast-error">
                        <table class="table table-hover">
                        <tbody id="result_exspo_1">
                        <tr>
                          <th>Metode</th>
                          <th>Perhitungan</th>
                          <th>HASIL</th>
                        </tr>
                        <tr>
                          <td>MAD</td>
                          <td id="nilaiPerhitunganMAD"></td>
                          <input type="hidden" id="nilaiPerhitunganMADValue" name="nilaiPerhitunganMADValue">
                          <td id="nilaiHasilMAD"></td>
                          <input type="hidden" id="nilaiHasilMADValue" name="nilaiHasilMADValue">
                        </tr>
                        <tr>
                          <td>MSE</td>
                          <td id="nilaiPerhitunganMSE"></td>
                          <input type="hidden" id="nilaiPerhitunganMSEValue" name="nilaiPerhitunganMSEValue">
                          <td id="nilaiHasilMSE"></td>
                          <input type="hidden" id="nilaiHasilMSEValue" name="nilaiHasilMSEValue">
                        </tr>
                        <tr>
                          <td>MAPE</td>
                          <td id="nilaiPerhitunganMAPE"></td>
                          <input type="hidden" id="nilaiPerhitunganMAPEValue" name="nilaiPerhitunganMAPEValue">
                          <td id="nilaiHasilMAPE"></td>
                          <input type="hidden" id="nilaiHasilMAPEValue" name="nilaiHasilMAPEValue">
                        </tr>
                        </tbody>
                        </table>
                      </form>
                  </div>
                  </div>
            </div>
      </div>
      
<div class="modal fade" id="modal-forecast" role="dialog">
    <div class="modal-dialog" style="width: 50%;">
      <div class="modal-content" style="">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="glyphicon glyphicon-remove"></span></button>
          <h4 class="modal-title">Add Data Forecasting</h4>
        </div>
        <div class="modal-body" style="padding: 0px;">
           <div class="col-xs-12">
            <form id="detail-forecast-input" method="post">
                      <input type="hidden" id="id_forecast" name="id_forecast" value=""> 
                      <div class="form-group">
                          <label>Periode Tahun</label>
                          <?=$frm_year_list?>
                      </div>
                      <div class="form-group">
                          <label>Periode Bulan</label>
                          <?=$frm_month_list?>
                      </div>
                      <div class="form-group">
                          <label>Periode Minggu</label>
                          <?=$frm_week_list?>
                      </div>
                      <div class="form-group">
                          <label>Nilai Observasi</label>
                          <input type="text" id="nilai_observasi" name="nilai_observasi" value="" class="form-control" placeholder="Nilai Observasi"> 
                      </div>
                      <label id="message-update-forecast" class="label"></label>
            </form>
           </div>
        </div>
        <div class="modal-footer" style="clear:both">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
          <button type="button" id="btn-save-add-media" onclick="saveDataExponential()" class="btn btn-primary">Simpan Peramalan</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>
    