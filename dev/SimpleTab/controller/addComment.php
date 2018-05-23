<?php
/**
 * Created by PhpStorm.
 * User: SAUSERR_INFO
 * Date: 18.05.2018
 * Time: 07:52
 */

/**
 * @copyright romain.ssr@eduge.ch 2018
 * @brief Ajoute un commentaire en base
 */

require_once '../model/commentManager.php';

// Nécessaire lorsqu'on retourne du json
header('Content-Type: application/json');

// Je récupère les champs dont j'ai besoin
$contentComment = "";
$idTabComment = -1;
$idUserComment = -1;




if (isset($_POST['contentComment']) && isset($_POST['idTabComment']) && isset($_POST['idUserComment']) )
{
    $contentComment = $_POST['contentComment'];
    $idTabComment = $_POST['idTabComment'];
    $idUserComment = $_POST['idUserComment'];
}

if ($contentComment != "" || $idTabComment != -1 || $idUserComment != -1 ){
    $success = commentManager::getInstance()->addComment($contentComment,$idTabComment,$idUserComment);
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