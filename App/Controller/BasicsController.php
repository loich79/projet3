<?php
namespace App\Controller;
use \App;

/**
 * Description of PostController
 * controleur des pages basique du site (about, contact et mentions légales
 * @author loich
 */
class BasicsController extends Controller{
    /**
     * controleur pour la page a propos
     */
    public function about()
    {
        // modifie le titre de la page, ainsi que le titre et le sous titre de la bannière
        App::getInstance()->setTitle("A propos");
        App::getInstance()->setPageTitle("Jean Forteroche");
        App::getInstance()->setPageSubtitle('A propos');
        // génère l'affichage de la page a propos
        $this-> render('Basics.about');
    }
    /**
     * controleur pour la page contact
     */
    public function contact()
    {
        // modifie le titre de la page, ainsi que le titre et le sous titre de la bannière
        App::getInstance()->setTitle("Contact");
        App::getInstance()->setPageTitle("Jean Forteroche");
        App::getInstance()->setPageSubtitle('Contact');
        // génère l'affichage de la page a propos
        $this-> render('Basics.contact');
    }
    /**
     * controleur pour la page mentions légales
     */
    public function legal()
    {
        // modifie le titre de la page, ainsi que le titre et le sous titre de la bannière
        App::getInstance()->setTitle("Mentions légales");
        App::getInstance()->setPageTitle("Jean Forteroche");
        App::getInstance()->setPageSubtitle('Mentions légales');
        // génère l'affichage de la page a propos
        $this-> render('Basics.legal');
    }
}
