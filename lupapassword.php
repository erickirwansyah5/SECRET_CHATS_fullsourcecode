<?php 
session_start();
header('Access-Control-Allow-Origin:http:*');
include 'koneksi.php';

if(isset($_POST['lupapassword'])) {
	$query= "SELECT password FROM login WHERE email = :email";
	$stmt = $conn->prepare($query);
	$data= [
		':email' => $_POST['lupapassword']
	];
	$stmt->execute($data);
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	if($stmt->rowCount() > 0) {
		$data['password']= base64_decode($result['password']);	
	}else{
		$data['kosong']="Tidak Ada Data";
	}
    echo json_encode($data);
}


 ?>