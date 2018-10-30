<?php
require_once './Model/Post.php';
require_once './Model/Comment.php';
require_once './Framework/Controller.php';
require_once './Framework/Request.php';

/**
 * Contrôleur des actions liées aux commentaires
 *
 */
class CommentsController
{
    private $comments = null;

    /**
     * Constructeur
     */
    public function __construct ()
    {
        $this->comments = new Comments();
    }

    // Affiche tous les commentaires

    public function index ()
    {
        $idPost = $this->request->getSetting( "id" );

        $post = $this->post->getPost( $idPost );
        $comments = $this->comment->getComments( $idPost );

        $this->generateView( array ( 'post' => $post , 'comments' => $comments ) );
    }

}