<?php
require_once './Framework/Config.php';

/**
 * Classe modélisant une vue
 */
class View
{
    const MAIN_LAYOUT = './View/template.php';
    const ADMIN_LAYOUT = './View/adminTemplate.php';


    /** Nom du fichier associé à la vue */
    private $file;

    /** Titre de la vue (défini dans le fichier vue) */
    private $title;

    private $template;

    /**
     * Constructeur
     *
     * @param string $action Action à laquelle la vue est associée
     * @param string $controleur Nom du contrôleur auquel la vue est associée
     */
    public function __construct ( $action , $controller = "" , $template = self::MAIN_LAYOUT )
    {
        // Détermination du nom du fichier vue à partir de l'action et du constructeur
        // La convention de nommage des fichiers vues est : Vue/<$controleur>/<$action>.php
        $file = "View/";
        if ($controller != "") {
            $file = $file . $controller . "/";
        }
        $this->file = $file . $action . ".php";
        $this->template = $template;
    }

    /**
     * Génère et affiche la vue
     *
     * @param array $donnees Données nécessaires à la génération de la vue
     */
    public function generate ( $datas )
    {
        // Génération de la partie spécifique de la vue
        try {
            $content = $this->generateFile( $this->file , $datas );
        } catch (Exception $e) {
        }

        // On définit une variable locale accessible par la vue pour la racine Web
        // Il s'agit du chemin vers le site sur le serveur Web
        // Nécessaire pour les URI de type controleur/action/id
        try {
            $rootWeb = Config::get( "rootWeb" , "/" );
        } catch (Exception $e) {
        }
        // Génération du gabarit commun utilisant la partie spécifique
        try {
            $view = $this->generateFile( $this->template ,
                array ( 'title' => $this->title , 'content' => $content ,
                    'rootWeb' => $rootWeb ) );
        } catch (Exception $e) {
        }
        // Renvoi de la vue générée au navigateur
        echo $view;
    }

    /**
     * Génère un fichier vue et renvoie le résultat produit
     *
     * @param string $fichier Chemin du fichier vue à générer
     * @param array $donnees Données nécessaires à la génération de la vue
     * @return string Résultat de la génération de la vue
     * @throws Exception Si le fichier vue est introuvable
     */
    private function generateFile ( $file , $datas )
    {
        if (file_exists( $file )) {
            // Rend les éléments du tableau $donnees accessibles dans la vue

            extract( $datas );
            // Démarrage de la temporisation de sortie
            ob_start();
            // Inclut le fichier vue
            // Son résultat est placé dans le tampon de sortie
            require $file;
            // Arrêt de la temporisation et renvoi du tampon de sortie
            return ob_get_clean();
        } else {
            throw new Exception( "Fichier '$file' introuvable" );
        }
    }


    /**
     * Nettoie une valeur insérée dans une page HTML
     * Permet d'éviter les problèmes d'exécution de code indésirable (XSS) dans les vues générées
     *
     * @param string $valeur Valeur à nettoyer
     * @return string Valeur nettoyée
     */
    private function clean ( $value )
    {
        return htmlspecialchars( $value , ENT_QUOTES , 'UTF-8' , false );
    }

    private function truncate ( $text , $limit = 50 , $ellipsis = '...' )
    {
        $text = strip_tags( $text );
        $words = preg_split( "/[\n\r\t ]+/" , $text , $limit + 1 , PREG_SPLIT_NO_EMPTY );
        if (count( $words ) > $limit) {
            array_pop( $words );
            $text = implode( ' ' , $words );
            $text = $text . $ellipsis;
        }
        return $text;
    }

    public function getFlash ()
    {
        if (isset( $_SESSION['flash']['message'] )) {
            include('View/_messageFlash.php');
            unset( $_SESSION['flash']['message'] );
            unset( $_SESSION['flash']['type'] );
        }
    }
}
