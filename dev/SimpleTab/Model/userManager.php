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
        $this->users = array();
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

    /**
     * @param $name = le nom de
     * @param $forename
     * @param $password
     * @param $email
     * @param $pseudo
     * @return true si l'ajout a fonctionné, sinon false
     */
    public function addUser($name, $forename, $password,$email,$pseudo)
    {
        $db = Database::getInstance();
        $defaultRole = 0;
        try {
            $sql = $db->prepare("INSERT INTO users ( nameUser, forenameUser, pwdUser, emailUser, pseudoUser,role_idrole) VALUES (  :name, :forname,:password, :email, :pseudo,:role);");
            $sql->bindParam(':name', $name, PDO::PARAM_STR);
            $sql->bindParam(':forname', $forename, PDO::PARAM_STR);
            $sql->bindParam(':password', $password, PDO::PARAM_STR);
            $sql->bindParam(':email', $email, PDO::PARAM_STR);
            $sql->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
            $sql->bindParam(':role', $defaultRole, PDO::PARAM_STR);
            $sql->execute();
            return true;
        }
        catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Retourne le prénom si l'utilisateur existe en base et que son mot de passe est correct, sinon false.
     *
     */
    function identifyUser($mailOrPseudo, $password)
    {
        $db = Database::getInstance();

        try {
            $sql = $db->prepare("SELECT * FROM simpletab.users WHERE (users.emailUser = :mailOrPseudo OR users.pseudoUser = :mailOrPseudo) AND  users.pwdUser = :password;");
            $sql-> bindParam(':mailOrPseudo',$mailOrPseudo,PDO::PARAM_STR);
            $sql-> bindParam(':password',$password,PDO::PARAM_STR);
            $sql->execute();
            $result = $sql->fetchAll();
            return $result;
        }

        catch (PDOException $e) {
            return false;
        }
    }


    /** Tableau d'utilisateurs */
    private $users;
}
?>