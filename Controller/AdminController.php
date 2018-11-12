<?php
require_once './Controller/SecureController.php';
require_once './Model/Post.php';
require_once './Model/Comment.php';
require_once './Model/Report.php';

/**
 * Contrôleur des actions d'administration
 */
class AdminController extends SecureController
{
    /**
     * @var
     */
    private $post;
    private $comment;
    private $report;

    /**
     * Constructeur
     */
    public function __construct ()
    {
        $this->post = new Post();
        $this->comment = new Comment();
        $this->report = new Report();
        $this->setTemplate( View::ADMIN_LAYOUT );

    }

    /**
     * Action par défaut
     */
    public function index ()
    {
        $nbPosts = $this->post->getPostsNomber();
        $nbComments = $this->comment->getCommentsNomber();
        $nbReports = $this->report->getReportsNumber();

        $posts = $this->post->getPosts();
        $login = $this->request->getSession()->getAttribut( "login" );
        $this->generateView(
            array ( 'nbPosts' => $nbPosts , 'nbComments' => $nbComments , 'nbReports' => $nbReports , 'posts' => $posts , 'login' => $login )
        );

    }


    /**
     * Action de charger la page de gestion des billets
     */
    public function managePost ()
    {
        $nbPosts = $this->post->getPostsNomber();
        $nbComments = $this->comment->getCommentsNomber();
        $posts = $this->post->getPosts();
        $login = $this->request->getSession()->getAttribut( "login" );
        $this->generateView(
            array ( 'nbPosts' => $nbPosts , 'nbComments' => $nbComments , /**'nbReports' => $nbReports,*/
                'posts' => $posts , 'login' => $login )
        );
    }

    /**
     * Action de sauvegarder un nouveau chapitre du roman
     */
    public function writingPost ()
    {
        $title = $this->request->getSetting( "new_title" );
        if ($this->request->existSetting( "new_content" )) {
            $content = $this->request->getSetting( "new_content" );
        } else {
            $content = '';
        }
        $this->post->create( $title , $content );
        $this->redirect( 'Admin' , 'index/' );
    }

    /**
     * Publier un nouveau chapitre
     */
    public function publishPost ()
    {
        $idPost = $this->request->getSetting( "id" );
        $this->post->publish( $idPost );
        $this->redirect( 'Admin' , 'managePost/' );
    }

    /**
     * Sauvegarde en statut brouillon des modifications d'un chapitre existant
     */
    public function savePost ()
    {
        $idPost = $this->request->getSetting( "id" );
        $title = $this->request->getSetting( "title" );
        if ($this->request->existSetting( "content" )) {
            $content = $this->request->getSetting( "content" );
        } else {
            $content = '';
        }
        $this->post->update( $title , $content , $idPost, isset($_POST['Publier']) );
        $this->redirect( 'Admin' , 'managePost/' );
    }

    /**
     * Action de charger la page d'écriture d'un nouveau billet
     */
    public function writePost ()
    {
        $this->generateView();
    }

    /**
     * Action de charger la page d'édition d'un chapitre existant
     */
    public function editPost ()
    {
        $idPost = $this->request->getSetting( "id" );
        try {
            $post = $this->post->getPost( $idPost );
        } catch (Exception $e) {
        }
        $this->generateView( array ( 'post' => $post ) );
    }

    /**
     * Action de supprimer un billet
     */
    public function deletePost ()
    {
        $idPost = $this->request->getSetting( 'id' );
        $this->post->deletePost( $idPost );
        $this->redirect( 'Admin' , 'managePost/' . $idPost );
    }
    /**
     * Action de supprimer un commentaire
     */
    public function deleteComment ()
    {
        $idPost = $this->request->getSetting( 'idComment' );
        $this->post->deleteComment( $idPost );
        $this->redirect( 'Admin' , 'allComments/' );
    }

    /**
     * Action de charger la page de la liste de tous les commentaires
     */
    public function allComments ()
    {
        $allComments = $this->comment->getAllComments( false );
        $this->generateView( array ( 'allComments' => $allComments ) );
    }

    /**
     * Action de charger la page de la liste de tous les commentaires signalés
     */
    public function reportedComments ()
    {
        $reportedComments = $this->comment->getAllComments( true );
        $this->generateView( array ( 'reportedComments' => $reportedComments ) );
    }

    /**
     * Action de supprimer un commentaire signalé
     */
    public function deleteReportedComment ()
    {
        $idComment = $this->request->getSetting( 'id' );
        $this->comment->deleteComment( $idComment );
        $this->redirect( 'Admin' , 'allComments/' );
    }

    /**
     * Action de valider un commentaire qui a été signalé
     */
    public function valideReportedComment ()
    {
        $idComment = $this->request->getSetting( "id" );
        $this->comment->deleteReports( $idComment );
        $this->redirect( 'Admin' , 'reportedComments' );
    }

}