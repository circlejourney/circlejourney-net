<?php
    $fileList = scandir("stories/");
    echo json_encode($fileList);
?>