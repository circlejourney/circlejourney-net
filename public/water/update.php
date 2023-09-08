<?php

    // This script updates the programme from the Brisbane ArcGIS map.
    // Run this periodically - but only on verifying that the JSON
    // file structure has not changed.

    $GET_JSON_URL = "https://services2.arcgis.com/dEKgZETqwmDAh1rP/arcgis/rest/services/park_drinking_fountain_tap_locations/FeatureServer/0/query?outFields=*&where=1%3D1&f=json";
    $OUTPUT_FILENAME = "bcc_coords.json";

    $coords = json_decode( file_get_contents($GET_JSON_URL), true );
    $existing = json_decode( file_get_contents( $OUTPUT_FILENAME ), true );

    foreach($coords["features"] as $k => $v) {

        $i = "BCC_" . strval($v["attributes"]["OBJECTID"]);
        if( isset($existing[$i]) ) continue;

        $existing[$i] = array("ID" => $i);
        $existing[$i]["contributor"] = "Brisbane City Council";
        $existing[$i]["description"] = titleCase( $v["attributes"]["PARK_NAME"].": ".$v["attributes"]["ITEM_DESCRIPTION"] );
        $existing[$i]["coords"] = [ $v["attributes"]["Y"], $v["attributes"]["X"] ];

        echo "Added " . $i . ": " . $existing[$i]["description"] . "\n";

    }

    file_put_contents( "bcc_coords.json", json_encode($existing, JSON_PRETTY_PRINT) );
       
    		
    function titleCase($text) {
        $rv = ucwords( strtolower($text) );
        return $rv;
    }

?>