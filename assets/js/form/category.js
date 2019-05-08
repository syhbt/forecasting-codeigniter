var base_url_tag = global_url+'category/';

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
        $("#form-head").html("Edit Category");
        $("#term_id").val(msg[0].term_id);
        $("#term_taxonomy_id").val(msg[0].term_taxonomy_id);
        $("#name").val(msg[0].name);
        $("#slug").val(msg[0].slug);
        $("#description").html(msg[0].description);
        $("#parent").html('<option value="0">None</option>'+msg[0].parentOption);
    });
    
    return false;
}

function deleteData(id) { 
    locationDel = base_url_tag+"delete/"+id;
    msg = "Apakah Anda Akan menghapus Category Ini ? ";
    
    var r = confirm(msg);
    if (r==true) {
           window.location = locationDel;
    }
}