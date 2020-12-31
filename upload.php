
<?php

if (isset($_POST['submitBtn'])) {
    // susikuriam temporary faila
    $file_name = $_FILES['file']['name'];
    $file_size = $_FILES['file']['size'];
    $file_error = $_FILES['file']['error'];
    $file_tmp = $_FILES['file']['tmp_name'];
    $file_type = $_FILES['file']['type'];
    $file_ext = explode('.', $file_name);
    $file_actual_ext = strtolower(end($file_ext));

    //kokius tipus leisiu kelti
    $allowed = array('jpg', 'pdf', 'jpeg', 'png', 'txt', 'php', 'doc', 'docx');

    if (in_array($file_actual_ext, $allowed)) {
        if ($file_error === 0) {
            if ($file_size < 1000000) {
                $file_name_new = uniqid('', true) . "." . $file_actual_ext;
                $file_destination = '$files' . $file_name_new;
                move_uploaded_file($file_tmp, $path . $file_name);
            } else {
                echo "Your file is too big!";
            }
        } else {
            echo "There was an error uploading your file";
        }
    } else {
        echo "You cannot upload files of this type!";
    }
}
//kad automatiskai refreshintu page ir matytusi
if (isset($_POST['submitBtn'])) {
    header("Refresh:1");
}


?>