var base_url_user = global_url+'user/';
$(function() {
    if ($('#myModal').length > 0) {
        $('#myModal').modal();                     
        $('#myModal').modal('show');  
    }
    
    $('#user_nicename').change(function(){
        var valName = $(this).val();
        $('#name-review').html(valName);
    });
    
    $('#user_email').change(function(){
        var valName = $(this).val();
        $('#name-email').html(valName);
    });
    
    $('#user_level').change(function(){
        var valName = $(this).val();
        var htmlVal;
        
        switch (valName) {
            //case
            case "1" : htmlVal = "Administrator";break;
            case "2" : htmlVal = "Editor";break;
            case "0" : htmlVal = "OFF";break;
        }
        $('#name-status').html(htmlVal);
    });
    
    /// For Validate user Form    
  $('#submit_user').click(function(e){
      e.preventDefault();
      $('#form_user').submit();
  });

  $('#form_user').validate({
    ignore : "",
    rules : {
      user_nicename : {
        required : true,
      },
      user_email : {
        required : true,
        email : true
      },
      user_login : {
        required : true,
      },
      user_password : {
        required : true,
      },
      user_password2 : {
        equalTo : "#user_password",
      },
      status : {
        required : true,
      },
      level : {
        required : true,
      },
    },
  });
  
  /// For Validate Password
  $('#submit_pass').click(function(e){
      e.preventDefault();
      $('#form_pass').submit();
  });
  var id = $('input[name=user_id]').val();
  var url_check_pass = base_url_user+"check_password/"+id;
  $('#form_pass').validate({
    ignore : "",
    rules : {
      user_password_old : {
        required : true,
        remote : {
            url : url_check_pass,
            type : "POST",
        }
      },
      user_password : {
        required : true,
      },
      user_password2 : {
        equalTo : "#user_password",
      },
     
    },
  });
});

function showUploadPicture(){
    $('#thumb_user').click();
}

$('#thumb_user').change(function(){
        var file_data = $("#thumb_user").prop("files")[0]; 
        var form_data = new FormData();               
        form_data.append("image_user", file_data);  
        $.ajax({
                    url: base_url_user+"uploadimage/",
                    cache: true,
                    contentType: false,
                    processData: false,
                    data: form_data,             
                    type: 'POST',
                    success: function(msg){
                        console.log(msg);
                        var data = jQuery.parseJSON(msg);
                        if (data['status']=='success') {
                            //code
                            var imgLink = data['msgHtml'];
                            var imgName = data['name'];
                            $('#profile-image').attr("src",imgLink);
                            $('input[name=thumb_user]').val(imgName);
                        }else{
                            alert(data['message']);
                        }
                        
                    }
           });       
})


