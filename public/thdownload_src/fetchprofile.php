<?php
    $url = "https://toyhou.se/".$_GET["url"];
    $cookie="cookie.txt";

    $curlrequest = curl_init();
        
    curl_setopt($curlrequest, CURLOPT_URL, $url);
    curl_setopt ($curlrequest, CURLOPT_COOKIEJAR, $cookie);
    curl_setopt ($curlrequest, CURLOPT_COOKIEFILE, $cookie);
    curl_setopt ($curlrequest, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curlrequest, CURLOPT_FOLLOWLOCATION, 0);
    
    $csrfresponse = curl_exec($curlrequest);
    preg_match("/<meta\sname=\"csrf-token\"\scontent=\"(.*?)\">/", $csrfresponse, $tokenmatches);
    $haswarning = preg_match("/name=\"user\"\stype=\"hidden\"\svalue=\"([0-9]+)\"/", $csrfresponse, $usermatches);
    preg_match("/name=\"character\"\stype=\"hidden\"\svalue=\"([0-9]+)\"/", $csrfresponse, $charactermatches);

    if($haswarning) {
        $token = $tokenmatches[1];
        $user = $usermatches[1];
        $character = $charactermatches[1];

        $postinfo = array(
            'user'=>$user,
            'character'=>$character,
            '_token'=>$token
        );

        curl_setopt($curlrequest, CURLOPT_URL, "https://toyhou.se/~account/warnings/accept");
        curl_setopt ($curlrequest, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curlrequest, CURLOPT_POST, 1);
        curl_setopt($curlrequest, CURLOPT_POSTFIELDS, http_build_query($postinfo));
        curl_exec($curlrequest);
    }

    curl_setopt($curlrequest, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($curlrequest, CURLOPT_POST, 0);
    curl_setopt($curlrequest, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt ($curlrequest, CURLOPT_COOKIEJAR, $cookie);
    curl_setopt ($curlrequest, CURLOPT_COOKIEFILE, $cookie);
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