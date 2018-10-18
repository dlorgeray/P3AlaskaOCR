<?php $this->title = "Billet simple pour l'Alaska - Administration - Modification d'un chapitre " ?>
<div class="right_col" role="main">

    <h2>Administration - Modification d'un chapitre</h2>

    <div class="col-md-12">
            <header>
                <h3>Modifier chapitre</h3>
            </header>
            <form action="<?= 'admin/savePost/' . $this->clean( $post['id'] ) ?>" method="post">
                <div class="form-group">
                    <label for="title">Votre titre</label>
                    <input type="text" class="form-control" name="title" id="title"
                           value="<?= $this->clean( $post['title'] ) ?>"/>
                </div>
                <div class="form-group">
                    <label for="content">Votre texte</label><br>
                    <textarea rows="3" class="admin-editor" id="content"
                              name="content"/><?= $this->clean( $post['content'] ) ?></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Sauvegarder</button>
                </div>
            </form>
        </div>


    <div class="col-md-12">
        <span style="color: #bfbfbf; font-size: 1rem; font-weight: 400;">Aperçu du Chapitre</span>
        </div>
    <div class="col-md-12">
            <h3><?= $this->clean( $post['title'] ) ?></h3>
            <time>Crée le : <?= $this->clean( $post['date'] ) ?></time>
            <p><?= $post['content'] ?></p>
        </div>
</div>