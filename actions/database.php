<?php
try{
    if(session_status()===PHP_SESSION_NONE)
    {
        session_start();
    }
    $bd=new PDO('mysql:host=localhost;dbname=forum;charset=utf8;', 'root', '');
}
catch(Exception $e)
{
    die('Erreur: ' . $e->getMessage());
}
