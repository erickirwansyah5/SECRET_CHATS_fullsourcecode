<?php 
session_start();
header('Access-Control-Allow-Origin:http:*');
include 'koneksi.php';


if(isset($_POST['self_info'])) {
	$query = "SELECT * FROM login WHERE user_id= :user_id";
	$stmt = $conn->prepare($query);
	$data = array(
		':user_id' => $_POST['self_info']
	);
	$stmt->execute($data);
	$result = $stmt->fetchAll();
	$output['username'] = "";
	$output['user_id'] ="";
	$output['password'] ="";
	$output['img']="";
	$output['email']="";
	foreach($result as $row) {
		if($row['img'] == ''){
			$output['img'] = 'img/user.png';
		}else{
			$output['img'] = $row['img'];
		}
		$output['username'] .= $row['username'];
		$output['user_id'] .=$row['user_id'];
		$output['password'] .=$row['password'];
		$output['email'] .=$row['email'];
	}
	echo json_encode($output);
}

if(isset($_POST['load_self_info'])) {
	$query = "SELECT * FROM login WHERE user_id = :user_id";
	$stmt = $conn->prepare($query);
	$data= [
		':user_id' => $_SESSION['user_id']
	];
	$stmt->execute($data);
	$result = $stmt->fetchAll();
	$output="";
	if($stmt->rowCount() > 0) {
		foreach($result as $row) {
			if($row['img'] == null ) {
				$img='img/user1.png';
			}else{
				$img = $row['img'];
			}
			$output .= '<div class="d-flex bd-highlight">
								<div class="img_cont">
									<img src="'.$img.'" class="rounded-circle user_img">
									<span class="online_icon" id="imgSender"></span>
								</div>
								<div class="self_info" id="'.$row["user_id"].'" data-toggle="modal" data-target="#exampleModal1">
									<span>Me</span>
									<p>You Are Online<p>
								</div>
							</div>';
		}
	}
	echo $output;
}





 ?>