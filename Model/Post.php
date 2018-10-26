<?php

require_once 'Framework/Model.php';

class Post extends Model
{
    /** Renvoie la liste des posts du blog
     *
     * @return PDOStatement La liste des posts
     */
    public function getPublishPosts ()
    {

        $sql = 'SELECT BIL_ID as id, BIL_DATE as date, BIL_TITLE as title, BIL_CONTENT as content,BIL_STATUS as status 
                FROM T_BILLET
                WHERE BIL_STATUS = "publié"
                ORDER BY BIL_ID';
        $posts = $this->executeRequest( $sql );
        return $posts;
    }

    public function getPosts ()
    {

        $sql = 'SELECT BIL_ID as id, BIL_DATE as date, BIL_TITLE as title, BIL_CONTENT as content, BIL_STATUS as status 
                FROM T_BILLET
                ORDER BY BIL_ID';
        $posts = $this->executeRequest( $sql );
        return $posts;
    }

    /** Renvoie les informations sur un post
     *
     * @param int $id L'identifiant du post
     * @return array Le post
     * @throws Exception Si l'identifiant du post est inconnu
     */
    public function getPost ( $idPost )
    {
        $sql = 'select BIL_ID as id, BIL_DATE as date,'
            . ' BIL_TITLE as title, BIL_CONTENT as content from T_BILLET'
            . ' where BIL_ID=?';
        $post = $this->executeRequest( $sql , array ( $idPost ) );
        if ($post->rowCount() > 0)
            return $post->fetch();  // Accès à la première ligne de résultat
        else
            throw new Exception( "Aucun post ne correspond à l'identifiant '$idPost'" );
    }

    /**
     * Renvoie le nombre total de billets
     *
     * @return int Le nombre de billets
     */
    public function getPostsNomber ()
    {
        $sql = 'SELECT COUNT(*) as nbPosts from T_BILLET';
        $result = $this->executeRequest( $sql );
        $line = $result->fetch(); // Le résultat comporte toujours 1 ligne
        return $line['nbPosts'];
    }

    /**
     * Créer un nouveau chapitre
     * @param $title
     * @param $content
     */
    public function create ( $title , $content )
    {
        $sql = 'INSERT INTO T_BILLET(BIL_TITLE, BIL_CONTENT, BIL_DATE, BIL_STATUS) VALUES(? ,? ,?, ?)';
        $date = date( 'Y-m-d H:i:s' );
        $status = "brouillon";
        $this->executeRequest( $sql , [ $title , $content , $date , $status ] );
    }

    public function publish ( $idPost )
    {
        $sql = 'UPDATE T_BILLET SET BIL_STATUS = "publié" WHERE BIL_ID = ?';
        $this->executeRequest( $sql , [ $idPost ] );
    }

    /**
     * Mise à jour d'un chapitre
     * @param $title
     * @param $content
     * @param $idPost
     */
    public function update ( $title , $content , $idPost )
    {
        $sql = 'UPDATE T_BILLET SET BIL_TITLE = ?, BIL_CONTENT = ?, BIL_UPDATE_DATE= ? WHERE BIL_ID = ?';
        $date = date( 'Y-m-d H:i:s' );
        $this->executeRequest( $sql , [ $title , $content , $date , $idPost ] );
    }

    /**
     * Suppression d'un chapitre et des éventuels commentaires associés
     * @param $idPost
     */
    public function deletePost ( $idPost )
    {
        $sql = 'DELETE FROM T_BILLET WHERE BIL_ID = ?; DELETE FROM T_COMMENT WHERE BIL_ID = ?';
        $this->executeRequest( $sql , [ $idPost , $idPost ] );
    }

    public function deleteComment ( $idComment )
    {
        $sql = 'DELETE FROM t_comment WHERE COM_ID = ?; DELETE FROM t_comment_report WHERE COM_ID = ?';
        $this->executeRequest( $sql , [ $idComment , $idComment ] );
    }

    /**
     * @return mixed
     */
    public function getlastPostId ()
    {
        $sql = 'SELECT t_billet.BIL_ID as id FROM t_billet WHERE BIL_STATUS = "publié" ORDER BY t_billet.BIL_ID DESC LIMIT 1';
        $req = $this->executeRequest( $sql );
        $post = $req->fetch();
        return $post['id'];
    }
}

