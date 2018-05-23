<?php
/**
 * Created by PhpStorm.
 * User: SAUSERR_INFO
 * Date: 17.05.2018
 * Time: 15:59
 */


/**
 * @copyright romain.ssr@eduge.ch 2018
 * @brief Récupère les commentaires à partir d'une tablature
 */

require_once '../model/commentManager.php';

// Nécessaire lorsqu'on retourne du json
header('Content-Type: application/json');

// Je récupère l'id de la tablature
$idTab = "";


if (isset($_POST['idTab']))
{
    $idTab = $_POST['idTab'];

}

	if ($idTab != ""){
        $comment = commentManager::getInstance()->getCommentAndUsersByTab($idTab);
        if ($comment === false){
            echo '{ "ReturnCode": 2, "Message": "Un problème de récupération des données"}';
            exit();
        }

        $jsn = json_encode($comment);
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