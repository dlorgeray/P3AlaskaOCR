<?php
/**
 * Classe de gestion des paramètres de configuration
 */

class Config
{
    /** Tableau des paramètres de configuration */
    private static $settings;

    /**
     * Renvoie la valeur d'un paramètre de configuration
     *
     * @param string $nom Nom du paramètre
     * @param string $valeurParDefaut Valeur à renvoyer par défaut
     * @return string Valeur du paramètre
     * @throws Exception
     */
    public static function get ( $name , $defaultValue = null )
    {
        if (isset( self::getSettings()[$name] )) {
            $value = self::getSettings()[$name];
        } else {

            $value = $defaultValue;
        }
        return $value;
    }

    /**
     * Renvoie le tableau des paramètres en le chargeant au besoin depuis un fichier de configuration.
     * Les fichiers de configuration recherchés sont Config/dev.ini et Config/prod.ini (dans cet ordre)
     *
     * @return array Tableau des paramètres
     * @throws Exception Si aucun fichier de configuration n'est trouvé
     */
    private static function getSettings ()
    {
        if (self::$settings == null) {
            $filePath = "Config/dev.ini";

            if (!file_exists( $filePath )) {
                $filePath = "Config/prod.ini";
            }
            if (!file_exists( $filePath )) {
                throw new Exception( "Aucun fichier de configuration trouvé" );
            } else {
                self::$settings = parse_ini_file( $filePath );
            }
        }
        return self::$settings;
    }
}