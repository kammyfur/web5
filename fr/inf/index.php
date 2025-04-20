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

?>

<?php 

$docroot = $_SERVER['DOCUMENT_ROOT'];
file_put_contents($docroot . "/tools/.htaccess","AuthType Basic\nAuthName \"Password authentication is required to enter Admin area\"\nAuthUserFile " . $docroot . "/.htpasswd\nRequire valid-user");

include_once $_SERVER['DOCUMENT_ROOT'] . "/tools/logIp.php"; logIP()

?>

<!DOCTYPE html5>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $lang == 'en' ? "About" : "À propos" ?>  •  Minteck Projects™</title>
    <link rel="stylesheet" href="/styles/main.css">
    <link rel="icon" href="/images/favicon.ico" />
</head>
<body class="page">
    <nav class="floating-menu hide" id="menu"><iframe src="/extensions/menu.php?hl=<?= $lang ?>" class="fm-iframe">Votre navigateur n'est (toujours) pas supporté par une ou plusieurs des fonctionnalités que nous utilisons</iframe></nav>
    <nav class="menubar" id="menubar"><iframe src="/extensions/navbar.php?hl=<?= $lang ?>" class="mb-iframe">Votre navigateur n'est (toujours) pas supporté par une ou plusieurs des fonctionnalités que nous utilisons</iframe></nav>
    <div class="menubutton menubar" id="menubar">
        <a onclick="menu()" title="Menu" class="menulink-button"><img title="Menu" alt="MENU" src="/images/menu.png" height="28px" width="28px" /></a>
        <span class="separator"></span>
        <span class="mobilebar-text" id="mbtxt">minteck-projects://</span>
        <script>
            document.getElementById('mbtxt').innerHTML = "minteck-projects:/" + location.pathname
        </script>
        <img class="mobilebar-image" title="Logo" style="vertical-align: middle;float: right;margin-right: 25px;" alt="Logo Minteck Projects" src="/images/icon.png" height="28px" width="28px" />
    </div>

    <!-- Début du véritable contenu de la page -->


    <div class="escape-nav"></div>
    <center><h1 style="font-family:'Zilla Slab Highlight';"><span class="infot">information://</span><span class="tseparator"> </span><a class="editLink" href="/tools/editInformation"><?= $lang == 'en' ? "edit" : "modifier" ?></a></h1></center>
    <?php echo(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/inf/markup.xhtml")); ?>
        
        <!-- Script de démarrage -->
        <script>
    var m_pres_mounted = false;
    var menu_default = true;
        function menu() {
        if (menu_default == true) {
            var x = document.getElementById("menu");
            fadeIn(x);
            document.getElementById("menu").style.display = "block";
            menu_default = false;
        } else {
        var x = document.getElementById("menu");
        if (x.style.display == "none") {
            fadeIn(x);
            document.getElementById("menu").style.display = "block";
        } else {
        fadeOut(x)
        setTimeout(function (x) {
            document.getElementById("menu").style.display = "none";
         }, 500);
        }
        }}
        function fadeIn(el){
  console.log("[mprjWeb.animation.jsHandler] Affichage du menu")
  el.classList.add('show');
  el.classList.remove('hide');  
}

function fadeOut(el){
  console.log("[mprjWeb.animation.jsHandler] Masquage du menu")
  el.classList.add('hide');
  el.classList.remove('show');
}

window.onscroll = function() {
 if(checkVisible(document.getElementById('security'))) {
    sca1();
 } else if (m_pres_mounted) {
     sca2();
 }
};

function sca1() {
    console.log("[mprjWeb.animation.jsHandler] Déclenchement de l'animation 'm-pres-security'")
    document.getElementById('security').classList.add('m-pres-security-animation');
    console.log("[mprjWeb.animation.jsHandler] Déclenchement de l'animation 'm-pres-advertising'")
    document.getElementById('advertising').classList.add('m-pres-advertising-animation');
    console.log("[mprjWeb.animation.jsHandler] Déclenchement de l'animation 'm-pres-freedom'")
    document.getElementById('freedom').classList.add('m-pres-freedom-animation');
    m_pres_mounted = true;
}

function checkVisible(element) {
var ret;
    var h1 = element;
    var bounding = h1.getBoundingClientRect();
    if (
	bounding.top >= 0 &&
	bounding.left >= 0 &&
	bounding.right <= (window.innerWidth || document.documentElement.clientWidth) &&
	bounding.bottom <= (window.innerHeight || document.documentElement.clientHeight)
) {
	ret = true;
} else {
	ret = false;
}
return ret;
}
    </script>

        <!-- Footer -->
        <br><div class="footer-placeholder"><iframe src="/extensions/footer.php" class="ft-iframe">Votre navigateur n'est (toujours) pas supporté par une ou plusieurs des fonctionnalités que nous utilisons</iframe></div>
        <div class="mobile-footer"><?php include_once($_SERVER['DOCUMENT_ROOT'] . "/extensions/mobile.php"); renderFooter() ?></div>

        
</body>
</html>