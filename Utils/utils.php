<?php

function postedTime($dt_creation){
    $dt_creation = strtotime($dt_creation);
    $current_time = time();
    $diff = $current_time - $dt_creation;
    $days = floor($diff/(60*60*24));
    $hours = floor($diff/(60*60));
    $minutes = floor($diff/60);
    $seconds = $diff;
    if($days > 0){
        return $days . " days ago";
    }elseif($hours > 0){
        return $hours . " hours ago";
    }elseif($minutes > 0){
        return $minutes . " minutes ago";
    }else{
        return $seconds . " seconds ago";
    }

}

function isAdmin($isAdmin){
    if($isAdmin == 1){
        return "Admin";
    }else{
        return "Etudiant";
    }
}

function flash(){

    if(isset($_SESSION["flash"])){
        $message = $_SESSION["flash"];
        unset($_SESSION["flash"]);
        return $message;
    }
}