<!-- 

Le code source de ce site Web à intégralement été rédigé par Minteck de l'équipe de développement Minteck Projects, et nous consentons à faire passer ce message au début du code de chacune des pages de notre site comme une preuve d'authenticité du contenu du site.

moz://a 4 ever

 -->

<?php 

if (isset($_GET['hl'])) {
    $lang = substr($_GET['hl'], 0, 2);
    $acceptLang = ['fr', 'en']; 
    $lang = in_array($lang, $acceptLang) ? $lang : 'en';
} else {
    $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
    $acceptLang = ['fr', 'en']; 
    $lang = in_array($lang, $acceptLang) ? $lang : 'en';
}

// $lang == 'en' ? "English Text" : "Texte en français"

$docroot = $_SERVER['DOCUMENT_ROOT'];
file_put_contents($docroot . "/tools/.htaccess","AuthType Basic\nAuthName \"Password authentication is required to enter Admin area\"\nAuthUserFile " . $docroot . "/.htpasswd\nRequire valid-user");

include_once $_SERVER['DOCUMENT_ROOT'] . "/tools/logIp.php"; logIP()

?>

<!DOCTYPE html5>
<html lang="fr">
<head>
<?php include_once $_SERVER['DOCUMENT_ROOT'] . "/extensions/header-preload.php"; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Minteck Projects pour les particuliers | Accueil | Minteck Projects™</title>
    <link rel="stylesheet" href="/styles/main.css">
    <link rel="icon" href="/images/favicon.ico" />
</head>
<body class="page">
<?php include_once $_SERVER['DOCUMENT_ROOT'] . "/extensions/menu.php"; ?>
    <nav class="menubar" id="menubar"><span class="mb-iframe"><?php include_once $_SERVER['DOCUMENT_ROOT'] . "/extensions/navbar.php"; ?></span></nav>
    <div class="menubutton menubar" id="menubar">
        <a class="image" onclick="pushbar.open('panel-navigation')" title="Menu" class="menulink-button"><img title="Menu" alt="MENU" src="/images/menu.png" height="28px" width="28px" /></a>
        <span class="separator"></span>
        <span class="mobilebar-text" id="mbtxt">minteck-projects://</span>
        <script>
            document.getElementById('mbtxt').innerHTML = "minteck-projects:/" + location.pathname
        </script>
        <img class="mobilebar-image" title="Logo" style="vertical-align: middle;float: right;margin-right: 25px;" alt="Logo Minteck Projects" src="/images/icon.png" height="28px" width="28px" />
    </div>

    <!-- Début du véritable contenu de la page -->


    <div class="escape-nav"></div>
    <?= file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/for-individuals/markup.xhtml") ?>
        
        <br><div class="footer-placeholder"><span class="ft-iframe"><?php include_once $_SERVER['DOCUMENT_ROOT'] . "/extensions/footer.php"; ?></span></div>

        
</body>
</html>