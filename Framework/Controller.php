<?php
require_once './Framework/Request.php';
require_once './Framework/View.php';
require_once './Framework/Config.php';

/**
 * Classe abstraite Controleur
 * Fournit des services communs aux classes Controleur dérivées
 */
abstract class Controller
{
    /**
     * @var
     */
    protected $request;

    // Requête entrante
    /** Action à réaliser */
    private $action;

    private $template = View::MAIN_LAYOUT;

    /**
     * Définit la requête entrante
     *
     * @param Request $request Requete entrante
     */
    public function setRequest ( Request $request )
    {
        $this->request = $request;
    }


    /**
     * Exécute l'action à réaliser.
     * Appelle la méthode portant le même nom que l'action sur l'objet Controleur courant
     *
     * @throws Exception Si l'action n'existe pas dans la classe Controleur courante
     */
    public function executeAction ( $action )
    {
        if (method_exists( $this , $action )) {
            $this->action = $action;
            $this->{$this->action}();
        } else {
            $classController = get_class( $this );
            throw new Exception( "Action '$action' non définie dans la classe $classController" );
        }
    }

    /**
     * Méthode abstraite correspondant à l'action par défaut
     * Oblige les classes dérivées à implémenter cette action par défaut
     */
    public abstract function index ();

    /**
     * @param mixed $template
     */
    public function setTemplate ( $template )
    {
        $this->template = $template;
    }

    /**
     * Génère la vue associée au contrôleur courant
     *
     * @param array $donnees Vue Données nécessaires pour la génération de la vue
     */
    protected function generateView ( $datasView = array () , $action = null )
    {
        // Utilisation de l'action actuelle par défaut
        $actionView = $this->action;
        if ($action != null) {
            // Utilisation de l'action passée en paramètre
            $actionView = $action;
        }
        // Utilisation du nom du contrôleur actuel
        $classController = get_class( $this );
        $controllerView = str_replace( "Controller" , "" , $classController );
        // Instanciation et génération de la view
        $view = new View( $actionView , $controllerView , $this->template );
        $view->generate( $datasView );
    }

    /**
     * Effectue une redirection vers un contrôleur et une action spécifiques
     *
     * @param string $controleur Contrôleur
     * @param  $action
     */
    protected function redirect ( $controller , $action = null , $ancre = null )
    {
        try {
            $rootWeb = Config::get( "rootWeb" , "/" );
        } catch (Exception $e) {
        }
// Redirection vers l'URL racine_site/controleur/action
        header( "Location:" . $rootWeb . $controller . "/" . $action . $ancre );
    }
}