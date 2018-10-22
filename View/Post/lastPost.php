<section id="banner">
    <header class="masthead bg-primary text-black-50 text-center text" style="background-image : url('./Content/img/home-bg nb gt.jpg');background-repeat: no-repeat;
	background-size: auto;">>
        <div class="inner">
            <h2>Billet Simple pour l'Alaska</h2>
            <hr class="star-light">
            <h3> Mon dernier chapitre </h3>
        </div>
    </header>
</section>
<article id="main">
    <section class="wrapper style5">
        <?php foreach ($posts as $post): ?>
            <div class="inner">
                <h3>
                    <?= $this->clean( $post['title'] ) ?>
                </h3>
                <br>
                <em>
                    <time>Publié le <?= $this->clean( $post['date'] ) ?></time>
                </em>
                <p>
                    <br>
                    <?= $this->clean( $post['content'] ) ?>
                    <br>
                </p>
            </div>
        <?php endforeach; ?>
    </section>
</article>

<section class="wrapper style2">
    <div class="inner">
        <header id="liste" class="major">
            <h3 id="titleReply">Commentaires des lecteurs sur le <?= $this->clean( $post['title'] ) ?></h3>
        </header>

        <?php foreach ($posts as $comment): ?>
            <time><?= $this->clean( $comment['dateComment'] ) ?></time>
            <p><?= $this->clean( $comment['authorComment'] ) ?> dit :</p>
            <p><?= $this->clean( $comment['contentComment'] ) ?></p>
            <div class="control-group">
                <div class="form-group floating-label-form-group controls mb-0 pb-2"></div>
                <form method="post" action="post/reportComment">
                    <input type="hidden" name="idPost" value="<?= $post['id'] ?>"/>
                    <button type="submit" name="idComment" value="<?= $this->clean( $comment['id'] ) ?>"
                            class="button special">Signaler
                    </button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<section class="wrapper style2">
    <div class="inner">
        <?php $this->getFlash() ?>
        <h3>Ajouter un commentaire</h3>

        <form action="post/comment" onSubmit="return actionlimite();" method="post" name="sentComment">
            <div class="control-group">
                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                    <label>Pseudo</label>
                    <input class="form-control" name="author" type="text" placeholder="Votre pseudo" value="">
                    <p class="help-block text-danger"></p>
                </div>
            </div>
            <div class="control-group">
                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                    <label>Votre commentaire</label>
                    <textarea class="form-control" name="content" rows="5"
                              onKeyUp="limite(this);" placeholder="Votre commentaire" required></textarea>
                    <p class="help-block text-danger"></p>
                </div>
            </div>
            <br>
            <div id="success"></div>
            <input type="hidden" name="id" value="<?= $post['id'] ?>"/>
            <div class="form-group">
                <input type="submit" class="button special" value="Ajouter le commentaire"/>
            </div>

        </form>
    </div>
</section>