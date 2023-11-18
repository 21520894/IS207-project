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
    } else if ($action == 'userManager' && $query == 'null') {
        include ("./modules/userManager/userManager.php");
    } else if ($action == 'userManager' && $query == 'edit') {
        include ("./modules/userManager/editUser.php");
    } else if ($action == 'orderManager' && $query == 'null') {
        include ("./modules/ecommerce/orderManager.php");
    } else if ($action == 'voucherManager' && $query == 'null') {
        include ("./modules/ecommerce/voucherManager.php");
    } else if ($action == 'report') {
        include ("./modules/report.php");
    } else {
        include ("./modules/dashboard.php");
    }
?>