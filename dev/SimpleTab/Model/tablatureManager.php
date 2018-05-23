<?php
/**
 * Created by PhpStorm.
 * User: SAUSERR_INFO
 * Date: 15.05.2018
 * Time: 09:22
 */


require_once '../model/database.php';
require_once '../model/tablature.php';
require_once '../model/commentManager.php';
require_once '../model/rateManager.php';



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


    function getTabById($idTab)
    {
        $db = Database::getInstance();

        try {
            $sql = $db->prepare("SELECT * FROM simpletab.tablatures WHERE tablatures.idTab = :idTab;");
            $sql->bindParam("idTab", $idTab,PDO::PARAM_INT);
            $sql->execute();
            $result = $sql->fetchAll();
            return $result;
        }

        catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Retourne Un tableau contenant les tablatures et les artistes associés ou false si une erreur est survenue
     *
     */
    function getTabAndRelatedArtist()
    {
        $db = Database::getInstance();

        try {
            $sql = $db->prepare("SELECT * FROM simpletab.tablatures JOIN simpletab.artists ON tablatures.ARTISTS_idArtist = artists.idArtist WHERE tablatures.approuved = 1;");
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
            $sql = $db->prepare("SELECT * FROM simpletab.tablatures JOIN simpletab.artists ON tablatures.ARTISTS_idArtist = artists.idArtist WHERE (tablatures.users_idUsers = :userId AND tablatures.approuved = 1);");
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
     * Récupère toutes les tablatures non approuvée (champ approuved =0)
     * @return un tableau des tablatures non approuvées ou false si échoue
     */
    function getAllNonApprouvedTab()
    {
        $db = Database::getInstance();

        try {
            $sql = $db->prepare("SELECT * FROM simpletab.tablatures JOIN simpletab.artists ON tablatures.ARTISTS_idArtist = artists.idArtist WHERE tablatures.approuved = 0;");
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
     * Ajoute une tablature en base et dans un fichier php au format XML
     * @param $title
     * @param $lvl
     * @param $artistId
     * @param $userId
     * @param $artistName
     * @param $capo
     * @param $key
     * @param $tuning
     * @param $tabBody
     * @return true si la tablature a été correctement ajoutée en base et que le fichier xml de la tablature a bien été créé, false sinon
     */
    function addTab($title, $lvl, $artistId, $userId, $artistName, $capo, $key, $tuning, $tabBody)
    {
        $db = Database::getInstance();
        $path = "temp.php";
        try {
            $db->beginTransaction();

            $sql = $db->prepare("INSERT INTO simpletab.tablatures (titleTab, pathTab, lvlTab, ARTISTS_idArtist, users_idUsers, approuved) VALUES (:title, :path, :lvl, :artistId, :idUser, 0);");
            $sql->bindParam(':title', $title, PDO::PARAM_STR);
            $sql->bindParam(':path', $path, PDO::PARAM_STR);
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

            $newPath = "../tabs/$lastId.php";
            $tab = fopen($newPath,'a+');
            $lvl = $this->getDifficultyInLetters($lvl);

            $tabXml = '<?php 
$xmlstr = <<<XML
<?xml version = "1.0" encoding="UTF-8" standalone="yes" ?>
<tabs>
     <metadata>
            <title> '.$title.' </title>
            <author>'.$artistName.'</author>
            <tuning>'.$tuning.'</tuning>
            <capo>'.$capo.'</capo>
            <key>'.$key.'</key>
            <level> '.$lvl.'</level>
     </metadata>
     <corpse>
     '.$tabBody.'
     </corpse>
</tabs>
XML;
?>';
            $tabXml = str_replace('&','&amp;',$tabXml);
            ftruncate($tab,0);
            fputs($tab,$tabXml);
            fclose($tab);

            $db->commit();
            return true;
        }

        catch (PDOException $e) {
            $db->rollBack();
            return false;
        }
    }

    /**
     * Modifie une tablature en base ainsi que dans le XML
     * @param $idTab
     * @param $title
     * @param $artistName
     * @param $artistId
     * @param $tuning
     * @param $capo
     * @param $key
     * @param $lvl
     * @param $tabBody
     * @return true si succès sinon false
     */
    function modifyTab($idTab, $title, $artistName,$artistId, $tuning, $capo, $key, $lvl, $tabBody)
    {
        $db = Database::getInstance();

        try {
            $db->beginTransaction();

            $sql = $db->prepare("UPDATE simpletab.tablatures SET titleTab = :title, lvlTab = :lvl, ARTISTS_idArtist = :idArtist, approuved = 0 WHERE (idTab = :idTab);");
            $sql->bindParam(':title', $title, PDO::PARAM_STR);
            $sql->bindParam(':idArtist', $artistId, PDO::PARAM_STR);
            $sql->bindParam(':lvl', $lvl, PDO::PARAM_INT);
            $sql->bindParam(':idTab', $idTab, PDO::PARAM_STR);
            $sql->execute();

            $path = "../tabs/$idTab.php";


            $tab = fopen($path,'w');
            $lvl = $this->getDifficultyInLetters($lvl);

            $tabXml = '<?php 
$xmlstr = <<<XML
<?xml version = "1.0" encoding="UTF-8" standalone="yes" ?>
<tabs>
     <metadata>
            <title> '.$title.' </title>
            <author>'.$artistName.'</author>
            <tuning>'.$tuning.'</tuning>
            <capo>'.$capo.'</capo>
            <key>'.$key.'</key>
            <level> '.$lvl.'</level>
     </metadata>
     <corpse>
     '.$tabBody.'
     </corpse>
</tabs>
XML;
?>';
            $tabXml = str_replace('&','&amp;',$tabXml);
            ftruncate($tab,0);
            fputs($tab,$tabXml);
            fclose($tab);

            $db->commit();
            return true;
        }

        catch (PDOException $e) {
            $db->rollBack();
            return false;
        }
    }

    /**
     * Supprime une tablature de la base ainsi que son fichier XML
     * @param $idTab
     * @return bool
     */
    function deleteTab($idTab)
    {
        $db = Database::getInstance();
        $path = "../tabs/$idTab.php";

        try {
            $db->beginTransaction();

            $successDeleteComment = commentManager::getInstance()->deleteCommentByTabId($idTab);
            if(!$successDeleteComment)
            {
                $db->rollBack();
            }

            $sql = $db->prepare("DELETE FROM simpletab.tablatures WHERE (idTab = :idTab);");
            $sql->bindParam(':idTab', $idTab, PDO::PARAM_INT);
            $sql->execute();
            $result =unlink($path);
            if($result)
            {
                $db->commit();
                return true;
            }
            else
            {
                $db->rollBack();
            }
        }
        catch (PDOException $e) {
            $db->rollBack();
            return false;
        }
    }

    /**
     * Passe le champ d'une tablature approuved à 1 ce qui la rend visible pour les utilisateurs
     * @param $idTab
     * @return bool
     */
    function approuveTab($idTab)
    {
        $db = Database::getInstance();

        try {
            $sql = $db->prepare("UPDATE simpletab.tablatures SET approuved = 1 WHERE (idTab = :idTab);");
            $sql->bindParam(':idTab',$idTab,PDO::PARAM_INT);
            $sql->execute();
            return true;
        }

        catch (PDOException $e) {
            return false;
        }
    }

    function updateTabRate($averageRate, $idTab)
    {
        $db = Database::getInstance();

        try {
            $sql = $db->prepare("UPDATE simpletab.tablatures SET rateTab = :averageRate WHERE (idTab = :idTab);");
            $sql->bindParam(':idTab',$idTab,PDO::PARAM_INT);
            $sql->bindParam(':averageRate',$averageRate,PDO::PARAM_INT);
            $sql->execute();
            return true;
        }

        catch (PDOException $e) {
            return false;
        }
    }

    /**
     * @param $lvl
     * @return la difficulté en lettre à partir d'un chiffe
     */
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
