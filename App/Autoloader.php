<?php
namespace App;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * autoloader pour les classes de mon namespace app
 *
 * @author loich
 */
class Autoloader 
{
    /**
     * methode statique permettant l'utilisation de l'autoloader
     */
    public static function register()
    {
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }
    /**
     * crée l'appel de la classe passé en paramètre
     * @param type $class string
     */
    private static function autoload($class)
    {
        if (strpos($class, __NAMESPACE__.'\\') === 0) {
            $classPath = str_replace(__NAMESPACE__.'\\', '', $class);
            $className = str_replace('/', '\\', $classPath);
            require ROOT.'/App/'.$className.'.php';
        }
    }
    
}
