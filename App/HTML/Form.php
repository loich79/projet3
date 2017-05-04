<?php
namespace App\HTML;


/**
 * Description of Form
 *  permet de créer des formulaires
 * @author loich
 */
class Form {
    /**
     * tableau stockant les données utilse au formulaire passé a l'instanciation
     * @var type 
     */
    protected $data;
    /**
     * tag html pour la fontion surrooung
     * @var type 
     */
    protected $tag = 'p';
    /**
     * setter pour le tag
     * @param type $tag
     */
    public function setTag($tag)
    {
        $this->tag = $tag;
    }
    /**
     * crée la div entourant l'element html passé en parametre
     * @param type $html string
     * @return type string
     */
    protected function surround($html)
    {
        return '<'.$this->tag.'>'.$html.'</'.$this->tag.'>';
    }
    /**
     * recupere la valeur stocké dans le tableau a l'index passé en parametre
     * @param type $index string
     * @return type string
     */
    protected function getValue($index)
    {
        if (is_object($this->data)){
            return $this->data->$index;
        } 
        if (isset($this->data[$index])){
            return $this->data[$index];
        } else {
            return null;
        }
        
    }
    /**
     * constructeur initialisant le tableau data
     * @param type $data array
     */
    public function __construct($data =array())
    {
        $this->data = $data;
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
            $input = '<textarea name="'.$name.'" id="'.$name.'" rows ="20">'.$this->getValue($name).'</textarea>' ;
        }
        else {
            $input = '<input type="'.$type.'" name="'.$name.'" id="'.$name.'" value="'.$this->getValue($name).'" />';
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
        $select = '<select name="'.$name.'"  id="'.$name.'">';
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
        return $this->surround('<button type="submit">'.$nom.'</button>');
    }
}
