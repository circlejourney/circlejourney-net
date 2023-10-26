<?php header("Content-type: text/html");
    $profilePath = $_GET["user"];
    $userprofile = "https://toyhou.se/$profilePath";
    $allfolder = "https://toyhou.se/$profilePath/characters/folder:all";

    $username="orchestrator"; 
    $password="G&(87g0g";
    $cookie="cookie.txt"; 

    $curlrequest = curl_init();
    // Options
    //curl_setopt($curlrequest, CURLOPT_CUSTOMREQUEST, 'GET');
    //curl_setopt($curlrequest, CURLOPT_FOLLOWLOCATION, true);
    //curl_setopt($curlrequest, CURLOPT_SSL_VERIFYHOST, 0);
    //curl_setopt($curlrequest, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.7.12) Gecko/20050915 Firefox/1.0.7");
    /**/
    
    curl_setopt ($curlrequest, CURLOPT_URL, "https://toyhou.se/~account/login");
    curl_setopt ($curlrequest, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curlrequest, CURLOPT_FOLLOWLOCATION, 0);
    curl_setopt ($curlrequest, CURLOPT_COOKIEJAR, $cookie); 
    curl_setopt ($curlrequest, CURLOPT_COOKIEFILE, $cookie); 
    $loginresponse = curl_exec($curlrequest);
    preg_match("/<meta\sname=\"csrf-token\"\scontent=\"(.*?)\">/", $loginresponse, $matches);
    $token = $matches[1];

    $postinfo = array(
        'username'=>$username,
        'password'>$password,
        '_token'=>$token
    );

    curl_setopt($curlrequest, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($curlrequest, CURLOPT_RETURNTRANSFER, 0);
    curl_setopt($curlrequest, CURLOPT_POST, 1);
    curl_setopt($curlrequest, CURLOPT_POSTFIELDS, http_build_query($postinfo));
    //curl_setopt($curlrequest, CURLOPT_REFERER, "https://localhost:5000/login.php?user=$profilePath");
    curl_exec($curlrequest);

    /*$userrequest = curl_init();
    curl_setopt($userrequest, CURLOPT_URL, $userprofile);
    curl_setopt($userrequest, CURLOPT_CUSTOMREQUEST, 'GET');
    curl_setopt($userrequest, CURLOPT_POST, 0);
    curl_setopt($userrequest, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($userrequest, CURLOPT_HTTPHEADER, array(
        "Access-Control-Allow-Origin: *",
        "Access-Control-Allow-Credentials: true",
        "Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding, X-CSRF-Token, Authorization, accept, origin, Cache-Control, X-Requested-With",
        "Access-Control-Allow-Methods: POST, OPTIONS, GET, PUT",
        'X-CSRF-TOKEN: ' . $token
    ));
    //curl_setopt($curlrequest, CURLOPT_POSTFIELDS, http_build_query($getinfo));
    $userHTML = curl_exec($userrequest);
    echo $userHTML;*/