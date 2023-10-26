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

    $cookie="cookie.txt";

    require("acceptwarning.php");

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

    $charlist = array();

    foreach($pages as $page) {
        curl_setopt($curlrequest, CURLOPT_URL, $page);
        $characterbody = curl_exec($curlrequest);

        // Get thumbnails
        preg_match_all("/href=\"(.*?)\"\sclass=\"img-thumbnail\">[\S]*(.*?)/", $characterbody, $matches);
        preg_match_all("/href=\"(.*?)\" .*character-name-badge\">(.*?)</", $characterbody, $names);
        preg_match_all("/thumb-character-stats text-center\">([\S\s]*?)<\/div>/", $characterbody, $stats);

        $matchreturn = array();
        foreach($names[1] as $i => $value) {
            $matchreturn[] = array(
                "name" => $names[2][$i],
                "url" => substr($value, 1)
            );

            $statblock = $stats[1][$i];
            if(preg_match("/title=\"Tabs\"/", $statblock)) {
                curl_setopt($curlrequest, CURLOPT_URL, "https://toyhou.se" . $value);
                $characterprofile = curl_exec($curlrequest);
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
    
    
    /*$dom->loadHTML($body);
    $uls = $dom->getElementsByTagName('ul');
    foreach($uls as $ul) {
        echo $ul;
    }*/