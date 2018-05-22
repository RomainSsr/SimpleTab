<?php
/**
 * Created by PhpStorm.
 * User: SAUSERR_INFO
 * Date: 22.05.2018
 * Time: 15:51
 */

/**
 * Classe des artistes
 * @author RS
 */
class rate implements JsonSerializable
{
    /**
     * Rate constructor.
     * @param int $InArtistId -> L'id de l'artiste
     * @param string $InArtistName -> Le nom de l'artiste
     */
    public function __construct ($InRateId = - 1, $InRate = -1, $InRateIdTab = -1, $InRateIdUser =-1)
    {
        $this->id = $InRateId;
        $this->rate = $InRate;
        $this->idTab = $InRateIdTab;
        $this->idUser = $InRateIdUser;
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
        return ( $this->id == -1 || $this->rate = -1 || $this->idTab = -1 || $this->idUser = -1) ? false : true;
    }

    /**
     * @brief Getter
     *
     * @return L'identifiant de la note
     */
    public function getId ()
    {
        return $this->id;
    }

    /**
     * @brief Getter
     *
     * @return La valeur de la note
     */
    public function getRate ()
    {
        return $this->rate;
    }

    /**
     * @brief Getter
     *
     * @return L'id de la tablature associée
     */
    public function getIdTab ()
    {
        return $this->idTab;
    }

    /**
     * @brief Getter
     *
     * @return L'id de l'utilisateur associé
     */
    public function getIdUser ()
    {
        return $this->idUser;
    }


    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

    /** Identifiant de la note */
    private $id;
    /** La valeur de la note */
    private $rate;
    /** L'id de la tablature associée */
    private $idTab;
    /** L'id de l'utilisateur associé */
    private $idUser;
}





