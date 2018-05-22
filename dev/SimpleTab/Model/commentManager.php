<?php
/**
 * Created by PhpStorm.
 * User: SAUSERR_INFO
 * Date: 17.05.2018
 * Time: 16:00
 */



require_once '../Model/database.php';
require_once '../Model/comment.php';

/**
 * @brief Helper class pour gérer les tablatures du site
 *
 * @author romain.ssr@eduge.ch
 */
class CommentManager
{
    private static $objInstance;

    /**
     * @brief Class Constructor - Create a new ECommentManager if one doesn't exist
     * Set to private so no-one can create a new instance via ' = new
     * ECommentManager();'
     */
    private function __construct ()
    {
        $this->comments = array();
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
                self::$objInstance = new CommentManager();

            } catch (Exception $e)
            {
                echo "EDataManager Error: " . $e;
            }
        }
        return self::$objInstance;
    }


    /**
     * @param $idTab -> l'id de la tablature associée au commentaire
     * @return les commentaires associés à la tablature sous forme de tableau ou false si une erreur survient
     */
    function getCommentByTab($idTab)
    {
        $db = Database::getInstance();

        try {
            $sql = $db->prepare("SELECT * FROM simpletab.comments  WHERE comments.tablatures_idTab = :idTab;");
            $sql->bindParam(':idTab',$idTab,PDO::PARAM_INT);
            $sql->execute();
            $result = $sql->fetchAll();
            return $result;
        }

        catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Ajoute un commentaire en base
     * @param $contentCommment
     * @param $tabIdComment
     * @param $userIdComment
     * @return bool
     */
    function addComment($contentCommment, $tabIdComment, $userIdComment)
    {
        $db = Database::getInstance();

        try {
            $sql = $db->prepare("INSERT INTO simpletab.comments ( contentComment, tablatures_idTab, users_idUsers) VALUES ( :contentComment, :idTab, :idUser);");
            $sql->bindParam(':contentComment', $contentCommment, PDO::PARAM_STR);
            $sql->bindParam(':idTab', $tabIdComment, PDO::PARAM_INT);
            $sql->bindParam(':idUser', $userIdComment, PDO::PARAM_INT);
            $sql->execute();
            return true;
        }
        catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Efface un commentaire par son Id
     * @param $idComment
     * @return bool
     */
    function deleteCommentByTabId($idTab)
    {
        $db = Database::getInstance();
        try{
            $sql = $db->prepare("DELETE  FROM simpletab.comments WHERE comments.tablatures_idTab = :idComment");
            $sql->bindParam(':idTab', $idTab, PDO::PARAM_INT);
            $sql->execute();
            return true;
        }
        catch (PDOException $e) {
            return false;
        }

    }

    /** Tableau de commentaires */
    private $comments;
}
