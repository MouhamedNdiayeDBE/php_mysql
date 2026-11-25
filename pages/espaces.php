<?php
//Empecher la connection sans passer par l'authentification
    require "../parametres/fonctions.php";
    if(!isset($_SESSION['login'])){
        header("location:../index.php?msg=Veuiller S'authentifier");
        exit();
    }
    else{
        echo "Bienvenu ".$_SESSION["prenom"]." ".$_SESSION["nom"]." tu es ".$_SESSION["profil"]." ";

        echo "<a href='deconnecter.php?action=dec'>Deconnexion</a></p>";
    }

    //gestionMenu

    if($_SESSION['profil']=="Etudiant Boursier"){
        echo "<a href='espaces.php?action=ajouterProduit'>Ajouter Produit</a><br/>";
        echo "<a href='espaces.php?action=supprimerProduit'>Supprimer Produit</a><br/>";
        /*echo "<a href='espaces.php?action=listerCategorie'>Lister Categorie</a><br/>";*/
        echo "<a href='?action=ajouterCategorie'>Lister Produit</a><br/>";

        if(isset($_GET['action'])){
            if($_GET['action']==="ajouterProduit"){
                echo "<form method='POST' action=''>
                        
                        

                        nomProd:   <input type='text' name='nomProd' placeholder='nomProd'><br/>
                        prix:      <input type='number' name='prix' placeholder='prix'><br/>
                        quantite:  <input type='number' name='quantite' placeholder='quantite'><br/>

                        Categorie:   <select name='categorie'>
                                        <option value='C1'>Informatique</option>
                                        <option value='C2'>Vehicule</option>
                                        <option value='C3'>Vetement</option>
                                     </select>
                        
                                   <input type='submit' value='Ajouter Produit'>
                      </form>";

                if(isset($_POST['nomProd']) && isset($_POST['prix']) && isset($_POST['quantite'])){
                    if(!empty($_POST['nomProd']) && !empty($_POST['prix']) && !empty($_POST['quantite'])){
                        extract($_POST);
                        mysqli_query(database(),"INSERT INTO produit(nom,prix,quantite,codeCat) values('".$nomProd."','".$prix."','".$quantite."','".$categorie."')");
                    }
                }

            }
        }

    }
    else if($_SESSION['profil']=="Etudiant non Boursier"){
        echo "<a href='?action=ajouterCategorie'>Lister Produit</a>";
    }
    

    //echo dirname(_DIR_)
?>