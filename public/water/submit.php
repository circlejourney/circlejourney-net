<?php
    $action = $_POST["action"];
    $lat = floatval($_POST["lat"]);
    $lng = floatval($_POST["lng"]);
    $contributor = htmlspecialchars($_POST["contributor"]);
    $description = htmlspecialchars($_POST["description"]);
    $time = intval($_POST["time"]);
    $editID = htmlspecialchars($_POST["editID"]);
    
    $data = json_decode(file_get_contents("coords.json"), TRUE);

    if($editID == "" || !isset($data[$editID])) {
        $newData = array("contributor" => $contributor, "coords" => [$lat, $lng], "description" => $description);
        if($editID == "") {
            $editID = preg_replace("/\W/", "", $contributor) . strval($time);
        }
        $data[$editID] = $newData;
    } else {
        $data[$editID]["description"] = $description;
    }

    file_put_contents("coords.json", json_encode($data, JSON_PRETTY_PRINT));
    echo $contributor." posted: ".strval($description);
    mail(
        "cj@circlejourney.net",
        "Pin added/updated on Brisbane Fountains",
        "Pin was added/updated on Brisbane Fountains by ".$contributor." at [".strval($lat).",".strval($lng)."].\nDescription: ".$description,
        "From: cj@circlejourney.net"
    );

?>