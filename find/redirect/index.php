<?php

function startsWith ($string, $startString) 
{ 
    $len = strlen($startString); 
    return (substr($string, 0, $len) === $startString); 
} 

if (isset($_GET['redir'])) {
    if (startsWith($_GET['redir'], 'https://') || startsWith($_GET['redir'], 'http://') || startsWith($_GET['redir'], 'ftp://') || startsWith($_GET['redir'], 'ftps://')) {
        echo("<title>Redirection...</title><script>location.href = \"{$_GET['redir']}\";</script>");
    } else {
        echo("<title>Redirection...</title><script>location.href = \"http://{$_GET['redir']}\";</script>");
    }
}