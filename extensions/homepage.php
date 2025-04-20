<script src="/lib/scroll.js"></script>
<link rel="stylesheet" href="/styles/newhome.css">

<div class="intro-wrapper">
    <div class="intro" data-background-color="#353535" style="height:max-content;">
        <div class="intro-content">
            <div class="intro-mplogo"><img src="/images/icon.png" class="intro-logo"><span class="intro-name">Minteck Projects™</span></div>
            <span class="intro-title">Avec vous aujourd'hui<br>pour les technologies de demain</span>
            <p class="intro-ccount">Laissons le passé derrière nous, évoluons dans le futur !</p>
            <a href="#content" class="intro-button">Continuer ↓</a>
        </div>
    </div><br><br>
</div>
<a id="content"></a><br><br><br>
<!--
    
Avertissement à décommenter avant les périodes de fin d'année (pour prévenir les visiteurs) :
--><!--
<div style="margin-left:-106px;margin-right:-106px;font-size:14px;background-color:#484000;" class="home-warn home-discover"><table><tbody><tr><td><img src="/images/home/warn.svg"></td><td style="font-size:14px"> À compter du 22 décembre (soir GMT+1) et jusqu'au 1er janvier (après-midi GMT+1), en raison des fêtes de fin d'année, l'équipe de développement Minteck Projects suspendera le développement de nos projets. Il n'y aura plus de nouvelles mises à jour ni de support technique qui vous seront proposés durant cette période, sauf en cas d'extrème urgence.</td></tr></tbody></table></div>
-->
<!--

Avertissement à décommenter lors des (= pendant les) périodes de fin d'année (pour prévenir les visiteurs) :
--><!---->
<div style="margin-left:-106px;margin-right:-106px;font-size:14px;background-color:#484000;" class="home-warn home-discover"><table><tbody><tr><td><img src="/images/home/warn.svg"></td><td style="font-size:14px"> Depuis le 22 décembre (soir GMT+1) et jusqu'au 2er janvier (après-midi GMT+1), en raison des fêtes de fin d'année, l'équipe de développement Minteck Projects a suspendu le développement de nos projets. Il n'y a donc plus de nouvelles mises à jour ni de support technique durant cette période, sauf en cas d'extrème urgence.</td></tr></tbody></table></div>
<!---->
<div id="home-providing">
    <img src="/images/icons/home.service.png">
    <b>Minteck Projects fournit des services pour ...</b>
</div>
<div id="home-providers">
    <div class="home-provider" id="home-provider-ind">
        <img class="hlogo" src="/images/icons/home.providers.indi.png"><br>
        <b>... les particuliers</b>
        <br><img class="home-provider-mascot" src="https://cdn-minteck-projects.000webhostapp.com/images/mascot/objects/conference.png"><br>
        <p>Utilisez des services permettant de vous simplifier le quotidien, gratuitement et spécialement pour vous, et tout cela sans changer vos habitudes.</p>
        <a href="/for-individuals" class="intro-button">En savoir plus ↗</a>
    </div>
    <div class="home-provider" id="home-provider-dev">
        <img class="hlogo" src="/images/icons/home.providers.dev.png"><br>
        <b>... les développeurs</b>
        <br><img class="home-provider-mascot" src="https://cdn-minteck-projects.000webhostapp.com/images/mascot/objects/laptop.png"><br>
        <p>Améliorez les services de Minteck Projects selon vos envies pour correspondre le plus à vos besoins et ajouter votre touche personnelle.</p>
        <a href="/for-developers" class="intro-button">En savoir plus ↗</a>
    </div>
    <div class="home-provider" id="home-provider-pro">
        <img class="hlogo" src="/images/icons/home.providers.pro.png"><br>
        <b>... les professionnels</b>
        <br><img class="home-provider-mascot" src="https://cdn-minteck-projects.000webhostapp.com/images/mascot/objects/support.png"><br>
        <p>Intégrez les services de Minteck Projects au sein de votre entreprise pour simplifier votre vie et celle de vos employés et améliorer la productivité.</p>
        <a href="/for-professionals" class="intro-button">En savoir plus ↗</a>
    </div>
</div>
<div id="home-count">
    <img src="/images/icons/home.count.png"> <b>Minteck Projects assure ses services depuis ...</b><br><br>
    <center><table id="home-count-table">
        <tr id="home-count-table-count">
            <?php

            $today = new DateTime();
            $birthday = new DateTime("2013-03-15");

            $interval = $today->diff($birthday);

            if ($interval->y > 9) {
                (string)$iy = $interval->y;
            } else {
                $iy = "0" . $interval->y;
            }
            if ($interval->m > 9) {
                (string)$im = $interval->m;
            } else {
                $im = "0" . $interval->m;
            }
            if ($interval->d > 9) {
                (string)$id = $interval->d;
            } else {
                $id = "0" . $interval->d;
            }

            ?>
            <td><span class="home-count-table-count-cell"><?= $iy ?></span></td>
            <td><span class="home-count-table-count-cell"><?= $im ?></span></td>
            <td><span class="home-count-table-count-cell"><?= $id ?></span></td>
        </tr>
        <tr id="home-count-table-legend">
            <td>A N S</td>
            <td>M O I S</td>
            <td>J O U R <?php
            
            if ($interval->d > 1) {
                echo("S");
            }

            ?></td>
        </tr>
    </table></center>
</div>
<div id="home-requests">
    <img src="/images/icons/home.requests.png"> <b>Rien que depuis que vous venez de charger cette page ...</b><br><br>
    <span id="home-requests-count">000 000 000</span><br>
    <b>requêtes effectuées<sup>1</sup> depuis et vers les serveurs de Minteck Projects</b>
    <script>

    function requestsToPrintable(number) {
        if (number > 999999) {
            return "999 999";
        } else {
            nmbstr = number.toString().padStart(6, "0");
            nmbstr_formatted = nmbstr.charAt(0) + nmbstr.charAt(1) + nmbstr.charAt(2) + " " + nmbstr.charAt(3) + nmbstr.charAt(4) + nmbstr.charAt(5);
            return nmbstr_formatted;
        }
    }

    function reloadRequests() {
        requests = requests + Math.round(Math.random() * 10);
        document.getElementById('home-requests-count').innerHTML = requestsToPrintable(requests);
        setTimeout(reloadRequests, Math.round(Math.random() * 10));
    }

    requests = 0;

    setTimeout(reloadRequests, Math.round(Math.random() * 10));

    </script><br><br>
    <span id="home-requests-files">000 000</span><br>
    <b>modifications de fichiers<sup>1</sup> sur les serveurs de Minteck Projects</b>
    <script>

    function filesToPrintable(number) {
        if (number > 999999) {
            return "999 999";
        } else {
            nmbstr2 = number.toString().padStart(6, "0");
            nmbstr2_formatted = nmbstr2.charAt(0) + nmbstr2.charAt(1) + nmbstr2.charAt(2) + " " + nmbstr2.charAt(3) + nmbstr2.charAt(4) + nmbstr2.charAt(5);
            return nmbstr2_formatted;
        }
    }

    function reloadFiles() {
        files = files + Math.round(Math.random() * Math.random());
        document.getElementById('home-requests-files').innerHTML = filesToPrintable(files);
        setTimeout(reloadFiles, Math.round(Math.random() * Math.random() * (Math.random() * 50)));
    }

    files = 0;

    setTimeout(reloadFiles, Math.round(Math.random() * Math.random() * (Math.random() * 250)));

    </script><br>
    <p><small><sup>1</sup> Nombre calculé automatiquement et donné à titre indicatif. Ce nombre ne peut excéder 999 999.</small></p><br>
</div>
<div id="home-args">
    <div class="home-arg" id="home-arg-security">
        <img class="hlogo" src="/images/icons/home.args.security.png"><br>
        <b>Sécurité</b>
        <!-- <br><img class="home-provider-mascot" src="https://cdn-minteck-projects.000webhostapp.com/images/mascot/objects/conference.png"><br> -->
        <p>Nous vous garantissons la sécurité et la protection de vos données, en utilisant jusqu'au chiffrement AES sur 256 bits et BCrypt pour vous assurer qu'elle ne peuvent être vues que par vous.</p>
        <a href="/terms" class="intro-button">En savoir plus ↗</a>
    </div>
    <div class="home-arg" id="home-arg-reliability">
        <img class="hlogo" src="/images/icons/home.args.reliability.png"><br>
        <b>Fiabilité</b>
        <!-- <br><img class="home-provider-mascot" src="https://cdn-minteck-projects.000webhostapp.com/images/mascot/objects/laptop.png"><br> -->
        <p>Nous promettons que vous pourrez accéder à nos services, 24 heures sur 24 et 7 jours sur 7, avec plus de 99,99% de disponibilité. Et en cas de problème, vous pouvez toujours obtenir des détails.</p>
        <a href="/status/polymer" target="_blank" class="intro-button">En savoir plus ↗</a>
    </div>
    <div class="home-arg" id="home-arg-transparency">
        <img class="hlogo" src="/images/icons/home.args.transparency.png"><br>
        <b>Transparence</b>
        <!-- <br><img class="home-provider-mascot" src="https://cdn-minteck-projects.000webhostapp.com/images/mascot/objects/support.png"><br> -->
        <p>Nous pouvons vous dire ce que nous faisons avec vos données, parce que c'est les vôtres. Ce traitement est détaillé dans différents documents. Sinon, vous pouvez nous envoyer un mail.</p>
        <a href="/privacy" class="intro-button">En savoir plus ↗</a>
    </div>
</div>

<br>
<div class="home-discover" data-background-color="#353535"><img src="/images/icons/home.try.png"> Et si vous regardiez ce qui fonctionne chez nous ?<br><br><a href="/status/polymer" target="_blank" title="Accéder à la page d'état des services">État des services</a></div>

<script src="/home.js"></script>
