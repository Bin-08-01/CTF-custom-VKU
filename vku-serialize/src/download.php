<?php 
session_start();

if (isset($_POST["data"])) {
    $result = $_SESSION['students'];
    $filename = 'students.dat';

    header("Content-Type: text/plain");
    header('Content-Disposition: attachment; filename="'.$filename.'"');
    header("Content-Length: " . strlen($result));
    echo $result;
    die();
}