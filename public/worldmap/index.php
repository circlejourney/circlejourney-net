<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0>
    <style> body {padding: 0; margin: 0;} </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="p5.min.js"></script>
    <script src="addons/p5.dom.min.js"></script>
    <script src="addons/p5.sound.min.js"></script>
    <script src="<?php 
        $get = $_GET["mod"];
        if ($_GET["mod"] == "1") {
             echo "sketch_.js";
        } else {
             echo "sketch.js";
        }
        echo "?".rand();
    ?>"></script>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Handlee&family=Rock+Salt&display=swap" rel="stylesheet">
    
    <style>
        body {
        }
        
        a {
            text-decoration: none;
            border-bottom: 1px dashed;
            color: brown;
        }
        
        #map-container {
            position: relative;
        }
        
        #panel, #tooltip {
            font-family: "Handlee", serif;
            position: absolute;
            background: rgba(255, 255, 255, 0.7);
            border-radius: 5px;
            font-size: 11pt;
            box-sizing: border-box;
            box-shadow: 1px 1px 4px rgba(0, 0, 0, 0.2);
        }
            
        #tooltip {
            transition: 0.1s opacity linear;
            max-width: 300px;
            padding: 2px 5px;
        }
        
        #tooltip-readmore {
            margin: 0.2em 0;
            color: brown;
        }
        
        #tooltip-name, #panel-title {
            font-family: "Rock Salt", serif;
        }
        
        #panel {
            z-index: 2;
            width: 500px;
            padding: 10px;
        }
        
        #panel-title {
            font-size: 16pt;
            margin: 0;
        }
        
        .invisible {
            display: none;
        }
        
        .active-marker {
            
        }
        
        .pointer {
            z-index: 3;
            opacity: 0.8;
            width: 15px;
            height: 15px;
            border-radius: 5px;
            position: absolute;
            background-color: rgba(255, 255, 255, 0.7);
        }
    </style>
  </head>
  
  <body>
      
      <div id="panel" class="invisible">
          <h1 id="panel-title"></h1>
          <div id="panel-content"></div>
      </div>
  </body>
</html>
