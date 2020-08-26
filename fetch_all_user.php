<?php 
header('Access-Control-Allow-Origin:http:*');
include 'koneksi.php';
session_start();
if(isset($_POST['data'])) {
$query = "SELECT * FROM login WHERE user_id != '".$_SESSION['user_id']."'";
$stmt = $conn->prepare($query);
$stmt->execute();
$result= $stmt->fetchAll();
$output="";
foreach($result as $row) {
	$status="";
	$current= strtotime(date('Y-m-d H:i:s'). '-10 second');
	$current = date('Y-m-d H:i:s',$current);
	$user_last_activity = fetch_user_last_activity($row['user_id'],$conn);
	if($user_last_activity > $current){
		$status="online";
	}else {
		$status="offline";
	}
	if($row['img'] == null ) {
    	$img='img/user1.png';
	}else{
		$img = $row['img'];
	}

	$output .='<div class="d-flex bd-highlight mb-2" id="user_dialog" style="position:relative;">
							<span class="fas fa-exclamation-triangle" id="report" style="position:absolute;right:0;top:0; color:#fff; cursor:pointer;" data-toggle="modal" data-target="#exampleModal2" data-placement="right" title="Laporkan User" data-touserid="'.$row["user_id"].'"></span>
							<div class="img_cont">
										<img src="'.$img.'" class="rounded-circle user_img">
										<span class="online_icon '.$status.'"></span>
									</div>
									<div class="user_info" data-touserid="'.$row["user_id"].'" data-tousername="'.$row["username"].'">
										<span>'.$row["username"].' '.count_unseen_message($row["user_id"],$_SESSION["user_id"],$conn).'</span>
										<p>'.$row["username"].' is '.$status.'<br>
											
										</p>											
									</div>
								</div>';
	}
	//'.fetch_is_type_status($row['user_id'],$conn).'
	echo $output;
}
if(isset($_POST['fetch_all_user'])) {
	$query = "SELECT * FROM login";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	$result= $stmt->fetchAll();
	$output="";
	foreach($result as $row) {
		$status="";
		$current= strtotime(date('Y-m-d H:i:s'). '-10 second');
		$current = date('Y-m-d H:i:s',$current);
		$user_last_activity = fetch_user_last_activity($row['user_id'],$conn);
		if($user_last_activity > $current){
			$status="online";
		}else {
			$status="offline";
		}
		if($row['img'] == null ) {
			$img='img/user1.png';
		}else{
			$img = $row['img'];
		}
		$output .='<div class="d-flex bd-highlight mb-2" id="banned" style=":position:relative">
		 <span id="banned" class="text-right fas fa-trash" data-id="'.$row["user_id"].'" data-username="'.$row["username"].'" style="position:absolute;right:25px;color:#fff;cursor:pointer;"  data-toggle="modal" data-target="#exampleModal1"></span>
								<div class="img_cont">
											<img src="'.$img.'" class="rounded-circle user_img">
											<span class="online_icon '.$status.'"></span>
										</div>
										<div class="user_info" data-id="'.$row["user_id"].'" data-username="'.$row["username"].'">
											<span>'.$row["username"].'</span>
												<p>'.$row["username"].' is '.$status.'<br>
											</p>
										</div>
									</div>';
		}
		echo $output;
}

 ?>