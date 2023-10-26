<?php
    if(!isset($_GET["user"]) || !$_GET["user"]) {
        $response = array(
            "error" => 'Username not specified.'
        );
        echo json_encode($response, JSON_PRETTY_PRINT);
        die();
    }

    $profilePath = $_GET["user"];
    $userprofile = "https://toyhou.se/$profilePath";
    $allfolder = "https://toyhou.se/$profilePath/characters/folder:all";

    $cookie = getcwd() . DIRECTORY_SEPARATOR . "cookie.txt";

    $loginendpoint = "https://toyhou.se/~account/login";
    $username = config("services.thdownload.username");
    $password = config("services.thdownload.password");


    // Initial CSRF handshake
    $postlogin = curl_init();
    curl_setopt($postlogin, CURLOPT_URL, $loginendpoint);
    curl_setopt($postlogin, CURLOPT_COOKIEJAR, $cookie);
    curl_setopt($postlogin, CURLOPT_COOKIEFILE, $cookie);
    curl_setopt($postlogin, CURLOPT_RETURNTRANSFER, 1);
    $csrfresponse = curl_exec($postlogin);
    $notauthed = preg_match("/<meta\sname=\"csrf-token\"\scontent=\"(.*?)\">/", $csrfresponse, $tokenmatches);
    if($notauthed) {
        error_log("Application currently not logged in. Logging in...");
        $token = $tokenmatches[1];

        // Login post request
        $loginheaders = array(
            "username" => $username,
            "password" => $password,
            "_token" => $token
        );
        curl_setopt($postlogin, CURLOPT_URL, $loginendpoint);
        curl_setopt($postlogin, CURLOPT_COOKIEFILE, $cookie);
        curl_setopt($postlogin, CURLOPT_COOKIEJAR, $cookie);
        curl_setopt($postlogin, CURLOPT_POST, 1);
        curl_setopt($postlogin, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($postlogin, CURLOPT_FOLLOWLOCATION, 0);
        curl_setopt($postlogin, CURLOPT_POSTFIELDS, http_build_query($loginheaders));
        $loginresponse = curl_exec($postlogin);
    }


    curl_setopt($postlogin, CURLOPT_URL, $userprofile);
    curl_setopt ($postlogin, CURLOPT_COOKIEJAR, $cookie);
    curl_setopt ($postlogin, CURLOPT_COOKIEFILE, $cookie);
    curl_setopt ($postlogin, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($postlogin, CURLOPT_FOLLOWLOCATION, 0);
    
    $csrfresponse = curl_exec($postlogin);
    preg_match("/<meta\sname=\"csrf-token\"\scontent=\"(.*?)\">/", $csrfresponse, $tokenmatches);
    $haswarning = preg_match("/name=\"user\"\stype=\"hidden\"\svalue=\"([0-9]+)\"/", $csrfresponse, $usermatches);
    if($haswarning) {
        $token = $token ?? $tokenmatches[1];
        $user = $usermatches[1];

        $postinfo = array(
            'user'=>$user,
            '_token'=>$token
        );

        curl_setopt($postlogin, CURLOPT_URL, "https://toyhou.se/~account/warnings/accept");
        curl_setopt ($postlogin, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($postlogin, CURLOPT_POST, 1);
        curl_setopt($postlogin, CURLOPT_POSTFIELDS, http_build_query($postinfo));
        $acceptresponse = curl_exec($postlogin);
    }
    
    curl_setopt($postlogin, CURLOPT_URL, $userprofile);
    curl_setopt ($postlogin, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($postlogin, CURLOPT_POST, 0);
    $userresponse = curl_exec($postlogin);
    
    if(strpos($userresponse, 'id="sidebar"') === false) {
        $response = array(
            "error" => 'User not found. They may be private or nonexistent.'
        );
        echo json_encode($response, JSON_PRETTY_PRINT);

    } else if(strpos($userresponse, "allow-thcj-import") === false) {
        $response = array(
            "error" => 'You are attempting to import from a user that has not allowed code import. To allow code import, paste the line <code>&lt;u id="allow-thcj-import">&lt;/u></code> at the start of your user profile.'
        );
        echo json_encode($response, JSON_PRETTY_PRINT);
        
    } else {

        // Fetch pagination list from "all" folder
        $paginationrequest = curl_init();
        curl_setopt($paginationrequest, CURLOPT_URL, $allfolder);
        curl_setopt($paginationrequest, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($paginationrequest, CURLOPT_COOKIEFILE, $cookie);
        $body = curl_exec($paginationrequest);
        $status = curl_getinfo($paginationrequest, CURLINFO_HTTP_CODE);

        $tidyconfig = array(
            'indent' => true,
            'output-xhtml' => true,
            'drop-empty-elements' => false,
            'wrap' => 0
        );
        
        preg_match_all('/<(?:a|span)\sclass\="page-link".*?>[0-9]+<\/(?:a|span)>/', $body, $matches);
        preg_match("/>([0-9]+)</", end($matches[0]), $lastpage);

        $pages = array_map(
            function($i)use($allfolder){
                return $allfolder."?page=".$i;
            },
            range(1, intval($lastpage[1]))
        );

        
        $tidy = new tidy;

        $charlist = array(
            array("name" => "[User] $profilePath", "url" => $profilePath)
        );

        foreach($pages as $page) {
            curl_setopt($postlogin, CURLOPT_URL, $page);
            $characterbody = curl_exec($postlogin);

            // Get thumbnailsu
            preg_match_all("/href=\"(.*?)\"\sclass=\"img-thumbnail\">[\S]*(.*?)/", $characterbody, $matches);
            preg_match_all("/href=\"(.*?)\" .*character-name-badge\">(?:<i.*>)?(?:&nbsp;)?(.+)</", $characterbody, $names);
            preg_match_all("/thumb-character-stats text-center\">([\S\s]*?)<\/div>/", $characterbody, $stats);

            $matchreturn = array();
            foreach($names[1] as $i => $value) {
                $matchreturn[] = array(
                    "name" => $names[2][$i],
                    "url" => substr($value, 1)
                );

                $statblock = $stats[1][$i];
                if(preg_match("/title=\"Tabs\"/", $statblock)) {
                    curl_setopt($postlogin, CURLOPT_URL, "https://toyhou.se" . $value);
                    $characterprofile = curl_exec($postlogin);
                    $tabsfound = preg_match("/sidebar-tab\ssidebar-tab-[0-9]+\">[\S\s]*?<a\shref=\"(.*?)\">[\S\s]*?<\/i>(.*)/", $characterprofile, $tabs);
                    if($tabsfound) {
                        $matchreturn[] = array(
                            "name" => $names[2][$i] . " (" . $tabs[2] . ")",
                            "url" => substr($tabs[1], 1)
                        );
                    }
                }
            }

            $charlist = array_merge($charlist, $matchreturn);
        }

        echo json_encode($charlist, JSON_PRETTY_PRINT);
    }