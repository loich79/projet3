<?php

namespace App\Model\Entity;

use App\Model\Entity\Entity;

/**
 * Description of EntityCategorie
 * classe permettant de gérer l'affichage des catégories 
 * @author loich
 */
class CategoriesEntity extends Entity{
    /**
     * génere l'url selon la catégorie
     * @return type
     */
    public function getUrl()
    {
        return 'index.php?page=posts.category&id=' . $this->id; 
    }
}
