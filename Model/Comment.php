<?php

require_once './Framework/Model.php';

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
            . ' COM_AUTHOR as author, COM_CONTENT as content from t_comment'
            . ' where BIL_ID=?';
        $comments = $this->executeRequest( $sql , array ( $idPost ) );
        return $comments->fetchAll();
    }

    /**
     * @param $author
     * @param $content
     * @param $idPost
     * Ajoute un commentaire dans la base
     * @param $status
     */
    public function addComment ( $author , $content , $idPost )
    {
        $sql = 'insert into t_comment(COM_DATE, COM_AUTHOR, COM_CONTENT, BIL_ID)'
            . ' values(?, ?, ?, ?)';
        $date = new DateTime(); // Récupère la date courante
        $this->executeRequest( $sql , array ( $date->format( 'Y-m-d H:i:s' ) , $author , $content , $idPost ) );
    }

    /**
     * Renvoie le nombre total de commentaires
     *
     * @return int Le nombre de commentaires
     */
    public function getCommentsNomber ()
    {
        $sql = 'select count(*) as nbComments from t_comment';
        $result = $this->executeRequest( $sql );
        $line = $result->fetch(); // Le résultat comporte toujours 1 ligne
        return $line['nbComments'];
    }

    public function report ( $idComment )
    {
        $sql = 'INSERT INTO t_comment_report (COM_ID, REPORT_DATE) VALUES (? ,?)';
        $date = date( 'Y-m-d H:i:s' );
        $this->executeRequest( $sql , [ $idComment , $date ] );
    }

    /**
     * @return mixed
     */
    public function getAllComments ( $only_reported = false )
    {
        $only_reported_sql = ($only_reported) ? " HAVING nbReports > 0 " : "";
        $order_sql = ($only_reported) ? " ORDER BY nbReports DESC " : " ORDER BY COM_DATE DESC";

        $sql = 'SELECT BIL_ID as id, COM_DATE as date, COM_AUTHOR as author, COM_CONTENT as content,t_comment.COM_ID as idComment,t_comment_report.COM_ID as idReportComment, COUNT(DISTINCT t_comment_report.REPORT_ID) as nbReports
                FROM t_comment
                LEFT JOIN t_comment_report
                ON t_comment.COM_ID = t_comment_report.COM_ID
                GROUP BY t_comment.COM_ID' .
            $only_reported_sql . $order_sql;
        $allComments = $this->executeRequest( $sql );
        return $allComments;
    }

    /**
     * Delete a comment and its reports when exist from DB
     *
     * @param int $idComment Comment id
     */
    public function deleteComment ( $idComment )
    {
        $sql = 'DELETE FROM t_comment WHERE t_comment.COM_ID = ?';
        $this->executeRequest( $sql , [ $idComment ] );
    }

    /**
     *
     * Validate a reported comment by deleting reports from DB
     *
     * @param int $idComment
     */
    public function deleteReports ( $idComment )
    {
        $sql = 'DELETE FROM t_comment_report WHERE t_comment_report.COM_ID = ? ';
        $this->executeRequest( $sql , [ $idComment ] );
    }


}

