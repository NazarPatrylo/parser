<?php
class View
{
    function generate($content_view, $template, $data){
        include 'application/views/'.$template;
    }
    
    
    
}