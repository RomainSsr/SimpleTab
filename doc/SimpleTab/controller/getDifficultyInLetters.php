<?php
/**
 * Auteur: romain.ssr@eduge.ch
 * Date : 15.05.2018
 * projet: SimpleTab
 */

/**
 * @copyright romain.ssr@eduge.ch 2018
 * @brief Renvoie la difficulté d'une tablature en toute lettres depuis un chiffre
 */

require_once '../model/tablatureManager.php';

// Nécessaire lorsqu'on retourne du json
header('Content-Type: application/json');

// Je récupère le nom de l'artiste
$lvlTab = "";


if (isset($_POST['lvlTab']))
{
    $lvlTab = $_POST['lvlTab'];

}

if ($lvlTab != ""){
    $difficulty = TablatureManager::getInstance()->getDifficultyInLetters($lvlTab);
    if ($difficulty === false){
        echo '{ "ReturnCode": 2, "Message": "Un problème de récupération des données"}';
        exit();
    }

    $jsn = json_encode($difficulty);
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