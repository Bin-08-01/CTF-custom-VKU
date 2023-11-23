<?php
$flag1 = "VKU{select_is_so_easy}";
$flag2 = "VKU{condition_in_sql}";
$flag3 = "VKU{LIKE_in_sql_is_so_easy}";
$flag4 = "VKU{insert_is_not_hard_for_me}";
$flag5 = "VKU{bing_chi_ling_is_so_cute}";
$flag6 = "VKU{delete_my_info_please}";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $flagInput = $_POST["flag"];
    $idChall = $_POST["idChall"];
    if ($idChall == "1") {
        if ($flagInput == $flag1) {
            echo true;
        } else {
            echo false;
        }
    } else if ($idChall == "2") {
        if ($flagInput == $flag2) {
            echo true;
        } else {
            echo false;
        }
    } else if ($idChall == "3") {
        if ($flagInput == $flag3) {
            echo true;
        } else {
            echo false;
        }
    } else if ($idChall == "4") {
        if ($flagInput == $flag4) {
            echo true;
        } else {
            echo false;
        }
    }
     else if ($idChall == "5") {
        if ($flagInput == $flag5) {
            echo true;
        } else {
            echo false;
        }
    } else if ($idChall == "6") {
        if ($flagInput == $flag6) {
            echo true;
        } else {
            echo false;
        }
    }
    
}
echo false;