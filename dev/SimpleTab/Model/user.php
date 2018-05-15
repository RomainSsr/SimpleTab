<?php
/**
 * Created by PhpStorm.
 * User: SAUSERR_INFO
 * Date: 15.05.2018
 * Time: 15:02
 */

/**
 * Classe des utilisateurs
 * @author RS
 */
class Users implements JsonSerializable
{
    /**
     * @brief Class Constructor
     * @param $InUserId L'identifiant de l'utilisateur
     * @param $InUserName Le nom de l'utilisateur
     * @param $InUserForename Le prénom de l'utilisateur
     * @param $InUserPassword Le mot de passe de l'utilisateur
     * @param $InUserEmail L'email de l'utilisateur
     * @param $InUserPseudo Le pseudonyme de l'utilisateur
     */
    public function __construct ($InUserId = - 1, $InUserName = "", $InUserForename = "", $InUserPassword = "", $InUserEmail = "", $InUserPseudo = "")
    {
        $this->id= $InUserId;
        $this->name = $InUserName;
        $this->forename = $InUserForename;
        $this->password = $InUserPassword;
        $this->email = $InUserEmail;
        $this->pseudo = $InUserPseudo;

    }

    /**
     * @brief On ne laisse pas cloner un utilisateur
     */
    private function __clone ()
    {}

    /**
     * @brief Est-ce que cet objet est valide
     *
     * @return True si valide, autrement false
     */
    public function isValid ()
    {
        return ( $this->id == -1 || $this->name == "" || $this->forename == "" || $this->password == "" || $this->email == "" || $this->pseudo == "") ? false : true;
    }

    /**
     * @brief Getter
     *
     * @return L'identifiant de l'utilisateur
     */
    public function getId ()
    {
        return $this->id;
    }

    /**
     * @brief Getter
     *
     * @return Le nom de l'utilisateur
     */
    public function getName ()
    {
        return $this->name;
    }

    /**
     * @brief Getter
     *
     * @return Le prénom de l'utilisateur
     */
    public function getForename ()
    {
        return $this->forename;
    }

    /**
     * @brief Getter
     *
     * @return Le mot de passe de l'utilisateur
     */
    public function getPassword ()
    {
        return $this->password;
    }

    /**
     * @brief Getter
     *
     * @return L'email de l'utilisateur
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @brief Getter
     *
     * @return Le pseudo de l'utilisateur
     */
    public function getPseudo ()
    {
        return $this->pseudo;
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }


    /** L'identifiant de l'utilisateur */
    private $id;
    /** Le nom de l'utilisateur */
    private $name;
    /** Le prénom de l'utilisateur */
    private $forename;
    /** Le mot de passe de l'utilisateur */
    private $password;
    /** L'email de l'utilisateur */
    private $email;
    /** Le pseudo de l'utilisateur */
    private $pseudo;

}
?>








