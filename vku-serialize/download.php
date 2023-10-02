<?php 
if (isset($_POST["data"])) {
    $result = $_POST["data"];
    $filename = 'students.dat';

    header("Content-Type: text/plain");
    header('Content-Disposition: attachment; filename="'.$filename.'"');
    header("Content-Length: " . strlen($result));
    echo $result;
    die();
}