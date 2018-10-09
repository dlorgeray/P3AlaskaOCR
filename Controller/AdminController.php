<?php
require_once 'Controller/SecureController.php';
require_once 'Model/Post.php';
require_once 'Model/Comment.php';

/**
 * Contrôleur des actions d'administration
 */
class AdminController extends SecureController
{
    private $post;
    private $comment;

    /**
     * Constructeur
     */
    public function __construct ()
    {
        $this->post = new Post();
        $this->comment = new Comment();
    }

    public function index ()
    {
        $nbPosts = $this->post->getPostsNomber();
        $nbComments = $this->comment->getCommentsNomber();
        $posts = $this->post->getPosts();
        $login = $this->request->getSession()->getAttribut( "login" );
        $this->generateView( array ( 'nbPosts' => $nbPosts ,
            'nbComments' => $nbComments , 'posts' => $posts , 'login' => $login ) );

    }

    /**
     * Ecrire un nouveau chapitre du roman
     */
    public function writing ()
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
     * Editer un chapitre existant
     */
    public function editPost ()
    {
        $idPost = $this->request->getSetting( "id" );
        $post = $this->post->getPost( $idPost );
        $this->generateView( array ( 'post' => $post ) );
    }

    /**
     * Sauvegarde des modifications d'un chapitre
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

        $this->post->update( $title , $content , $idPost );
        $this->redirect( 'admin' , 'editPost/' . $idPost );
    }

    public function deletePost ()
    {
        $idPost = $this->request->getSetting( 'id' );
        $this->post->delete( $idPost );
        $this->redirect( 'Admin' , 'index/' );
    }
}