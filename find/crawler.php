<?php

(PHP_SAPI !== 'cli' || isset($_SERVER['HTTP_USER_AGENT'])) && die("Crawler can't work via HTTP protocol, you may run it via PHP command line.\n");

function startsWith ($string, $startString) { 
    $len = strlen($startString); 
    return (substr($string, 0, $len) === $startString); 
}

function endsWith($haystack, $needle) {
    $length = strlen($needle);
    if ($length == 0) {
        return true;
    }

    return (substr($haystack, -$length) === $needle);
}

function crawl(string $website) {
    global $wsroot;
    global $wsargs;
    $fst = false;
    $url = $wsroot . $wsargs;
    $html= file_get_contents($url);
    $html = strip_tags($html, '<title><a>');
    // echo($html);
    // exit;
    //$html = $html . "</html>";
    $dom = new DOMDocument();
    @$dom->loadHTML('<?xml encoding="utf-8" ?>' . $html);
    $xPath = new DOMXPath($dom);
    $elements = $xPath->query("//a/@href");
    try {
        $result = $xPath->query('//title')->item(0)->textContent;
    } catch (Notice $err) {
        $result = "Minteck Projects CMS";
    }
    foreach($elements as $e) {
        if (strpos(file_get_contents(getcwd() . "/crawler.db"), $e->value) !== false) {
            return;
        }
        if (startsWith($e->value, "http") || startsWith($e->value, "/tools")) {} else {
            $url = $wsroot . $e->value . $wsargs;
            $html= file_get_contents($url);
            $html = strip_tags($html, '<title><a>');
            //$html = $html . "</html>";
            $dom = new DOMDocument();
            @$dom->loadHTML('<?xml encoding="utf-8" ?>' . $html);
            $x=new DOMXPath($dom);
            $result = $x->query('//title')->item(0)->textContent;
            if (strpos($e->value, "Mes_") !== false) {
                echo "\e[0;32m[verbose] {$wsroot}{$e->value} contains personnal info, skipping entry \e[0m\n";
                file_put_contents(getcwd() . "/crawler.db", file_get_contents(getcwd() . "/crawler.db") . "\n" . "[SKIP!]|" . $wsroot . $e->value);
            } else {
                echo "\e[0;32m[verbose] Adding entry for {$wsroot}{$e->value} \e[0m\n";
                file_put_contents(getcwd() . "/crawler.db", file_get_contents(getcwd() . "/crawler.db") . "\n" . $result . "|" . $wsroot . $e->value);
                echo "\e[1;33m[success] Added 1 entry to database (crawler.db)\e[0m\n"; 
            }
            echo "\e[0;32m[verbose] Crawling {$wsroot}{$e->value} \e[0m\n";
            crawl("{$wsroot}{$e->value}");
            echo "\e[1;33m[success] Crawled {$wsroot}{$e->value}\e[0m\n"; 
        }
    }
    return true;
}

function shutdown() { 
     $a = error_get_last(); 
     if ($a == null)   
            echo "\e[1;33m[success] No errors occured while running script\e[0m\n"; 
     else 
            echo "\e[0;35m[warning] Errors are occured while running script\e[0m\n"; 

} 
register_shutdown_function('shutdown'); 

try {
    echo "\e[0;32m[verbose] Loaded Minteck Projects Search crawler...\e[0m\n";
    set_time_limit(80);
    echo "\e[0;32m[verbose] Maximum runtime execution time is 1 min, 30 sec\e[0m\n";
    echo "\e[0;32m[verbose] Reset prevent DB\e[0m\n";
    //file_put_contents(getcwd() . "/crawler.db", "");
    try {
        echo "\e[0;32m[verbose] Crawling https://mpdn.alwaysdata.net/ \e[0m\n";
        $url = "https://mpdn.alwaysdata.net/";
        $html= file_get_contents($url);
        $html = strip_tags($html, '<title><a>');
        $dom = new DOMDocument();
        @$dom->loadHTML('<?xml encoding="utf-8" ?>' . $html);
        $xPath = new DOMXPath($dom);
        $elements = $xPath->query("//a/@href");
        $result = $xPath->query('//title')->item(0)->textContent;
        echo "\e[0;32m[verbose] Entry skipped for {$url} \e[0m\n";
        $subname = "MPDN";
        if (isset($result)) {
            if (trim($result) == "") {
                $result = $subname;
            }
        } else {
            $result = $subname;
        }
        global $wsroot;
        global $wsargs;
        $wsroot = "https://mpdn.alwaysdata.net";
        $wsargs = "";
        crawl("https://mpdn.alwaysdata.net");
        echo "\e[1;33m[success] Crawled {$url}\e[0m\n"; 
    } catch (Exception $err) {
        echo "\e[0;31m[error] Failed to crawl website, skipping website: {$err}\e[0m\n";    
    }
    try {
        echo "\e[0;32m[verbose] Crawling https://projectpedia.alwaysdata.net/ \e[0m\n";
        $url = "https://projectpedia.alwaysdata.net/";
        $html= file_get_contents($url);
        $html = strip_tags($html, '<title><a>');
        $dom = new DOMDocument();
        @$dom->loadHTML('<?xml encoding="utf-8" ?>' . $html);
        $xPath = new DOMXPath($dom);
        $elements = $xPath->query("//a/@href");
        $result = $xPath->query('//title')->item(0)->textContent;
        echo "\e[0;32m[verbose] Entry skipped for {$url} \e[0m\n";
        $subname = "MPDN";
        if (isset($result)) {
            if (trim($result) == "") {
                $result = $subname;
            }
        } else {
            $result = $subname;
        }
        global $wsroot;
        global $wsargs;
        $wsroot = "https://projectpedia.alwaysdata.net";
        $wsargs = "";
        crawl("https://projectpedia.alwaysdata.net");
        echo "\e[1;33m[success] Crawled {$url}\e[0m\n"; 
    } catch (Exception $err) {
        echo "\e[0;31m[error] Failed to crawl website, skipping website: {$err}\e[0m\n";    
    }
    echo "\e[0;32m[verbose] Adding entry for http://mpcms.rf.gd \e[0m\n";
        file_put_contents(getcwd() . "/crawler.db", file_get_contents(getcwd() . "/crawler.db") . "\n" . "Minteck Projects CMS" . "|" . "http://mpcms.rf.gd");
        echo "\e[1;33m[success] Added 1 entry to database (crawler.db)\e[0m\n"; 
    try {
        echo "\e[0;32m[verbose] Crawling http://mpcms.rf.gd \e[0m\n";
        $url = "http://mpcms.rf.gd";
        $html= file_get_contents($url);
        $html = strip_tags($html, '<title><a>');
        $dom = new DOMDocument();
        @$dom->loadHTML('<?xml encoding="utf-8" ?>' . $html);
        $xPath = new DOMXPath($dom);
        $elements = $xPath->query("//a/@href");
        $result = $xPath->query('//title')->item(0)->textContent;
        echo "\e[0;32m[verbose] Entry skipped for {$url} \e[0m\n";
        $subname = "Minteck Projects CMS";
        // echo "\e[0;32m[verbose] Adding entry for http://mpcms.rf.gd \e[0m\n";
        // file_put_contents(getcwd() . "/crawler.db", file_get_contents(getcwd() . "/crawler.db") . "\n" . "Minteck Projects CMS" . "|" . "http://mpcms.rf.gd");
        // echo "\e[1;33m[success] Added 1 entry to database (crawler.db)\e[0m\n"; 
        if (isset($result)) {
            if (trim($result) == "") {
                $result = $subname;
            }
        } else {
            $result = $subname;
        }
        global $wsroot;
        global $wsargs;
        $wsroot = "http://mpcms.rf.gd";
        $wsargs = "";
        crawl("http://mpcms.rf.gd");
        echo "\e[1;33m[success] Crawled {$url}\e[0m\n"; 
    } catch (Exception $err) {
        echo "\e[0;31m[error] Failed to crawl website, skipping website: {$err}\e[0m\n";    
    }
    try {
        echo "\e[0;32m[verbose] Crawling https://minteck-projects.alwaysdata.net/ \e[0m\n";
        $url = "https://minteck-projects.alwaysdata.net";
        $html= file_get_contents($url . "/?hl=fr");
        $html = strip_tags($html, '<title><a>');
        $dom = new DOMDocument();
        @$dom->loadHTML('<?xml encoding="utf-8" ?>' . $html);
        $xPath = new DOMXPath($dom);
        $elements = $xPath->query("//a/@href");
        $result = $xPath->query('//title')->item(0)->textContent;
        echo "\e[0;32m[verbose] Adding entry for {$url} \e[0m\n";
        $subname = "Minteck Projects";
        if (isset($result)) {
            if (trim($result) == "") {
                $result = $subname;
            }
        } else {
            $result = $subname;
        }
        file_put_contents(getcwd() . "/crawler.db", $result . "|" . $url);
        echo "\e[1;33m[success] Added 1 entry to database (crawler.db)\e[0m\n"; 
        global $wsroot;
        global $wsargs;
        $wsroot = "https://minteck-projects.alwaysdata.net";
        $wsargs = "/?hl=fr";
        crawl("https://minteck-projects.alwaysdata.net");
        echo "\e[1;33m[success] Crawled {$url}\e[0m\n"; 

        echo "\e[0;32m[verbose] Crawling https://minteck-projects.alwaysdata.net/inf \e[0m\n";
        $url = "https://minteck-projects.alwaysdata.net/inf";
        $html= file_get_contents($url . "/?hl=fr");
        $html = strip_tags($html, '<title><a>');
        $dom = new DOMDocument();
        @$dom->loadHTML('<?xml encoding="utf-8" ?>' . $html);
        $xPath = new DOMXPath($dom);
        $elements = $xPath->query("//a/@href");
        $result = $xPath->query('//title')->item(0)->textContent;
        echo "\e[0;32m[verbose] Adding entry for {$url} \e[0m\n";
        $subname = "À propos de Minteck Projects";
        if (isset($result)) {
            if (trim($result) == "") {
                $result = $subname;
            }
        } else {
            $result = $subname;
        }
        file_put_contents(getcwd() . "/crawler.db", file_get_contents(getcwd() . "/crawler.db") . "\n" . $result . "|" . $url);
        global $wsroot;
        global $wsargs;
        $wsroot = "https://minteck-projects.alwaysdata.net";
        $wsargs = "/?hl=fr";
        global $wsroot;
    global $wsargs;
    $fst = false;
    $url = "https://minteck-projects.alwaysdata.net/inf/?lang=fr";
    $html= file_get_contents($url);
    $html = strip_tags($html, '<title><a>');
    $dom = new DOMDocument();
    @$dom->loadHTML('<?xml encoding="utf-8" ?>' . $html);
    $xPath = new DOMXPath($dom);
    $elements = $xPath->query("//a/@href");
    $result = $xPath->query('//title')->item(0)->textContent;
    foreach($elements as $e) {
        if (strpos(file_get_contents(getcwd() . "/crawler.db"), $e->value) !== false) {
            return;
        }
        if (startsWith($e->value, "http") || startsWith($e->value, "/tools")) {} else {
            $url = $wsroot . $e->value . $wsargs;
            $html= file_get_contents($url);
            $html = strip_tags($html, '<title><a>');
            //$html = $html . "</html>";
            $dom = new DOMDocument();
            @$dom->loadHTML('<?xml encoding="utf-8" ?>' . $html);
            $x=new DOMXPath($dom);
            $result = $x->query('//title')->item(0)->textContent;
            if (strpos($e->value, "Mes_") !== false) {
                echo "\e[0;32m[verbose] {$wsroot}{$e->value} contains personnal info, skipping entry \e[0m\n";
                file_put_contents(getcwd() . "/crawler.db", file_get_contents(getcwd() . "/crawler.db") . "\n" . "[SKIP!]|" . $wsroot . $e->value);
            } else {
                echo "\e[0;32m[verbose] Adding entry for {$wsroot}{$e->value} \e[0m\n";
                file_put_contents(getcwd() . "/crawler.db", file_get_contents(getcwd() . "/crawler.db") . "\n" . $result . "|" . $wsroot . $e->value);
                echo "\e[1;33m[success] Added 1 entry to database (crawler.db)\e[0m\n"; 
            }
        }
    }
    echo "\e[1;33m[success] Crawled https://minteck-projects.alwaysdata.net/inf\e[0m\n"; 

    echo "\e[0;32m[verbose] Crawling https://minteck-projects.alwaysdata.net/branding \e[0m\n";
    $url = "https://minteck-projects.alwaysdata.net/branding";
    $html= file_get_contents($url . "/?hl=fr");
    $html = strip_tags($html, '<title><a>');
    $dom = new DOMDocument();
    @$dom->loadHTML('<?xml encoding="utf-8" ?>' . $html);
    $xPath = new DOMXPath($dom);
    $elements = $xPath->query("//a/@href");
    $result = $xPath->query('//title')->item(0)->textContent;
    echo "\e[0;32m[verbose] Adding entry for {$url} \e[0m\n";
    $subname = "Utilisation de la marque Minteck Projects";
    if (isset($result)) {
        if (trim($result) == "") {
            $result = $subname;
        }
    } else {
        $result = $subname;
    }
    file_put_contents(getcwd() . "/crawler.db", file_get_contents(getcwd() . "/crawler.db") . "\n" . $result . "|" . $url);
    global $wsroot;
    global $wsargs;
    $wsroot = "https://minteck-projects.alwaysdata.net";
    $wsargs = "/?hl=fr";
    global $wsroot;
global $wsargs;
$fst = false;
$url = "https://minteck-projects.alwaysdata.net/branding/?lang=fr";
$html= file_get_contents($url);
$html = strip_tags($html, '<title><a>');
$dom = new DOMDocument();
@$dom->loadHTML('<?xml encoding="utf-8" ?>' . $html);
$xPath = new DOMXPath($dom);
$elements = $xPath->query("//a/@href");
$result = $xPath->query('//title')->item(0)->textContent;
foreach($elements as $e) {
    if (strpos(file_get_contents(getcwd() . "/crawler.db"), $e->value) !== false) {
        return;
    }
    if (startsWith($e->value, "http") || startsWith($e->value, "/tools")) {
        if (endsWith($e->value, ".png")) {
            echo "\e[0;32m[verbose] Adding entry for {$e->value} \e[0m\n";
            file_put_contents(getcwd() . "/crawler.db", file_get_contents(getcwd() . "/crawler.db") . "\n" . "Image|" . $e->value);
            echo "\e[1;33m[success] Added 1 entry to database (crawler.db)\e[0m\n"; 
        }
    } else {
        if (endsWith($e->value, ".png")) {
            echo "\e[0;32m[verbose] Adding entry for {$wsroot} \e[0m\n";
            file_put_contents(getcwd() . "/crawler.db", file_get_contents(getcwd() . "/crawler.db") . "\n" . "Image|" . $wsroot . $e->value);
            echo "\e[1;33m[success] Added 1 entry to database (crawler.db)\e[0m\n"; 
        } else {
            $url = $wsroot . $e->value . $wsargs;
            $html= file_get_contents($url);
            $html = strip_tags($html, '<title><a>');
            $dom = new DOMDocument();
            @$dom->loadHTML('<?xml encoding="utf-8" ?>' . $html);
            $x=new DOMXPath($dom);
            $result = $x->query('//title')->item(0)->textContent;
            if (strpos($e->value, "Mes_") !== false) {
                echo "\e[0;32m[verbose] {$wsroot}{$e->value} contains personnal info, skipping entry \e[0m\n";
                file_put_contents(getcwd() . "/crawler.db", file_get_contents(getcwd() . "/crawler.db") . "\n" . "[SKIP!]|" . $wsroot . $e->value);
            } else {
                echo "\e[0;32m[verbose] Adding entry for {$wsroot}{$e->value} \e[0m\n";
                file_put_contents(getcwd() . "/crawler.db", file_get_contents(getcwd() . "/crawler.db") . "\n" . $result . "|" . $wsroot . $e->value);
                echo "\e[1;33m[success] Added 1 entry to database (crawler.db)\e[0m\n"; 
            }
        }
    }
}
echo "\e[1;33m[success] Crawled https://minteck-projects.alwaysdata.net/branding\e[0m\n"; 

    } catch (Exception $err) {
        echo "\e[0;31m[error] Failed to crawl website, skipping website: {$err}\e[0m\n";    
    }
    try {
        echo "\e[0;32m[verbose] Crawling https://mpaccount.000webhostapp.com/ \e[0m\n";
        $url = "https://mpaccount.000webhostapp.com/";
        $html= file_get_contents($url);
        $html = strip_tags($html, '<title><a>');
        //$html = $html . "</html>";
        $dom = new DOMDocument();
        @$dom->loadHTML('<?xml encoding="utf-8" ?>' . $html);
        $xPath = new DOMXPath($dom);
        $elements = $xPath->query("//a/@href");
        $result = $xPath->query('//title')->item(0)->textContent;
        echo "\e[0;32m[verbose] Adding entry for {$url} \e[0m\n";
        $subname = "Compte Minteck Projects";
        if (isset($result)) {
            if (trim($result) == "") {
                $result = $subname;
            }
        } else {
            $result = $subname;
        }
        file_put_contents(getcwd() . "/crawler.db", file_get_contents(getcwd() . "/crawler.db") . "\n" . $result . "|" . $url);
        echo "\e[1;33m[success] Added 1 entry to database (crawler.db)\e[0m\n"; 
        global $wsroot;
        global $wsargs;
        $wsroot = "https://mpaccount.000webhostapp.com";
        $wsargs = "";
        crawl("https://mpaccount.000webhostapp.com");
        echo "\e[1;33m[success] Crawled {$url}\e[0m\n"; 
    } catch (Exception $err) {
        echo "\e[0;31m[error] Failed to crawl website, skipping website: {$err}\e[0m\n";    
    }
    echo "\e[0;32m[verbose] Crawling https://mpdn.alwaysdata.net (2nd time) \e[0m\n";
    $url2 = "https://mpdn.alwaysdata.net";
    $html2= file_get_contents($url2,
    false,
    stream_context_create([
        'http' => [
            'ignore_errors' => true,
        ],
    ]));
    $html2 = strip_tags($html2, '<title><a>');
    $dom2 = new DOMDocument();
    @$dom2->loadHTML('<?xml encoding="utf-8" ?>' . $html2);
    $xPath2 = new DOMXPath($dom2);
    $elements2 = $xPath2->query("//a/@href");
    $result2 = $xPath2->query('//title')->item(0)->textContent;
    echo "\e[0;32m[verbose] Skipping entry {$url2} \e[0m\n";
    $wsroot = "https://mpdn.alwaysdata.net";
    $wsargs = "";
$fst2 = false;
$url2 = "https://mpdn.alwaysdata.net";
$html2= file_get_contents($url2,
false,
stream_context_create([
    'http' => [
        'ignore_errors' => true,
    ],
]));
$html2 = strip_tags($html2, '<title><a>');
$dom2 = new DOMDocument();
@$dom2->loadHTML('<?xml encoding="utf-8" ?>' . $html2);
$xPath2 = new DOMXPath($dom2);
$elements2 = $xPath2->query("//a/@href");
$result2 = $xPath2->query('//title')->item(0)->textContent;
foreach($elements2 as $e2) {
    // if (strpos(file_get_contents(getcwd() . "/crawler.db"), $e2->value) !== false) {
    //     return;
    // }
    if (startsWith($e2->value, "http") || startsWith($e2->value, "www") || startsWith($e2->value, "/www") || startsWith($e2->value, "/tools")) {
        if (endsWith($e2->value, ".png")) {
            echo "\e[0;32m[verbose] Adding entry for {$e2->value} \e[0m\n";
            file_put_contents(getcwd() . "/crawler.db", file_get_contents(getcwd() . "/crawler.db") . "\n" . "Image|" . $e->value);
            echo "\e[1;33m[success] Added 1 entry to database (crawler.db)\e[0m\n"; 
        }
    } else {
        if (endsWith($e2->value, ".png")) {
            echo "\e[0;32m[verbose] Adding entry for {$wsroot} \e[0m\n";
            file_put_contents(getcwd() . "/crawler.db", file_get_contents(getcwd() . "/crawler.db") . "\n" . "Image|" . $wsroot . $e2->value);
            echo "\e[1;33m[success] Added 1 entry to database (crawler.db)\e[0m\n"; 
        } else {
            $url3 = $wsroot . $e2->value . $wsargs;
            $html3= file_get_contents($url3,
            false,
            stream_context_create([
                'http' => [
                    'ignore_errors' => true,
                ],
            ]));
            $html3 = strip_tags($html3, '<title><a>');
            $dom3 = new DOMDocument();
            @$dom3->loadHTML('<?xml encoding="utf-8" ?>' . $html3);
            $x3=new DOMXPath($dom3);
            $result3 = $x3->query('//title')->item(0)->textContent;
            if (strpos($e2->value, "Mes_") !== false || strpos($e2->value, "mediawiki.org") !== false || startsWith($e2->value, "www") || startsWith($e2->value, "/www")) {
                echo "\e[0;32m[verbose] {$wsroot}{$e2->value} contains personnal info or point to external website, skipping entry \e[0m\n";
                file_put_contents(getcwd() . "/crawler.db", file_get_contents(getcwd() . "/crawler.db") . "\n" . "[SKIP!]|" . $wsroot . $e2->value);
            } else {
                echo "\e[0;32m[verbose] Adding entry for {$wsroot}{$e2->value} \e[0m\n";
                file_put_contents(getcwd() . "/crawler.db", file_get_contents(getcwd() . "/crawler.db") . "\n" . $result3 . "|" . $wsroot . $e2->value);
                echo "\e[1;33m[success] Added 1 entry to database (crawler.db)\e[0m\n"; 
            }
        }
    }
}
echo "\e[1;33m[success] Crawled https://mpdn.alwaysdata.net (2nd time)\e[0m\n"; 
    } catch (Exception $err) {
        echo "\e[0;31m[error] Failed to crawl website, skipping website: {$err}\e[0m\n";    
    }
    echo "\e[0;32m[verbose] Crawling https://projectpedia.alwaysdata.net (2nd time) \e[0m\n";
    $url2 = "https://projectpedia.alwaysdata.net";
    $html2= file_get_contents($url2,
    false,
    stream_context_create([
        'http' => [
            'ignore_errors' => true,
        ],
    ]));
    $html2 = strip_tags($html2, '<title><a>');
    $dom2 = new DOMDocument();
    @$dom2->loadHTML('<?xml encoding="utf-8" ?>' . $html2);
    $xPath2 = new DOMXPath($dom2);
    $elements2 = $xPath2->query("//a/@href");
    $result2 = $xPath2->query('//title')->item(0)->textContent;
    echo "\e[0;32m[verbose] Skipping entry {$url2} \e[0m\n";
    $wsroot = "https://projectpedia.alwaysdata.net";
    $wsargs = "";
$fst2 = false;
$url2 = "https://projectpedia.alwaysdata.net";
$html2= file_get_contents($url2,
false,
stream_context_create([
    'http' => [
        'ignore_errors' => true,
    ],
]));
$html2 = strip_tags($html2, '<title><a>');
$dom2 = new DOMDocument();
@$dom2->loadHTML('<?xml encoding="utf-8" ?>' . $html2);
$xPath2 = new DOMXPath($dom2);
$elements2 = $xPath2->query("//a/@href");
$result2 = $xPath2->query('//title')->item(0)->textContent;
foreach($elements2 as $e2) {
    // if (strpos(file_get_contents(getcwd() . "/crawler.db"), $e2->value) !== false) {
    //     return;
    // }
    if (startsWith($e2->value, "http") || startsWith($e2->value, "www") || startsWith($e2->value, "/www") || startsWith($e2->value, "/tools")) {
        if (endsWith($e2->value, ".png")) {
            echo "\e[0;32m[verbose] Adding entry for {$e2->value} \e[0m\n";
            file_put_contents(getcwd() . "/crawler.db", file_get_contents(getcwd() . "/crawler.db") . "\n" . "Image|" . $e->value);
            echo "\e[1;33m[success] Added 1 entry to database (crawler.db)\e[0m\n"; 
        }
    } else {
        if (endsWith($e2->value, ".png")) {
            echo "\e[0;32m[verbose] Adding entry for {$wsroot} \e[0m\n";
            file_put_contents(getcwd() . "/crawler.db", file_get_contents(getcwd() . "/crawler.db") . "\n" . "Image|" . $wsroot . $e2->value);
            echo "\e[1;33m[success] Added 1 entry to database (crawler.db)\e[0m\n"; 
        } else {
            $url3 = $wsroot . $e2->value . $wsargs;
            $html3= file_get_contents($url3,
            false,
            stream_context_create([
                'http' => [
                    'ignore_errors' => true,
                ],
            ]));
            $html3 = strip_tags($html3, '<title><a>');
            $dom3 = new DOMDocument();
            @$dom3->loadHTML('<?xml encoding="utf-8" ?>' . $html3);
            $x3=new DOMXPath($dom3);
            $result3 = $x3->query('//title')->item(0)->textContent;
            if (strpos($e2->value, "Mes_") !== false || strpos($e2->value, "mediawiki.org") !== false || startsWith($e2->value, "www") || startsWith($e2->value, "/www")) {
                echo "\e[0;32m[verbose] {$wsroot}{$e2->value} contains personnal info or point to external website, skipping entry \e[0m\n";
                file_put_contents(getcwd() . "/crawler.db", file_get_contents(getcwd() . "/crawler.db") . "\n" . "[SKIP!]|" . $wsroot . $e2->value);
            } else {
                echo "\e[0;32m[verbose] Adding entry for {$wsroot}{$e2->value} \e[0m\n";
                file_put_contents(getcwd() . "/crawler.db", file_get_contents(getcwd() . "/crawler.db") . "\n" . $result3 . "|" . $wsroot . $e2->value);
                echo "\e[1;33m[success] Added 1 entry to database (crawler.db)\e[0m\n"; 
            }
        }
    }
}
echo "\e[1;33m[success] Crawled https://projectpedia.alwaysdata.net (2nd time)\e[0m\n"; 
    // } catch (Exception $err) {
    //     echo "\e[0;31m[error] Failed to crawl website, skipping website: {$err}\e[0m\n";    
    // }
    try {
        echo "\e[0;32m[verbose] Crawling http://mpcms.rf.gd/ \e[0m\n";
        $url = "http://mpcms.rf.gd/";
        $html= file_get_contents($url);
        $html = strip_tags($html, '<title><a>');
        $dom = new DOMDocument();
        @$dom->loadHTML('<?xml encoding="utf-8" ?>' . $html);
        $xPath = new DOMXPath($dom);
        $elements = $xPath->query("//a/@href");
        try {
            $result = $xPath->query('//title')->item(0)->textContent;
        } catch (Notice $err) {
            $result = "Minteck Projects CMS";
        }
        echo "\e[0;32m[verbose] Entry skipped for {$url} \e[0m\n";
        $subname = "Minteck Projects CMS";
        if (isset($result)) {
            if (trim($result) == "") {
                $result = $subname;
            }
        } else {
            $result = $subname;
        }
        global $wsroot;
        global $wsargs;
        $wsroot = "http://mpcms.rf.gd";
        $wsargs = "";
        crawl("http://mpcms.rf.gd");
        echo "\e[1;33m[success] Crawled {$url}\e[0m\n"; 
    } catch (Exception $err) {
        echo "\e[0;31m[error] Failed to crawl website, skipping website: {$err}\e[0m\n";    
    }
    try {
        echo "\e[0;32m[verbose] Crawling https://cdn-minteck-projects.000webhostapp.com \e[0m\n";
        $url = "https://cdn-minteck-projects.000webhostapp.com";
        $html= file_get_contents($url);
        $html = strip_tags($html, '<title><a>');
        $dom = new DOMDocument();
        @$dom->loadHTML('<?xml encoding="utf-8" ?>' . $html);
        $xPath = new DOMXPath($dom);
        $elements = $xPath->query("//a/@href");
        $result = $xPath->query('//title')->item(0)->textContent;
        echo "\e[0;32m[verbose] Adding entry for {$url} \e[0m\n";
        $subname = "Domaine de ressources Minteck Projects™";
        $result = $subname;
        file_put_contents(getcwd() . "/crawler.db", file_get_contents(getcwd() . "/crawler.db") . "\n" . $result . "|" . $url);
        global $wsroot;
        global $wsargs;
        $wsroot = "https://cdn-minteck-projects.000webhostapp.com";
        $wsargs = "";
        global $wsroot;
    global $wsargs;
    $fst = false;
    $url = "https://cdn-minteck-projects.000webhostapp.com";
    $html= file_get_contents($url);
    $html = strip_tags($html, '<title><a>');
    $dom = new DOMDocument();
    @$dom->loadHTML('<?xml encoding="utf-8" ?>' . $html);
    $xPath = new DOMXPath($dom);
    $elements = $xPath->query("//a/@href");
    $result = $xPath->query('//title')->item(0)->textContent;
    foreach($elements as $e) {
        if (strpos(file_get_contents(getcwd() . "/crawler.db"), $e->value) !== false) {
            return;
        }
        if (startsWith($e->value, "http") || startsWith($e->value, "/tools")) {
            if (endsWith($e->value, ".png")) {
                echo "\e[0;32m[verbose] Adding entry for {$e->value} \e[0m\n";
                file_put_contents(getcwd() . "/crawler.db", file_get_contents(getcwd() . "/crawler.db") . "\n" . "Image|" . $e->value);
                echo "\e[1;33m[success] Added 1 entry to database (crawler.db)\e[0m\n"; 
            }
        } else {
            if (endsWith($e->value, ".png")) {
                echo "\e[0;32m[verbose] Adding entry for {$wsroot}{$e->value} \e[0m\n";
                file_put_contents(getcwd() . "/crawler.db", file_get_contents(getcwd() . "/crawler.db") . "\n" . "Image|" . $wsroot . $e->value);
                echo "\e[1;33m[success] Added 1 entry to database (crawler.db)\e[0m\n"; 
            } else {
                /*$url = $wsroot . $e->value . $wsargs;
                $html= file_get_contents($url);
                $html = strip_tags($html, '<title><a>');
                $dom = new DOMDocument();
                @$dom->loadHTML('<?xml encoding="utf-8" ?>' . $html);
                $x=new DOMXPath($dom);
                $result = $x->query('//title')->item(0)->textContent;*/
                if (strpos($e->value, "Mes_") !== false) {
                    echo "\e[0;32m[verbose] {$wsroot}{$e->value} contains personnal info, skipping entry \e[0m\n";
                    file_put_contents(getcwd() . "/crawler.db", file_get_contents(getcwd() . "/crawler.db") . "\n" . "[SKIP!]|" . $wsroot . $e->value);
                } else {
                    echo "\e[0;32m[verbose] Adding entry for {$wsroot}{$e->value} \e[0m\n";
                    file_put_contents(getcwd() . "/crawler.db", file_get_contents(getcwd() . "/crawler.db") . "\n" . $e->value . "|" . $wsroot . $e->value);
                    echo "\e[1;33m[success] Added 1 entry to database (crawler.db)\e[0m\n"; 
                }
            }
        }
    }
    echo "\e[1;33m[success] Crawled https://cdn-minteck-projects.000webhostapp.com\e[0m\n"; 
    
        } catch (Exception $err) {
            echo "\e[0;31m[error] Failed to crawl website, skipping website: {$err}\e[0m\n";    
        }
        echo "\e[0;32m[verbose] Adding entry for http://mpcms.rf.gd \e[0m\n";
                    file_put_contents(getcwd() . "/crawler.db", file_get_contents(getcwd() . "/crawler.db") . "\nMinteck Projects CMS|http://mpcms.rf.gd");
                    echo "\e[1;33m[success] Added 1 entry to database (crawler.db)\e[0m\n"; 
        $count = count(explode("\n", file_get_contents(getcwd() . "/crawler.db")));
        echo "\e[1;33m[success] Finished crawling task, added {$count} entries\e[0m\n"; 
// } catch (Exception $err) {
//     echo "\e[0;31m[error] {$err}\e[0m\n";
// }