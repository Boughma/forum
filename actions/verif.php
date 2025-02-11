<?php
session_start();
if(!isset($_SESSION['authentification'])){
    header('Location: login.php');
}