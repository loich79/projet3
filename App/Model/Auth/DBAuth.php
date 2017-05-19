<?php

namespace App\Model\Auth;

use App\Model\Database\Database;
/**
 * Description of DatabaseAuth
 * gere les intéractions avec la table users
 * @author loich
 */
class DBAuth {
    /**
     * isntance PDO
     * @var type 
     */
    private $db;
    /**
     * constructeur récupérant l'instance PDO
     * @param Database $db
     */
    public function __construct(Database $db) 
    {
        $this->db = $db;
    }
    /**
     * retourne l'id de l'utilisateur s'il est loggué
     * @return int / boolean
     */
    public function getUserId()
    {
        if($this->logged()){
            return $_SESSION['auth'];
        }
        return false;
    }

    /**
     * verifie si les identifiants passé en parametre permettent de se connecter 
     * @param type $username string
     * @param type $password string
     * @return boolean 
     */
    public function login($username, $password)
    {
        $user = $this->db->prepare('SELECT * FROM users WHERE username = ?', [$username],null, true);
        if($user) {
            if(password_verify($password, $user->password)) {
                $_SESSION['auth'] = $user->id;
                return true;
            }
        } 
        return false;
        
    }
    /**
     * teste si une session existe
     * @return type boolean
     */
    public function logged()
    {
        return isset($_SESSION['auth']);
    }

}
