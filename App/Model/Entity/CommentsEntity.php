<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model\Entity;

/**
 * Description of CommentsEntity
 *
 * @author loich
 */
class CommentsEntity extends Entity {
    public function arrayChild($id)
    {
        return $name = 'ChildOfComment'.$id;
    }
}
