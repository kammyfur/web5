<div class="home-content-wrapper">
    <div class="intro">
        <div class="intro-mplogo"><img src="/images/icon.png" class="intro-logo"><span class="intro-name">Minteck Projects™</span></div>
        <span class="intro-title">Des services sur lesquels<br>vous pouvez compter</span>
        <p class="intro-ccount">Découvrez nos projets respectueux de la vie privée</p>
        <a href="/prod/intro" class="intro-button">Voir la liste</a>
    </div><br><br>
    <!--
    
    Avertissement à décommenter avant les périodes de fin d'année (pour prévenir les visiteurs) :
    --><!--
    <div style="margin-left:-106px;margin-right:-106px;font-size:14px;background-color:#484000;" class="home-warn home-discover"><table><tbody><tr><td><img src="/images/home/warn.svg"></td><td style="font-size:14px"> À compter du 22 décembre (soir GMT+1) et jusqu'au 1er janvier (après-midi GMT+1), en raison des fêtes de fin d'année, l'équipe de développement Minteck Projects suspendera le développement de nos projets. Il n'y aura plus de nouvelles mises à jour ni de support technique qui vous seront proposés durant cette période, sauf en cas d'extrème urgence.</td></tr></tbody></table></div>
    -->
    <!--
    
    Avertissement à décommenter lors des (= pendant les) périodes de fin d'année (pour prévenir les visiteurs) :
    --><!--
    <div style="margin-left:-106px;margin-right:-106px;font-size:14px;background-color:#484000;" class="home-warn home-discover"><table><tbody><tr><td><img src="/images/home/warn.svg"></td><td style="font-size:14px"> Depuis le 22 décembre (soir GMT+1) et jusqu'au 1er janvier (après-midi GMT+1), en raison des fêtes de fin d'année, l'équipe de développement Minteck Projects a suspendu le développement de nos projets. Il n'y a donc plus de nouvelles mises à jour ni de support technique durant cette période, sauf en cas d'extrème urgence.</td></tr></tbody></table></div>
    -->
    <br><br><br>
    <div class="home-grid">
        <a class="home-grid-link" href="/privacy">
            <div class="home-grid-element">
                <span style="background-image:url('/images/home/privacy.png" class="home-gel-up"></span>
                <span class="home-gel-down">
                    <small>Vie privée</small>
                    <p class="home-gel-dtitle">Ne vous laissez pas avoir</p>
                    <p>Beaucoup de géants du Web violent votre vie privée et revendent vos données personnelles, mais pas nous !</p>
                </span>
            </div>
        </a>
        <a class="home-grid-link" href="/aboutai">
            <div class="home-grid-element">
                <span style="background-image:url('/images/home/ai.jpg" class="home-gel-up"></span>
                <span class="home-gel-down">
                    <small>Nouvelles technologies</small>
                    <p class="home-gel-dtitle">Intelligence artificielle</p>
                    <p>Minteck Projects tire intelligemment profit des technologies d'intelligence artificielle pour beaucoup de ses services.</p>
                </span>
            </div>
        </a>
    </div><br><br>
    <div class="home-feature">
        <div class="hf-image">
            <img src="/images/home/power.png">
        </div>
        <div class="hf-text">
            <p class="home-gel-dtitle">À votre service depuis 2013</p>
            <p>Depuis maintenant <?php
            
            $years = (int)date('Y') - 2013;
            $month = (int)date('m');
            if ($month < 3) {
                $years = $years - 1;
                $months = 12 - $month;
            } else {
                $months = $month - 3;
            }
            echo($years . " ans et " . $months . " mois");
            
            ?>, nous plaçons les gens avant l'argent, en créant des services permettant un Internet plus sain chaque jour.</p>
            <p><a href="/inf">En apprendre plus sur nous</a></p>
        </div>
    </div><br><br>
    <div class="home-grid">
        <a class="home-grid-link" href="/story">
            <div class="home-grid-element">
                <span style="background-image:url('/images/home/promise.jpg" class="home-gel-up"></span>
                <span class="home-gel-down">
                    <small>Notre histoire</small>
                    <p class="home-gel-dtitle">Toujours à votre service</p>
                    <p>Nous vous garantissons un temps de disponibilité (up-time) de plus de 90%, ainsi qu'une rapidité et une facilité d'accès accrue. Et avec la page d'état des services, vous voyez en un coup d'œil les services qui rencontrent des problèmes.</p>
                </span>
            </div>
        </a>
        <a class="home-grid-link" href="/terms">
            <div class="home-grid-element">
                <span style="background-image:url('/images/home/security.jpg" class="home-gel-up"></span>
                <span class="home-gel-down">
                    <small>Conditions d'utilisation</small>
                    <p class="home-gel-dtitle">N'ayez plus peur de votre sécurité</p>
                    <p>Vous utilisez nos services, et on s'occupe de votre sécurité. Vous n'avez plus à vous soucier du fait que vous données personnelles soient en sécurité avec nous, car elles le seront toujours ! Le chiffrement AES 256 bits permet aussi une meilleure sécurité.</p>
                </span>
            </div>
        </a>
    </div><br><br>
    <div class="home-feature">
        <div class="hf-text">
            <p class="home-gel-dtitle">Pour un Internet plus sain et plus ouvert</p>
            <p>Internet est un univers trop renfermé sur lui-même, et les géants du Web nous cachent trop de choses. Nous soutenons un Internet libre, ouvert, et plus sain pour tous.</p>
            <p><a href="https://gitlab.com/minteck-projects/">Voir le code source de nos projets</a></p>
        </div>
        <div class="hf-image" style="text-align: left;">
            <img src="/images/home/opensource.png">
        </div>
    </div><br><br>
</div>
<br>
<div class="home-discover"><img src="/images/projects/try.svg"> Et si vous regardiez ce qui fonctionne chez nous ?<br><br><a href="/status" title="Accéder à la page d'état des services">État des services</a></div>