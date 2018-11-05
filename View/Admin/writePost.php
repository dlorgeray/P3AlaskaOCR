<?php $this->title = "Billet simple pour l'Alaska - Administration - Accueil " ?>

<div class="right_col" role="main">
    <h3>Écrire un nouveau chapitre</h3>

    <form action="admin/writingPost" method="post">
        <div class="form-group">
            <input class="form-control" id="new_title" name="new_title" type="text"
                   placeholder="Titre du chapitre" required/>
        </div>
        <div class="form-group">
                    <textarea class="admin-editor" id="new_content" name="new_content" rows="4"
                              placeholder="Votre texte"></textarea>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Sauvegarder</button>
        </div>
    </form>
</div>
