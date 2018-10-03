<?php $this->title = "Billet simple pour l'Alaska - Administration" ?>

<div class="post-preview" xmlns="http://www.w3.org/1999/html">

    <h2>Administration</h2>
    Bienvenue, <?= $this->clean( $login ) ?> ! </br>
Ce blog comporte <?= $this->clean( $nbPosts ) ?> billet(s) et
<?= $this->clean( $nbComments ) ?> commentaire(s).
J.Forteroche
    <div class="form-group">
        <a id="lienDeco" class="btn btn-primary" href="connexion/deconnect">Se déconnecter</a>
    </div>
</div>