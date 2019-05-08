<?php


if(!function_exists("echoPre")){
    function echoPre($string){
        echo "<pre>";
        print_r($string);
        echo "</pre>";
    }
}

if(!function_exists("urlGenerator")){
    function urlGenerator($url){
        # Prep string with some basic normalization
    $url = strtolower($url);
    $url = strip_tags($url);
    $url = stripslashes($url);
    $url = html_entity_decode($url);

    # Remove quotes (can't, etc.)
    $url = str_replace('\'', '', $url);

    # Replace non-alpha numeric with hyphens
    $match = '/[^a-z0-9]+/';
    $replace = '-';
    $url = preg_replace($match, $replace, $url);

    $url = trim($url, '-');
    return $url;
    }
}
if(!function_exists("extractDate")){
    function extractDate($date){
        //$scheduleNews = isset($arrDataPost['news_schedule']) ? $arrDataPost['news_schedule'] : date("Y-m-d h:i:s");
        $datetime = explode(" ",$date);
        $dateFull = $datetime[0];
        $timeFull = $datetime[1];
        
        $date = explode("-" , $dateFull);
        $time = explode(":" , $timeFull);
        
        $year = $date[0];
        $month = $date[1];
        $date = $date[2];
        
        $hour = $time[0];
        $minute = $time[1];
        $second = $time[2];
        
        $extractedDateTime = array($year , $month , $date , $hour , $minute , $second);
        return $extractedDateTime;
    }
}


if(!function_exists("indonesian_date")){
    function indonesian_date ($timestamp = '', $date_format = 'j F Y   H:i', $suffix = '') {
    if (trim ($timestamp) == '')
    {
            $timestamp = time ();
    }
    elseif (!ctype_digit ($timestamp))
    {
        $timestamp = strtotime ($timestamp);
    }
    # remove S (st,nd,rd,th) there are no such things in indonesia :p
    $date_format = preg_replace ("/S/", "", $date_format);
    $pattern = array (
        '/Mon[^day]/','/Tue[^sday]/','/Wed[^nesday]/','/Thu[^rsday]/',
        '/Fri[^day]/','/Sat[^urday]/','/Sun[^day]/','/Monday/','/Tuesday/',
        '/Wednesday/','/Thursday/','/Friday/','/Saturday/','/Sunday/',
        '/Jan[^uary]/','/Feb[^ruary]/','/Mar[^ch]/','/Apr[^il]/','/May/',
        '/Jun[^e]/','/Jul[^y]/','/Aug[^ust]/','/Sep[^tember]/','/Oct[^ober]/',
        '/Nov[^ember]/','/Dec[^ember]/','/January/','/February/','/March/',
        '/April/','/June/','/July/','/August/','/September/','/October/',
        '/November/','/December/',
    );
    $replace = array ( 'Sen','Sel','Rab','Kam','Jum','Sab','Min',
        'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu',
        'Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des',
        'Januari','Februari','Maret','April','Juni','Juli','Agustus','Sepember',
        'Oktober','November','Desember',
    );
    $date = date ($date_format, $timestamp);
    $date = preg_replace ($pattern, $replace, $date);
    $date = "{$date} {$suffix}";
    return $date;
} 
}


if(!function_exists("buildCategoryList")){
    function buildCategoryList($data,$prefix = '',$url=""){
        $html = '';
        foreach($data as $d){
            
            $html .= '<tr>
                <td><a href="#" onclick="loadData(\''.$url.'edit/'.$d->term_id.'\')">'.$prefix.' '.$d->name.' ('.$d->term_id.')</a></td>
                <td>'.$d->slug.'</td>
                <td>'.$d->count.'</td>
                <td><a href="javascript:void(0)" onclick="deleteData(\''.$d->term_id.'-'.$d->term_taxonomy_id.'\')" class="btn btn-danger  btn-xs"><span class="glyphicon glyphicon-trash"></span></a></td>
            </tr>';
            
            if(is_array($d->child)){
                $html .= buildCategoryList($d->child ,$prefix.' &#8212; ',$url);                
            }
            
        }
        return $html;
    }
}

if(!function_exists("buildCategoryOption")){
    function buildCategoryOption($data, $noChild = '', $active = '', $prefix = ''){
        $html = '';
        foreach($data as $d){
            
            if($d->term_id != $noChild){                
                $selected = ($d->term_id == $active) ? 'selected' : '';                
                $html .= '<option value="'.$d->term_id.'" '.$selected.' >'.$prefix.' '.$d->name.' ('.$d->term_id.')</option>';
                
                if(is_array($d->child)){
                    $html .= buildCategoryOption($d->child ,$noChild, $active, $prefix.' &#8212; ');                 
                }    
            }
            
            
        }
        return $html;
    }
}

if(!function_exists("buildCategoryOption")){
    function buildCategoryOption($data, $noChild = '', $active = '', $prefix = ''){
        $html = '';
        foreach($data as $d){           
            if($d->term_id != $noChild){                
                $selected = ($d->term_id == $active) ? 'selected' : '';                
                $html .= '<option value="'.$d->term_id.'" '.$selected.' >'.$prefix.' '.$d->name.'</option>';
                
                if(is_array($d->child)){
                    $html .= buildCategoryOption($d->child ,$noChild, $active, $prefix.' &#8212; ');                 
                }    
            }
            
            
        }
        return $html;
    }
}

if(!function_exists('update_cache_desktop')){
    function update_cache_desktop($link){
        // Get cURL resource
        $curl = curl_init();
        // Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $link,
            CURLOPT_USERAGENT => 'Delete Cache'
        ));
        // Send the request & save response to $resp
        $resp = curl_exec($curl);
        // Close request to clear up some resources
        curl_close($curl);
    }
}

function youtube_id_from_url($url) {
    $pattern = 
        '%^# Match any youtube URL
        (?:https?://)?  # Optional scheme. Either http or https
        (?:www\.)?      # Optional www subdomain
        (?:             # Group host alternatives
          youtu\.be/    # Either youtu.be,
        | youtube\.com  # or youtube.com
          (?:           # Group path alternatives
            /embed/     # Either /embed/
          | /v/         # or /v/
          | /watch\?v=  # or /watch\?v=
          )             # End path alternatives.
        )               # End host alternatives.
        ([\w-]{10,12})  # Allow 10-12 for 11 char youtube id.
        $%x'
        ;
    $result = preg_match($pattern, $url, $matches);
    if (false !== $result) {
        return $matches[1];
    }
    return false;
}

if(!function_exists("getNameFile")){
    function getNameFile($fileName){
        $files = explode("." , $fileName);
        $extension = end($files);
        $realname = str_replace(".".$extension,"",$fileName);
        return $realname;
    }
}

?>