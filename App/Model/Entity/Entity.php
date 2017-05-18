<?php
namespace App\Model\Entity;
/**
 * Description of entity
 * gere l'affichage des objets contenant les données venant de la bdd
 * @author loich
 */
class Entity {
    /**
     * fonction "magique" permettant l'appel de fonction get si la fonction n'est pas défini (ex url)
     * @param type $name nom de la fonction appellée (ex : url)
     * @return type fonction appellée (ex : getUrl() )
     */
    public function __get($name) {
       $method = 'get' . ucfirst($name);
       $this->$name = $this->$method();
       return $this->$name;
    }
}
