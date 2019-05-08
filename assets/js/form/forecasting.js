var base_url_post = global_url+'forecasting/';
var base_url_media = global_url+'media/';
var max_chars_synopsis = 210;

/// TinyMCE Initialization


$(function () {
       
  $('#frm-eksponensial').validate({
    ignore : "",
    rules : {
      nilai_alfa : {
        required : true,
        range : [0,1]
      },
      periode_list : {
        required : true,
        range : [1,12]
      }
    },messages : {
      nilai_alfa : {
        required : "Nilai Alfa Harus Di Isi",
        range : "Nilai Alfa Peramalan Harus 0 - 1",
      },
      periode_list : {
        required : "Nilai Periode Harus Di Isi",
        range : "Nilai Periode Peramalan Harus 1 - 12",
      },
    }
  });
  
$('#btnHitung').click(function(){
	if($('#frm-eksponensial').valid()){
		hitungPeramalan();
	}
	});
       
});


/// Modal Media
$('#modal-forecast').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) 
  var id = button.data('id')
  
});

$('#modal-forecast-double').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) 
  var id = button.data('id')
  
});

$('#btnSimpanForecast').click(function(){
  $.ajax({
    url : base_url_post + 'getFormSimpan/',
    success : function msg(response){
      bootbox.dialog({
        title : "Form Simpan Peramalan",
        message : response,
      })
    }
  })
});


$('#add-forecast').click(function(){
       
       var nilai_alfa = $('#nilai_alfa').val().trim();
       var nilai_periode = $('#periode_list').val().trim();
       if (nilai_alfa=="") {
              //code
              alert("isi terlebih dahulu nilai alfa");
	   }else if(nilai_periode==""){
			alert("isi terlebih dahulu nilai periode");
       }else{
              $('#modal-forecast').modal('show');       
       }
       
});

$('#add-forecast-double').click(function(){
       
       var nilai_alfa = $('#nilai_alfa').val().trim();
       var nilai_beta = $('#nilai_beta').val().trim();
       if ((nilai_alfa=="") && (nilai_beta=="")) {
              //code
              alert("isi terlebih dahulu nilai alfa");
       }else{
              $('#modal-forecast-double').modal('show');       
       }
});

function changeType(){
       var type_list = $('#type_list').val();
       if (type_list==2) {
              //code
              $('#nilai_observasi').prop("disabled" , true);
       }else{
              $('#nilai_observasi').prop("disabled" , false);
       }
}



function saveDataExponential(){
       var nilai_observasi = $('#nilai_observasi').val().trim();
       var nilai_alfa = $('#nilai_alfa').val();
       if ((nilai_observasi=="")) {
              //code
              alert("Masukan Nilai Observasi Dan Alfa");
       }else{
       $.ajax({
              url : base_url_post+"saveValueForecasting/",
              type : "POST",
              data : $('#detail-forecast-input').serialize() + "&alfa="+nilai_alfa,
              dataType : "html",
              success: function msg(res){
                   var data = jQuery.parseJSON(res);
                   var status = data['status'];
                   var msg = data['status_msg'];
                   // AutoSave
                   if (status=='Success') {
                     //code
                     var rowHtml = data['rowHtml'];
                     $('#list_exspo_1').append(rowHtml);
                     $('#detail-forecast-input')[0].reset();
                     $('#message-update-forecast').html(msg);
                     $('#message-update-forecast').addClass('label-success');
                     $('#modal-forecast').modal('hide');
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

function truncateTable(){
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
                   if (status=='success') {
                     //code
                     window.location.reload();
                     $('#result_box_ekspo1').css("display" , "none");
                     $('#result_graph_ekspo1').css("display" , "none");
                   }else{
                     alert(msg);
                   }
              }
       }); 
       }
}


function hitungPeramalan(){
       
       var nilai_alfa = $('#nilai_alfa').val();
       if ((nilai_alfa=="")) {
              //code
              alert("Masukan Nilai Alfa");
       }else{
       $.ajax({
              url : base_url_post+"processForecastingEksponential/",
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
                     $('#result_exspo_1').html(htmlTag);
                     $('#result_box_ekspo1').css("display" , "inherit");
                     $('#result_graph_ekspo1').css("display" , "inherit");
                     var resError = data['ErrorMethod'];
                     $('#nilaiPerhitunganMAD').html(resError['SumAbsDeviasi'] + " / " + resError['Devider']);
                     $('#nilaiPerhitunganMADValue').val(resError['SumAbsDeviasi'] + " / " + resError['Devider']);
                     $('#nilaiHasilMAD').html(resError['MAD_value']);
                     $('#nilaiHasilMADValue').val(resError['MAD_value']);

                     $('#nilaiPerhitunganMSE').html(resError['SumPowDeviasi'] + " / " + resError['Devider']);
                     $('#nilaiHasilMSE').html(resError['MSE_value']);
                     $('#nilaiPerhitunganMSEValue').val(resError['SumPowDeviasi'] + " / " + resError['Devider']);
                     $('#nilaiHasilMSEValue').val(resError['MSE_value']);

                     $('#nilaiPerhitunganMAPE').html(resError['SumAbsSquareError'] + " / " + resError['Devider']);
                     $('#nilaiHasilMAPE').html(resError['MAPE_value'] + "%");
                     $('#nilaiPerhitunganMAPEValue').val(resError['SumAbsSquareError'] + " / " + resError['Devider']);
                     $('#nilaiHasilMAPEValue').val(resError['MAPE_value'] + "%");
                   }else{
                     alert(msg);
                   }
                   // AutoSave
              }
       });       
       }
}
