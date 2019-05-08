var base_url_trending = global_url+'trending/'+mode_trend+'/';
var key;
$(document).ready(function() {
    $('#list_trending').sortable({
        update : function(){
            var order = $('#list_trending').sortable('serialize'); 
            //console.log(order);
            changeOrder(order); 
        }
    });
    /// Start Trending By Ajax
    key = $('#key_mode').val();
    getTrending();
});

function deleteTrend(id){
    $.ajax({
       url : base_url_trending+"removeTrending/",
       data : "ID="+id,
       type : "post",
       dataType : "html",
       success: function msg(res){
            var data = jQuery.parseJSON(res);
            var status = data['status'];
            if (status==true) {
                //code
                getTrending();
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
                getTrending();
            }else{
                alert(message);
            }
       }
  });
}

function getTrending(){
    $.ajax({
       url : base_url_trending+"getTrending/",
       type : "post",
       dataType : "html",
       success: function msg(res){
            var data = jQuery.parseJSON(res);
            var html = data['html'];
            $('#list_trending').html(html);
       }
  });
}