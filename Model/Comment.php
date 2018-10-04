<?php

require_once 'Framework/Model.php';

class Comment extends Model
{

    /**
     * Renvoie la liste des commentaires associés à un post
     * @param $idPost
     * @return PDOStatement
     */
    public function getComments ( $idPost )
    {
        $sql = 'select COM_ID as id, COM_DATE as date,'
            . ' COM_AUTHOR as author, COM_CONTENT as content, COM_STATUS as status from T_COMMENT'
            . ' where BIL_ID=?';
        $comments = $this->executeRequest( $sql , array ( $idPost ) );
        return $comments;
    }

    /**
     * @param $author
     * @param $content
     * @param $idPost
     * Ajoute un commentaire dans la base
     * @param $status
     */
    public function addComment ( $author , $content , $idPost , $status )
    {
        $sql = 'insert into T_COMMENT(COM_DATE, COM_AUTHOR, COM_CONTENT, BIL_ID,COM_STATUS)'
            . ' values(?, ?, ?, ?, ?)';
        $date = new DateTime(); // Récupère la date courante
        $this->executeRequest( $sql , array ( $date->format( 'Y-m-d H:i:s' ) , $author , $content , $idPost , $status ) );
    }

    /**
     * Renvoie le nombre total de commentaires
     *
     * @return int Le nombre de commentaires
     */
    public function getCommentsNomber ()
    {
        $sql = 'select count(*) as nbComments from T_COMMENT';
        $result = $this->executeRequest( $sql );
        $line = $result->fetch(); // Le résultat comporte toujours 1 ligne
        return $line['nbComments'];
    }
}