<?php

require_once 'Model/Post.php';
require_once 'Model/Comment.php';
require_once 'Framework/Controller.php';
require_once 'Framework/Request.php';

/**
 * Contrôleur des actions liées aux billets
 *
 */
class PostController extends Controller
{
    private $post;
    private $comment;
    private $reportComment;

    /**
     * Constructeur
     */
    public function __construct ()
    {
        $this->post = new Post();
        $this->comment = new Comment();
    }

    // Affiche les détails sur un post

    public function index ()
    {
        $idPost = $this->request->getSetting( "id" );

        $post = $this->post->getPost( $idPost );
        $comments = $this->comment->getComments( $idPost );

        $this->generateView( array ( 'post' => $post , 'comments' => $comments ) );
    }


    /**
     * Ajoute un commentaire à un post
     * @throws Exception
     */
    public function comment ()
    {
        $this->request->getSetting( "content" );
        $idPost = $this->request->getSetting( "id" );
        $author = $this->request->getSetting( "author" );
        $content = $this->request->getSetting( "content" );

        $this->comment->addComment( $author , $content , $idPost );
        $this->request->getSession()->setFlash( 'Commentaire ajouté' , 'success' );
        $this->redirect( 'Post' , 'index/' . $idPost . '#comment' );
    }

    public function reportComment ()
    {
        $commentId = $this->request->getSetting( "idComment" );
        $idPost = $this->request->getSetting( "idPost" );
        $this->comment->report( $commentId );
        $this->request->getSession()->setFlash( 'Commentaire signalé' , 'warning' );
        $this->redirect( 'Post' , 'index/' . $idPost . '#comment' );
    }

    public function listPost ()
    {
        $posts = $this->post->getPublishPosts();
        $this->generateView( array ( 'posts' => $posts ) );
    }

    public function lastPost ()
    {
        $idPost = $this->post->getlastPostId();
        $this->redirect( 'Post' , 'index/' . $idPost );
    }
}