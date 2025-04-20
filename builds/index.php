<?php

$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);

if ($lang == "fr") {
    header("Location: fr");
} else {
    header("Location: en");
}

die();