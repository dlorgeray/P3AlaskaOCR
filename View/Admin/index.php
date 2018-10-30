<?php $this->title = "Billet simple pour l'Alaska - Administration - Accueil " ?>
<div class="right_col" role="main">
    <div class="row top_tiles">

        <a href="admin/managePost">
            <div class="animated flipInY col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-caret-square-o-right"></i></div>
                    <div class="count"><?= $this->clean( $nbPosts ) ?></div>
                    <h3>Chapitres</h3>
                    <p></p>
                </div>
            </div>
        </a>
        <a href="admin/allComments">
            <div class="animated flipInY col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-comments-o"></i></div>
                    <div class="count"><?= $this->clean( $nbComments ) ?></div>
                    <h3>Commentaires</h3>
                    <p></p>
                </div>
                </div>
        </a>
        <a href="Admin/reportedComments"
        <div class="animated flipInY col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-check-square-o"></i></div>
                <div class="count"><?= $this->clean( $nbReports ) ?></div>
                <h3>Commentaires signalés</h3>
                <p></p>
            </div>
        </div>
        </a>
    </div>
</div>

