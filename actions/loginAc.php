<?php

require('actions/database.php');

//validation du formulaire
if(isset($_POST['validate'])){

    //verif si user a complété les champs
    if(!empty($_POST['pseudo']) AND !empty($_POST['password'])){
        
        //données de user
        $user_pseudo=htmlspecialchars($_POST['pseudo']);
        $user_password=htmlspecialchars($_POST['password']);

        //verif user existe
        $verifDejaCree=$bd->prepare('SELECT * FROM utilisateurs WHERE username = ?');
        $verifDejaCree->execute(array($user_pseudo));

        if($verifDejaCree->rowCount()>0){
            
            //recup data user
            $infosUser=$verifDejaCree->fetch();
           
           // verif mdp user bon
            if(password_verify($user_password, $infosUser['mdp']))
            {
                 //autentification de user
                $_SESSION['authentification']=true;
                $_SESSION['id']=$infosUser['id'];
                $_SESSION['lastname']=$infosUser['nom'];
                $_SESSION['firstname']=$infosUser['prenom'];
                $_SESSION['pseudo']=$infosUser['username'];

                //redirection vers la page d'accueil
                header('Location: index.php');
            }else{
                $msgErreur="MDP incorrect";
            }


        }else{
            $msgErreur="Les champs ne sont pas tous remplis!";
        }
    }
}