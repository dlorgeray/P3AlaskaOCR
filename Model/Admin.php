<?php
require_once './Framework/Model.php';

/**
 * Modélise un utilisateur du blog
 *
 * @author Baptiste Pesquet
 */
class Admin extends Model
{
    /**
     * Vérifie qu'un utilisateur existe dans la BD
     *
     * @param string $login Le login
     * @param string $mdp Le mot de passe
     * @return boolean Vrai si l'utilisateur existe, faux sinon
     */
    public function connect ( $login , $mdp )
    {
        $sql = "select UTIL_ID, UTIL_MDP from t_utilisateur where UTIL_LOGIN=?";
        $user = $this->executeRequest( $sql , array ( $login ) )->fetch();

        if ($user) {
            if (password_verify( $mdp , $user['UTIL_MDP'] )) {
                return true;
            }
        }

        return false;
    }

    /**
     * Renvoie un utilisateur existant dans la BD
     *
     * @param string $login Le login
     * @return mixed L'utilisateur
     * @throws Exception Si aucun utilisateur ne correspond aux paramètres
     */
    public function getUser ( $login )
    {
        $sql = "select UTIL_ID as idUser, UTIL_LOGIN as login from t_utilisateur where UTIL_LOGIN=?";
        $user = $this->executeRequest( $sql , array ( $login ) );
        if ($user->rowCount() == 1)
            return $user->fetch(); // Accès à la première ligne de résultat
        else
            throw new Exception( "Aucun utilisateur ne correspond aux identifiants fournis" );
    }
}