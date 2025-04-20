<?php

function renderFooter (): void {
    // echo(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/extensions/mobile-footer.xhtml"));
    include_once $_SERVER['DOCUMENT_ROOT'] . "/extensions/mobile-footer.php";
};

?>