<?php
require_once './Framework/Controller.php';
require_once './Model/Admin.php';


/**
 * Contrôleur gérant la connexion au site
 */
class ConnexionController extends Controller
{
    private $admin;

    public function __construct ()
    {
        $this->admin = new Admin();
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
            if ($this->admin->connect( $login , $mdp )) {
                try {
                    $user = $this->admin->getUser( $login );
                } catch (Exception $e) {
                }
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

    public function disconnect ()
    {
        $this->request->getSession()->destroy();
        $this->redirect( "home" );
    }
}