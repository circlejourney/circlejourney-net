<?php

    $profilePath = $_GET["user"];
    $userprofile = "https://toyhou.se/$profilePath";
    $allfolder = "https://toyhou.se/$profilePath/characters/folder:all";
    $cookie="cookie.txt";
    $curlrequest = curl_init();

    curl_setopt($curlrequest, CURLOPT_URL, $userprofile);
    curl_setopt ($curlrequest, CURLOPT_COOKIEJAR, $cookie);
    curl_setopt ($curlrequest, CURLOPT_COOKIEFILE, $cookie);
    curl_setopt ($curlrequest, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curlrequest, CURLOPT_FOLLOWLOCATION, 0);
    
    $csrfresponse = curl_exec($curlrequest);
    preg_match("/<meta\sname=\"csrf-token\"\scontent=\"(.*?)\">/", $csrfresponse, $tokenmatches);
    $haswarning = preg_match("/name=\"user\"\stype=\"hidden\"\svalue=\"([0-9]+)\"/", $csrfresponse, $usermatches);
    if($haswarning) {
        $token = $tokenmatches[1];
        $user = $usermatches[1];

        $postinfo = array(
            'user'=>$user,
            '_token'=>$token
        );

        curl_setopt($curlrequest, CURLOPT_URL, "https://toyhou.se/~account/warnings/accept");
        curl_setopt ($curlrequest, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curlrequest, CURLOPT_POST, 1);
        curl_setopt($curlrequest, CURLOPT_POSTFIELDS, http_build_query($postinfo));
        $acceptresponse = curl_exec($curlrequest);
    }
    
    curl_setopt($curlrequest, CURLOPT_URL, $userprofile);
    curl_setopt ($curlrequest, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curlrequest, CURLOPT_POST, 0);
    $userresponse = curl_exec($curlrequest);
    
    if(strpos($userresponse, "user-content") === false) {
        $response = array(
            "error" => 'Private or invalid profile.'
        );
        echo json_encode($response, JSON_PRETTY_PRINT);
        die();

    } else if(strpos($userresponse, "allow-thcj-import") === false) {
        $response = array(
            "error" => 'You are attempting to import a profile that has not been set to allow code import. To allow code import, paste the line <code>&lt;u id="allow-thcj-import">&lt;/u></code> at the start of your user profile.'
        );
        echo json_encode($response, JSON_PRETTY_PRINT);
        die();
    } else {
        error_log("$profilePath: This profile has been set to allow import. Importing...");
    }
    