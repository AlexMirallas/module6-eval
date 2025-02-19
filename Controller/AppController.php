<?php

class AppController extends AbstractController
{
    public function home()
    {   
        $data=[
            "titre" => "Accueil",
            "etudiants" =>BDD::getInstance()->query("SELECT * FROM etudiants")
        ];

        $this->render("home", $data);
    }
    
    public function etudiant(string $id){


        $etudiant = BDD::getInstance()->query("SELECT * FROM etudiants WHERE id = :id", ["id"=>$id]);

        if(empty($etudiant)){
            $data = [
                "titre" => "Erreur",
                "contenu" => [
                    "num" => 404,
                    "msg" => "L'etudiant demandé n'existe pas"
                ]
            ];

            $this->render("erreur", $data);
            die();
        }

        $data = [
            "titre" => "page Etudiant",
            "etudiant" => $etudiant
        ];

        $this->render("etudiant", $data);
    }

    public function new_etudiant(){

        $id="";
        $prenom = "";
        $nom = "";
        $email = "";
        $dt_naissance = "";
        $specialite = "";
        $cv = "";
        $isAdmin = false;

        $erreurs = [];
        $success = [];
        if(!empty($_POST)){
            
            $id = isset($_POST["id"]) ? $_POST["id"] : "";
            $prenom = isset($_POST["prenom"]) ? $_POST["prenom"] : "";
            $nom = isset($_POST["nom"]) ? $_POST["nom"] : "";
            $email = isset($_POST["email"]) ? $_POST["email"] : "";
            $dt_naissance = isset($_POST["dt_naissance"]) ? $_POST["dt_naissance"] : "";
            $specialite = isset($_POST["specialite"]) ? $_POST["specialite"] : "";
            $cv = isset($_POST["cv"]) ? $_POST["cv"] : "";
            $isAdmin = isset($_POST["isAdmin"]) ? true : false;
            
            if(strlen($prenom)<2 || strlen($prenom) >100) {
                $erreurs[] = "le prenom doit contenir entre 2 et 99 caracteres";
            }
            
            if(!filter_var($email , FILTER_VALIDATE_EMAIL)){
                $erreurs[] = "l'email n'est pas conforme"; 
            }

            if(strlen("nom")<2 || strlen("nom") >100) {
                $erreurs[] = "le nom doit contenir entre 2 et 99 caracteres";
            }

            if(empty($dt_naissance)){
                $erreurs[] = "la date de naissance est obligatoire";
            }

            if(strlen($cv) > 65000){
                $erreurs[] = "le cv ne doit pas depasser 65000 caracteres";
            }

            $user = BDD::getInstance()->query("SELECT * FROM etudiants WHERE email = :email", ["email"=>$email]);

            if(!empty($user)){
                $erreurs[]= "L'email est deja utilise, veuillez en choisir un autre";
            }
        }

            

        if (count($erreurs)===0 && !empty($_POST)){
            $etudiant = [
                "id" => $id,
                "prenom" => $prenom,
                "nom" => $nom,
                "email" => $email,
                "dt_naissance" => $dt_naissance,
                "specialite" => $specialite,
                "cv" => $cv,
                "isAdmin" => $isAdmin
            ];
                
            BDD::getInstance()->query("INSERT INTO etudiants (id, prenom, nom, email, dt_naissance, specialite, cv, isAdmin) VALUES (:id, :prenom, :nom, :email, :dt_naissance, :specialite, :cv, :isAdmin)", $etudiant);
            $success[] = "l'etudiant a ete ajoute avec succes";
            $erreurs=[];
            sleep(2);
            header("Location: " . URL);

        }

        $data = [
            "titre" => "Ajouter un etudiant",
            "erreurs" => $erreurs,
            "success" => $success,
            "data_form"=>[
                "id" => $id,
                "prenom" => $prenom,
                "nom" => $nom,
                "email" => $email,
                "dt_naissance" => $dt_naissance,
                "specialite" => $specialite,
                "cv" => $cv,
                "isAdmin" => $isAdmin
            ]
        ];

        $this->render("new_etudiant", $data);
    }

    public function edit_etudiant(string $id){
        $etudiant = BDD::getInstance()->query("SELECT * FROM etudiants WHERE id = :id", ["id"=>$id]);

        if(empty($etudiant)){
            $data = [
                "titre" => "Erreur",
                "contenu" => [
                    "num" => 404,
                    "msg" => "L'etudiant demandé n'existe pas"
                ]
            ];

            $this->render("erreur", $data);
            die();
        }

        $id = $etudiant[0]["id"];
        $prenom = $etudiant[0]["prenom"];
        $nom = $etudiant[0]["nom"];
        $email = $etudiant[0]["email"];
        $dt_naissance = $etudiant[0]["dt_naissance"];
        $specialite = $etudiant[0]["specialite"];
        $cv = $etudiant[0]["cv"];
        $isAdmin = $etudiant[0]["isAdmin"];

        $erreurs = [];
        $success = [];

        if(!empty($_POST)){
            
            $id = isset($_POST["id"]) ? $_POST["id"] : "";
            $prenom = isset($_POST["prenom"]) ? $_POST["prenom"] : "";
            $nom = isset($_POST["nom"]) ? $_POST["nom"] : "";
            $email = isset($_POST["email"]) ? $_POST["email"] : "";
            $dt_naissance = isset($_POST["dt_naissance"]) ? $_POST["dt_naissance"] : "";
            $specialite = isset($_POST["specialite"]) ? $_POST["specialite"] : "";
            $cv = isset($_POST["cv"]) ? $_POST["cv"] : "";
            $isAdmin = isset($_POST["isAdmin"]) ? true : false;
            
            if(strlen($prenom)<2 || strlen($prenom) >100) {
                $erreurs[] = "le prenom doit contenir entre 2 et 99 caracteres";
            }
            
            if(!filter_var($email , FILTER_VALIDATE_EMAIL)){
                $erreurs[] = "l'email n'est pas conforme"; 
            }

            if(strlen($nom)<2 || strlen($nom) >100) {
                $erreurs[] = "le nom doit contenir entre 2 et 99 caracteres";
            }

            if(empty($dt_naissance)){
                $erreurs[] = "la date de naissance est obligatoire";
            }

            if(strlen($cv) > 65000){
                $erreurs[] = "le cv ne doit pas depasser 65000 caracteres";
            }
        }

        if(empty($erreurs) && !empty($_POST)){
            $etudiant = [
                "id" => $id,
                "prenom" => $prenom,
                "nom" => $nom,
                "email" => $email,
                "dt_naissance" => $dt_naissance,
                "specialite" => $specialite,
                "cv" => $cv,
                "isAdmin" => $isAdmin
            ];
                
            BDD::getInstance()->query("UPDATE etudiants SET prenom = :prenom, nom = :nom, email = :email, dt_naissance = :dt_naissance, specialite = :specialite, cv = :cv, isAdmin = :isAdmin WHERE id = :id", $etudiant);
            $success[] = "l'etudiant a ete modifie avec succes";
            $erreurs=[];
        }
        
        $data =[
            "titre" => "Editer un etudiant",
            "erreurs" => $erreurs,
            "success" => $success,
            "data_form"=>[
                "id" => $id,
                "prenom" => $prenom,
                "nom" => $nom,
                "email" => $email,
                "dt_naissance" => $dt_naissance,
                "specialite" => $specialite,
                "cv" => $cv,
                "isAdmin" => $isAdmin
            ]
            ];

        $this->render("edit_etudiant", $data);
    }    

}