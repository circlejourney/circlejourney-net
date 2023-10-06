<!doctype html>
<html>
    <head>    
        <meta charset="UTF-8">
        
        <title>Circlejourney's hypertext engine</title>
        <meta description="Circlejourney's hypertext engine">
        
        <script src="src/jquery-3.5.1.min.js"></script>
        <script src="script.js?<?php echo rand();?>"></script>
        <link rel="stylesheet" href="style.css?<?php echo rand();?>">
    </head>
    <body>
        <div id="display-container">
            <div id="display"></div>
        </div>
        <textarea id="response"></textarea>
    </body>
</html>