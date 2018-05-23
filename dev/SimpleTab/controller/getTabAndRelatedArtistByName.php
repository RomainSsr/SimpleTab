<?php
/**
 * Created by PhpStorm.
 * User: SAUSERR_INFO
 * Date: 17.05.2018
 * Time: 07:45
 */

/**
 * @copyright romain.ssr@eduge.ch 2018
 * @brief Récupère les tablatures ainsi que leur artiste posté par un utilisateur par leurs nom.
 */

require_once '../model/tablatureManager.php';

// Nécessaire lorsqu'on retourne du json
header('Content-Type: application/json');

$tabTitleOrArtistNAme="";

if(isset($_POST['tabTitleOrArtistNAme']))
{
    $tabTitleOrArtistNAme = $_POST['tabTitleOrArtistNAme'];
}

if($tabTitleOrArtistNAme!="")
{
    $tablature = TablatureManager::getInstance()->getTabAndRelatedArtistByName($tabTitleOrArtistNAme);
}

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


?>