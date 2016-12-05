<?php

function __autoload($name){
    if(!strripos ($name,'_')){
        include "application/classes/".$name.".php";
    }else{
        include "application/".lcfirst(substr($name, 0, stripos($name, '_')))."s/".strtolower($name).'.php';
    }
    }
require_once 'application/bootstrap.php';
