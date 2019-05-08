var base_url_trending = global_url+'gallery/'+mode_gallery+'/';
var key;
$(document).ready(function() {
    $('#list_gallery').sortable({
        update : function(){
            var order = $('#list_gallery').sortable('serialize'); 
            //console.log(order);
            changeOrder(order); 
        }
    });
    /// Start Gallery By Ajax
    key = $('#key_mode').val();
    getGallery();
});

function getYoutubeDetail(){
    
    api_key = "AIzaSyBNqhOJe_KkDpk7THIIvo4Ed2dodYZnlpY";
    var youtube_link = $("#form_url_video").val();
    var youtube_id = youtube_parser(youtube_link);
    if (youtube_link=="") {
        //code
        alert("Fill The Video Link First");
    }else{
    var api_url = 'https://www.googleapis.com/youtube/v3/videos?id='+youtube_id+'&key='+api_key+'&part=snippet';
        $.ajax({
           url : api_url,
           type : "get",
           dataType : "html",
           success: function msg(res){
                var data = jQuery.parseJSON(res);
                insertToFormVideo(data);
           }
      });    
    }
}

function insertToFormVideo(data){
                console.log(data.items[0].snippet.localized);
                var titleVideo = data.items[0].snippet.localized.title;
                var descVideo = data.items[0].snippet.localized.description;
                var thumbVideo = data.items[0].snippet.thumbnails.standard.url;
                $('#form_vid_title').val(titleVideo);
                $('#form_vid_description').val(descVideo);
                $('#form_vid_thumb').val(thumbVideo);
                $('#youtube-results').html("<img src='"+thumbVideo+"' class='img-responsive' />")
}

function youtube_parser(url){
    var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
    var match = url.match(regExp);
    return (match&&match[7].length==11)? match[7] : false;
}

function deleteTrend(id){
    $.ajax({
       url : base_url_trending+"removeGallery/",
       data : "ID="+id,
       type : "post",
       dataType : "html",
       success: function msg(res){
            var data = jQuery.parseJSON(res);
            var status = data['status'];
            if (status==true) {
                //code
                getGallery();
            }
       }
  });
}
function changeOrder(data){
    
    $.ajax({
       url : base_url_trending+"changeOrder/",
       type : "POST",
       data : data,
       type : "post",
       dataType : "html",
       success: function msg(res){
            var data = jQuery.parseJSON(res);
            console.log(data);
            getGallery();
       }
  });
}

function findPost(){
    var title = $('#title_post').val();
    $.ajax({
       url : base_url_trending+"findPost/",
       type : "POST",
       data : "title="+title,
       dataType : "html",
       success: function msg(res){
            var data = jQuery.parseJSON(res);
            console.log(data);
            var status = data['status'];
            var html = data['html'];
            $('#post_list_trending').html(html);    
       }
  });
}

function addPost(id){
    $.ajax({
       url : base_url_trending+"addTrending/",
       type : "POST",
       data : "id="+id,
       type : "post",
       dataType : "html",
       success: function msg(res){
            var data = jQuery.parseJSON(res);
            var status = data['status'];
            var message = data['message'];
            if (status=='success') {
                //code
                getGallery();
            }else{
                alert(message);
            }
       }
  });
}

function getGallery(){
    $.ajax({
       url : base_url_trending+"getGallery/",
       type : "post",
       dataType : "html",
       success: function msg(res){
            var data = jQuery.parseJSON(res);
            var html = data['html'];
            $('#list_gallery').html(html);
       }
  });
}



////*Media Image JS Additional For Form*////

var base_url_media = global_url+'media/';
/// Modal Media




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


$('#modal-media').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) 
  var id = button.data('id')
  getLatestMedia();
});

$('#modal-video').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) 
  
});


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
                   $('#form_title').val(data['form_title']);
                   $('#form_caption').val(data['form_caption']);
                   $('#form_alt_text').val(data['form_alt_image']);
                   $('#form_desc').val(data['form_description']);
              }
       });
}



// Insert Media
function insertMedia() {
       //code
       var imageSource = $('#form_url').val();
       var altText = $('#form_alt_text').val();
       var name = $('#form_name').val();
       var caption = $('#form_caption').val();
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
                          insertMediaToGallery();
                     }
              });       
       }
       
}




function insertMediaToGallery(){
    $.ajax({
                     url : base_url_trending+"addGallery/",
                     type : "POST",
                     data : $('#detail-media').serialize(),
                     dataType : "html",
                     success: function msg(res){
                          var data = jQuery.parseJSON(res);
                          var status = data['status'];
                          var message = data['message'];
                          if (status==true) {
                              //code
                              $('#modal-media').modal('hide');
                              getGallery();
                          }else{
                              alert(message);
                          }
                     }
              });      
}


function insertMediaVideo() {
       //code
       var imageSource = $('#form_url_video').val();
       if (imageSource=='') {
              //code
              alert("Please Fill Video Link First!!!!")
       }else{
              $.ajax({
                     url : base_url_trending+"addGallery/",
                     type : "POST",
                     data : $('#detail-media-video').serialize(),
                     dataType : "html",
                     success: function msg(res){
                          var data = jQuery.parseJSON(res);
                          var status = data['status'];
                          var message = data['message'];
                          if (status==true) {
                              //code
                            removePopupModal();
                          }else{
                              alert(message);
                          }
                     }
              });       
       }
       
}

function removePopupModal(){
    getGallery();
    $('#modal-video').modal('hide');
    $('#detail-media-video')[0].reset();
    $('#youtube-results').html("")
    
    
}

function updateHeader(id , value) {
    //code
    $.ajax({
        url : base_url_trending+"setHeaderGallery/",
        type : "POST",
        data : "id="+id+"&value="+value,
        dataType : "html",
        success: function msg(res){
            var data = jQuery.parseJSON(res);
            var status = data['status'];
            var message = data['message'];
            if (status==true) {
            //code
                getGallery();
            }else{
                alert(message);
            }
        }
     });      
}

