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