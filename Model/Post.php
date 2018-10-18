<?php

require_once 'Framework/Model.php';

class Post extends Model
{
    /** Renvoie la liste des posts du blog
     *
     * @return PDOStatement La liste des posts
     */
    public function getPosts ()
    {

        $sql = 'select BIL_ID as id, BIL_DATE as date,'
            . ' BIL_TITLE as title, BIL_CONTENT as content from T_BILLET'
            . ' order by BIL_ID';
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
        $sql = 'select count(*) as nbPosts from T_BILLET';
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
        $status = "in progress";
        $this->executeRequest( $sql , [ $title , $content , $date , $status ] );
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
    public function delete ( $idPost )
    {
        $sql = 'DELETE FROM T_BILLET WHERE BIL_ID = ?; DELETE FROM T_COMMENT WHERE BIL_ID = ?';
        $this->executeRequest( $sql , [ $idPost , $idPost ] );
    }

    public function getlastPost ()
    {

        $sql = 'SELECT BIL_ID as id, BIL_DATE as date,'
            . ' BIL_TITLE as title, BIL_CONTENT as content FROM T_BILLET'
            . ' ORDER BY BIL_ID DESC LIMIT 1';
        $posts = $this->executeRequest( $sql );
        return $posts;
    }
}

