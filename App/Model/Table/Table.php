<?php

namespace App\Model\Table;

use App\Model\Database\Database;
/**
 * Description of Table
 * gère les intéractions avec les tables de la bdd
 * @author loich
 */
class Table {
    /**
     * nom de la classe instanciée
     * @var type string
     */
    protected  $class;
    /**
     * nom de la table à interroger
     * @var type string
     */
    protected $table;
    /**
     * instance de la connexion a la bdd
     * @var type objet pdo
     */
    protected $db;
    
    /**
     * constructeur de la classe initialisant les propriétés de la class
     * @param Database $db 
     */
    public function __construct(Database $db) {
        $this->db = $db;
        if (is_null($this->class)) {
            $parts = explode('\\',get_class($this));       
            $className = end($parts);
            $this->class = strtolower(str_replace('Table', '', $className));
            $this->table = $this->class;
        }
        
    }
    /**
     * récupère l'objet correspondant à l'id passé en parametre
     * @param type $id int
     * @return type objet
     */
    public function find($id)
    {
        $res = $this->query('SELECT * FROM '. $this->table . ' WHERE id = :id', 
                array(':id' => $id),
                true);
        return $res;
    }
    /**
     * récupère l'ensemble des entrées de la table interrogée
     * @return type array
     */
    public function all()
    {
        return $this->query('SELECT * FROM '. $this->table);
    }
    /**
     * excute une requete (préparée si un tableau d'attribut est passé en parametres)
     * @param type $statement string
     * @param type $attributes array
     * @param type $one boolean
     * @return type boolean / objet / array
     */
    public function query ($statement, $attributes = null, $one = false)
    {
        $className = str_replace('Table', 'Entity', get_class($this));
        $className = str_replace('table', 'entity', $className);
        if($attributes) {
            return $this->db->prepare(
                    $statement, 
                    $attributes, 
                    $className, 
                    $one);
        } else {
            return $this->db->query(
                    $statement, 
                    $className, 
                    $one);
        }
    }
    /**
     * met à jour une entrée dans la table
     * @param type $id int
     * @param type $fields array
     * @return type bool
     */
    public function update($id, $fields)
    {
        $sqlParts =[];
        $attributes =[];
        foreach ($fields as $key =>$value) {
            $sqlParts[] = "$key = ?";
            $attributes[] = $value;
        }
        $attributes[] = $id;
        $sqlSet = implode(', ', $sqlParts);
        $sql = "UPDATE {$this->table} SET {$sqlSet} WHERE {$this->table}.id=?";
        $res = $this->query($sql,$attributes, true); 
        return $res;
    }
    /**
     * crée une entrée dans la table
     * @param type $fields array
     * @return type bool
     */
    public function create($fields)
    {
        $sqlParts =[];
        $sqlMarkers =[];
        $attributes =[];
        foreach ($fields as $key =>$value) {
            $sqlParts[] = "$key";
            $attributes[] = $value;
            $sqlMarkers[] = '?';
        }
        $sqlSet = implode(', ', $sqlParts);
        $sqlValues = implode(', ', $sqlMarkers);
        $sql = "INSERT INTO {$this->table} ({$sqlSet}) VALUES ({$sqlValues})";
        $res = $this->query($sql,$attributes, true); 
        return $res;
    }
    /**
     * supprime une entrée dans la table
     * @param type $id iny
     * @return type bool
     */
    public function delete($id)
    {
        return $this->query("DELETE FROM {$this->table} WHERE id= ?", [$id], true);
    }
    /**
     * retourne une liste sous forme de tableau
     * @param type $key string
     * @param type $value string
     * @return type array
     */
    public function getList($key, $value) 
    {
        $records = $this->all();
        $return = [];
        foreach ($records as $record) {
            $return[$record->$key] = $record->$value; 
        }
        return $return;
    }
}