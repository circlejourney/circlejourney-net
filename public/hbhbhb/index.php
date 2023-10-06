<?php
    $file = fopen("count.txt", "a");
    $date = date('l j F Y h:i:s A');
    $ip = $_SERVER['REMOTE_ADDR'];
    fwrite($file, "\n".$date."\n".$ip."\n---\n");
?>
<html>
    <head>
        <style>
        body {
            text-align: center;
            display: flex;
            flex-direction: column;
            height: 100%;
            margin: 0;
        }

        .main {
            flex-grow: 1;
            overflow-y: scroll;
        }

        iframe {
            display: inline-block;
        }

        img {
            margin-top: -1px;   
            max-width: 100vw;
        }

        .audio {
            width: 100%;
            text-align: center;
        }
        audio {
            width: 100%;
            display: inline-block;
        }

        .info-wrapper {
            width: 100%;
            display: flex;
            justify-content: center;
        }

        .info {
            margin: 0;
            background-color: black;
            color: white;
            min-width: 1000px;   
            max-width: 100vw;
            font-size: 14pt;
        }
    </style>
    </head>
<body>

<div class="main">
<div class="info-wrapper">
    <p class="info">(Press the play button in the bottom left to start the song)</p>
</div>
<img src="hbhbhb1.jpg">
<img src="hbhbhb2.jpg">
<img src="hbhbhb3.jpg">
<img src="hbhbhb4.jpg">
<img src="hbhbhb5.jpg">
<img src="hbhbhb6.jpg">
<img src="hbhbhb7.jpg">
<img src="hbhbhb8.jpg">
<img src="hbhbhb9.jpg">
<img src="hbhbhb10.jpg">
<img src="hbhbhb11.jpg">
<img src="hbhbhb12.jpg">
<img src="hbhbhb13.jpg">
</div>

<div class="audio">
<audio controls>
<source src="https://circlejourney.net/hbhbhb/How%20Big,%20How%20Blue,%20How%20Beautiful.mp3">
</audio>
</div>

</body>
<html>