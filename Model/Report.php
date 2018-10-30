<?php
require_once './Framework/Model.php';

class Report extends Model
{

    public function getReportsNumber ()
    {
        $sql = 'SELECT COUNT(DISTINCT (COM_ID)) as nbReports FROM t_comment_report';
        $results = $this->executeRequest( $sql );
        $lines = $results->fetch();
        return $lines['nbReports'];
    }

}