<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['site_db'] = 'default';
$config['site_cms'] = array("greencore" , "danangda");

$config['site_property'] = array("greencore" =>
                                 array(
                                       "cms_name" => "GreenCore CMS" ,
                                       "theme_color" => "green",
                                       "site_name" => "Greensoul.co.id",
                                       "cache_site" => "http://ferdifiansyah.com/greensoul.rc/",
                                       ),
                                 "danangda" =>
                                 array(
                                       "cms_name" => "Danang CMS" ,
                                       "theme_color" => "blue",
                                       "site_name" => "Danang.co.id",
                                       "cache_site" => "http://ferdifiansyah.com/danangisme/",
                                       )
                           );

                           

?>
