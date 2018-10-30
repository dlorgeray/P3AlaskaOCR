<?php $this->title = "Billet simple pour l'Alaska - " . $this->clean( $post['title'] ); ?>

    <h1 id="titleReply">Commentaires sur le <?= $this->clean( $post['title'] ) ?></h1>
</header>
<?php foreach ($comments as $comments): ?>
    <p><?= $this->clean( $comments['author'] ) ?> dit :</p>
    <p><?= $this->clean( $comments['content'] ) ?></p>
<?php endforeach; ?>
