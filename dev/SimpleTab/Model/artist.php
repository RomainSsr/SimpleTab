<?php
/**
 * Created by PhpStorm.
 * User: SAUSERR_INFO
 * Date: 18.05.2018
 * Time: 12:57
 */


/**
 * Classe des artistes
 * @author RS
 */
class Artist implements JsonSerializable
{
    /**
     * Artist constructor.
     * @param int $InArtistId -> L'id de l'artiste
     * @param string $InArtistName -> Le nom de l'artiste
     */
    public function __construct ($InArtistId = - 1, $InArtistName = "")
    {
        $this->id= $InArtistId;
        $this->name = $InArtistName;
    }

    /**
     * @brief On ne laisse pas cloner une tablature
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
        return ( $this->id == -1 || $this->name == "") ? false : true;
    }

    /**
     * @brief Getter
     *
     * @return L'identifiant de l'artiste
     */
    public function getId ()
    {
        return $this->id;
    }

    /**
     * @brief Getter
     *
     * @return Le nom de l'artiste
     */
    public function getName ()
    {
        return $this->name;
    }


    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

    /** Identifiant de l'artiste */
    private $id;
    /** Le nom de l'artiste */
    private $name;

}