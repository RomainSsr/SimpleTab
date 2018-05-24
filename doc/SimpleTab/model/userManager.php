<?php
/**
 * Auteur: romain.ssr@eduge.ch
 * Date : 15.05.2018
 * projet: SimpleTab
 */

require_once '../model/database.php';
require_once '../model/user.php';
require_once '../model/tablatureManager.php';

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
        return $this->users;
    }

    /**
     * @param $pseudo
     * @return utilisateur sinon false
     */
    function getUserByPseudo($pseudo)
    {
        $db = Database::getInstance();

        try {
            $sql = $db->prepare("SELECT * FROM simpletab.users WHERE users.pseudoUser = :pseudo;");
            $sql-> bindParam(':pseudo',$pseudo,PDO::PARAM_STR);
            $sql->execute();
            $result = $sql->fetchAll();
            return $result;
        }

        catch (PDOException $e) {
            return false;
        }
    }

    /**
     * @param $email
     * @return utilisateur sinon false
     */
    function getUserByEmail($email)
    {
        $db = Database::getInstance();

        try {
            $sql = $db->prepare("SELECT * FROM simpletab.users WHERE users.emailUser = :email;");
            $sql-> bindParam(':email',$email,PDO::PARAM_STR);
            $sql->execute();
            $result = $sql->fetchAll();
            return $result;
        }

        catch (PDOException $e) {
            return false;
        }
    }

    /**
     * @param $emailOrPseudo
     * @return le mot de passe de l'utilisateur hashé si succès sinon false
     */
    function getPasswordFromEmailOrPseudo($mailOrPseudo)
    {
        $db = Database::getInstance();

        try {
            $sql = $db->prepare("SELECT users.pwdUser FROM simpletab.users WHERE (users.emailUser = :mailOrPseudo OR users.pseudoUser = :mailOrPseudo);");
            $sql-> bindParam(':mailOrPseudo',$mailOrPseudo,PDO::PARAM_STR);
            $sql->execute();
            $result = $sql->fetchAll();
            return $result;
        }

        catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Récupère les utilisateurs et le nombre de tablatures qu'ils ont postés
     * @return les utilisateurs et le nombre de tablatures qu'ils ont postés, sinon false
     */
    function getUsersAndNbTabPosted()
    {
        $db = Database::getInstance();

        try {
            $sql = $db->prepare("SELECT users.idUsers, pseudoUser, emailUser, count(users_idUsers) as nbTab
                                           FROM users LEFT JOIN tablatures ON (tablatures.users_idUsers = users.idUsers)
                                           WHERE users.role_idrole = 0
                                           GROUP BY users.idUsers, pseudoUser, emailUser
                                           ORDER BY count(users_idUsers) DESC, pseudoUser;");
            $sql->execute();
            $result = $sql->fetchAll();
            return $result;
        }

        catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Ajoute un utilisateur en base
     * @param $name
     * @param $forename
     * @param $password
     * @param $email
     * @param $pseudo
     * @return true si succès sinon false
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
     * Efface un utilisateur en base ainsi que ses tablatures associées
     * @param $idUser
     * @return true si succès sinon false
     */
    function deleteUserById($idUser)
    {
        $db = Database::getInstance();
        try {

            $sql = $db->prepare("SELECT idTab FROM simpletab.tablatures JOIN simpletab.users ON tablatures.users_idUsers = users.idUsers where users.idUsers = :idUser;");
            $sql->bindParam(':idUser', $idUser, PDO::PARAM_INT);
            $sql->execute();
            $result = $sql->fetchAll();
            if($result!= "" && isset($result) && count($result) != 0)
            {
                for ($i =0; $i<count($result);$i++)
                {
                    $successDeleteTab = tablatureMAnager::getInstance()->deleteTab($result[$i]['idTab']);

                }
            }
            else
            {
                $successDeleteTab = true;
            }

            if($successDeleteTab)
            {
                $sql = $db->prepare("DELETE  FROM simpletab.users WHERE users.idUsers = :idUser");
                $sql->bindParam(':idUser', $idUser, PDO::PARAM_INT);
                $sql->execute();
                return true;
            }
            else
            {
                return false;
            }
        }
        catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Retourne l'utilisateur s'il existe en base  sinon false.
     *
     */
    function identifyUser($mailOrPseudo)
    {
        $db = Database::getInstance();

        try {
            $sql = $db->prepare("SELECT * FROM simpletab.users WHERE (users.emailUser = :mailOrPseudo OR users.pseudoUser = :mailOrPseudo);");
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