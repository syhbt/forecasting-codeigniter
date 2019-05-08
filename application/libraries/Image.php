<?php
class CI_Image {
    
    var $upload_class = "";
    var $image_class = "";
    var $dir_file = "";
    private $_imageType = array('jpeg', 'jpg', 'gif', 'png');
    private $_error_code = array('There is no error, the file uploaded with success. ',
        'The uploaded file exceeds the upload_max_filesize directive in php.ini. ',
        'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form. ',
        'The uploaded file was only partially uploaded. ',
        'No file was uploaded. ',
        6 => 'Missing a temporary folder.',
        7 => 'Failed to write file to disk.'
    );
    
    function __construct(){
        parent::__construct();
    }
    
    function upload($file , $type ){
        
    }
}

?>