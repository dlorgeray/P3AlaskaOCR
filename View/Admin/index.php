<?php $this->title = "Billet simple pour l'Alaska - Administration" ?>
<h2>Administration</h2>
Bienvenue, <?= $this->clean( $login ) ?> !
Ce blog comporte <?= $this->clean( $nbPosts ) ?> billet(s) et
<?= $this->clean( $nbComments ) ?> commentaire(s).
J.Forteroche
<a id="lienDeco" href="connexion/deconnect">Se déconnecter</a>