<center><img src="/images/icon.png" class="newfooter-logo"><span class="newfooter-name">Minteck Projects™</span></center>

<div class="images">
    <center><table id="footer-images-table">
        <tbody>
            <tr>
                <td class="footer-images-table-left">Ils nous soutiennent depuis toujours : </td>
                <td class="footer-images-table-right">
                    <a class="image partner" target="_blank" href="https://kde.org/" title="KDE"><img class="footer-img" style="vertical-align:middle;opacity:0.75;" src="/images/partners/kde.svg" alt="KDE" height=36px /></a>
                    <a class="image partner" target="_blank" href="https://ubports.com/fr_FR/" title="UBports"><img class="footer-img" style="vertical-align:middle;" src="/images/partners/ubports.png" alt="ubports" height=36px /></a>
                    <a class="image partner" target="_blank" href="https://mozilla.org/fr" title="Mozilla"><img class="footer-img" style="vertical-align:middle;" src="/images/partners/mozilla.png" alt="moz://a" height=28px /></a>
                    <a class="image partner" target="_blank" href="https://canonical.com" title="Canonical"><img class="footer-img" style="vertical-align:middle;" src="/images/partners/canonical.png" alt="canOnical" height=16px /></a>
                </td>
            </tr>
        </tbody>
    </table>
    <hr style="border-top:none;">
    <table id="footer-images-table">
        <tbody>
            <tr>
                <td class="footer-images-table-left">Ils nous ont parlés : </td>
                <td class="footer-images-table-right">
                    <a class="image partner" target="_blank" href="https://canonical.com" title="Canonical"><img class="footer-img" style="vertical-align:middle;" src="/images/partners/canonical.png" alt="canOnical" height=16px /></a>
                    <a class="image partner" target="_blank" href="https://kde.org/" title="KDE"><img class="footer-img" style="vertical-align:middle;opacity:0.75;" src="/images/partners/kde.svg" alt="KDE" height=36px /></a>
                    <a class="image partner" target="_blank" href="https://ubports.com/fr_FR/" title="UBports"><img class="footer-img" style="vertical-align:middle;" src="/images/partners/ubports.png" alt="ubports" height=36px /></a>
                    <a class="image partner" target="_blank" href="https://microsoft.com/" title="Microsoft"><img class="footer-img" style="vertical-align:middle;" src="/images/talkers/microsoft.png" alt="Microsoft" height=36px /></a>
                    <a class="image partner" target="_blank" href="https://tysontan.com/" title="Tyson Tan"><img class="footer-img" style="vertical-align:middle;" src="/images/talkers/tysontan.jpg" alt="Tyson Tan" height=36px /></a>
                </td>
            </tr>
        </tbody>
    </table></center>
    <details>
        <summary style="cursor:default;">Informations juridiques</summary>
        <p><center><i>Si vous êtes une personne représentant une des entitées citées ci-dessus et que vous pensez que l'utilisation de votre marque ne respecte pas vos conditions, vous pouvez <a href="mailto:minteck.projects+legal@gmail.com">nous envoyer un mail</a> avant toute procédure judiciaire, nous nous ferons un plaisir de vous répondre dans les plus brefs délais, merci !</i></center></p>
        <p><center><i>Tout abus et/ou usurpation d'identité sera puni.</i></center></p>
    </details>
</div>
<br>
<?= file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/extensions/navigation.html") ?><br>
<div class="rights">
                 Europe : Tous droits reservés à Minteck Projects<br>
                 Autres : © 2013-<?= date('Y') ?> Minteck Projects, Tous droits reservés<br><br>
                 Reproduction interdite<br>
                 Minteck Projects™, le logo Minteck Projects (y compris toutes les versions précédentes), et tout autre nom associé sont des marques de Minteck Projects en France et dans d'autres pays.
    </div><br>
    <!-- <small><p><ul><li><a onclick="window.scrollTo({ top: 0, behavior: 'smooth' });">Retourner en haut de la page</a></li><li><a href="/tools">Administration du site</a></li></ul></p></small> -->
    <div id="footeroptions">
        <a href="/tools"><div class="footeroption"><center>
            <img src="/images/icons/footer.admin.png">
        </center></div></a>
        <a onclick="window.scrollTo({ top: 0, behavior: 'smooth' });"><div class="footeroption"><center>
            <img src="/images/icons/footer.top.png">
        </center></div></a>
    </div>

<!-- ************************************** -->

<style>html{overflow-x:hidden;}</style>
<script>

function menu() {
    pushbar.open("panel-navigation");
}
</script>

<!-- ************************************** -->

<script src="/pushbar.js/library.js"></script>
<link rel="stylesheet" href="/pushbar.js/library.css">
<script type="text/javascript">var pushbar = new Pushbar({blur:true,overlay:true,});</script>

<!-- ************************************** -->

    <script src="/lib/jquery.js"></script>
    <script>

    function changePage(page) {
        document.getElementById('loadingbar').classList.remove('loader-hide')
        location.href = page;
    }

    function newWin(page) {
        window.open(page,'','width=,height=,resizable=yes,toolbars=no,scrollbars=yes');
    }

    </script>

<!-- ************************************** -->

<script src="https://cdn-minteck-projects.000webhostapp.com/script/js/smooth-scroll.js"></script>
<?php include_once $_SERVER['DOCUMENT_ROOT'] . "/mprj-sync/everywhere.php"; ?>

<!-- ************************************** -->

<?php
echo("<!-- " . date("dm") . " -->");

if (date("dm") == "1503" || isset($_GET['birthday'])) {
    echo('<link rel="stylesheet" href="/styles/birthday.css">');
}

?>
</span></div><div id="snowapi-placeholder"><div snowapi-enable-snowfall></div></div><span><div>