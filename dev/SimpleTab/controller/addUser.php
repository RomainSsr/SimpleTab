<?php
/**
 * Created by PhpStorm.
 * User: SAUSERR_INFO
 * Date: 15.05.2018
 * Time: 16:04
 */

/**
 * @copyright romain.ssr@eduge.ch 2018
 * @brief Renvoie la difficulté d'une tablature en toute lettres depuis un chiffre
 */

require_once '../Model/userManager.php';

// Nécessaire lorsqu'on retourne du json
header('Content-Type: application/json');

// Je récupère les champs dont j'ai besoin
$nameUser = "";
$forenameUser = "";
$passwordUser = "";
$emailUser = "";
$pseudoUser = "";
$passwordConfirmUser = "";



if (isset($_POST['name']) && isset($_POST['forename']) && isset($_POST['pseudo']) &&isset($_POST['email']) &&isset($_POST['password'])&&isset($_POST['passwordConfirm']) && $_POST['password'] == $_POST['passwordConfirm'])
{
    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        if (checkdnsrr(explode('@',$_POST['email'])[1], 'MX')) {
            $nameUser = $_POST['name'];
            $forenameUser = $_POST['forename'];
            $passwordUser = $_POST['pseudo'];
            $emailUser = $_POST['email'];
            $pseudoUser = $_POST['password'];
            $passwordConfirmUser = $_POST['passwordConfirm'];
        }

    }

}

if ($nameUser != "" || $forenameUser != "" || $passwordUser != "" || $emailUser != "" || $pseudoUser != "" ){
    $success = UserManager::getInstance()->addUser($nameUser,$forenameUser,$pseudoUser,$emailUser,$passwordUser);
    if ($success === false){
        echo '{ "ReturnCode": 2, "Message": "Un problème de récupération des données"}';
        exit();
    }

    $jsn = json_encode($success);
    // Problème d'encodage Json
    if ($jsn == FALSE){
        $code = json_last_error();
        echo '{ "ReturnCode": 3, "Message": "Un problème de d\'encodage json ('.$code.'"}';
        exit();
    }
    // Succès
    echo '{ "ReturnCode": 0, "Data": '.utf8_encode($jsn).'}';
    exit();

}

// Erreur
echo '{ "ReturnCode": 1, "Message": "Il manque les paramètres"}';

?>