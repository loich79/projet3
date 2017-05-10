<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model\Table;

/**
 * Description of CommentsTable
 *
 * @author loich
 */
class CommentsTable  extends Table{
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
    public function allForPost($postId)
    {
        return $this->query("SELECT * FROM  {$this->table} WHERE post_id =  {$postId} ORDER BY id" );
    }
}
