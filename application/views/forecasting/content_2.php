<section class="content-header">
      <h1>
        Sistem Peramalan
        <small>Dengan Metode Eksponesial Ganda</small>
      </h1>
    </section>
<section class="content">
      <div class="row">
        <div class="col-md-9">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Eksponential Dua Parameter</h3>
              <div class="box-tools">
                <div class="input-group input-group-sm" >
                  <a href="#" class="btn btn-success" id="add-forecast-double">Add Data</a>
                  <a href="#" class="btn btn-danger" onclick="truncateTableDouble()" id="clear-forecast">Clear Data</a>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody id="list_exspo_1">
                  <tr>
                  <th>Periode</th>
                  <th>Penjualan Produk</th>
                  <th>At</th>
                  <th>T</th>
                  <th>Forecasting</th>
                  <th>P</th>
                </tr>
                <?php
                  foreach($data_transaction as $rowTrans) :
                  $periode = $rowTrans['periode'];
                  $year = substr($periode,0,4);
                  $month = substr($periode,4,2);
                  $monthString = $arrMonth[$month];
                ?>
                <tr>
                  <td><?=$monthString." - ".$year?></td>
                  <td><?=$rowTrans['x_value']?></td>
                  <td><?=$rowTrans['at_value']?></td>
                  <td><?=$rowTrans['t_value']?></td>
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
                  <h3 class="box-title" id="form-head">Property Forecasting</h3>
                </div>
                <div class="box-body">
                  <form method="post" id="frm-eksponensial">
                  <?php
                  $readonlyAlfa = !empty($alfaValue) ? "readonly" : "";
                  $readonlyBeta = !empty($betaValue) ? "readonly" : "";
                  ?>
                   <div class="form-group">
                        <label>Alfa</label>
                        <input type="text" class="form-control" <?=$readonlyAlfa?> value="<?=$alfaValue?>" placeholder="Nilai Alfa Peramalan" name="nilai_alfa" id="nilai_alfa" required="required">
                        <p class="help-block">Masukan Nilai Alfa Peramalan (0-1)</p>
                    </div>
                   <div class="form-group">
                        <label>Beta</label>
                        <input type="text" class="form-control" <?=$readonlyBeta?> value="<?=$betaValue?>" placeholder="Nilai Beta Peramalan" name="nilai_beta" id="nilai_beta" required="required">
                        <p class="help-block">Masukan Nilai Beta Peramalan (0-1)</p>
                    </div>
                   <div class="form-group">
                        <label>Periode Peramalan</label>
                        <?=$frm_periode_list?>
                        <p class="help-block">Pilih Jumlah Periode Peramalan (1-12)</p>
                    </div>
                    <div class="box-footer">
                        <button type="button" onclick="hitungPeramalanDouble()" class="btn btn-primary">Hitung</button>
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
                        <h3 class="box-title">Forecast Eksponential</h3>
                        </div>
                        <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody id="result_exspo_1">
                <tr>
                  <th>Periode</th>
                  <th>Forecasting</th>
                  <th>P</th>
                </tr>
              </tbody></table>
            </div>
                  </div>
            
            </div>
            
            <div class="col-md-6" id="result_graph_ekspo1" style="display: none;">
                  <div class="box box-success">
                  <div class="box-header">
                  <h3 class="box-title">Forecasting Error</h3>
                  </div>
                  <div class="box-body table-responsive no-padding">
                        <div class="box-body table-responsive no-padding">
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
                          <td id="nilaiHasilMAD"></td>
                        </tr>
                        <tr>
                          <td>MSE</td>
                          <td id="nilaiPerhitunganMSE"></td>
                          <td id="nilaiHasilMSE"></td>
                        </tr>
                        <tr>
                          <td>MAPE</td>
                          <td id="nilaiPerhitunganMAPE"></td>
                          <td id="nilaiHasilMAPE"></td>
                        </tr>
                        </tbody>
                        </table>
                  </div>
                  </div>
                  </div>
                        
            </div>
      </div>
      
<div class="modal fade" id="modal-forecast-double" role="dialog">
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
                          <label>Periode Bulan</label>
                          <?=$frm_month_list?>
                      </div>
                      <div class="form-group">
                          <label>Periode Tahun</label>
                          <?=$frm_year_list?>
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
          <button type="button" id="btn-save-add-media" onclick="saveDataExponentialDouble()" class="btn btn-primary">Simpan Peramalan</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>
    