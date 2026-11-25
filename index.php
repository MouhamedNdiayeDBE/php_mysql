<form method="POST" action="">
    <table>
        <tr>    
            <td><input type="login" name="login" placeholder="login"></td>
        </tr>
        <tr>
            <td><input type="password" name="motPasse" placeholder="mot de Passe"></td>
        </tr>
        <tr>  
            <td><input type="submit"></td>
        </tr> 
    </table>
</form>

<?php

    if(isset($_REQUEST['msg'])){
        echo $_REQUEST['msg'] ;
    }

    require "parametres/fonctions.php";
    if($_SERVER["REQUEST_METHOD"]==="POST"){
        extract($_POST);
        authentification($login,$motPasse);
    }

    

?>