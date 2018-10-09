<?php $this->title = "Billet simple pour l'Alaska - Connexion" ?>
    <header class="masthead" style="background-image: url('img/contact-bg.jpg')">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="page-heading">
                        <h3>Administration du site</h3>
                        <span class="subheading">Connectez-vous pour accéder au tableau de bord de votre roman</span>
                    </div>
                    <form action="connexion/connect" method="post"
                          name="sentMessage" id="contactForm" novalidate>
                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls">
                                <input name="login" type="text" placeholder="Nom d'utilisateur" class="validate"
                                       required
                                       autofocus>
                                <label for="username">Nom d'utilisateur</label>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls">
                                <input name="mdp" type="password" placeholder="Mot de passe"
                                       required>
                                <label for="password">Mot de passe</label>
                            </div>
                        </div>
                        <br>
                        <div id="success"></div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" id="sendMessageButton">Se connecter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </header>
<?php if (isset( $msgError )): ?>
    <p><?= $msgError ?></p>
<?php endif; ?>