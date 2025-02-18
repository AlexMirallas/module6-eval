<?php

abstract class AbstractController
{
    function render($template, $data =[]){
        extract($data);
        
        require_once "View/header.php";
        require_once "View/".$template.".php";
        require_once "View/footer.php";
          
    }
}