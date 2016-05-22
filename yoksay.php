<?php
include "config.php";
$id = $_GET["id"];

$query = $db->delete("istekler","iid = '$id'");
header("Location: istekler.php?id=".$_SESSION["id"]."");
