<?php header("Content-type: application/json");
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

    $username="orchestrator"; 
    $password="G&(87g0g";
    $cookie="cookie.txt"; 

    $curlrequest = curl_init();
    curl_setopt($curlrequest, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($curlrequest, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curlrequest, CURLOPT_URL, $userprofile);
    $userHTML = curl_exec($curlrequest);
    
    if(strpos($userHTML, "We can't find that page") !== false || strpos($userHTML, "Invalid user selected") !== false) {
        $response = array(
            "error" => 'Private or invalid profile.'
        );
        echo json_encode($response, JSON_PRETTY_PRINT);
        die();

    } else if(strpos($userHTML, "allow-thcj-import") === false) {
        $response = array(
            "error" => 'You are attempting to import a profile that has not been set to allow code import. To allow code import, paste the line <code>&lt;u id="allow-thcj-import">&lt;/u></code> at the start of your user profile.'
        );
        echo json_encode($response, JSON_PRETTY_PRINT);
        die();
    }

    // Fetch pagination list from "all" folder
    curl_setopt($curlrequest, CURLOPT_URL, $allfolder);
    $scraped = curl_exec($curlrequest);
    $status = curl_getinfo($curlrequest, CURLINFO_HTTP_CODE);
    $body = $scraped . PHP_EOL;

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

    $charlist = array();

    foreach($pages as $page) {
        curl_setopt($curlrequest, CURLOPT_URL, $page);
        $scraped = curl_exec($curlrequest);

        $characterbody = $scraped . PHP_EOL;
        preg_match_all("/href=\"(.*?)\"\sclass=\"img-thumbnail\">[\S]*(.*?)/", $characterbody, $matches);
        preg_match_all("/character-name-badge\">(.*?)</", $characterbody, $names);
        $matchreturn = array();

        foreach($matches[1] as $i => $value) {
            $matchreturn[$i] = array(
                "name" => $names[1][$i],
                "url" => substr($value, 1)
            );
        }

        $charlist = array_merge($charlist, $matchreturn);
    }

    echo json_encode($charlist, JSON_PRETTY_PRINT);
    
    
    /*$dom->loadHTML($body);
    $uls = $dom->getElementsByTagName('ul');
    foreach($uls as $ul) {
        echo $ul;
    }*/