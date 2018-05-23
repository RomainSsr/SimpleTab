<?php
/**
 * Created by PhpStorm.
 * User: SAUSERR_INFO
 * Date: 16.05.2018
 * Time: 08:47
 */

/**
 * @copyright romain.ssr@eduge.ch 2018
 * @brief Identifie un utilisateur depuis son pseudo ou email et son mot de passe
 */

session_start();

require_once '../model/userManager.php';

// Nécessaire lorsqu'on retourne du json
header('Content-Type: application/json');

// Je récupère les champs dont j'ai besoin
$mailOrPseudoUser = "";
$passwordUser = "";

if (isset($_POST['mailOrPseudo']) && isset($_POST['pwdConnexion']))
{
    $mailOrPseudoUser = $_POST['mailOrPseudo'];
    $passwordUser = $_POST['pwdConnexion'];
}

if ($mailOrPseudoUser != "" || $passwordUser != ""){
    $passwordHashed = UserManager::getInstance()->getPasswordFromEmailOrPseudo($mailOrPseudoUser);
    $passwordHashed =$passwordHashed[0]['pwdUser'];
    $success = password_verify($passwordUser, $passwordHashed);
    $user = userManager::getInstance()->identifyUser($mailOrPseudoUser);
    if ($success === false){
        echo '{ "ReturnCode": 2, "Message": "Un problème de récupération des données"}';
        exit();
    }
    // l'utilisateur est identifié et sa session est crée
    $_SESSION['user'] = $user;

    $jsn = json_encode($user);
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