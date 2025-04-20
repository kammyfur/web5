<?php

$preload = "";
$found = array();

function endsWith($haystack, $needle)
{
    $length = strlen($needle);
    if ($length == 0) {
        return true;
    }

    return (substr($haystack, -$length) === $needle);
}

if (isset($_GET['q'])) {
    if (trim($_GET['q']) == "") {
        echo("<script>location.href = '..'</script>");
        exit;
    } else {
        $query = $_GET['q'];
        header("Set-Cookie: __last={$query}; Path=/");
        // $res = setcookie("__last", '', time() - 3600);
        // setcookie("__last", $query, null, '/');
    }
} else {
    echo("<script>location.href = '..'</script>");
    exit;
}

function startsWith ($string, $startString) 
{ 
    $len = strlen($startString); 
    return (substr($string, 0, $len) === $startString); 
} 

function searchIntDb(string $query) {
    $wtr = "";
    global $found;
    $db = file_get_contents(getcwd() . "/../crawler.db");
    $sites = explode("\n", $db);
    foreach ($sites as $site) {
        if (trim($site) == "") {} else {
            $pieces = explode("|", $site);
            if ($pieces[0] != "[SKIP!]") {
                $url = $pieces[1];
                $displayName = $pieces[0];
                if (preg_match("/{$query}/i", $pieces[1]) || preg_match("/{$query}/i", $pieces[0])) {
                    if (in_array($site, $found)) {} else {
                        $displayLink = explode("/", str_replace("https://", "", str_replace("http://","",$pieces[1])))[0];
                        $wtr = $wtr . "<a class=\"res_title\" href=\"../redirect/?redir=" . urlencode($url) . "\">" . $displayName . "</a><br><small><span class=\"res_uri\"><span class=\"res_ad\">Index : <code>LO1</code></span> {$displayLink}</span></small><span class=\"res_snip\">";

                        if ($displayName == "Image") {
                            $wtr = $wtr . "<br><a href=\"../redirect/?redir=" . urlencode($url) . "\"><img src=\"{$url}\" height=64px></img></a>";
                        }

                        $wtr = $wtr . "</span><br><br>";
                    }
                }
            }
        }
    }
    return $wtr;
}

function countIntDb(string $query) {
    $cidb = 0;
    global $found;
    $db = file_get_contents(getcwd() . "/../crawler.db");
    $sites = explode("\n", $db);
    foreach ($sites as $site) {
        if (trim($site) == "") {} else {
            $pieces = explode("|", $site);
            if ($pieces[0] != "[SKIP!]") {
                $url = $pieces[1];
                $displayName = $pieces[0];
                if (preg_match("/{$query}/i", $pieces[1]) || preg_match("/{$query}/i", $pieces[0])) {
                    if (in_array($site, $found)) {} else {
                        $cidb = $cidb + 1;
                    }
                }
            }
        }
    }
    return $cidb;
}

function crawlMain($query) {
    return 0;
}

function services($query) {
    if (preg_match("/{$query}/i", "état") || preg_match("/{$query}/i", "server") || preg_match("/{$query}/i", "serveur") || preg_match("/{$query}/i", "etat") || preg_match("/{$query}/i", "ettat") || preg_match("/{$query}/i", "services") || preg_match("/{$query}/i", "service") || preg_match("/{$query}/i", "status") || preg_match("/{$query}/i", "statu")) {
        echo("<div class=\"status\"><span class=\"status_title\">État des services</span><span class=\"status_sep\">I</span>");
        try {
            $json_string = file_get_contents("https://minteck-projects.alwaysdata.net/lib/jsonStatus.php");
            $json = json_decode($json_string);
            $overall = 2;
            foreach ($json->servers as $server) {
                if (endsWith($server, "0")) {
                    $overall = 0;
                }
                if (endsWith($server, "1")) {
                    if ($overall == 0) {} else {
                        $overall = 1;
                    }
                }
            }
            foreach ($json->services as $service) {
                if (endsWith($service, "0")) {
                    $overall = 0;
                }
                if (endsWith($service, "1")) {
                    if (endsWith($service, "1")) {} else {
                        $overall = 1;
                    }
                }
            }
            if ($overall == 0) {
                echo("<a class=\"status_overall_fatal\"></a> Problèmes techniques importants<br>");
            }
            if ($overall == 1) {
                echo("<a class=\"status_overall_medium\"></a> Légers problèmes techniques<br>");
            }
            if ($overall == 2) {
                echo("<a class=\"status_overall_active\"></a> Tout fonctionne correctement<br>");
            }
            echo("<br>");
            echo("<table style=\"width: 100%;\"><tbody><tr><td><b>Serveurs</b></td></tr>");

            $cserver = 0;
            foreach ($json->servers as $server) {
                if (endsWith($server, "2")) {
                    echo("<tr><td class=\"status_active\">" . array_search($server, (array)$json->servers) . "</td></tr>");
                }
                if (endsWith($server, "1")) {
                    echo("<tr><td class=\"status_medium\">" . array_search($server, (array)$json->servers) . "</td></tr>");
                }
                if (endsWith($server, "0")) {
                    echo("<tr><td class=\"status_fatal\">" . array_search($server, (array)$json->servers) . "</td></tr>");
                }
                $cserver = $cserver + 1;
            }

            echo("</tbody></table>");
            echo("<br><table style=\"width: 100%;\"><tbody><tr><td><b>Services</b></td></tr>");

            $cserver = 0;
            foreach ($json->services as $server) {
                if (endsWith($server, "2")) {
                    echo("<tr><td class=\"status_active\">" . array_search($server, (array)$json->services) . "</td></tr>");
                }
                if (endsWith($server, "1")) {
                    echo("<tr><td class=\"status_medium\">" . array_search($server, (array)$json->services) . "</td></tr>");
                }
                if (endsWith($server, "0")) {
                    echo("<tr><td class=\"status_fatal\">" . array_search($server, (array)$json->services) . "</td></tr>");
                }
                if (endsWith($server, "3")) {
                    echo("<tr><td class=\"status_finished\">" . array_search($server, (array)$json->services) . "</td></tr>");
                }
                $cserver = $cserver + 1;
            }

            echo("</tbody></table>");
        } catch (Exception $err) {
            echo("<a class=\"status_overall_fatal\"></a> Impossible de retrouver l'état des services : {$err}");
        }
        echo("</div><br>");
    } else {
        if (preg_match("/(agent)|(user)|(utilisateur)/i", $query)) {
            echo("<div class=\"status\"><span class=\"status_title\">Votre user-agent</span><br>{$_SERVER['HTTP_USER_AGENT']}</div><br>");
        }
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>« <?= $query ?> » - Recherche Minteck Projects</title>
    <link rel="stylesheet" href="../index.css">
    <link rel="shortcut icon" href="../icon.png" type="image/png">
    <script>
function getCookie(cname) {
  var name = cname + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');
  for(var i = 0; i <ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

function validate() {
        if (document.getElementById('searchbox').value.trim() == "") {
            return;
        } else {
            location.href = "../search/?q=" + document.getElementById('searchbox').value.trim();
            return;
        }
    }

    function prevalidate() {
        if (document.getElementById('searchbox').value.trim() == "") {
            document.getElementsByClassName('searchnow')[0].classList.add('disabled');
            return;
        } else {
            document.getElementsByClassName('searchnow')[0].classList.remove('disabled');
            return;
        }
    }
    </script>
</head>
<body>
    <form action="javascript:validate()" class="resultssearch">
        <img class="rs_logo" src="../icon.png" onclick="location.href = '..'" width=36px height=36px>
        <input type="text" onchange="prevalidate()" onkeydown="prevalidate()" onkeypress="prevalidate()" onkeyup="prevalidate()" id="searchbox" name="q" class="searchbox" value="<?= $query ?>" autocomplete="off" placeholder="Rechercher dans Minteck Projects..."><input type="submit" class="searchnow" value="">
    </form>
    <div class="results">
        <!-- <b>Aucun résultat correspondant à votre recherche</b> -->
<?php

if (startsWith($query, ".")) {
    if (trim(str_replace(".", "", $query)) == "") {
        echo("<b>Aucun résultat correspondant à votre recherche</b><br><br>Essayez les actions suivantes : <br><ul><li><a class=\"res_title\" href=\"..\">Retourner à l'accueil de la recherche</a></li><li><a class=\"res_title\" href=\"./?q=Minteck Projects\">Chercher pour \"Minteck Projects\"</a></li></ul>");
        exit;
    } else {
        echo("<b>Aucun résultat correspondant à votre recherche</b><br><br>Essayez les actions suivantes : <br><ul><li><a class=\"res_title\" href=\"./?q=" . str_replace(".", "", $query) . "\">Rechercher en retirant les points superflus</a></li><li><a class=\"res_title\" href=\"./?q=Minteck Projects\">Chercher pour \"Minteck Projects\"</a></li></ul>");
        exit;
    }
}

if (startsWith($query, "?")) {
    if (trim(str_replace("?", "", $query)) == "") {
        echo("<b>Aucun résultat correspondant à votre recherche</b><br><br>Essayez les actions suivantes : <br><ul><li><a class=\"res_title\" href=\"..\">Retourner à l'accueil de la recherche</a></li><li><a class=\"res_title\" href=\"./?q=Minteck Projects\">Chercher pour \"Minteck Projects\"</a></li></ul>");
        exit;
    } else {
        echo("<b>Aucun résultat correspondant à votre recherche</b><br><br>Essayez les actions suivantes : <br><ul><li><a class=\"res_title\" href=\"./?q=" . str_replace("?", "", $query) . "\">Rechercher en retirant les points d'interrogation superflus</a></li><li><a class=\"res_title\" href=\"./?q=Minteck Projects\">Chercher pour \"Minteck Projects\"</a></li></ul>");
        exit;
    }
}

if (startsWith($query, "!")) {
    if (trim(str_replace("!", "", $query)) == "") {
        echo("<b>Aucun résultat correspondant à votre recherche</b><br><br>Essayez les actions suivantes : <br><ul><li><a class=\"res_title\" href=\"..\">Retourner à l'accueil de la recherche</a></li><li><a class=\"res_title\" href=\"./?q=Minteck Projects\">Chercher pour \"Minteck Projects\"</a></li></ul>");
        exit;
    } else {
        echo("<b>Aucun résultat correspondant à votre recherche</b><br><br>Essayez les actions suivantes : <br><ul><li><a class=\"res_title\" href=\"./?q=" . str_replace("!", "", $query) . "\">Rechercher en retirant les points d'exclamation superflus</a></li><li><a class=\"res_title\" href=\"./?q=Minteck Projects\">Chercher pour \"Minteck Projects\"</a></li></ul>");
        exit;
    }
}

if (startsWith($query, "#")) {
    if (trim(str_replace("#", "", $query)) == "") {
        echo("<b>Aucun résultat correspondant à votre recherche</b><br><br>Essayez les actions suivantes : <br><ul><li><a class=\"res_title\" href=\"..\">Retourner à l'accueil de la recherche</a></li><li><a class=\"res_title\" href=\"./?q=Minteck Projects\">Chercher pour \"Minteck Projects\"</a></li></ul>");
        exit;
    } else {
        echo("<b>Aucun résultat correspondant à votre recherche</b><br><br>Essayez les actions suivantes : <br><ul><li><a class=\"res_title\" href=\"./?q=" . str_replace("#", "", $query) . "\">Rechercher en retirant les croisillons superflus</a></li><li><a class=\"res_title\" href=\"./?q=Minteck Projects\">Chercher pour \"Minteck Projects\"</a></li></ul>");
        exit;
    }
}

if (startsWith($query, "@")) {
    if (trim(str_replace("@", "", $query)) == "") {
        echo("<b>Aucun résultat correspondant à votre recherche</b><br><br>Essayez les actions suivantes : <br><ul><li><a class=\"res_title\" href=\"..\">Retourner à l'accueil de la recherche</a></li><li><a class=\"res_title\" href=\"./?q=Minteck Projects\">Chercher pour \"Minteck Projects\"</a></li></ul>");
        exit;
    } else {
        echo("<b>Aucun résultat correspondant à votre recherche</b><br><br>Essayez les actions suivantes : <br><ul><li><a class=\"res_title\" href=\"./?q=" . str_replace("@", "", $query) . "\">Rechercher en retirant les arobases superflus</a></li><li><a class=\"res_title\" href=\"./?q=Minteck Projects\">Chercher pour \"Minteck Projects\"</a></li></ul>");
        exit;
    }
}

set_error_handler(function($errno, $errstr, $errfile, $errline, $errcontext) {
    // error was suppressed with the @-operator
    if (0 === error_reporting()) {
        return false;
    }

    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
});

        try {
            $string = file_get_contents('https://minteck-projects.alwaysdata.net/lib/fetchQuery.php?q=' . urlencode($query));
        $result = json_decode($string, true);
        if (isset($result['items'])) {
            echo("<span class=\"res_time\">" . (trim(count($result['items'])) + (int)trim(crawlMain($query)) + (int)trim(countIntDb($query))) . " résultats en " . substr(str_replace('0.', '', $result['searchInformation']['searchTime']), 0, 3) . " millisecondes</span><br><br>");
            echo(services($query));
        }
        if (isset($result['promotions'])) {
            foreach($result['promotions'] as $item) {
                echo("<a class=\"res_title\" href=\"../redirect/?redir=" . urlencode($item['link']) . "\">" . $item['htmlTitle'] . "</a><br><small><span class=\"res_uri\"><span class=\"res_ad\">Annonce</span> {$item['displayLink']}</span></small><br>");
                foreach($item['bodyLines'] as $line) {
                    echo("<span class=\"res_snip\">{$line['htmlTitle']}<br>");
                }
                echo("</span><br>");
            }
        }
        if (isset($result['items'])) {
            foreach($result['items'] as $item) {
                if ($item['kind'] == "customsearch#result") {
                    echo("<a class=\"res_title\" href=\"../redirect/?redir=" . urlencode($item['link']) . "\">" . $item['htmlTitle'] . "</a><br><small><span class=\"res_uri\"><span class=\"res_ad\">Index : <code>GS0</code></span> {$item['displayLink']}</span></small><br><span class=\"res_snip\">{$item['htmlSnippet']}</span><br><br>");
                    array_push($found, $item['link']);
                }
            }
            if (trim($preload) != "") {
                echo($preload);
            }
            echo(searchIntDb($query));
        } else {
            crawlMain($query);
            echo(services($query));
            if (trim($preload) != "") {
                echo($preload);
            } else {
                if (trim(searchIntDb($query)) != "") {
                    echo(searchIntDb($query));
                } else {
                    echo("<b>Aucun résultat correspondant à votre recherche</b></b><br><br>Essayez les actions suivantes : <br><ul><li><a class=\"res_title\" href=\"..\">Retourner à l'accueil de la recherche</a></li><li><a class=\"res_title\" href=\"./?q=Minteck Projects\">Chercher pour \"Minteck Projects\"</a></li></ul>");
                }
            }
        }
        } catch (Exception $e) {
            crawlMain($query);
            if (trim($preload) != "") {
                echo("<span class=\"res_time\">" . crawlMain($query) . " résultats en quelques millisecondes<br>Un problème technique empèche momentanément le chargement de certains résultats</span><br><br>");
                echo(services($query));
                echo($preload);
                echo(searchIntDb($query));
            } else {
                echo("<span class=\"res_time\">Un problème technique empèche momentanément le chargement de certains résultats</span><br><br>");
                echo(services($query));
                if (trim(searchIntDb($query)) != "") {
                    echo(searchIntDb($query));
                } else {
                    echo("<b>Aucun résultat correspondant à votre recherche</b></b><br><br>Essayez les actions suivantes : <br><ul><li><a class=\"res_title\" href=\"..\">Retourner à l'accueil de la recherche</a></li><li><a class=\"res_title\" href=\"./?q=Minteck Projects\">Chercher pour \"Minteck Projects\"</a></li></ul>");
                }
            }
        }

        // var_dump($found);
        ?>
    </div>
</body>
</html>