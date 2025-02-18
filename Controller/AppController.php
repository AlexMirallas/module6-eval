<?php

class AppController extends AbstractController
{
    public function home()
    {   
        $data=[
            "titre" => "Accueil",
            "students" =>BDD::getInstance()->query("SELECT * FROM student")
        ];

        $this->render("home", $data);
    }
    
    public function erreur401()
    {
        $this->render("erreur401");
    }
}