<?php
include "PDOext.php";
error_reporting(0);
session_start();
ob_start();
$db = new PDOext("localhost","friend","root","");