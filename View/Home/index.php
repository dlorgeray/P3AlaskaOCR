<?php $this->title = "Billet simple pour l'Alaska"; ?>

<?php foreach ($posts as $post): ?>
    <article>
        <header>
            <a href="<?= "post/index/" . $this->clean( $post['id'] ) ?>">
                <h1 class="titlePost"><?= $this->clean( $post['title'] ) ?></h1>
            </a>
            <time><?= $this->clean( $post['date'] ) ?></time>
        </header>
        <p><?= $this->clean( $post['content'] ) ?></p>
    </article>
    <hr/>
<?php endforeach; ?>