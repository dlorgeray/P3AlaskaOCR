<?php $this->title = "Billet simple pour l'Alaska - Administration - Accueil " ?>
<header>
<div class="post-preview" xmlns="http://www.w3.org/1999/html">

    <h2>Espace d'administration de votre Roman</h2>
    Bienvenue sur votre tableau de bord, <?= $this->clean( $login ) ?> ! </br>
Ce blog comporte <?= $this->clean( $nbPosts ) ?> billet(s) et
<?= $this->clean( $nbComments ) ?> commentaire(s).
</div>
</header>
<hr>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <header>
                <h3>Écrire un nouveau chapitre</h3>
            </header>
            <form action="admin/writing" method="post">
                <div class="form-group">
                    <input class="form-control" id="new_title" name="new_title" type="text"
                           placeholder="Titre du chapitre" required/>
                </div>
                <div class="form-group">
                    <textarea class="admin-editor" id="new_content" name="new_content" rows="4"
                              placeholder="Votre texte"></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Sauvegarder</button>
                </div>
            </form>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-auto-12">
            <header>
                <h2>Gérer les billets</h2>
            </header>
            <div class="table-responsive">
                <table class="table table-hover table-striped table-dark">
                    <thead>
                    <tr>
                        <th scope="col">Titre</th>
                        <th scope="col">Date de création</th>
                        <th scope="col">Éditer</th>
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
                            <td><a class="btn btn-primary btn-xs"
                                   href="<?= "admin/deletePost/" . $this->clean( $post['id'] ) ?>">Supprimer</a></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <hr>
</div>
    <div class="form-group">
        <a id="lienDeco" class="btn btn-primary" href="connexion/deconnect">Se déconnecter</a>
    </div>
