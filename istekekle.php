<?php
include "config.php";
$id = $_GET["id"];

$query = $db->update("istekler","durum = 1","iid = '$id'");
$queryS = $db->select("istekler","WHERE","iid = '$id'");
$rowS = $queryS->fetch(PDO::FETCH_ASSOC);
$queryI = $db->insert("friends","my_id = '".$_SESSION['id']."', friend_id = '".$rowS["gonderen_id"]."'");
header("Location: my.php?id=".$_SESSION["id"]."");