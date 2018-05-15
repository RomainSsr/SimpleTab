<?php
/**
 * Created by PhpStorm.
 * User: SAUSERR_INFO
 * Date: 15.05.2018
 * Time: 15:00
 */



require_once '../Model/database.php';
require_once '../Model/user.php';

/**
 * @brief Helper class pour gérer les utilisateurs du site
 *
 * @author romain.ssr@eduge.ch
 */
class UserManager
{
    private static $objInstance;

    /**
     * @brief Constructeur de la Classe - Crée un nouveau UserManager si aucun n'existe déjà.
     * Le met en privé de telle sorte à ce que personne ne peut céer un nouveau manager depuis ' = new
     * UserManager();'
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
                self::$objInstance = new UserManager();

            } catch (Exception $e)
            {
                echo "EDataManager Error: " . $e;
            }
        }
        return self::$objInstance;
    }

    /**
     * Retourne le tableau de tous les utilisateurs
     *
     */
    public function getUsers()
    {
        return $this->tablature;
    }

    public function addUser($name, $forename, $password,$email,$pseudo)
    {
        $db = Database::getInstance();

        try {
            $sql = $db->prepare("INSERT INTO users ( nameUser, forenameUser, pwdUser, emailUser, pseudoUser) VALUES (  :name, :forname,:password, :email, :pseudo);");
            $sql->bindParam(':name', $name, PDO::PARAM_STR);
            $sql->bindParam(':forname', $forename, PDO::PARAM_STR);
            $sql->bindParam(':password', $password, PDO::PARAM_STR);
            $sql->bindParam(':email', $email, PDO::PARAM_STR);
            $sql->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
            $sql->execute();
            return true;
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
?>