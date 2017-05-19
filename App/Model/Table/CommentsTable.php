<?php
namespace App\Model\Table;

/**
 * Description of CommentsTable
 * Modele faisant l'interface avec la table comments
 * @author loich
 */
class CommentsTable  extends Table{
    /**
     * récupère l'objet correspondant à l'id passé en parametre
     * @param type $id int
     * @return type objet de type commentsEntity
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
        return $this->query("SELECT `id`, `authorname`, `comment`, `email`, `post_id`, `parent_id`, `level`, `flag`, DATE_FORMAT(comment_date, '%d/%m/%Y %H:%i') AS date FROM  {$this->table} WHERE post_id={$postId} ORDER BY id" );
    }
    /**
     * retourne le nombre de commentaires ayant été signalé
     * @return type string
     */
    public function countFlagged()
    {
        $res = $this->query("SELECT COUNT(id) AS count FROM {$this->table} WHERE flag != 0", [], true);
        //le résultat de la requete etant un objet on ne retourne que la valeur du compteur count
        return $res->count;
    }
    /**
     * retourne un tableau contenant les commentaires enfants du commentaire ayant pour id : $id
     * @param type $id int
     * @return type 
     */
    public function findChild($id)
    {
        $res = $this->query('SELECT * FROM '. $this->table . ' WHERE parent_id = :id', 
                array(':id' => $id));
        return $res;
    }
}
