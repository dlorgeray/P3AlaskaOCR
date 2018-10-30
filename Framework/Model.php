<?php
require_once './Framework/Config.php';

/**
 * Classe abstraite Modèle.
 * Centralise les services d'accès à une base de données.
 * Utilise l'API PDO de PHP
 */
abstract class Model
{
    /** Objet PDO d'accès à la BD
     * Statique donc partagé par toutes les instances des classes dérivées */
    private static $bdd;

    /**
     * Exécute une requête SQL
     *
     * @param string $sql La requête SQL
     * @param array $valeurs Les valeurs associées à la requête
     * @return PDOStatement Le résultat renvoyé par la requête
     */
    protected function executeRequest ( $sql , $sets = null )
    {
        if ($sets == null) {
            $result = self::getBdd()->query( $sql );    // exécution directe
        } else {
            $result = self::getBdd()->prepare( $sql );  // requête préparée
            $result->execute( $sets );
        }
        return $result;
    }

    /**
     * Renvoie un objet de connexion à la BD en initialisant la connexion au besoin
     *
     * @return PDO L'objet PDO de connexion à la BDD
     */
    private function getBdd ()
    {
        if (self::$bdd == null) { // Récupération des paramètres de configuration BD
            try {
                $dsn = Config::get( "dsn" );
            } catch (Exception $e) {
            }
            try {
                $login = Config::get( "login" );
            } catch (Exception $e) {
            }
            try {
                $mdp = Config::get( "mdp" );
            } catch (Exception $e) {
            }
            self::$bdd = new PDO( $dsn , $login , $mdp ,
                array ( PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ) );
        }
        return self::$bdd;
    }

}



