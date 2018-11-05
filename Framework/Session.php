<?php

/**
 * Classe modélisant la session.
 * Encapsule la superglobale PHP $_SESSION.
 *
 * @author Baptiste Pesquet
 */
class Session
{
    /**
     * Constructeur.
     * Démarre ou restaure la session
     */
    public function __construct ()
    {
        session_start();
    }

    /**
     * Détruit la session actuelle
     */
    public function destroy ()
    {
        session_destroy();
    }

    /**
     * Ajoute un attribut à la session
     *
     * @param string $name Nom de l'attribut
     * @param string $value Valeur de l'attribut
     */
    public function setAttribut ( $name , $value )
    {
        $_SESSION[$name] = $value;
    }

    /**
     * Renvoie la valeur de l'attribut demandé
     *
     * @param string $name Nom de l'attribut
     * @return string Valeur de l'attribut
     * @throws Exception Si l'attribut n'existe pas dans la session
     */
    public function getAttribut ( $name )
    {
        if ($this->existAttribut( $name )) {
            return $_SESSION[$name];
        } else {
            throw new Exception( "Attribut '$name' absent de la session" );
        }
    }

    /**
     * Renvoie vrai si l'attribut existe dans la session
     *
     * @param string $name Nom de l'attribut
     * @return bool Vrai si l'attribut existe et sa valeur n'est pas vide
     */
    public function existAttribut ( $name )
    {
        return (isset( $_SESSION[$name] ) && $_SESSION[$name] != "");
    }

    public function setFlash ( $message , $type = 'error' )
    {
        $_SESSION['flash'] = array (
            'message' => $message ,
            'type' => $type );
    }
}