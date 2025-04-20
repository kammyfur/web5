<?php

if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
    $langsel = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
} else {
    $langsel = "en";
}

if (file_exists("./" . $langsel . ".conf")) {
    $lang = json_decode(file_get_contents("./" . $langsel . ".conf"));
} else {
    $lang = json_decode(file_get_contents("./en.conf"));
}

if (isset($_SERVER['HTTP_USER_AGENT'])) {
    if (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident') !== false) {
        $browser = "Microsoft Internet Explorer";
    }
    if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false) {
        $browser = "Microsoft Internet Explorer";
    }
    if (strpos($_SERVER['HTTP_USER_AGENT'], 'WOW64') !== false) {
        $browser = "Microsoft Internet Explorer";
    }
    if (strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') !== false) {
        $browser = "Google Chrome";
    }
    if (strpos($_SERVER['HTTP_USER_AGENT'], 'Safari') !== false) {
        $browser = "Apple Safari";
    }
    if (strpos($_SERVER['HTTP_USER_AGENT'], 'KHTML') !== false) {
        $browser = "Konqueror/Google Chrome/Safari";
    }
    if (strpos($_SERVER['HTTP_USER_AGENT'], 'MinteckProjectsWebSpace') !== false) {
        $browser = "Minteck Projects WebSpace";
    }
    if (strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') !== false) {
        $browser = "Mozilla Firefox";
    }
    if (strpos($_SERVER['HTTP_USER_AGENT'], 'Edge/1') !== false) {
        $browser = "Microsoft Edge EdgeHTML";
    }
    if (strpos($_SERVER['HTTP_USER_AGENT'], 'AppleWebKit') !== false) {
        $browser = "Apple WebKit/Google Blink";
    }
    if (strpos($_SERVER['HTTP_USER_AGENT'], 'HTTrack') !== false) {
        $browser = "Netscape Navigator";
    }
} else {
    $browser = "?";
}

?>

<!DOCTYPE html>
<html lang="multi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $lang->title ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <center><div class="vertical-center">
        <h2><?= $lang->header ?></h2>
        <p><?= $lang->messages[0][0] ?> (<?= $browser ?>) <?= $lang->messages[0][1] ?></p>
        <p><?= $lang->messages[1] ?></p>
        <p><?= $lang->messages[2] ?></p>
        <p><b>
        <?php
        
        if ($browser == "Google Chrome") {
            echo($lang->warnings->chrome);
        }
        
        if ($browser == "Internet Explorer") {
            echo($lang->warnings->ie);
        }
        
        if ($browser == "Mozilla Firefox") {
            echo($lang->warnings->firefox);
        }
        
        if ($browser == "Konqueror/Google Chrome/Safari") {
            echo($lang->warnings->konqueror . "<br>" . $lang->warnings->chrome . "<br>" . $lang->warnings->safari);
        }
        
        if ($browser == "Apple WebKit/Google Blink") {
            echo($lang->warnings->webkit);
        }
        
        if ($browser == "Apple Safari") {
            echo($lang->warnings->safari);
        }
        
        if ($browser == "Microsoft Edge EdgeHTML") {
            echo($lang->warnings->edge);
        }
        
        if ($browser == "Netscape Navigator") {
            echo($lang->warnings->netscape);
        }
        
        if ($browser == "Minteck Projects WebSpace") {
            echo($lang->warnings->mpapp);
        }
        
        if ($browser == "?") {
            echo($lang->warnings->other);
        }
        
        ?>
        </b></p>
    </div></center>
</body>
</html>