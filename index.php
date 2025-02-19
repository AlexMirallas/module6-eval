<?php

declare(strict_types=1);

define("URL", "http://localhost/module6-eval/index.php");

$page ="";

if (isset($_GET['page']) && !empty($_GET['page'])) {
    $page = $_GET['page'];
}else{
    $page = "/";
}


$routes = [
    "/" => ["home", "AppController"],
    "erreur401" => ["erreur401", "ErreurController"],
    "etudiant" => ["etudiant", "AppController"],
    "erreur" => ["erreur", "ErreurController"],
    "etudiant/new" => ["new_etudiant", "AppController"],
    "etudiant/edit" => ["edit_etudiant", "AppController"],
];

require_once "Utils/utils.php";
require_once "Controller/AbstractController.php";
require_once "Model/BDD.php";
require_once "Controller/AppController.php";
require_once "Controller/ErreurController.php";

if(array_key_exists($page, $routes)){
    $class = $routes[$page][1];
    $method = $routes[$page][0];
    $controller = new $class();
    $id = isset($_GET["id"]) ? $_GET["id"] : null;
    call_user_func([$controller, $method], $id);
} else {
    $errorController = new ErreurController();
    $errorController->erreur(404, "La page demandée n'existe pas");
}