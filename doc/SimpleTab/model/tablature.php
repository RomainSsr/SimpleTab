<?php
/**
 * Auteur: romain.ssr@eduge.ch
 * Date : 15.05.2018
 * projet: SimpleTab
 */

/**
 * Classe des tablatures
 * @author RS
 */
class Tablature implements JsonSerializable
{
    /**
     * @brief Class Constructor
     * @param $InTabId L'identifiant de la tablature
     * @param $InTabTitle Le titre de la tablature
     * @param $InTabPath Le chemin de la tablature au format XML
     * @param $InTabRate La note de la tablature sur 5
     * @param $InLvlTab Le niveau de la tablature (0 -> facile; 1-> moyen; 2-> difficile)
     * @param $InUserID L'id de l'utilisateur qui a posté la tablature
     * @param $InArtistID L'id de l'artiste qui a créé la tablature

     */
    public function __construct ($InTabId = - 1, $InTabTitle = "", $InTabPath = "", $InTabRate = -1, $InLvlTab = -1, $InUserID = - 1,$InArtistID = - 1)
    {
        $this->id= $InTabId;
        $this->title = $InTabTitle;
        $this->path = $InTabPath;
        $this->rate = $InTabRate;
        $this->lvl = $InLvlTab;
        $this->userId = $InUserID;
        $this->artistId = $InArtistID;
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
        return ( $this->id == -1 || $this->title == "" || $this->path == "" || $this->rate == -1 || $this->lvl == -1 || $this->userId == -1 || $this->artistId == -1) ? false : true;
    }

    /**
     * @brief Getter
     *
     * @return L'identifiant de la tablature
     */
    public function getId ()
    {
        return $this->id;
    }

    /**
     * @brief Getter
     *
     * @return Le titre de la tablature
     */
    public function getTitle ()
    {
        return $this->title;
    }

    /**
     * @brief Getter
     *
     * @return Le chemin de la tablature
     */
    public function getPath ()
    {
        return $this->path;
    }

    /**
     * @brief Getter
     *
     * @return La note de la tablature
     */
    public function getRate ()
    {
        return $this->rate;
    }

    /**
     * @brief Getter
     *
     * @return Le niveau de la tablature
     */
    public function getLvl ()
    {
        return $this->lvl;
    }

    /**
     * @brief Getter
     *
     * @return L'identifiant de l'utilisateur qui a posté la tablature
     */
    public function getUserId ()
    {
        return $this->userId;
    }

    /**
     * @brief Getter
     *
     * @return L'identifiant de l'artiste qui a créé la tablature
     */
    public function getArtistId ()
    {
        return $this->artistId;
    }

    /**
     * Sérialize l'objet en json
     * @return array|mixed
     */
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }


    /** Identifiant de la tablature */
    private $id;
    /** Le titre de la tablature */
    private $title;
    /** Le chemin de la tablature au format XML */
    private $path;
    /** La note de la tablature sur 5 */
    private $rate;
    /** Le niveau de la tablature (0 -> facile; 1-> moyen; 2-> difficile)*/
    private $lvl;
    /** L'id de l'utilisateur qui a posté la tablature */
    private $userId;
    /** L'id de l'artiste qui a créé la tablature */
    private $artistId;
}








