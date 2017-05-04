<?php
namespace App\HTML;
/**
 * Description of BootstrapForm
 * permet de créer des formulaires avec le css de bootstrap
 * @author loich
 */
class BootstrapForm extends Form
{
    /**
     * crée la div entourant l'element html passé en parametre
     * @param type $html string
     * @return type string
     */
    protected function surround($html)
    {
        return '<div class="form-group">'.$html.'</div>';
    }
    /**
     * crée un champ du formulaire (input text, input password, textarea)
     * @param type $name string 
     * @param type $label string
     * @param type $options array
     * @return type string
     */
    public function input($name, $label, $options = []) 
    {
        $type = 'text';
        if (isset($options['type'])){
            $type = $options['type'];
        } 
        $label = '<label for="'.$name.'">'.$label.' : </label>';
        
        if ($type === 'textarea') {
            $input = '<textarea name="'.$name.'" id="'.$name.'" class ="form-control" rows ="15">'.$this->getValue($name).'</textarea>' ;
        }
        else {
            $input ='<input type="'.$type.'" name="'.$name.'" id="'.$name.'" value="'.$this->getValue($name).'" class ="form-control" />';
        }
        return $this->surround($label . $input);
    }
    /**
     * crée une liste déroulante pour le formulaire
     * @param type $name string
     * @param string $label string
     * @param type $values array
     * @return type string
     */
    public function select($name, $label, $values)
    {
        $label = '<label for="'.$name.'">'.$label.' : </label>';
        $select = '<select name="'.$name.'"  id="'.$name.'" class="form-control">';
        foreach ($values as  $key => $value) {
           $attributes = '';
           if ($key == $this->getValue($name)) {
               $attributes = 'selected';
           }
           $select .= '<option value="'.$key .'" '.$attributes.'>'.$value.'</option>'; 
        }
        $select .= '</select>';
        return $this->surround($label . $select);
        
    }
    /**
     * crée un bouton de soumission pour le formulaire
     * @param type $nom string
     * @return type string
     */
    public function submit($nom = 'Envoyer') 
    {
        return $this->surround('<button type="submit" class="btn btn-primary">'.$nom.'</button>');
    }

}
