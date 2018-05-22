<?php
/**
 * Created by PhpStorm.
 * User: SAUSERR_INFO
 * Date: 17.05.2018
 * Time: 16:00
 */


/**
 * Classe des commentaires
 * @author RS
 */
class Comment implements JsonSerializable
{
    /**
     * @brief Class Constructor
     * @param $InCommentId L'identifiant du commentaire
     * @param $InCommentContent Le contenu du commentaire
     * @param $InTabId L'id de la tablature associée au commentaire
     * @param $InUserId L'id de l'utilisateur associée au commentaire
     */
    public function __construct ($InCommentId = -1, $InCommentContent = "", $InTabId = "",  $InUserId = - 1)
    {
        $this->id= $InCommentId;
        $this->commentContent = $InCommentContent;
        $this->tabId = $InTabId;
        $this->userId = $InUserId;
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
        return ( $this->id == -1 || $this->commentContent == "" || $this->tabId == -1 ||  $this->userId == -1 ) ? false : true;
    }

    /**
     * @brief Getter
     *
     * @return L'identifiant du commentaire
     */
    public function getId ()
    {
        return $this->id;
    }

    /**
     * @brief Getter
     *
     * @return Le contenu du commentaire
     */
    public function getContent ()
    {
        return $this->commentContent;
    }

    /**
     * @brief Getter
     *
     * @return L'id de la tablature associée au commentaire
     */
    public function getTabId ()
    {
        return $this->tabId;
    }

    /**
     * @brief Getter
     *
     * @return L'id de l'utilisateur associée au commentaire
     */
    public function getUserId ()
    {
        return $this->userId;
    }

    /**
     * Serialize l'objet en json
     * @return array|mixed
     */
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }


    /** Identifiant du commentaire */
    private $id;
    /** Le contenu du commentaire */
    private $commentContent;
    /** L'id de la tablature associée au commentaire */
    private $tabId;
    /** L'id de l'utilisateur associé au commentaire */
    private $userId;

}








