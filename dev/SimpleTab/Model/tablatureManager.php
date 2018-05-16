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
     *
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
     * Retourne les tablatures associées à un artiste
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

    /** Tableau de tablature */
    private $tablature;
}
