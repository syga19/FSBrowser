<?php
    if (isset($_POST['delete_file'])) {
        $file_name = $_POST['file_name'];
        if (file_exists($file_name)){
            unlink($file_name);
        }
    }
?>