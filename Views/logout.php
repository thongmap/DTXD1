<?php
session_start();
require_once ('../controllers/home_controller.php');
$homecontroll = new HomeController();
$homecontroll->DeleteUnsave();
session_destroy();
ob_clean();
header("location:login.php");