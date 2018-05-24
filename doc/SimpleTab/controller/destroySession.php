<?php
/**
 * Auteur: romain.ssr@eduge.ch
 * Date : 16.05.2018
 * projet: SimpleTab
 */

//Permet de déconnecter l'utilisateur
session_start();
session_unset();
session_destroy();
header("Location: ../view/homePage.php")
?>