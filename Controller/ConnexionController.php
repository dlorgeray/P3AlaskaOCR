<?php
require_once 'Framework/Controller.php';
require_once 'Model/User.php';


/**
 * Contrôleur gérant la connexion au site
 */
class ConnexionController extends Controller
{
    private $user;

    public function __construct ()
    {
        $this->user = new User();
    }

    public function index ()
    {
        $this->generateView();
    }

    public function connect ()
    {
        if ($this->request->existSetting( "login" ) &&
            $this->request->existSetting( "mdp" )) {
            $login = $this->request->getSetting( "login" );
            $mdp = $this->request->getSetting( "mdp" );
            if ($this->user->connect( $login , $mdp )) {
                $user = $this->user->getUser( $login );
                $this->request->getSession()->setAttribut( "idUser" ,
                    $user['idUser'] );
                $this->request->getSession()->setAttribut( "login" ,
                    $user['login'] );
                $this->redirect( "admin" );
            } else
                $this->generateView( array ( 'msgError' =>
                    'Login ou mot de passe incorrects' ) , "index" );
        } else
            throw new Exception(
                "Action impossible : login ou mot de passe non défini" );
    }

    public function deconnect ()
    {
        $this->request->getSession()->destroy();
        $this->redirect( "home" );
    }
}