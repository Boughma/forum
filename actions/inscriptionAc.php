<?php
session_start();
require('actions/database.php');

//validation du formulaire
if(isset($_POST['validate'])){

    //verif si user a complété les champs
    if(!empty($_POST['pseudo']) AND !empty($_POST['lastname']) AND !empty($_POST['firstname']) AND !empty($_POST['password'])){
        
        //données de user
        $user_pseudo=htmlspecialchars($_POST['pseudo']);
        $user_lastname=htmlspecialchars($_POST['lastname']);
        $user_firstname=htmlspecialchars($_POST['firstname']);
        $user_password=password_hash($_POST['password'], PASSWORD_DEFAULT);

        //verif si user existe
        $verifDejaCree=$bd->prepare('SELECT username FROM utilisateurs WHERE username = ?');
        $verifDejaCree->execute(array($user_pseudo)); 

        if($verifDejaCree->rowCount()==0){
           
            //insérer user dans bd
            $ajoutUser=$bd->prepare('INSERT INTO utilisateurs (username, nom, prenom, mdp) VALUES (?,?,?,?)');
            $ajoutUser->execute(array($user_pseudo, $user_lastname, $user_firstname, $user_password));
        
        //Récup infos user
        $recolteInfo=$bd->prepare('SELECT id, username, nom, prenom FROM utilisateurs WHERE nom=? AND prenom =? AND username=?');
        $recolteInfo->execute(array($user_lastname, $user_firstname, $user_pseudo));
        
        $infosUser=$recolteInfo->fetch();

        //autentification de user
        $_SESSION['authentification']=true;
        $_SESSION['id']=$infosUser['id'];
        $_SESSION['lastname']=$infosUser['nom'];
        $_SESSION['firstname']=$infosUser['prenom'];
        $_SESSION['pseudo']=$infosUser['username'];

        //redirection vers page d'accueil
        header('Location: index.php');
        
        }else{
            $msgErreur="Utilisateur déjà existant!"; 
        }
    }else{
        $msgErreur="Les champs ne sont pas tous remplis!";
    }
}

