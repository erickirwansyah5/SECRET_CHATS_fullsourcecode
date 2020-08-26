<?php 
session_start();
header('Access-Control-Allow-Origin:http:*');
include 'koneksi.php';

/*cek ketersedian username secara live*/

if(isset($_POST['value'])) {
	$keyword = $_POST['value'];
	$stmt = $conn->prepare("SELECT * FROM login WHERE username = '$keyword'");
	$stmt->execute();
	if($stmt->rowCount() == 0) {
		$data['info'] = 'tersedia';
		$data['pesan'] = "<i style='color:darkgreen;'>✔ Username tersedia</i>";
	}else{
		$data['info'] = 'tidak tersedia';
		$data['pesan']="<i style='color:red;'>❌ Username Sudah Terdaftar</i>";
	}
	echo json_encode($data);
}
if(isset($_POST['value2'])) {
	$keyword = $_POST['value2'];
	$stmt = $conn->prepare("SELECT * FROM login WHERE email = '$keyword'");
	$stmt->execute();
	if($stmt->rowCount() == 0) {
		$data['info'] = 'tersedia';
		$data['pesan'] = "<i style='color:darkgreen;'>✔ Email tersedia</i>";
	}else{
		$data['info'] = 'tidak tersedia';
		$data['pesan']="<i style='color:red;'>❌ Email Sudah Terdaftar</i>";
	}
	echo json_encode($data);
}






 ?>