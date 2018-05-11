<?php
/**
 * Created by PhpStorm.
 * User: SAUSERR_INFO
 * Date: 11.05.2018
 * Time: 15:36
 */

require_once"database.php";

function getTabAndRelatedArtist()
{
    $db = EDatabase::getInstance();

    try {
        $sql = $db->prepare("SELECT * FROM simpletab.tablatures JOIN simpletab.artists ON tablatures.ARTISTS_idArtist = artists.idArtist;");
        $sql->execute();
        $result = $sql->fetchAll();
        return $result;
    }

    catch (PDOException $e) {
        return false;
    }
}

function getDifficultyInLetters($lvlNumber)
{
    switch ($lvlNumber)
    {
        case 0:
            return "Facile";
            break;
        case 1:
            return "Moyen";
            break;

        case 2:
            return "Difficile";
            break;

    }
}

function sortTabByArtist($artistName)
{
    $db = EDatabase::getInstance();

    try {
        $sql = $db->prepare("SELECT * FROM simpletab.tablatures JOIN simpletab.artists ON tablatures.ARTISTS_idArtist = artists.idArtist WHERE  artists.nameArtist == :nameArtist;");
        $sql->bindParam(':nameArtist', $artistName, PDO::PARAM_STR);
        $sql->execute();
        $result = $sql->fetchAll();
        return $result;
    }

    catch (PDOException $e) {
        return false;
    }
}
?>