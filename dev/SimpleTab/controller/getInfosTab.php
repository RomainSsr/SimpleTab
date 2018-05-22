<?php
/**
 * Created by PhpStorm.
 * User: SAUSERR_INFO
 * Date: 22.05.2018
 * Time: 07:47
 */

/**
 * @copyright romain.ssr@eduge.ch 2018
 * @brief Récupère les informations des tablatures au format XML
 */

session_start();


require_once "../Model/tablatureManager.php";

// Je récupère l'id de la tablature
$idTab = -1;


if (isset($_POST['idTab']))
{
    $idTab = $_POST['idTab'];
    $_SESSION['currentIdTab'] = $idTab;
}

if ($idTab != -1){

    require_once "../tabs/" . $idTab . ".php";

    $tabs = new SimpleXMLElement($xmlstr);
    $title = $tabs->metadata->title;
    $author = $tabs->metadata->author;
    $tuning = $tabs->metadata->tuning;
    $capo = $tabs->metadata->capo;
    $key = $tabs->metadata->key;
    $lvl = $tabs->metadata->level;
    $bodyTab = $tabs->corpse;

    $jsn = json_encode($tabs);
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

?>