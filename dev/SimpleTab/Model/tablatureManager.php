<?php
/**
 * Created by PhpStorm.
 * User: SAUSERR_INFO
 * Date: 15.05.2018
 * Time: 09:22
 */


require_once '../Model/database.php';
require_once '../Model/tablature.php';


/**
 * @brief Helper class pour gérer les tablatures du site
 *
 * @author romain.ssr@eduge.ch
 */
class TablatureManager
{
    private static $objInstance;

    /**
     * @brief Class Constructor - Create a new ECommentManager if one doesn't exist
     * Set to private so no-one can create a new instance via ' = new
     * ECommentManager();'
     */
    private function __construct ()
    {
        $this->tablature = array();
    }

    /**
     * @brief Like the constructor, we make clone private so nobody can clone
     * the instance
     */
    private function __clone ()
    {}

    /**
     * @brief Retourne notre instance ou la crée
     *
     * @return $objInstance;
     */
    public static function getInstance ()
    {
        if (!self::$objInstance)
        {
            try
            {
                self::$objInstance = new TablatureManager();

            } catch (Exception $e)
            {
                echo "EDataManager Error: " . $e;
            }
        }
        return self::$objInstance;
    }

    /**
     * Retourne le tableau de toutes les tablatures
     *
     */
    public function getTablature()
    {
        return $this->tablature;
    }

    /**
     * Retourne Un tableau contenant les tablatures et les artistes associés ou false si une erreur est survenue
     *
     */
    function getTabAndRelatedArtist()
    {
        $db = Database::getInstance();

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

    /**
     * Retourne Un tableau contenant les tablatures et les artistes associés que l'utilisateur a posté ou false si une erreur est survenue
     * @param $userId -> l'identifiant de l'utilisateur
     */
    function getTabAndRelatedArtistPostedByUser($userId)
    {
        $db = Database::getInstance();

        try {
            $sql = $db->prepare("SELECT * FROM simpletab.tablatures JOIN simpletab.artists ON tablatures.ARTISTS_idArtist = artists.idArtist WHERE tablatures.users_idUsers = :userId;");
            $sql->bindParam(':userId',$userId,PDO::PARAM_INT);
            $sql->execute();
            $result = $sql->fetchAll();
            return $result;
        }

        catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Retourne les tablatures associées à un artiste, sinon false
     *
     * @param $artistName
     *
     */
    function sortTabByArtist($artistName)
    {
        $db = Database::getInstance();

        try {
            $sql = $db->prepare("SELECT * FROM simpletab.tablatures JOIN simpletab.artists ON tablatures.ARTISTS_idArtist = artists.idArtist WHERE  artists.nameArtist = :nameArtist;");
            $sql->bindParam(':nameArtist', $artistName, PDO::PARAM_STR);
            $sql->execute();
            $result = $sql->fetchAll();
            return $result;
        }

        catch (PDOException $e) {
            return false;
        }
    }

    /**
     * @param $tabTitleOrArtistNAme
     * @return la tablature qui correspond au nom de l'artiste ou au titre de la tablature, sinon false
     */
    function getTabAndRelatedArtistByName($tabTitleOrArtistNAme)
    {
        $db = Database::getInstance();

        try {
            $sql = $db->prepare("SELECT * FROM simpletab.tablatures JOIN simpletab.artists ON tablatures.ARTISTS_idArtist = artists.idArtist 
                                           WHERE tablatures.titleTab = :tabTitleOrArtistNAme OR artists.nameArtist = :tabTitleOrArtistNAme;");
            $sql->bindParam(':tabTitleOrArtistNAme',$tabTitleOrArtistNAme,PDO::PARAM_STR);
            $sql->execute();
            $result = $sql->fetchAll();
            return $result;
        }

        catch (PDOException $e) {
            return false;
        }
    }

    /**
     * @param $titleTab
     * @return Un tableau contant les informations de la tablature récupérée par son titre
     */
    function getTabByTitle($titleTab)
    {
        $db = Database::getInstance();

        try {
            $sql = $db->prepare("SELECT * FROM simpletab.tablatures  WHERE tablatures.titleTab = :titleTab;");
            $sql->bindParam(':titleTab',$titleTab,PDO::PARAM_STR);
            $sql->execute();
            $result = $sql->fetchAll();
            return $result;
        }

        catch (PDOException $e) {
            return false;
        }
    }

    /**
     * @param $title -> le titre de la tablature
     * @param $artist -> le nom de l'artiste de la tablature
     * @param $lvl -> le niveau de la tablature
     * @param $capo -> la place du capodastre de la tablature (vide si pas de capo)
     * @param $key -> la tonalité de la tablature (vide si atonale ou inconnue)
     * @param $tuning -> l'accordage de la tablature
     * @param $tabBody -> le texte et les accords de la tablature
     * @param $link -> le lien du tuto YouTube de la tablature
     * @return true si la tablature a été correctement ajoutée en base, false sinon
     */
    function addTab($title, $link, $lvl, $artistId, $userId, $author, $capo,$key,$tuning,$tabBody)
    {
        $db = Database::getInstance();
        $path = "temp.php";
        try {
            $db->beginTransaction();

            $sql = $db->prepare("INSERT INTO simpletab.tablatures (titleTab, pathTab, linkVideo, lvlTab, ARTISTS_idArtist, users_idUsers) VALUES (:title, :path, :link,:lvl, :artistId, :idUser);");
            $sql->bindParam(':title', $title, PDO::PARAM_STR);
            $sql->bindParam(':path', $path, PDO::PARAM_STR);
            $sql->bindParam(':link', $link, PDO::PARAM_STR);
            $sql->bindParam(':lvl', $lvl, PDO::PARAM_STR);
            $sql->bindParam(':artistId', $artistId, PDO::PARAM_STR);
            $sql->bindParam(':idUser', $userId, PDO::PARAM_STR);
            $sql->execute();

            $lastId = $db->lastInsertId();
            $newPath = $lastId.".php";

            $sql = $db->prepare("UPDATE simpletab.tablatures SET pathTab = :path WHERE idTab = :idTab;");
            $sql->bindParam(':idTab', $lastId, PDO::PARAM_STR);
            $sql->bindParam(':path',$newPath , PDO::PARAM_STR);
            $sql->execute();

            saveTabXML($lastId,$title,$author,$tuning,$capo,$key,$lvl,$link,$tabBody);

            $db->commit();
            return true;
        }

        catch (PDOException $e) {
            $db->rollBack();
            return false;
        }
    }

    function saveTabXML($tabId,$title, $author, $tuning, $capo, $key, $lvl, $link, $tabBody)
    {

        $tab = fopen('../tabs'.$tabId.'.php','a+');


        $tabXml = ' $xmlstr = <<<XML
                    <?xml version = "1.0" encoding="UTF-8" standalone="yes" ?>
                    <tabs>
                         <metadata>
		                        <title> '.$title.' </title>
                                <author>'.$author.'</author>
                                <tuning>'.$tuning.'</tuning>
                                <capo>'.$capo.'</capo>
                                <key>'.$key.'</key>
                                <level> '.$lvl.'</level>
                                <link>'.$link.'</link>
                         </metadata>
                        <corpse>'.$tabBody.'</corpse>
                    </tabs>
                    XML;';

        ftruncate($tab,0);
        fputs($tab,$tabXml);
        fclose($tab);
    }

    function getDifficultyInLetters($lvl)
    {
        switch ($lvl)
        {
            case "0":
                return "Facile";
                break;
            case "1":
                return "Moyen";
                break;

            case "2":
                return "Difficile";
                break;

        }
    }

    /** Tableau de tablature */
    private $tablature;
}
