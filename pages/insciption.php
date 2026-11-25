<form method="POST" action=""> <table>
    <tr>
       <td><input type="text" name="prenom" placeholder="Votre prénom" /></td>
       <td><input type="text" name="nom" placeholder="Votre nom" /></td>
   </tr>
   <tr>
       <td><input type="text" name="adresse" placeholder="Votre adresse" /></td>
       <td><input type="tel" name="telephone" placeholder="Votre telephone" maxlength="9" /></td>
   </tr>
   <tr>
       <td><input type="email" name="email" placeholder="Votre email" /></td>
       <td><input type="text" name="login" placeholder="Votre login" /></td>
   </tr>
   <tr>
       <td><input type="password" name="motPasse" placeholder="Votre mot de passe" /></td>
       <td><input type="password" name="confPasse" placeholder="Confirmer mot de passe" /></td>
   </tr>
<tr>
      <td><select name="profil"> <option>Etudiant Boursier</option><option>Etudiant non Boursier</option>
</select></td><td><input type="submit" name="inscrire" value="Inscription"/></td> </tr>
    </table> 
</form>
<?php

if($_SERVER['REQUEST_METHOD']==="POST"){
    extract($_POST);
    if($motPasse != $confPasse){
        echo "Non Conformes";
    }
    else{
        require "../parametres/fonctions.php";
        inscrire($prenom,$nom,$adresse,$telephone,$email,$profil,$login,$motPasse);
    }
}

?>