<?php $this->title = "Billet simple pour l'Alaska - Administration - Accueil " ?>

<div class="right_col" role="main">

    <hr>
    <div class="row">
        <div class="col-lg-auto-12">
            <header>
                <h3>Gérer les billets</h3>
            </header>
            <div class="table-responsive">
                <table class="table table-hover table-striped table-dark">
                    <thead>
                    <tr>
                        <th scope="col">Titre</th>
                        <th scope="col">Date de création</th>
                        <th scope="col">Modification</th>
                        <th scope="col">Publication</th>
                        <th scope="col">Supprimer</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($posts as $post): ?>
                        <tr>
                            <td><?= $this->clean( $post['title'] ) ?></td>
                            <td>
                                <time><?= $this->clean( $post['date'] ) ?></time>
                            </td>
                            <td><a class="btn btn-primary btn-xs"
                                   href="<?= "admin/editPost/" . $this->clean( $post['id'] ) ?>">Editer</a></td>
                            <td><?php if ($post['status'] === "brouillon" )
                                { ?>
                                <a class="btn btn-success btn-xs"
                                   href="<?= "admin/publishPost/" . $this->clean( $post['id'] ) ?>">Publier</a>
                                <?php }
                                else {
                                ?>
                                  publié
                                <?php
                                }
                                ?>
                            </td>
                            <td><a class="btn btn-danger btn-xs""
                                href="<?= "admin/deletePost/" . $this->clean( $post['id'] ) ?>">Supprimer</a></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
