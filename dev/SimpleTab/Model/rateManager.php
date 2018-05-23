<?php
/**
 * Created by PhpStorm.
 * User: SAUSERR_INFO
 * Date: 22.05.2018
 * Time: 15:46
 */

require_once '../model/database.php';
require_once '../model/rate.php';

/**
 * @brief Helper class pour gérer les artistes du site
 *
 * @author romain.ssr@eduge.ch
 */
class rateManager
{
    private static $objInstance;

    /**
     * @brief Class Constructor - Create a new ECommentManager if one doesn't exist
     * Set to private so no-one can create a new instance via ' = new
     * ECommentManager();'
     */
    private function __construct()
    {
        $this->rate = array();
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
                self::$objInstance = new rateManager();

            } catch (Exception $e) {
                echo "EDataManager Error: " . $e;
            }
        }
        return self::$objInstance;
    }

    /**
     * @return le tableau des notes sinon false
     */
    function getRate()
    {

        $db = Database::getInstance();

        try {
            $sql = $db->prepare("SELECT * FROM simpletab.rates");
            $sql->execute();
            $result = $sql->fetchAll();
            return $result;
        }
        catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Ajoute une note en base
     * @param $rate
     * @param $idTab
     * @param $idUser
     * @return true si succès, sinon false
     */
    function addRate($rate,$idTab,$idUser)
    {
        $db = Database::getInstance();

        try {
            $sql = $db->prepare("INSERT INTO simpletab.rates (rate,tablatures_idTab,users_idUsers) VALUES ( :rate, :idTab, :idUser);");
            $sql->bindParam(':rate', $rate, PDO::PARAM_INT);
            $sql->bindParam(':idTab', $idTab, PDO::PARAM_INT);
            $sql->bindParam(':idUser', $idUser, PDO::PARAM_INT);
            $sql->execute();
            return true;
        }
        catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Récupère la moyenne des notes par l'id d'une tablature
     * @param $idTab
     * @return les notes de la tablature si succès sinon false
     */
    function getRateByTabId($idTab)
    {
        $db = Database::getInstance();
        try{
            $sql = $db->prepare("SELECT * FROM simpletab.rates WHERE rates.tablatures_idTab = :idTab");
            $sql->bindParam(':idTab', $idTab, PDO::PARAM_INT);
            $sql->execute();
            $result = $sql->fetchAll();
            return $result;
        }
        catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Récupère la moyenne des notes par l'id d'un utilisateur
     * @param $idTab
     * @return les notes de la tablature si succès sinon false
     */
    function getRateByUserId($idUser)
    {
        $db = Database::getInstance();
        try{
            $sql = $db->prepare("SELECT * FROM simpletab.rates WHERE rates.users_idUsers = :idUser");
            $sql->bindParam(':idUser', $idUser, PDO::PARAM_INT);
            $sql->execute();
            $result = $sql->fetchAll();
            return $result;
        }
        catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Supprime une note par l'id d'une tablature
     * @param $idTab
     * @return true si succès sinon false
     */
    function deleteRateByIdTab($idTab)
    {
        $db = Database::getInstance();
        try{
            $sql = $db->prepare("DELETE  FROM simpletab.rates WHERE rates.tablatures_idTab = :idTab");
            $sql->bindParam(':idTab', $idTab, PDO::PARAM_INT);
            $sql->execute();
            return true;
        }
        catch (PDOException $e) {
            return false;
        }
    }

    function getAverageRateByTabId($idTab)
    {
        $db = Database::getInstance();
        try{
            $sql = $db->prepare("SELECT ROUND(AVG(rates.rate)) FROM simpletab.rates WHERE rates.tablatures_idTab = :idTab");
            $sql->bindParam(':idTab', $idTab, PDO::PARAM_INT);
            $sql->execute();
            $result = $sql->fetchAll();
            return $result;
        }
        catch (PDOException $e) {
            return false;
        }
    }

    /**
     * @var Tableau des artistes
     */
    private $rate;
}