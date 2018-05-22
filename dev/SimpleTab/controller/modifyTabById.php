<?php
/**
 * Created by PhpStorm.
 * User: SAUSERR_INFO
 * Date: 22.05.2018
 * Time: 07:48
 */

/**
 * @copyright romain.ssr@eduge.ch 2018
 * @brief Modifie la tablatures à partir d'un ID
 */

session_start();

require_once '../Model/tablatureManager.php';
require_once '../Model/artistManager.php';


// Nécessaire lorsqu'on retourne du json
header('Content-Type: application/json');

// Je récupère l'id de la tablature
$idTab = -1;
$title ="";
$nameArtist="";
$lvl="";
$capo = "";
$key ="";
$tuning = "";
$tabBody="";

if (isset($_POST['modifyTitle']) && isset($_POST['modifyAuthor']) && isset($_POST['modifyLvl']) && isset($_POST['modifyCapo']) && isset($_POST['modifyKey']) && isset($_POST['modifyTuning']) && isset($_POST['modifyTabBody'])&&  isset($_SESSION['currentIdTab']))
{
    $title =$_POST['modifyTitle'];
    $nameArtist=$_POST['modifyAuthor'];
    $lvl=$_POST['modifyLvl'];
    $capo = $_POST['modifyCapo'];
    $key =$_POST['modifyKey'];
    $tuning = $_POST['modifyTuning'];
    $tabBody=$_POST['modifyTabBody'];
    $idTab = $_SESSION['currentIdTab'];

}

if ($title != "" || $nameArtist != "" || $lvl != "" || $tuning != "" || $tabBody != "" || $idTab!=-1 || $capo != "" || $key!=""|| $tabBody !="" || $idTab!=-1 ||$rateValue !=-1) {


    // Récupère le nom de l'artiste dans la base sinon le crée en base et le récupère.
    $artist = artistManager::getInstance()->getArtistByName($nameArtist);
    if ($artist == false) {
        if (!$artistAdded = artistManager::getInstance()->addArtist($nameArtist)) {
            exit();
        } else {
            $artist = artistManager::getInstance()->getArtistByName($nameArtist);
        }
    }

    $idArtist = $artist['0']['idArtist'];
    $artistName = $artist['0']['nameArtist'];
    $success = TablatureManager::getInstance()->modifyTab($idTab,$title,$artistName,$idArtist,$tuning,$capo,$key,$lvl,$tabBody);
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
