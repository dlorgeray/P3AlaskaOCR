<?php

require_once './Framework/Request.php';
require_once './Framework/View.php';
require_once './Framework/Controller.php';

/*
 * Classe de routage des requêtes entrantes.
 *
 */

class Router
{
    /**
     * Méthode principale appelée par le contrôleur frontal
     * Examine la requête et exécute l'action appropriée
     */

    public function routerRequest ()
    {
        try {
            // Fusion des paramètres GET et POST de la requête
            // Permet de gérer uniformément ces deux types de requête HTTP
            $request = new Request( array_merge( $_GET , $_POST ) );
            $controller = $this->createController( $request );
            $action = $this->createAction( $request );

            $controller->executeAction( $action );
        } catch (Exception $e) {
            $this->manageError( $e );
        }
    }

    /**
     * Instancie le contrôleur approprié en fonction de la requête reçue
     *
     * @param Requete $requete Requête reçue
     * @return Instance d'un contrôleur
     * @throws Exception Si la création du contrôleur échoue
     */
    private function createController ( Request $request )
    {
        // Grâce à la redirection, toutes les URL entrantes sont du type :
        // managePost.php?controleur=XXX&action=YYY&id=ZZZ

        $controller = "Home";  // Contrôleur par défaut
        if ($request->existSetting( 'controller' )) {
            $controller = $request->getSetting( 'controller' );
            // Première lettre en majuscule
            $controller = ucfirst( strtolower( $controller ) );
        }
        // Création du nom du fichier du contrôleur
        // La convention de nommage des fichiers controleurs est : Controleur/<$controleur>Controleur.php
        $classController = $controller . "Controller";
        $fileController = "Controller/" . $classController . ".php";
        if (file_exists( $fileController )) {
            // Instanciation du contrôleur adapté à la requête
            require($fileController);
            $controller = new $classController();
            $controller->setRequest( $request );
            return $controller;
        } else
            throw new Exception( "Fichier '$fileController' introuvable" );
    }

    /**
     * Détermine l'action à exécuter en fonction de la requête reçue
     *
     * @param $requete : Requête reçue
     * @return string Action à exécuter
     */
    private function createAction ( Request $request )
    {
        $action = "index";  // Action par défaut
        if ($request->existSetting( 'action' )) {
            try {
                $action = $request->getSetting( 'action' );
            } catch (Exception $e) {
            }
        }
        return $action;
    }

    /**
     * Gère une erreur d'exécution (exception)
     *
     * @param Exception $exception Exception qui s'est produite
     */
    private function manageError ( Exception $exception )
    {
        $view = new View( 'error' );
        $view->generate( array ( 'msgError' => $exception->getMessage() ) );
    }
}