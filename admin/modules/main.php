<?php 
    if (isset($_GET['action']) && $_GET['query']) {
        $action = $_GET['action'];
        $query = $_GET['query'];
    } else {
        $action = '';
        $query = '';
    }
    
    if ($action == 'dishManager' && $query == 'null') {
        include ("./modules/dishManager/dishManager.php");
    } else if ($action == 'dishManager' && $query == 'edit') {
        include ("./modules/dishManager/editDish.php");
    } else if ($action == 'userManager') {
        include ("./modules/userManager.php");
    } else if ($action == 'ecommerce') {
        include ("./modules/ecommerce.php");
    } else if ($action == 'report') {
        include ("./modules/report.php");
    } else {
        include ("./modules/dashboard.php");
    }
?>