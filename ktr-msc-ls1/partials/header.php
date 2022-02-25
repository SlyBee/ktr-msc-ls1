<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/styles.css">
    <title>Create your account</title>
</head>
<?php 
    require 'utils/conf.php';

    // error message collection, triggered via get param
    if(isset($_GET['status']) && !empty($_GET['status'])) {
        if($_GET['status'] === "created") {
            $message = $_SESSION['user']." created !";
            $class = 'btn-success';
        } 
        if($_GET['status'] === "card_created") {
            $message = "The card have been created !";
            $class = 'btn-success';
        } 
        if($_GET['status'] === "user_exists") {
            $message = "The User already exists !";
            $class = 'btn-warning';
        } 
    } else {
        $message = null;
        $class = null;
    }

    echo '<div class="container my-3 notif btn '.$class.'" >'.$message.'</div>';
?>