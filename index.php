<?php
ini_set("display_errors", 1);
ini_set("track_errors", 1);
ini_set("html_errors", 1);
error_reporting(E_ALL);
//echo $_SERVER['DOCUMENT_ROOT'];
//const DR = "C:/OpenServer/domains/shopgenerator/"; 
function __autoload($name){
    if(!strripos ($name,'_')){
        include "application/classes/".$name.".php";
    }else{
        include "application/".lcfirst(substr($name, 0, stripos($name, '_')))."s/".strtolower($name).'.php';
        
    }
            
    }
require_once 'application/bootstrap.php';   