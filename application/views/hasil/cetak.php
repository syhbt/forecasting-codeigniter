<section class="content-header">
      <h1>
        Sistem Peramalan
        <small>Metode Double Exponential Smoothing</small>
      </h1>
    </section>
<section class="content">
    <div class="col-md-12">
    
    <section class="invoice">
    <div class="col-md-12 text-right no-print clearfix">    
    <!-- <button name="btnCetak" type="button" onclick="cetakHasil()" class="btn btn-default btn-flat"><i class="fa fa-print"></i> Cetak</button> -->
    </div>
<!-- title row -->

<div class="row">
  
  <!-- /.col -->
</div>
<div class="text-center">
  <h4>Hasil Peramalan</h4>
</div>
<div class="row invoice-info">
        <div class="col-sm-6">
          <address>
            <strong>Tanggal Peramalan :</strong> <?=indonesian_date($detailPeramalan['tanggal_hasil'])?><br>
            <strong>Judul Peramalan :</strong> <?=$detailPeramalan['nama_hasil']?><br>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-2 invoice-col">
        </div>
        <!-- /.col -->
</div>
<div class="row">
    <div class="col-sm-12">
    <div class="text-center">
      <h4>Forecast Trend</h4>
    </div>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Periode Peramalan</th>
                    <th>Hasil Peramalan</th>
                    <th>Periode Urutan</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $number = 1;
                    foreach($detailHasilPeramalan as $rowPeramalan) :
                ?>
                <tr>
                    <td><?=$number?></td>
                    <td><?=$rowPeramalan['periode_char']?></td>
                    <td><?=$rowPeramalan['hasil']?></td>
                    <td><?=$rowPeramalan['periode_urutan']?></td>
                </tr>
                <?php 
                    $number++;
                    endforeach;
                ?>
            </tbody>
        </table>
    </div>
    <div class="col-sm-12 invoice-col">
    <div class="text-center">
      <h4>Forecast Error</h4>
    </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Metode</th>
                    <th>Perhitungan</th>
                    <th>Periode Urutan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>MAD</td>
                    <td><?=$detailHasilError['nilaiPerhitunganMADValue']?></td>
                    <td><?=$detailHasilError['nilaiHasilMADValue']?></td>
                </tr
                <tr>
                    <td>MSE</td>
                    <td><?=$detailHasilError['nilaiPerhitunganMSEValue']?></td>
                    <td><?=$detailHasilError['nilaiHasilMSEValue']?></td>
                </tr>
                <tr>
                    <td>MAPE</td>
                    <td><?=$detailHasilError['nilaiPerhitunganMAPEValue']?></td>
                    <td><?=$detailHasilError['nilaiHasilMAPEValue']?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- /.row -->    
</section>
    </div>
</section>
<script>
function cetakHasil(){
    window.print();
}
</script>