<?php
/**
 * Created by PhpStorm.
 * User: SAUSERR_INFO
 * Date: 18.05.2018
 * Time: 12:56
 */

require_once '../Model/database.php';
require_once '../Model/artist.php';

/**
 * @brief Helper class pour gérer les artistes du site
 *
 * @author romain.ssr@eduge.ch
 */
class artistManager
{
    private static $objInstance;

    /**
     * @brief Class Constructor - Create a new ECommentManager if one doesn't exist
     * Set to private so no-one can create a new instance via ' = new
     * ECommentManager();'
     */
    private function __construct()
    {
        $this->artist = array();
    }

    /**
     * @brief Like the constructor, we make clone private so nobody can clone
     * the instance
     */
    private function __clone()
    {
    }

    /**
     * @brief Retourne notre instance ou la crée
     *
     * @return $objInstance;
     */
    public static function getInstance()
    {
        if (!self::$objInstance) {
            try {
                self::$objInstance = new artistManager();

            } catch (Exception $e) {
                echo "EDataManager Error: " . $e;
            }
        }
        return self::$objInstance;
    }

    function addArtist($nameArtist)
    {
        $db = Database::getInstance();

        try {
            $sql = $db->prepare("INSERT INTO simpletab.artists (ameArtist) VALUES ( :nameArtist);");
            $sql->bindParam(':nameArtist', $nameArtist, PDO::PARAM_STR);
            $sql->execute();
            return true;
        }
        catch (PDOException $e) {
            return false;
        }
    }

    function getArtistByName($nameArtist)
    {
        $db = Database::getInstance();

        try {
            $sql = $db->prepare("SELECT * FROM simpletab.artists WHERE artists.nameArtist = :nameArtist;");
            $sql->bindParam(':nameArtist', $nameArtist, PDO::PARAM_STR);
            $sql->execute();
            return true;
        }
        catch (PDOException $e) {
            return false;
        }
    }

    /**
     * @var Tableau des artistes
     */
    private $artist;
}