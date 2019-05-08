<form id="form-forecast-result" method="post">
    <input type="hidden" id="id_forecast" name="id_forecast" value=""> 
    <div class="form-group">
        <label>Tanggal</label>
       <!--<?php $ttgl=date('Y-m-d H:i:s');
        echo "$ttgl";

        ?>-->
       <?=$frm_tanggal?>
    </div>
    <div class="form-group">
        <label>Nama File</label>
        <?=$frm_file?>
    </div>
    <label id="message-update-forecast" class="label"></label>
    <div class="text-center">
        <button type="button" class="btn btn-primary" id="btnSimpanForecasting">Simpan</button>
    </div>
</form>

<script>
    $(function(){
        $('#tglData')

        $('#tglData').datepicker({

           "format": 'yyyy-mm-dd'
        }).datepicker("setDate", new Date ());


        $('#btnSimpanForecasting').click(function(){
            $.ajax({
                url : global_url + 'forecasting/simpanHasilForecasting/',
                type : "POST",
                data : $('#form-forecast-result').serialize()+"&"+$('#frm-forecast-list-result').serialize() + "&" + $('#frm-forecast-error').serialize(),
                success : function msg(response){
                    var data = $.parseJSON(response);
                    $('.bootbox').modal('hide');
                    var status = data['status'];
                    var message = data['message'];
                    alertPopUp(status , message , "");
                }
            });
        });
        
    });

    function alertPopUp(status,message,urlreturn){
    var classDiv = "modal-success";
    if(!status){
        classDiv = "modal-danger";
    }

    bootbox.alert({
        size : "small",
        title : "Peringatan",
        message : message,
        className : classDiv,
        callback : function(){
            if(urlreturn!="" && status==true){
                window.location = urlreturn;
            }
            
        }
    });
}
</script>