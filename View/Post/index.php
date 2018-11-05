<?php $this->title = "Billet simple pour l'Alaska - " . $this->clean( $post['title'] ); ?>
<section id="banner">
    <header class="masthead bg-primary text-black-50 text-center text" style="background-image : url('../Content/img/home-bg nb gt.jpg');background-repeat: no-repeat;
	background-size: auto;">>
        <div class="inner">
            <h2>Billet Simple pour l'Alaska</h2>
            <hr class="star-light">
            <h3 class="titlePost"><?= $this->clean( $post['title'] ) ?></h3>
        </div>
    </header>
</section>
<!-- Chapitre -->
<article id="main">
    <section class="wrapper style5">
        <div class="inner">
            <?= $this->clean( $post['date'] ) ?><br>

            <h2 class="titlePost"><?= $this->clean( $post['title'] ) ?></h2>
            <br>
            <p><?=  $post['content']  ?></p>
        </div>
    </section>
</article>

<!-- Commentaires -->
<section class="wrapper style2">
    <div id="comment" class="inner">
        <?php $this->getFlash() ?>
        <header id="liste" class="major">
            <h3 id="titleReply">Commentaires des lecteurs : </h3>

            <?php if(!count($comments)) {
                echo '<p>aucun commentaire, soyez le premier !!!</p>';
            }
            ?>
        </header>

<?php foreach ($comments as $comment): ?>
                        <time><?= $this->clean( $comment['date'] ) ?></time>
                        <p><?= $this->clean( $comment['author'] ) ?> dit :</p>
                        <p><?= $this->clean( $comment['content'] ) ?></p>
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

<hr/>
<section class="wrapper style2">
    <div class="inner">

        <h3>Ajouter un commentaire</h3>

        <form action="post/comment" method="post" name="sentComment">
                <div class="control-group">
                    <div class="form-group floating-label-form-group controls mb-0 pb-2">
                        <label>Pseudo</label>
                        <input class="form-control" name="author" type="text"
                               placeholder="Votre pseudo" value="" required minlength="3" maxlength="20">
                        <p class="help-block text-danger"></p>
                    </div>
                </div>
                <div class="control-group">
                    <div class="form-group floating-label-form-group controls mb-0 pb-2">
                        <label>Votre commentaire</label>
                        <textarea class="form-control" name="content" rows="5" minlength="10"
                                  placeholder="Votre commentaire" required></textarea>
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



