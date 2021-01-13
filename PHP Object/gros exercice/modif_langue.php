<?php
session_start();
var_dump($_POST);
if (isset($_POST['langue']) && isset($_POST['location'])) {
    $_SESSION['langue'] = $_POST['langue'];
    header("Location:./".$_POST['location']."");
}