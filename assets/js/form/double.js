var base_url_post = global_url+'double/';
var base_url_media = global_url+'media/';
var max_chars_synopsis = 210;

/// TinyMCE Initialization


$(function () {
       
});


/// Modal Media


$('#modal-forecast-double').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) 
  var id = button.data('id')
  
});

$('#add-forecast-double').click(function(){
       
       var nilai_alfa = $('#nilai_alfa').val().trim();
       var nilai_beta = $('#nilai_beta').val().trim();
       if (nilai_alfa=="") {
              //code
        alert("isi terlebih dahulu nilai alfa");
       }else if(nilai_beta==""){
        alert("isi terlebih dahulu nilai beta");
       }else{
        $('#modal-forecast-double').modal('show');       
       }
});

function saveDataExponentialDouble(){
       var nilai_observasi = $('#nilai_observasi').val().trim();
       var nilai_alfa = $('#nilai_alfa').val();
       var nilai_beta = $('#nilai_beta').val();
       if ((nilai_observasi=="")) {
              //code
              alert("Masukan Nilai Observasi Dan Alfa");
       }else{
       $.ajax({
              url : base_url_post+"saveValueForecastingDouble/",
              type : "POST",
              data : $('#detail-forecast-input').serialize() + "&alfa="+nilai_alfa+"&beta="+nilai_beta,
              dataType : "html",
              success: function msg(res){
                   var data = jQuery.parseJSON(res);
                   var status = data['status'];
                   var msg = data['status_msg'];
                   // AutoSave
                   if (status=='Success') {
                     //code
                     var rowHtml = data['rowHtml'];
                     $('#list_exspo_1').html(rowHtml);
                     $('#detail-forecast-input')[0].reset();
                     $('#message-update-forecast').html(msg);
                     $('#message-update-forecast').addClass('label-success');
                     $('#modal-forecast-double').modal('hide');
                     $('#message-update-forecast').removeClass('label-success');
                     $('#message-update-forecast').html("");
                   }else{
                     $('#message-update-forecast').html(msg);
                     $('#message-update-forecast').removeClass('label-success');
                     $('#message-update-forecast').addClass('label-danger');
                   }
              }
       });       
       }
       
}

function truncateTableDouble(){
       var r = confirm("Apakah Anda Ingin Menghapus Seluruh Data??");
       if (r==true) {
              //code
              $.ajax({
              url : base_url_post+"clearData/",
              type : "POST",
              dataType : "html",
              success: function msg(res){
                   var data = jQuery.parseJSON(res);
                   var status = data['status'];
                   var msg = data['msg'];
                   var html = data['html'];
                   if (status=='success') {
                     //code 
                     window.location.reload();
                   }else{
                     alert(msg);
                   }
              }
       }); 
       }
}


function hitungPeramalanDouble(){
       var nilai_alfa = $('#nilai_alfa').val();
       var nilai_beta = $('#nilai_beta').val();
       if ((nilai_alfa=="")) {
              //code
              alert("Masukan Nilai Alfa");
       }else if(nilai_beta==""){
              alert("Masukan Nilai Beta");
      }else{
       $.ajax({
              url : base_url_post+"processForecastingEksponentialDouble/",
              type : "POST",
              data : $('#frm-eksponensial').serialize(),
              dataType : "html",
              success: function msg(res){
                   var data = jQuery.parseJSON(res);
                   var status = data['status'];
                   var msg = data['status_msg'];
                   
                   if (status=="Success") {
                     //code
                     var htmlTag = data['htmlVal'];
                     var resGraphic = data['resVal'];
                     $('#result_exspo_1').html(htmlTag)
                     $('#result_box_ekspo1').css("display" , "inherit");
                     $('#result_graph_ekspo1').css("display" , "inherit");
                     var resError = data['ErrorMethod'];
                     $('#nilaiPerhitunganMAD').html(resError['SumAbsDeviasi'] + " / " + resError['Devider']);
                     $('#nilaiHasilMAD').html(resError['MAD_value']);
                     $('#nilaiPerhitunganMSE').html(resError['SumPowDeviasi'] + " / " + resError['Devider']);
                     $('#nilaiHasilMSE').html(resError['MSE_value']);
                     $('#nilaiPerhitunganMAPE').html(resError['SumAbsSquareError'] + " / " + resError['Devider']);
                     $('#nilaiHasilMAPE').html(resError['MAPE_value'] + "%");
                   }else{
                     alert(msg);
                   }
                   // AutoSave
              }
       });       
       }
}
