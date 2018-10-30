<?php
require_once './Framework/Controller.php';
require_once './Model/Post.php';

class ChaptersController extends Controller
{
    private $post;

    public function __construct ()
    {
        $this->post = new Post();
    }

    // Affiche la liste de tous les posts du blog
    public function index ()
    {
        $posts = $this->post->getPosts();
        $this->generateView( array ( 'posts' => $posts ) );
    }
}