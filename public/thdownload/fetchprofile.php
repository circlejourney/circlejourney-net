<?php
    $url = "https://toyhou.se/".$_GET["url"];
    $curlrequest = curl_init();
    curl_setopt($curlrequest, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($curlrequest, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curlrequest, CURLOPT_URL, $url);
    $characterHTML = curl_exec($curlrequest);

    $tidyconfig = array(
        'indent' => true,
        'output-xhtml' => true,
        'drop-empty-elements' => false,
        'wrap' => 0
    );
    $tidy = new tidy;
    $tidy -> parseString($characterHTML, $tidyconfig, 'utf8');
    $characterHTML = tidy_get_output($tidy);
    $characterHTML = preg_replace('/[^\S\t\n\r]{16}([^\s])/', "$1", $characterHTML);
    echo $characterHTML;