<?php 
session_start();
header('Access-Control-Allow-Origin:http:*');
include 'koneksi.php';

if(isset($_POST['ubah_data'])) {
	$message ="";
	$query = "UPDATE login SET username=:username,img=:img,email=:email WHERE user_id=:user_id";
	$stmt = $conn->prepare($query);
	$data= array(
		':username' => $_POST['ubah_data'],
		':email' => $_POST['email'],
		':img' => $_POST['img'],
		':user_id' => $_SESSION['user_id']
	);
	if($stmt->execute($data)){
		$message="Data Berhasil DiUpdate";
	}

	if(!empty($_POST['pwd'])) {
		$query = "UPDATE login SET password=:password WHERE user_id=:user_id";
		$stmt = $conn->prepare($query);
		$data= array(
			':password' => $_POST['pwd'],
		);
		$stmt->execute($data);
	}
	echo $message;
}

 ?>