<?php

namespace App\Model\Table;


/**
 * Description of TableArticle
 * gère les intéractions avec la table 'articles' spécifique à la table
 * @author loich
 */
class PostsTable extends Table{

    /**
     * Récupère tout les articles triés du plus recent au plus ancien
     * @return array
     */
    public function last()
    {
        return $this->query('SELECT posts.id, posts.title,'
                . 'posts.content, categories.title AS categorie, posts.category_id,'
                . 'DATE_FORMAT(posts.publication_date, \'%d/%m/%Y à %H:%i\') AS date '
                . 'FROM posts '
                . 'LEFT JOIN categories ON category_id = categories.id '
                . 'ORDER by posts.publication_date DESC');       
    }
    /**
     * récupère les articles correspondant a l'id de la catégorie passé en parametre
     * @param type $id int
     * @param type $nbArticles int (par defaut = 5)
     * @return type array
     */
    public function lastByCategory($idCategorie, $nbArticles = 25)
    {
        return $this->query('SELECT posts.id, posts.title, '
                . 'posts.content, categories.title AS categorie, '
                . 'DATE_FORMAT(posts.publication_date, \'%d/%m/%Y à %H:%i\') AS date '
                . 'FROM posts '
                . 'LEFT JOIN categories ON posts.category_id = categories.id '
                . 'WHERE posts.category_id = ? '
                . 'ORDER BY publication_date DESC LIMIT 0, ' . $nbArticles, 
                array((int)$idCategorie));
    }
    /**
     * recupere les articles triés du plus en recent au plus ancien 
     * a partir de la position du premier article passé en paramètre
     * jusqu'au nombre max d'articles par page 
     * @param type $firstPost string
     * @return array
     */
    public function limitedList($firstPost)
    {
        return $this->query('SELECT posts.id, posts.title,'
                . 'posts.content, categories.title AS categorie, posts.category_id,'
                . 'DATE_FORMAT(posts.publication_date, \'%d/%m/%Y à %H:%i\') AS date '
                . 'FROM posts '
                . 'LEFT JOIN categories ON category_id = categories.id '
                . 'ORDER by posts.publication_date DESC '
                . 'LIMIT '.$firstPost.', '.NB_POSTS_PER_PAGE );      
    }
    /**
     recupere les articles pour une categorie dont l'id est passé en parametre
     * triés du plus en recent au plus ancien 
     * a partir de la position du premier article passé en paramètre
     * jusqu'au nombre max d'articles par page 
     * @param type $firstPost string
     * @param type $categoryId string
     * @return type array
     */
    public function limitedListByCategory($firstPost, $categoryId)
    {
        return $this->query("SELECT posts.id, posts.title, posts.content, "
                . "categories.title AS categorie, posts.category_id, "
                . "DATE_FORMAT(posts.publication_date, '%d/%m/%Y à %H:%i') AS date "
                . "FROM posts LEFT JOIN categories ON category_id = categories.id "
                . "WHERE posts.category_id = {$categoryId} "
                . "ORDER by posts.publication_date DESC "
                . "LIMIT {$firstPost}, ".NB_POSTS_PER_PAGE );      
    }
    /**
     * récupère l'article correspondant à l'id passé en parametre
     * @param type $id int
     * @return type objet
     */
    public function find($id)
    {
        $res = $this->query('SELECT posts.id, posts.title, '
                . 'posts.content, categories.title AS categorie, posts.category_id,'
                . 'DATE_FORMAT(posts.publication_date, \'%d/%m/%Y à %H:%i\') AS date '
                . 'FROM '. $this->table . ' '
                . 'LEFT JOIN categories ON posts.category_id = categories.id '
                . 'WHERE posts.id = :id', 
                array(':id' => $id),
                true);
        return $res;
    }
    
    /**
     * retourne le nombre total d'articles
     * @return type string
     */
    public function countPosts() {
        $res = $this->query('SELECT COUNT(id) as nbPosts FROM posts');
        // retourne uniquement la valeur de nbPosts
        return $res[0]->nbPosts;
    }
    /**
     * retourne le nombre total d'articles par catégories
     * @return type string
     */
    public function countPostsBycategory($categoryId) {
        $res = $this->query('SELECT COUNT(posts.id) as nbPosts FROM posts '
                . 'LEFT JOIN categories ON posts.category_id = categories.id '
                . 'WHERE posts.category_id = '.$categoryId);
        // retourne uniquement la valeur de nbPosts
        return $res[0]->nbPosts;
    }
}
