<?php
/**
 * Created by PhpStorm.
 * User: SAUSERR_INFO
 * Date: 18.05.2018
 * Time: 10:33
 */

/**
 * @copyright romain.ssr@eduge.ch 2018
 * @brief Ajoute une tablature en base
 */

session_start();

require_once '../model/tablatureManager.php';
require_once '../model/artistManager.php';

// Nécessaire lorsqu'on retourne du json
header('Content-Type: application/json');

// Je récupère les champs dont j'ai besoin
$title ="";
$nameArtist="";
$lvl="";
$capo = "";
$key ="";
$tuning = "";
$tabBody="";


if (isset($_POST['addTitle']) && isset($_POST['addArtist']) && isset($_POST['addLvl']) && isset($_POST['addTuning']) && isset($_POST['addTabBody']) && isset($_SESSION['user'] ))
{
    $title =$_POST['addTitle'];
    $nameArtist=$_POST['addArtist'];
    $lvl=$_POST['addLvl'];
    $tuning = $_POST['addTuning'];
    $tabBody=$_POST['addTabBody'];
    $userId =$_SESSION['user'][0]['idUsers'];
}

if(!isset($_POST['addCapo']))
{
    $capo = "";
}


if(!isset($_POST['addKey']))
{
    $key = "";
}


if ($title != "" || $nameArtist != "" || $lvl != "" || $tuning != "" || $tabBody != "" ){

    // Récupère le nom de l'artiste dans la base sinon le crée en base et le récupère.
    $artist = artistManager::getInstance()->getArtistByName($nameArtist);
    if($artist == false)
    {
        if(!$artistAdded = artistManager::getInstance()->addArtist($nameArtist))
        {
            exit();
        }
        else
        {
            $artist = artistManager::getInstance()->getArtistByName($nameArtist);
        }
    }

    $idArtist = $artist['0']['idArtist'];
    $artistName = $artist['0']['nameArtist'];
    $success = tablatureManager::getInstance()->addTab($title, $lvl, $idArtist, $userId, $artistName, $capo, $key, $tuning, $tabBody);
    if ($success === false) {
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