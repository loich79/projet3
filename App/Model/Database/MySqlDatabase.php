<?php

namespace App\Model\Database;
use \PDO;

/**
 * Description of Database
 * Gere l'intéraction avec la base de données mySQL
 * @author loich
 */
class MySqlDatabase extends Database{
    /**
     * nom de la base de données
     * @var type string
     */
    private $dbName;
    /**
     * identifiant pour la basse de données
     * @var type string
     */
    private $dbUser;
    /**
     * mot de passe associé à l'identifiant
     * @var type string
     */
    private $dbPwd;
    /**
     * adresse du la base de données
     * @var type string
     */
    private $dbHost;
    /**
     * objet PDO contient 
     * @var type objet PDO
     */
    private $pdo;
    
    
    /**
     * Construit l'objet et initialise ses propriétés (seul dbName est obligatoire)
     * @param type $dbName string
     * @param type $dbUser string (par défaut : 'root')
     * @param type $dbPwd string (par défaut : 'qdpxzK0N6c0I0Nz5')
     * @param type $dbHost string (par défaut : 'localhost')
     */
    public function __construct($dbName, $dbUser='root', $dbPwd='qdpxzK0N6c0I0Nz5', $dbHost ='localhost')
    {
        
        $this->dbName = $dbName;
        $this->dbUser = $dbUser;
        $this->dbPwd = $dbPwd;
        $this->dbHost = $dbHost;
    }
    /**
     * crée la connexion à la base de données si elle n'existe pas 
     * @return type objet PDO
     */
    private function getPDO()
    {
        if ($this->pdo == null)
        {
            try {
                $this->pdo = new PDO('mysql:host='.$this->dbHost.';dbname='.$this->dbName, 
                        $this->dbUser, $this->dbPwd,array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

            } catch (Exception $ex) {
                die('Erreur : '.$ex->getMessage());
            }
        }
        return $this->pdo;
    }
    /**
     * execute une requete SQL
     * @param type $statement string
     * @param type $className string
     * @param type $one bool
     * @return type array
     */
    public function query($statement,$className = null, $one = false)
    {
        $req = $this->getPDO()->query($statement);
        if (
                strpos($statement, 'UPDATE') === 0 ||
                strpos($statement, 'INSERT') === 0 ||
                strpos($statement, 'DELETE') === 0){
            return $req;
        }
        if($className === null) {
            $req->setFetchMode(PDO::FETCH_OBJ);
        } else {
            $req->setFetchMode(PDO::FETCH_CLASS, $className);
        }
        if($one) {
            $datas = $req->fetch();
        } else {
            $datas = $req->fetchAll();
        }
        return $datas;
    }
    /**
     * prépare et execute
     * @param type $statement string
     * @param type $attributes array
     * @param type $className string
     * @param type $one bool
     * @return type array
     */
    public function prepare($statement, $attributes, $className = null, $one = false)
    {
        $req = $this->getPDO()->prepare($statement);
        $res = $req->execute($attributes); 
        if (
                strpos($statement, 'UPDATE') === 0 ||
                strpos($statement, 'INSERT') === 0 ||
                strpos($statement, 'DELETE') === 0){
            return $res;
        }
        if($className === null) {
            $req->setFetchMode(PDO::FETCH_OBJ);
        } else {
            $req->setFetchMode(PDO::FETCH_CLASS, $className);
        }
        if($one) {
            $datas = $req->fetch();
        } else {
            $datas = $req->fetchAll();
        }
        return $datas;
    }
    /**
     * retourne l'id de la dernière entrée insérée
     * @return type int
     */
    public function lastInsertId() {
        return $this->getPDO()->lastInsertId();
    }
}
