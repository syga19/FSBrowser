<?php 
    $path = "./" . $_GET['path'];
    $newDir = $_POST['newDir'];
    if(!file_exists($path . $newDir)) {
        mkdir($path . $newDir);
    }
?>