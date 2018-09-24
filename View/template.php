<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <base href="<?= $rootWeb ?>">
    <link rel="stylesheet" href="Content/style.css"/>
    <title><?= $title ?></title>
</head>
<body>
<div id="global">
    <header>
        <a href=""><h1 id="titleBlog">Billet simple pour l'Alaska</h1></a>
        <p>Je vous souhaite la bienvenue sur ce blog.</p>
    </header>
    <div id="content">
        <?= $content ?>
    </div> <!-- #contenu -->
    <footer id="footerBlog">
        Blog réalisé avec PHP, HTML5 et CSS.
    </footer>
</div> <!-- #global -->
</body>
</html>