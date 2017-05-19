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
     * retourne le nombre total d'articles
     * @return type object
     */
    public function countPosts() {
        $res = $this->query('SELECT COUNT(id) as nbPosts FROM posts');
        // retourne uniquement la valeur de nbPosts
        return $res[0]->nbPosts;
    }
}
