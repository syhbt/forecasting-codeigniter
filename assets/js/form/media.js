var base_url_media = global_url+'media/';

$(function(){
    
});

$('#addMedia').click(function(){
    $('#uploadForm').toggle();
});

Dropzone.options.fileUpload = {
  paramName: "file_upload", // The name that will be used to transfer the file
  maxFilesize: 2, // MB
  accept: function(file, done) {
    if (file.name == "justinbieber.jpg") {
      done("Naha, you don't.");
    }
    else { done(); }
  },
  complete: function(file) {
    var _this = this;
    //this.removeFile(file);
    getLatestMedia();
    
  }
};

function setCrop() {
    $('#img-detail-container').Jcrop({
        boxWidth: 751,
        boxHeight: 960
    });
}

Dropzone.options.fileUploadInsert = {
  paramName: "file_upload", // The name that will be used to transfer the file
  maxFilesize: 2, // MB
  accept: function(file, done) {
    if (file.name == "justinbieber.jpg") {
      done("Naha, you don't.");
    }
    else { done(); }
  },
  complete : function(file){
        var _this = this;
        this.removeFile(file);
  },
  success: function(file , response) {
    var data = jQuery.parseJSON(response);
    var html = '<div class="col-xs-2">' +
                    '<a class="thumbnail" href="#" data-toggle="modal" data-id="'+data['id_post']+'" data-target="#mymodal">' +
                        '<img class="img-responsive" src="'+data['link_thumb']+'" alt="">' +
                    '</a>' +
                  '</div>';
    $('#content-media-uploaded').append(html);
  }
};

$('#mymodal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) 
  var id = button.data('id') 
  $.ajax({
       url : base_url_media+"detailMedia/",
       type : "POST",
       data : "id="+id,
       type : "post",
       dataType : "html",
       success: function msg(res){
            var data = jQuery.parseJSON(res);
            console.log(data);
            var modal = $(this)
            modal.find('.modal-title').text('id ' + id);
            //modal.find('#img-detail-container').html(data['form_image']);
            $('#img-detail-container').html(data['form_image']);
            $('#form_id_post').val(id);
            $('#form_url').val(data['form_url']);
            $('#form_url_guid').val(data['form_url_guid']);
            $('#form_title').val(data['form_title']);
            $('#form_caption').val(data['form_caption']);
            $('#form_alt_text').val(data['form_alt_image']);
            $('#form_desc').val(data['form_description']);
            $('#message-update-media').html("");
            //modal.find('#form_alt_text').val(data['form_caption']);
            $('#form_description').val(data['form_desc']);
            //modal.find('.modal-body input').val(recipient)
       }
  });
  
  
})

function getLatestMedia(){
    $.ajax({
       url : base_url_media+"latestMedia/",
       type : "POST",
       type : "post",
       dataType : "html",
       success: function msg(res){
            var data = jQuery.parseJSON(res);
            console.log(data);
            var htmlPage = data["html"];
            $('#content-media').html(htmlPage);
       }
    });
}

function deleteMedia(){
    var r = confirm("Delete File Permanently?");
    if (r==true) {
        //code
       $.ajax({
       url : base_url_media+"deleteMedia/",
       type : "POST",
       data : "id="+$('#form_id_post').val(),
       type : "post",
       dataType : "html",
       success: function msg(res){
            var data = jQuery.parseJSON(res);
            var status = data['status'];
            if (status==true) {
                //code
                alert("Media Has Been Deleted");
                window.location = base_url_media;
                $('#mymodal').close();
                
            }else{
                alert("Media Fail To Delete");
            }
       }
    }); 
    
    }
}

function saveDetailMedia(){
    $.ajax({
       url : base_url_media+"saveDetailMeta/",
       type : "POST",
       data : $('#detail-media').serialize(),
       type : "post",
       dataType : "html",
       success: function msg(res){
            var data = jQuery.parseJSON(res);
            var status = data['status'];
            if (status==true) {
                //code
                $("#message-update-media").html(data['error_stat']);
                $("#message-update-media").addClass("label-success");
            }else{
                $("#message-update-media").html("Failed To Connect "+data['error_stat']);
                $("#message-update-media").addClass("label-danger");
            }
       }
    });
}

