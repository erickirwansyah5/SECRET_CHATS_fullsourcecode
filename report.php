<?php 
session_start();
header('Access-Control-Allow-Origin:http:*');
include 'koneksi.php';
if(isset($_POST['select_report_user'])) {
	$query = "SELECT * FROM login WHERE user_id = :user_id";
	$data = [
		":user_id" => $_POST['select_report_user']
	];
	$stmt = $conn->prepare($query);
	$stmt->execute($data);
	$result = $stmt->fetchAll();
	$output['user_id'] ="";
	$output['username'] ="";
	if($stmt->rowCount() > 0 ) {
		foreach($result as $row) {
		$output['user_id'] .= $row['user_id'];
		$output['username'] .= $row['username'];
	  } 
	}
	echo json_encode($output);
}

if(isset($_POST['laporkan'])) {
	$query= "SELECT * FROM report WHERE id_user = :user_id and id_pelapor = :id_pelapor";
	$stmt = $conn->prepare($query);
	$data=[
		":user_id" =>$_POST['user_id'],
		":id_pelapor"=> $_SESSION['user_id']
	];
	$stmt->execute($data);
	if($stmt->rowCount() > 0) {
		$output="Anda Sudah Melaporkan User Ini";
	}else{
		$query="INSERT INTO report(id_pelapor,id_user,username,ket,status) VALUES(:id_pelapor,:id_user,:username,:ket,:status)";
		$stmt = $conn->prepare($query);
		$data= [
			":id_pelapor" => $_SESSION['user_id'],
			":id_user" => $_POST['user_id'],
			":username" => $_POST['laporkan'],
			":ket" => $_POST['ket'],
			":status" => "1"
		];
		if($stmt->execute($data)) {
			$output="User Berhasil Dilaporkan";
		}else{
			$output="User Gagal Dilaporkan";
		}

	}
	echo $output;
}


 ?>