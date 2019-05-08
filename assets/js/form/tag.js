var base_url_tag = global_url+'tags/';

$(function() {
    if ($('#myModal').length > 0) {
        $('#myModal').modal();                     
        $('#myModal').modal('show');  
    }    
});

function loadData(url) {
    $.ajax({
        url: url
    })
    .done(function( msg ) {
        var tag_status = msg[0].term_status;
        if (tag_status==1) {
            $("#is_hot").prop('checked' , true);    
        }else{
            $("#is_hot").prop('checked' , false);    
        }
        $("#form-head").html("Edit Tag");
        $("#term_id").val(msg[0].term_id);
        $("#term_taxonomy_id").val(msg[0].term_taxonomy_id);
        $("#name").val(msg[0].name);
        $("#slug").val(msg[0].slug);
        $("#description").html(msg[0].description);
    });
    return false;
}
    
function deleteData(id) {
    locationDel = base_url_tag+"delete/"+id;
    msg = "Apakah Anda Akan menghapus Tag Ini ? ";
    
    var r = confirm(msg);
    if (r==true) {
           window.location = locationDel;
    }
}