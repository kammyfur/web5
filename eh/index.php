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

<!DOCTYPE html5>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Erreur | Minteck Projects™</title>
    <link rel="stylesheet" href="/styles/main.css">
    <link rel="icon" href="/images/favicon.ico" />
    <?php 

    if (isset($_GET['eid']))
    {
	    $errorId = $_GET['eid'];
    }
        else
    {
	    echo '<script>alert("Mmm... Les informations de l\'erreur ne sont pas valides");location.href = "/"</script>';
    };
    if (isset($_GET['etxt']))
    {
	    $errorDescription = $_GET['etxt'];
    }
        else
    {
	    echo '<script>alert("Mmm... Les informations de l\'erreur ne sont pas valides");location.href = "/"</script>';
    }

    ?>
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

    <div class="main-before"></div>
    <a href="/"><center>
        <p><code class="mcode"><?= $errorId ?>_</code></p>
        <p>Quel dommage, une erreur s'est produite... C'est tout ce que nous savons !</p>
        <p>Si vous êtes curieux, nous savons que c'est une erreur de type <code><?= $errorDescription ?></code>...</p>
    </center></a>

    <!-- Fin du véritable contenu de la page -->
    <!-- Footer -->
    <div class="footer-placeholder"><span class="ft-iframe"><?php include_once $_SERVER['DOCUMENT_ROOT'] . "/extensions/footer.php"; ?></span></div>

</body>
</html>