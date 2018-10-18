<?php $this->title = "Billet simple pour l'Alaska - " . $this->clean( $post['title'] ); ?>
<section id="banner">
    <header class="masthead bg-primary text-black-50 text-center text" style="background-image : url('./Content/img/home-bg nb gt.jpg');background-repeat: no-repeat;
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
            <p><?= $this->clean( $post['content'] ) ?></p>
        </div>
    </section>
</article>

<!-- Commentaires -->
<section class="wrapper style2">
    <div class="inner">
        <header id="liste" class="major">
            <h3 id="titleReply">Commentaires des lecteurs sur le <?= $this->clean( $post['title'] ) ?></h3>
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
        <header id="liste" class="major">
            <h3>Ajouter un commentaire</h3>
            <form action="post/comment" method="post" name="sentComment">
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
                                  placeholder="Votre commentaire"></textarea>
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
    </div>

    <script>
        var total = 0;
        var mini = 5;
        var maxi = 200;

        function actionlimite() {
            if (total < mini || total > maxi) {
                alert("Veuillez saisir entre " + mini + " et " + maxi + " caractères !");
                return false;
            }
            else {
                return true;
            }
        }

        function limite(textarea) {
            total = textarea.value.length;
        }
    </script>

