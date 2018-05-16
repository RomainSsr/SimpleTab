<?php
/**
 * Created by PhpStorm.
 * User: SAUSERR_INFO
 * Date: 16.05.2018
 * Time: 11:00
 */

//Permet de déconnecter l'utilisateur
session_start();
session_unset();
session_destroy();
header("Location: ../View/homePage.php")
?>