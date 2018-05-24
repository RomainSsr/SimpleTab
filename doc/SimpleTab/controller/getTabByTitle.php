<?php
/**
 * Auteur: romain.ssr@eduge.ch
 * Date : 17.05.2018
 * projet: SimpleTab
 */
/**
 * @copyright romain.ssr@eduge.ch 2018
 * @brief Récupère les tablatures à partir du titre
 */

require_once '../model/tablatureManager.php';

// Nécessaire lorsqu'on retourne du json
header('Content-Type: application/json');

// Je récupère le nom de l'artiste
$titleTab = "";


if (isset($_POST['titleTab']))
{
    $titleTab = $_POST['titleTab'];

}

	if ($titleTab != ""){
        $tablature = TablatureManager::getInstance()->getTabByTitle($titleTab);
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