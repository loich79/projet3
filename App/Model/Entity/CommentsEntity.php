<?php
namespace App\Model\Entity;

/**
 * Description of CommentsEntity
 * classe permettant de gérer l'affichage des commentaires
 * @author loich
 */
class CommentsEntity extends Entity {
    /**
     * crée le nom du tableau d'enfant pour une commentaire
     * @param type $id 
     * @return type string
     */
    public function arrayChild($id)
    {
        return $name = 'ChildOfComment'.$id;
    }
}
