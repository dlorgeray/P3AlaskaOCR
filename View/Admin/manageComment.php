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
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($allComments as $comment): ?>
                        <tr>
                            <td><?= $this->clean( $comment['id'] ) ?></td>
                            <td>
                                <time><?= $this->clean( $comment['date'] ) ?></time>
                            </td>
                            <td><?= $this->clean( $comment['author'] ) ?></td>
                            <td><?= $this->clean( $comment['content'] ) ?></td>
                            <td><?php if ($comment['idReport'] == null) {
                                    echo $comment['idReport'] = 'NON';
                                } else {
                                    echo $comment['idReport'] = 'OUI';
                                }
                                ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>