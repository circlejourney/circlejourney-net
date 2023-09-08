<?php //hotfix

    $coords = json_decode(file_get_contents("coords.json"), TRUE);

    for($i = 0; $i < 10000; $i++) {
        $workObj = array();
        $workObj["ID"] = "stressTest_" . strval($i);
        $workObj["description"] = "test " . strval($i);
        $workObj["contributor"] = "Amari";
        $workObj["coords"] = [ mt_rand(0, 100000)/100000 * 180 - 90, 360 * rand(0, 100000)/100000 - 180 ];

        $coords[$workObj["ID"]] = $workObj;
    }

    file_put_contents("coords.json", json_encode($coords, JSON_PRETTY_PRINT));
  
?>