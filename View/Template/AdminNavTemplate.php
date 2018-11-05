<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="admin" class="site_title"><span>Tableau de Bord</span></a>
                </div>

                <div class="clearfix"></div>

<!-- menu profile quick info -->
<div class="profile clearfix">
    <div class="profile_pic">
        <img src="../Content/img/jf.jpg" alt="..." class="img-circle profile_img">
    </div>
    <div class="profile_info">
        <span>Bienvenue,</span>
        <h2>Jean Forteroche</h2>
    </div>
</div>
<!-- /menu profile quick info -->

<br/>

<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3>Menu</h3>
        <ul class="nav side-menu">
            <li><a><i class="fa fa-home"></i> Accueil <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="Admin">Tableau de Bord</a></li>
                    <li><a href="Home">Retour sur le blog</a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-edit"></i> Gestion Chapitres <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="Admin/writePost">Ecrire un nouveau Chapitre</a></li>
                    <li><a href="Admin/managePost">Gérer un chapitre existant</a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-comments-o"></i> Gestion commentaires <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="Admin/allComments">Lire tous les commentaires</a></li>
                    <li><a href="Admin/reportedComments">Gérer les commentaires signalés</a></li>
                </ul>
            </li>
        </ul>
    </div>

</div>
<!-- /sidebar menu -->

<!-- /menu footer buttons -->
<div class="sidebar-footer hidden-small">
    <a data-toggle="tooltip" data-placement="top" title="Déconnexion" href="Connexion/disconnect">
        <span class="fa fa-sign-out pull" aria-hidden="true"></span>
    </a>
</div>
<!-- /menu footer buttons -->
</div>
</div>

<!-- top navigation -->
<div class="top_nav">
    <div class="nav_menu">
        <nav>
            <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-right">
                <li class="">
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown"
                       aria-expanded="false">
                        <img src="../Content/img/jf.jpg" alt="">Jean Fortercohe
                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                        <li><a href="javascript:"> Profil</a></li>
                        <li><a href="Connexion/disconnect"><i class="fa fa-sign-out pull-right"></i>Déconnexion</a></li>
                    </ul>
                </li>

            </ul>
        </nav>
    </div>
</div>
