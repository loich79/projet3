<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;

/**
 * Description of Config
 * singleton pour la gestion de la configuration du site
 * @author loich
 */
class Config {
    /**
     * tableau contenant les parametres du site
     * @var type array
     */
    private $settings = [];
    /**
     * stocke l'instance de l'objet config
     * @var type objet
     */
    private static $instance;
    
    /**
     * permet de récupérer l'instance et la crée si besoin
     * @param type $file string (chemin du fichier de configuration)
     * @return type objet
     */
    public static function getInstance($file)
    {
        if(is_null(self::$instance)) {
            self::$instance = new Config($file);
        }
        return self::$instance;
    }

    /**
     * contructeur initilisant le tableau contenant les parametres du site
     * @param type $file string (chemin du fichier de configuration)
     */
    public function __construct($file) {
        $this->settings = require($file);
    }
    /**
     * génere le getter selon la clé du tableau donnée
     * @param type $key string
     * @return type string
     */
    public function get($key)
    {
        if(!isset($this->settings[$key])) {
            return null;
        }
        return $this->settings[$key];
    }
}
