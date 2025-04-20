<!DOCTYPE html>
<html lang='fr'>

    <head>
        <meta charset="UTF-8">
        <title>Minteck Projects : Informations du serveur</title>
        <meta name="description" content="Avec nous, votre vie devient plus facile !">
        <link rel="icon" href="https://lh5.googleusercontent.com/F1tFbZNKTEjxRKLVfgQ35YXCaI3BY9DktFc8Qh0lam1JwfhCj6pBMCAAT9eMdS0kdybvdkIkMpUED9fopqS1xFvI8cfiZFru">
        <link rel="stylesheet" href="/fr/styles.css">
    </head>

    <body>
        <header class="header">
            <h1>
                <img src="/fr/rsc/large-icon.png" width="95" height="37">
                Informations du serveur
            </h1>
            <iframe class="menu" title="Navigation du site" width="100%" height="59.2" frameBorder="0" src="/fr/components/main/nav.html">Votre navigateur n'est pas compatible avec une des fonctionnalités de nous utilisons</iframe>
            <div class='banner'><img src="/fr/rsc/top-banner.jpg" width="100%" height="100%"></div>
        </header>
        <article class="main">
            <iframe class="menu2" title="Navigation du composant" width="100%" height="59.2" frameBorder="0" src="/fr/components/info/nav.html">Votre navigateur n'est pas compatible avec une des fonctionnalités de nous utilisons</iframe>
            <p>
                <b><u>Informations à propos du serveur :</b></u><br>
                <?php 
                phpinfo()
                ?>
            </p>
        </article>
        <iframe class="pagefoot" title="Pied de page" width="100%" height="130" frameBorder="0" src="/fr/components/main/footer.html">Votre navigateur n'est pas compatible avec une des fonctionnalités de nous utilisons</iframe>
    </body>

</html>