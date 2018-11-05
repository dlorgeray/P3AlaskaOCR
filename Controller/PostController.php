<?php

require_once './Model/Post.php';
require_once './Model/Comment.php';
require_once './Framework/Controller.php';
require_once './Framework/Request.php';

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

    /**
     * @throws Exception
     */
    public function index ()
    {
        $idPost = $this->request->getSetting( "id" );

        $post = $this->post->getPost( $idPost );
        if ($post['status'] == Post::STATUS_DRAFT) {
            throw new Exception( "Cette page n'est pas encore en ligne" );
        }
        $comments = $this->comment->getComments( $idPost );

        $this->generateView( array ( 'post' => $post , 'comments' => $comments ) );
    }


    /**
     * Ajoute un commentaire à un post
     * @throws Exception
     */
    public
    function comment ()
    {
        $this->request->getSetting( "content" );
        $idPost = $this->request->getSetting( "id" );
        $author = $this->request->getSetting( "author" );
        $content = $this->request->getSetting( "content" );
        if (strlen( $content ) < 25) {
            $this->request->getSession()->setFlash( 'Votre commentaire est trop court' , 'danger' );

        } else {
            $this->comment->addComment( $author , $content , $idPost );
            $this->request->getSession()->setFlash( 'Commentaire ajouté' , 'success' );
        }
        $this->redirect( 'Post' , 'index/' . $idPost . '#comment' );
    }

    public
    function reportComment ()
    {
        $commentId = $this->request->getSetting( "idComment" );
        $idPost = $this->request->getSetting( "idPost" );
        $this->comment->report( $commentId );
        $this->request->getSession()->setFlash( 'Commentaire signalé' , 'warning' );
        $this->redirect( 'Post' , 'index/' . $idPost . '#comment' );
    }

    public
    function listPost ()
    {
        $posts = $this->post->getPublishPosts();
        $this->generateView( array ( 'posts' => $posts ) );
    }

    public
    function lastPost ()
    {
        $idPost = $this->post->getlastPostId();
        $this->redirect( 'Post' , 'index/' . $idPost );
    }
}