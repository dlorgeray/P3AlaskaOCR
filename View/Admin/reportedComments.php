<div class="right_col" role="main">

    <hr>
    <div class="row">
        <div class="col-lg-auto-12">
            <header>
                <h3>Liste des commentaires</h3>
            </header>
            <div class="table-responsive">
                <table class="table table-hover table-striped table-dark">
                    <thead>
                    <tr>
                        <th scope="col">Chapitre</th>
                        <th scope="col">Date du commentaire</th>
                        <th scope="col">Auteur</th>
                        <th scope="col">Commentaire</th>
                        <th scope="col">Signalement</th>
                        <th scope="col">Modérer</th>
                        <th scope="col">Supprimer</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($reportedComments as $reportedComment): ?>
                        <tr>
                            <td><?= $this->clean( $reportedComment['id'] ) ?></td>
                            <td>
                                <time><?= $this->clean( $reportedComment['date'] ) ?></time>
                            </td>
                            <td><?= $this->clean( $reportedComment['author'] ) ?></td>
                            <td><?= $this->clean( $reportedComment['content'] ) ?></td>
                            <td><?= $this->clean( $reportedComment['nbReports'] ) ?></td>
                            <td><a class="btn btn-success btn-xs"
                                   href="<?= "admin/valideReportedComment/" . $this->clean( $reportedComment['idComment'] ) ?>">Valider</a>
                            </td>
                            <td><a class="btn btn-danger btn-xs"
                                   href="<?= "admin/deleteReportedComment/" . $this->clean( $reportedComment['idComment'] ) ?>">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>