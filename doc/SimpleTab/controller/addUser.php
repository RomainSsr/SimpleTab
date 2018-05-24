<?php
/**
 * Auteur: romain.ssr@eduge.ch
 * Date : 15.05.2018
 * projet: SimpleTab
 */

/**
 * @copyright romain.ssr@eduge.ch 2018
 * @brief Ajoute un utilisateur en base
 */

require_once '../model/userManager.php';

// Nécessaire lorsqu'on retourne du json
header('Content-Type: application/json');

// Je récupère les champs dont j'ai besoin
$nameUser = "";
$forenameUser = "";
$passwordUser = "";
$emailUser = "";
$pseudoUser = "";



if (isset($_POST['name']) && isset($_POST['forename']) && isset($_POST['pseudo']) &&isset($_POST['email']) &&isset($_POST['password'])&&isset($_POST['passwordConfirm']) && $_POST['password'] == $_POST['passwordConfirm'])
{
    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        if (checkdnsrr(explode('@',$_POST['email'])[1], 'MX')) {
            $nameUser = $_POST['name'];
            $forenameUser = $_POST['forename'];
            $passwordUser = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $emailUser = $_POST['email'];
            $pseudoUser = $_POST['pseudo'];

        }

    }

}

if ($nameUser != "" || $forenameUser != "" || $passwordUser != "" || $emailUser != "" || $pseudoUser != "" ){
    $success = UserManager::getInstance()->addUser($nameUser,$forenameUser,$passwordUser,$emailUser,$pseudoUser);
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