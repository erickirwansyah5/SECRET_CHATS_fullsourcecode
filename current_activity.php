<?php 
header('Access-Control-Allow-Origin:*');
include 'koneksi.php';
session_start();
$query = "UPDATE login_details SET last_activity = now() WHERE login_details_id='".$_SESSION['login_details_id']."'";

$stmt = $conn->prepare($query);
$stmt->execute();
 ?>