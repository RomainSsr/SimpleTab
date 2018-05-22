<?php
/**
 * Created by PhpStorm.
 * User: SAUSERR_INFO
 * Date: 22.05.2018
 * Time: 10:14
 */

/**
 * @copyright romain.ssr@eduge.ch 2018
 * @brief Récupère l'utilisateur depuis son id
 */

require_once '../Model/userManager.php';

// Nécessaire lorsqu'on retourne du json
header('Content-Type: application/json');

// Je récupère l'id de l'utilisateur
$idUser = "";


if (isset($_POST['idUser']))
{
    $idUser = $_POST['idUser'];
}

if ($idUser != ""){
    $user = userManager::getInstance()->getUserById($idUser);
    if ($user === false){
        echo '{ "ReturnCode": 2, "Message": "Un problème de récupération des données"}';
        exit();
    }

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