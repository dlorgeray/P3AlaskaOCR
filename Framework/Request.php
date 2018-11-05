<?php

require_once './Framework/Session.php';

/*
 * Classe modélisant une requête HTTP entrante
 */

class Request
{
    /** Tableau des paramètres de la requête */
    private $settings;
    /** Objet session associé à la requête */
    private $session;

    /**
     * Constructeur
     *
     * @param array $parametres Paramètres de la requête
     */
    public function __construct ( $settings )
    {
        $this->settings = $settings;
        $this->session = new Session();
    }

    /**
     * Renvoie la valeur du paramètre demandé
     *
     * @param string $nom Nom d paramètre
     * @return string Valeur du paramètre
     * @throws Exception Si le paramètre n'existe pas dans la requête
     */
    public function getSetting ( $name )
    {
        if ($this->existSetting( $name )) {
            return $this->settings[$name];
        } else
            throw new Exception( "Paramètre '$name' absent de la requête" );
    }

    /**
     * Renvoie vrai si le paramètre existe dans la requête
     *
     * @param string $nom Nom du paramètre
     * @return bool Vrai si le paramètre existe et sa valeur n'est pas vide
     */
    public function existSetting ( $name )
    {
        return (isset( $this->settings[$name] ) && $this->settings[$name] != "");
    }

    /**
     * Renvoie l'objet session associé à la requête
     *
     * @return Session Objet session
     */
    public function getSession ()
    {
        return $this->session;
    }
}