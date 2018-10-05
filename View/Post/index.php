<?php $this->title = "Billet simple pour l'Alaska - " . $this->clean( $post['title'] ); ?>


<article>
    <header>
        <h1 class="titlePost"><?= $this->clean( $post['title'] ) ?></h1>
        <time><?= $this->clean( $post['date'] ) ?></time>
    </header>
    <p><?= $this->clean( $post['content'] ) ?></p>
</article>
<hr/>
<header>
    <h1 id="titleReply">Commentaires sur le <?= $this->clean( $post['title'] ) ?></h1>
</header>
<?php foreach ($comments as $comment): ?>
    <p><?= $this->clean( $comment['author'] ) ?> dit :</p>
    <p><?= $this->clean( $comment['content'] ) ?></p>
    <div class="col-sm-6">
        <form method="post" action="post/reportComment">
            <input type="hidden" name="idPost" value="<?= $post['id'] ?>"/>
            <button type="submit" name="idComment" value="<?= $this->clean( $comment['id'] ) ?>"
                    class="btn btn-secondary btn-sm">Signaler
            </button>
        </form>
    </div>
<?php endforeach; ?>

<hr/>
<form method="post" action="post/comment">
    <input id="author" name="author" type="text" placeholder="Votre pseudo"
           required/><br/>
    <textarea id="txtComment" name="content" rows="5"
              placeholder="Votre commentaire" required></textarea><br/>
    <input type="hidden" name="id" value="<?= $post['id'] ?>"/>
    <input type="submit" value="Commenter"/>

</form>


