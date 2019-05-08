var base_url_modul = global_url+'data-tindakan/';
var infoTable = "";
var data_grid = "";
$( document ).ready(function(){
    data_grid = $('#table-hasil-forecasting').DataTable({

          "searching": false,
          "ordering": false,
          "info": false,
          "autoWidth": true,
          "processing" : true,
          "ajax" : {
            "url" : global_url+"hasil/getDataHasil/",
            "type" : "POST",
            "data" : function (postParams) {
                postParams.start_date = $('#datepicker1').val();
                postParams.end_date = $('#datepicker2').val();
            }
          }
    });
     
    $('#btnCheckData').click(function(){
        data_grid.ajax.reload();
    });

    data_grid.on('draw.dt', function () {
        ///console.log( 'Redraw occurred at: '+new Date().getTime() );
        infoTable = data_grid.page.info();
    });

    $('.datepicker').datepicker({
        "format": 'yyyy-mm-dd',
        "locale" : 'id',
    });

    $('#btnExportExcel').click(function(){
        exportExcel();
    });

    $('#btnPrint').click(function(){
        print();
    });
    
});

function exportExcel(){
    var urlDownload = global_url+"mrekapitulasi/rekapitulasi_pengunjung/downloadExcel/rekap-pengunjung/";
    var id_pelayanan = $('#cmbPoli').val();
    var start_date = $('#datepicker1').val();
    var end_date = $('#datepicker2').val();
    var recordsTotal = infoTable.recordsTotal;
    var startRecord = infoTable.start;
    var endRecord = infoTable.length;

    if(recordsTotal > 0){
        var linkDownload = urlDownload+id_pelayanan+"/"+start_date+"/"+end_date+"/"+startRecord+"/"+endRecord; 
        window.open(linkDownload,'_blank');
    }
        
}
function print(){
    var urlDownload = global_url+"mrekapitulasi/rekapitulasi_pengunjung/printOut/rekap-pengunjung/";
    var start_date = $('#datepicker1').val();
    var end_date = $('#datepicker2').val();
    var linkDownload = urlDownload+start_date+"/"+end_date+"/"; 
    window.open(linkDownload,'_blank');
}

function hapusData(id_hasil){
    bootbox.confirm({
    title: "Peringatan",
    message: "Apakah Anda Akan Menghapus Data Ini ? ",
    buttons: {
        cancel: {
            label: '<i class="fa fa-times"></i> Tidak'
        },
        confirm: {
            label: '<i class="fa fa-check"></i> Ya'
        }
    },
    callback: function (result) {
        if(result==true){
            $.ajax({
                url : global_url + 'hasil/hapusData/' + id_hasil,
                success : function msg(response){
                    var data = $.parseJSON(response);
                    var status = data['status'];
                    if(status){
                        bootbox.alert({
                            message: "Data Berhasil Di Hapus",
                            backdrop: true
                        });
                        data_grid.ajax.reload();
                    }
                }
            });
        }
    }
});
}