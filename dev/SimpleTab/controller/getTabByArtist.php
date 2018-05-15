<?php
/**
 * Created by PhpStorm.
 * User: SAUSERR_INFO
 * Date: 15.05.2018
 * Time: 08:23
 */




/**
 * @copyright romain.ssr@eduge.ch 2018
 * @brief Récupère les tablatures d'un artiste en particulier
 */

require_once '../controller/tablatureManager.php';

// Nécessaire lorsqu'on retourne du json
header('Content-Type: application/json');

// Je récupère le nom de l'artiste
$artistName = "";


if (isset($_POST['artistName']))
{
    $artistName = $_POST['artistName'];

}

	if ($artistName != ""){
        $tablature = TablatureManager::getInstance()->sortTabByArtist($artistName);
        if ($tablature === false){
            echo '{ "ReturnCode": 2, "Message": "Un problème de récupération des données"}';
            exit();
        }

        $jsn = json_encode($tablature);
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