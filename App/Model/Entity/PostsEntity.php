<?php
namespace App\Model\Entity;

use \App\Model\Entity\Entity;
/**
 * Description of ArticleEntity
 * classe permettant de gérer l'affichage des articles 
 * @author loich
 */
class PostsEntity extends Entity{
    
    /**
     * génere l'url selon l'article
     * @return type
     */
    public function getUrl()
    {
        return 'index.php?page=posts.show&id=' . $this->id; 
    }
    /**
     * génère un extrait de l'article
     * @return string
     */
    public function getExtract()
    {
        $html = '<p>' . substr($this->content, 0, 350) . '...</p>';
        $html .= '<p>&nbsp <a class="btn btn-primary pull-right" href="' . $this->getUrl() . '">Voir la suite</a></p>';
        return $html;
    }
}
