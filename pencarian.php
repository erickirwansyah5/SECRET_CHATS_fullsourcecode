<?php 
session_start();
header('Access-Control-Allow-Origin:http:*');
include 'koneksi.php';
if(isset($_POST['keyword'])) { 
	$keyword =$_POST['keyword'];
	$query ="SELECT * FROM login WHERE username LIKE '%$keyword%'";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	$result = $stmt->fetchAll();
	$output = "";
	$status="";
	if($stmt->rowCount() > 0) {
		foreach($result as $row) {
			// $current= strtotime(date('Y-m-d H:i:s'). '-10 second');
			// $current = date('Y-m-d H:i:s',$current);
			// $user_last_activity = fetch_user_last_activity($row['user_id'],$conn);
			// if($user_last_activity > $current){
			// 	$status="online";
			// }else {
			// 	$status="offline";
			// }
			if($row['img'] == null ) {
				$img='img/user1.png';
			}else{
				$img = $row['img'];
			}
			$output .='<div class="d-flex bd-highlight mb-2" id="user_dialog">
								<div class="img_cont">
											<img src="'.$img.'" class="rounded-circle user_img">
											<span class=""></span>
										</div>
										<div class="user_info">
											<span>'.$row["username"].'</span>
											<p>
											</p>
											<i id="banned" class="text-right fas fa-trash" data-id="'.$row["user_id"].'" data-username="'.$row["username"].'"></i>
										</div>

									</div>';
		}

	}else {
		$output .= '<div class="d-flex bd-highlight mb-2" id="user_dialog">
			<p>Tidak Ada Records</p>
			</div></div>
		';
	}
	echo $output;
}
if(isset($_POST['searchUser'])) { 
	$keyword =$_POST['searchUser'];
	$query ="SELECT * FROM login WHERE username LIKE '%$keyword%'";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	$result = $stmt->fetchAll();
	$output = "";
	$status="";
	if($stmt->rowCount() > 0) {
		foreach($result as $row) {
			if($row['user_id']  !== $_SESSION['user_id']){
			// $current= strtotime(date('Y-m-d H:i:s'). '-10 second');
			// $current = date('Y-m-d H:i:s',$current);
			// $user_last_activity = fetch_user_last_activity($row['user_id'],$conn);
			// // echo $user_last_activity.">".$current;
			// if($current > $user_last_activity){
			// 	$status="online";
			// }else {
			// 	$status="offline";
			// }
			if($row['img'] == null ) {
				$img='img/user1.png';
			}else{
				$img = $row['img'];
			}
			$output .='<div class="d-flex bd-highlight mb-2" id="user_dialog">
								<div class="img_cont">
											<img src="'.$img.'" class="rounded-circle user_img">
											<span class=""></span>
										</div>
										<div class="user_info">
											<span>'.$row["username"].'</span>
											<p>
											</p>
											
										</div>

									</div>';
			}
			
		}

	}else {
		$output .= '<div class="d-flex bd-highlight mb-2" id="user_dialog">
			<p>Tidak Ada Records</p>
			</div></div>
		';
	}
	echo $output;
}

 ?>