var base_url_post = global_url+'post/';
var base_url_media = global_url+'media/';
var max_chars_synopsis = 210;

/// TinyMCE Initialization

function setLimitChar(length) {
       //code
       var sisa = max_chars_synopsis - length;
       var htmlW = "Limit Character : " + sisa;
       $('#limit-synopsis').html(htmlW);
}

tinymce.init({
        selector:"#post_synopsis",
        plugins: [
                "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "table contextmenu directionality emoticons template textcolor paste textcolor colorpicker textpattern"
        ],
        height:"200",
        setup : function(ed){
          ed.on("KeyDown",function(ed,evt){
          chars = $.trim(tinyMCE.activeEditor.getContent().replace(/(<([^>]+)>)/ig,"")).length;
              var key = ed.keyCode;
          max_chars = max_chars_synopsis;
          setLimitChar(chars);
          
          if (chars > max_chars-1 && key != 8 && key != 46) {
              //code
                     return false;       
                ed.stopPropagation();
                ed.preventDefault();
          }
          });    
        },

        toolbar1: "bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | formatselect | subscript superscript | charmap | pagebreak ",
        toolbar2: "cut copy paste | bullist numlist | undo redo | link unlink | forecolor backcolor | image | code",
        menubar: false
    });

 tinymce.init({
        selector:"#post_content",
        plugins: [
                "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "table contextmenu directionality emoticons template textcolor paste textcolor colorpicker textpattern"
        ],
        height:"500",
        
        toolbar1: "bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | formatselect | subscript superscript | charmap | pagebreak ",
        toolbar2: "cut copy paste | bullist numlist | undo redo | link unlink | forecolor backcolor | image | code",
        menubar: false
    });
 
 

$(function () {
       $('#post_schedule').datetimepicker({
            format:"YYYY-MM-DD HH:mm:ss"
       });
       $("#post_tags").tokenInput(base_url_post+"get-tag", {
                method: 'post',
                queryParam : 'key',
                theme: "facebook",
                minChars : 3,
                searchDelay : 500,
                preventDuplicates : true,
                prePopulate : resultTags
       });
       
       $("#save_post").click(function(e) {
       e.preventDefault();
       tinyMCE.triggerSave();
       
       var StatusPost = $('#post_status').val();
       
       if ((StatusPost=='draft') || (StatusPost=='inherit')) {
        //code
       if ($('#post_title').val()=="") {
            //code
            $('#err-form-title').html("Isi Title Terlebih Dahulu");
            $('#err-form-featured-image').html("");
            $('#err-form-category').html("");
            $('#err-form-synopsis').html("");
       }else{
       saveDataPost(2);
       }
       }else{
       if ($("#form_post").valid()) {
              saveDataPost(2);
              
       }       
       }
       });
       
       $('#form_post').validate({
              
              ignore : "",
              rules : {
                     post_title : {
                            required : true,
                     },
                     post_synopsis : {
                            required : true,
                     },
                     'post_category[]' : {
                            required : true,
                     },
                     post_featured_image : {
                            required : true,
                     }
              },messages : {
                post_title:"Isi Title Terlebih Dahulu",
                'post_category[]':"Pilih Salah satu Category",
                post_featured_image:"Upload Featured Image Terlebih Dahulu",
                post_synopsis:"Isi Synopsis Terlebih Dahulu",
              },errorPlacement : function (error , element){
                     
                     var name = element.attr("name");
                     $('#msg-error-post').html("<div class='alert alert-danger'>Post Tidak Valid, Cek Atribut lainnya</div>");
                     if (name=="post_featured_image") {
                            //code
                            $('#err-form-featured-image').html(error);
                            
                     }else if (name=='post_title') {
                            //code
                            $('#err-form-title').html(error);
                            
                     }else if (name=='post_category[]') {
                            //code
                            $('#err-form-category').html(error);
                            
                     }
                     else if (name=='post_synopsis') {
                            //code
                            $('#err-form-synopsis').html(error);
                            
                     }
                     
              }
       });
});


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
    $('#tab_1').removeClass('active');
    $('#tab_2').addClass('active');
    //$('#image-library').append(html);
    $('#page_modal_media').val(1);
    getLatestMedia();
  }
};

function getLatestMedia(){
    var page = $('#page_modal_media').val();
    $.ajax({
       url : base_url_media+"latestMedia/",
       type : "POST",
       data : "type=post&page="+page,
       dataType : "html",
       success: function msg(res){
            var data = jQuery.parseJSON(res);
            console.log(data);
            var htmlPage = data["html"];
            if (page==1) {
              //code
              $('#image-library').html(htmlPage);
            }else{
              $('#image-library').append(htmlPage);
            }
            //page = parseInt(page + 1);
            var pageNext = data["page_next"];
            $('#page_modal_media').val(pageNext);
       }
    });
}

function moveToTrash(idPost , type) {
       //code
       locationDel = base_url_post+"updateStatus/"+idPost+'/inherit/';
       msg = "Apakah Anda Akan menghapus Postingan Ini ? ";
       if (type=='permanent') {
              locationDel = base_url_post+"deletePost/"+idPost;
              msg = "Apakah Anda Akan Menghapus Secara Permanen??";
       }
       
       var r = confirm(msg);
       if (r==true) {
              //code
              window.location = locationDel;
       }
}

function getDetailMedia(idMedia){
       $.ajax({
              url : base_url_media+"detailMedia/",
              type : "POST",
              data : "id="+idMedia,
              type : "post",
              dataType : "html",
              success: function msg(res){
                   var data = jQuery.parseJSON(res);
                   console.log(data);
                   $('#form_id_post').val(idMedia);
                   $('#form_url').val(data['form_url']);
                   $('#form_url_guid').val(data['form_url_guid']);
                   $('#form_title').val(data['form_title']);
                   $('#form_caption').val(data['form_caption']);
                   $('#form_alt_text').val(data['form_alt_image']);
                   $('#form_desc').val(data['form_description']);
              }
       });
}

/// Modal Media
$('#modal-media').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) 
  var id = button.data('id')
  getLatestMedia();
  
});

$('#btn-featured-image').click(function(){
       var htmlMsg = "Set Featured Image";
       $('#btn-save-add-media').attr("onclick" , "insertFeaturedPost()");
       $('#btn-save-add-media').html(htmlMsg);
       $('#modal-media').modal('show');
});

$('#add-media-post').click(function(){
       var htmlMsg = "Insert Into Post";
       $('#btn-save-add-media').attr("onclick" , "insertMedia()");
       $('#btn-save-add-media').html(htmlMsg);
       $('#modal-media').modal('show');
});



function insertFeaturedPost(){
       //alert("Hai Featured Post!!!");
       var imageId = $('#form_id_post').val();
       var imageSource = $('#form_url').val();
       var altText = $('#form_alt_text').val();
       var name = $('#form_name').val();
       var caption = $('#form_caption').val();
       var imgHtml = '<img alt="'+altText+'" data-caption="'+caption+'" width="220" src="' + imageSource + '"/>';
       if (imageSource=='') {
              //code
              alert("Please Select Image First!!!!")
       }else{
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
                              $('input[name=post_featured_image]').val(imageId);
                              $('#featured-image-container').html(imgHtml);
                              $('#modal-media').modal('hide');
                          }else{
                              alert("data not updated!!!");
                              $('#featured-image-container').html(imgHtml);
                              $('#modal-media').modal('hide');
                          }
                     }
              });       
       }
}
// Insert Media
function insertMedia() {
       //code
       var imageSource = $('#form_url').val();
       var altText = $('#form_alt_text').val();
       var name = $('#form_name').val();
       var caption = $('#form_caption').val();
       var guid = $('#form_url_guid').val();
       if (imageSource=='') {
              //code
              alert("Please Select Image First!!!!")
       }else{
              $.ajax({
                     url : base_url_media+"saveDetailMeta/",
                     type : "POST",
                     data : $('#detail-media').serialize(),
                     dataType : "html",
                     success: function msg(res){
                          var data = jQuery.parseJSON(res);
                          var status = data['status'];
                          if (status==true) {
                              //code
                              var html = '<div class="wp-caption aligncenter"><img alt="'+altText+'" data-caption="'+caption+'" data-guide="'+guid+'" height="300" width="300" src="' + imageSource + '"/><p class="wp-caption-text">'+caption+'</p></div><p></p>';
                              tinyMCE.execCommand('mceInsertContent', false, html);
                              $('#modal-media').modal('hide');
                          }else{
                              tinyMCE.execCommand('mceInsertContent', false, '<img alt="'+altText+'" data-caption="'+caption+'" data-guide="'+guid+'" height="300" width="300" src="' + imageSource + '"/>');
                          }
                     }
              });       
       }
       
}

$(function(){
   setInterval(function () {
        //$.post(base_url_post + "saveData/", $("#form_post").serialize());
        var title = $('#post_title').val();
        if (title!='') {
              //code
              //saveDataPost(1);
        }
    }, 10000);
});

function autoSave(){
       tinyMCE.triggerSave();
       $.ajax({
              url : base_url_post+"savePost/",
              type : "POST",
              data : $('#form_post').serialize(),
              dataType : "html",
              success: function msg(res){
                   var data = jQuery.parseJSON(res);
                   var status = data['success'];
                   var id = data['id'];
                   
                   
              }
       });
}

function saveDataPost(modesave){
       tinyMCE.triggerSave();
       $.ajax({
              url : base_url_post+"savePost/",
              type : "POST",
              data : $('#form_post').serialize(),
              dataType : "html",
              success: function msg(res){
                   var data = jQuery.parseJSON(res);
                   var status = data['success'];
                   
                   // AutoSave
                   if (status==true) {
                     //code
                     var idPost = data['id'];
                     if (modesave==1) {
                            $('input[name=post_id]').val(idPost);
                     }else{
                            var redirectUrl = base_url_post;
                            $('#msg-error-post').html("<div class='alert alert-success'>Data Has Been Saved</div>")
                            window.location = redirectUrl;       
                     }
                   }else{
                     $('#msg-error-post').html("<div class='alert alert-danger'>Failed To Save!!! Check Your Connection!!!!</div>")
                   }
                   
              }
       });
}

function postFormatValue(valueFormat){
       $('input[name=post_format]').val(valueFormat);
       $('.post_format_div').removeClass("active");
       $('#post_format_div'+valueFormat).addClass("active");
}
