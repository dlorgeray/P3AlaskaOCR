<section id="banner">
    <header class="masthead bg-primary text-black-50 text-center text" style="background-image : url('../Content/img/home-bg nb gt.jpg');background-repeat: no-repeat;
	background-size: auto;">>
        <div class="inner">
            <h2>Billet Simple pour l'Alaska</h2>
            <hr class="star-light">
            <h3> Mon nouveau roman </h3>
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
                    <?= $this->truncate( $post['content'] ) ?>
                    <br>
                <ul class="actions">
                    <li>
                        <a href="/Post/index/<?= $this->clean( $post['id'] ) ?>" class="button">Lire la suite</a>
                    </li>
                </ul>
                </p>
            </div>
        <?php endforeach; ?>
    </section>
</article>