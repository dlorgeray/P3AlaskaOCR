<?php $this->title = "Billet simple pour l'Alaska"; ?>
<div class="post-preview">
    <?php foreach ($posts as $post): ?>
        <a href="<?= "post/index/" . $this->clean( $post['id'] ) ?>">
            <h4 class="post-title"><?= $this->clean( $post['title'] ) ?></h4>
        </a>
        <div class="post-preview">
            <p><em><?= $this->clean( $post['content'] ) ?></em></p>
        </div>
        <div class="list-inline-item">
            <div>
                <strong>Jean Forteroche</strong>
                <span><time><?= $this->clean( $post['date'] ) ?></time></span>
            </div>
        </div>
        <hr/>
    <?php endforeach; ?>
</div>
