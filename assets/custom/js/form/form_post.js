$(function () {
        $('#date').datetimepicker({
            format:"YYYY-MM-DD HH:mm:ss"
        });
    });


$(document).ready(function () {
    $("#tags").tokenInput("http://localhost/globaladmin/tags-sample.php", {
                theme: "facebook"
            });
});


    tinymce.init({
        selector:"#post",
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