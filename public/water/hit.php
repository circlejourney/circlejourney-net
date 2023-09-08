<?php
    $hits = json_decode(file_get_contents("hit.json"));
    $coords = $_POST["coords"];
    if($_SERVER["REMOTE_ADDR"] !== "::1") {
        array_push(
            $hits,
            array(
                "time"=>time(),
                "coords"=>$coords,
                "ip"=>$_SERVER["REMOTE_ADDR"]
            )
        );
        file_put_contents("hit.json", json_encode($hits, JSON_PRETTY_PRINT));
    }
?>