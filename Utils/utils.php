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

function flashTitre(){

    if(isset($_SESSION["titre"])){
        $titre = $_SESSION["titre"];
        unset($_SESSION["titre"]);
        return $titre;
    }
}

function flashMessage(){
    if(isset($_SESSION["message"])){
        $message = $_SESSION["message"];
        unset($_SESSION["message"]);
        return $message;
    }
}

function flashType(){
    if(isset($_SESSION["type"])){
        $type = $_SESSION["type"];
        unset($_SESSION["type"]);
        return $type;
    }
}
