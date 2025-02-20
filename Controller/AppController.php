<?php

class AppController extends AbstractController
{
    public function home(){
        $searchQuery = isset($_GET["searchQuery"]) ? $_GET["searchQuery"] : "";

        if(!empty($searchQuery))
        {   
            
            $searchQuery = htmlspecialchars($searchQuery);
            $searchQuery = trim($searchQuery);
            $searchQuery = stripslashes($searchQuery);
            $searchQuery = "%".$searchQuery."%";
            $sql = "SELECT * FROM etudiants WHERE prenom LIKE :searchQuery OR nom LIKE :searchQuery OR email LIKE :searchQuery OR specialite LIKE :searchQuery";

            $etudiants = BDD::getInstance()->query($sql, ["searchQuery" => $searchQuery]);

            if(empty($etudiants)){
                $data = [
                    "titre" => "Erreur",
                    "contenu" => [
                        "num" => 404,
                        "msg" => "Aucun etudiant ne correspond a votre recherche"
                    ]
                ];
    
                $this->render("erreur", $data);
                die();
            }else{
                $data = [
                    "titre" => "Recherche",
                    "etudiants" => $etudiants
                ];
                $this->render("home", $data);
                die();
            }
            
        }

        

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
        $isAdmin = 0;

        $erreurs = [];

        if(!empty($_POST)){
            
            $id = isset($_POST["id"]) ? $_POST["id"] : "";
            $prenom = isset($_POST["prenom"]) ? $_POST["prenom"] : "";
            $nom = isset($_POST["nom"]) ? $_POST["nom"] : "";
            $email = isset($_POST["email"]) ? $_POST["email"] : "";
            $dt_naissance = isset($_POST["dt_naissance"]) ? $_POST["dt_naissance"] : "";
            $specialite = isset($_POST["specialite"]) ? $_POST["specialite"] : "";
            $cv = isset($_POST["cv"]) ? $_POST["cv"] : "";
            $isAdmin = ($_POST["isAdmin"])===1 ? true : false;
            
            if(strlen($prenom)<2 || strlen($prenom) >100) {
                $erreurs[] = "le prenom doit contenir entre 2 et 100 caracteres";
            }
            
            if(!filter_var($email , FILTER_VALIDATE_EMAIL)){
                $erreurs[] = "l'email n'est pas conforme"; 
            }

            if(strlen("nom")<2 || strlen("nom") >100) {
                $erreurs[] = "le nom doit contenir entre 2 et 100 caracteres";
            }

            if(strlen($specialite)<2 || strlen($specialite) >100) {
                $erreurs[] = "la specialite doit contenir entre 2 et 100 caracteres";
            }

            if(empty($dt_naissance) || $dt_naissance > date("Y-m-d")){
                $erreurs[] = "la date de naissance est obligatoire et tu ne peux pas naître demain";
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
            $erreurs=[];
            sleep(2);
            $_SESSION["type"]="success";
            $_SESSION["titre"]="l'etudiant a ete ajoute avec success";
            $_SESSION["message"]="vous allez etre redirige vers la page d'accueil";
            header("Location: " . URL);
        }

        $data = [
            "titre" => "Ajouter un etudiant",
            "erreurs" => $erreurs,
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
                $erreurs[] = "le prenom doit contenir entre 2 et 100 caracteres";
            }
            
            if(!filter_var($email , FILTER_VALIDATE_EMAIL)){
                $erreurs[] = "l'email n'est pas conforme"; 
            }

            if(strlen($nom)<2 || strlen($nom) >100) {
                $erreurs[] = "le nom doit contenir entre 2 et 100 caracteres";
            }

            if(strlen($specialite)<2 || strlen($specialite) >100) {
                $erreurs[] = "la specialite doit contenir entre 2 et 100 caracteres";
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
                "isAdmin" => $isAdmin,
                "dt_mis_a_jour" => date("Y-m-d H:i:s")
            ];
                
            BDD::getInstance()->query("UPDATE etudiants SET prenom = :prenom, nom = :nom, email = :email, dt_naissance = :dt_naissance, specialite = :specialite, cv = :cv, isAdmin = :isAdmin, dt_mis_a_jour = :dt_mis_a_jour WHERE id = :id", $etudiant);
            $_SESSION["type"]="info";
            $_SESSION["titre"]="l'etudiant a ete modifie avec success";
            $_SESSION["message"]="Vous pouvez voir les modifications dans la liste des etudiants";
            header("Location: " . URL);
            $erreurs=[];
        }
        
        $data =[
            "titre" => "Editer un etudiant",
            "erreurs" => $erreurs,
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

    public function delete_etudiant(string $id){
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

        BDD::getInstance()->query("DELETE FROM etudiants WHERE id = :id", ["id"=>$id]);
        $_SESSION["type"]="danger";
        $_SESSION["titre"] ="l'etudiant a ete supprime avec success";
        $_SESSION["message"]="Vous pouvez voir les modifications dans la liste des etudiants";
        header("Location: " . URL);
    }
}