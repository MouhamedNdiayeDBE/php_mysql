<?php
    session_start();
    // fonction pour se connecter
    function database()
    {
        $host = "localhost";
        $user = "root";
        $pass = "";
        $base = "gestionEtudiant2";
        $con = mysqli_connect($host, $user, $pass, $base);
        if($con)
            $con = mysqli_connect($host, $user, $pass, $base);
        else
            $con = mysqli_connect_error($con);

        return $con;
    }
    $db = database();
    // fonction our créer un compte
    function inscrire($pre, $nom, $adr, $tel, $ema, $pro, $log, $mot)
    {
        global $db;
        // vérifier si l'email existe
        $verEmail = "select * from etudiant where email='".$ema."'";
        $result1 = mysqli_query($db, $verEmail);
        $nb = mysqli_num_rows($result1);
        if($nb === 1)
            echo "Cette adresse email existe déjà";
        else
        {
            // vérifier si le login existe 
            $verLog = "select * from compte where login='".$log."'";
            $result2 = mysqli_query($db, $verLog);
            if(mysqli_num_rows($result2) === 1)
                echo "Le login existe déjà";
            else
            {
                // insérer dans la table etudiant
                $insertEtud = "insert into etudiant(prenom, nom, adresse, 
                telephone, email, profil) values('".$pre."','".$nom."','".$adr."',
                '".$tel."','".$ema."','".$pro."')";
                if(mysqli_query($db, $insertEtud) === false)
                    echo "Echec d'enregistrement";
                else
                {
                    // insérer dans la table compte
                    $id = mysqli_insert_id($db);
                    $crypte = password_hash($mot, PASSWORD_DEFAULT);
                    $insertComp = "insert into compte values('".$log."', 
                    '".$crypte."','".$id."')";
                    if(mysqli_query($db, $insertComp) === false)
                        echo "Echec de création compte";
                    else
                        echo "Compte crée avec success";     
                }
            }

        }
    }
    //inscrire("birane","koundoul","diamniadio",771234567, "birane1@gmail.com","etu", "log1", "mp");

    function authentification($log,$mot){
        global $db;
        $verEmail = "select * from etudiant e Join compte c on e.idEtudiant=c.idEtudiant  where login='".$log."'";
        $res = mysqli_query($db, $verEmail);
        if(mysqli_num_rows($res)==1){
            while($data = mysqli_fetch_assoc($res)){
                $_SESSION['id']=$data['idEtudiant'];
                $_SESSION['prenom']=$data['prenom'];
                $_SESSION['nom']=$data['nom'];
                $_SESSION['login']=$data['login'];
                $_SESSION['profil']=$data['profil'];
                if(password_verify($mot,$data['motPasse'])){
                    header("location:pages/espaces.php");
                }
                else {
                    echo "Erreur mot de passe";
                }
            }
        }
        else {
            echo "Ce login n'existe pas";
        }
    }

    function deconnecte(){
        unset($_SESSION['login']);
        session_destroy();
    }
?>