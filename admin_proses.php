<?php 
session_start();
header('Access-Control-Allow-Origin:http:*');
include 'koneksi.php';

if(isset($_POST['to_user_id'])) {
    echo fetch_user_chat_history($_SESSION['user_id'],$_POST['to_user_id'],$conn);
}

if(isset($_GET['deleteChat'])){
	$query = "DELETE FROM chat_message WHERE chat_message_id= ".$_GET['deleteChat'];
	$stmt = $conn->prepare($query);
	$stmt->execute();
}

if(isset($_POST['fetch_all_chat'])) {
	$query = "SELECT * FROM chat_message ORDER BY chat_message_id ASC";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	$result = $stmt->fetchAll();
	$output['total_message'] = count($result)." Chats";
	$output['chat_traffic']='';
	foreach($result as $row) {
		$output["chat_traffic"] .= '<div class="d-flex justify-content-center mb-3">
								<div class="msg_container_">'.get_user_name($row["from_user_id"],$conn).' Mengirim Pesan Kepada '.get_user_name($row["to_user_id"],$conn).'...<small><em> <b>'.$row["waktustamp"].'</b></em></small></div>
							</div>';
	}  
	$output['chat_traffic'] .= fetch_user_activity($conn);
	echo json_encode($output);                                                                
}
if(isset($_POST['msg1'])) {
	// $current= strtotime(date('Y-m-d H:i:s'));
	if($_POST['key1'] !=='') 
		{
			$chat = do_ecrypting($_POST['msg1'],$_POST['key1']);
			$key = $_POST['key1'];
		}else {
			$chat = $_POST['msg1'];
			$key = 0;
		}
		// var_dump($chat);
	$current = date('d F, Y (l)');
	$data = array(
		':to_user_id'  => $_POST['to_user_id1'],
		':from_user_id' => $_SESSION['user_id'],
		':chat_message' => $chat,
		':status'	=> '1',
		':imgsrc' => $_POST['imgsrc1'],
		':waktustamp' => $current,
		':status' => 1,
		':kunci' => $key
	);

	$query = "INSERT INTO chat_message (to_user_id,from_user_id,chat_message,imgsrc,waktustamp,status,kunci) VALUES(:to_user_id,:from_user_id,:chat_message,:imgsrc,:waktustamp,:status,:kunci)";
	$stmt = $conn->prepare($query);
	if($stmt->execute($data)) {
		echo fetch_user_chat_history($_SESSION['user_id'],$_POST['to_user_id1'],$conn);
	}else {
		echo "gagal";
	}
}
// date_default_timezone_set('Asia/jakarta');

// date_default_timezone_set('Asia/jakarta');

/*admin function */

if(isset($_POST['fetch_banned_user'])) {
	$stmt = $conn->prepare('SELECT * FROM login WHERE user_id= :user_id ORDER BY user_id ASC');
	$data = [':user_id' => $_POST['fetch_banned_user']];
	$stmt->execute($data);
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$output['user_id'] ="";
	$output['username'] ="";
	$output['email'] ="";

	foreach($result as $row)
	{
		$output['user_id'] .= $row['user_id'];
		$output['username'] .= $row['username'];
		$output['email'] .= $row['email'];
	}
	echo json_encode($output);
}

if(isset($_POST['deleteUser'])) {
	$stmt= $conn->prepare("UPDATE report set status = :status WHERE id_user = :id_user");
	$data= [
		':status' => 0,
		':id_user' => $_POST['deleteUser']
	];
	$stmt->execute($data);
	if($stmt->rowCount() > 0 )
	{
		$query = "DELETE FROM login WHERE user_id = :user_id";
		$data = [':user_id' => $_POST['deleteUser']];
		$stmt = $conn->prepare($query);
		$data = [':user_id' => $_POST['deleteUser']];
		$execute = $stmt->execute($data);
		if($execute){
			$data['pesan'] = "berhasil";
		}else{
			$data['pesan'] = "gagal";
		}
			
	}else {
		$data['pesan'] = "gagal";
	}
	
	echo json_encode($data);
}

if(isset($_POST['hislap'])){
	$stmt = $conn->prepare("SELECT * FROM report");
 	$stmt->execute();
 	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
 
 	 $output='<table id="hislap" class="table table-bordered table-striped">
				<tr>
					<th>Terlapor</th>
					<th>Ket</th>
					<th>Pelapor</th>
					<th>Status</th>
				</tr>';
 		$no=1;
 		foreach($result as $row)
 		{
 			if($row['status'] == 0){
 				$status = "<b style='color:green'>Approve</b>";
 			}else{
 				$status = "<b style='color:orange'>Pending</b>";
 			}
 			$output .= '
				<tr>
					<td style="color:salmon;">'.$row["username"].'</td>
					<td>'.$row["ket"].'</td>
					<td>'.get_user_name($row["id_pelapor"],$conn).'</td>
					<td>'.$status.'</td>
				</tr>
 			';
 		}
 		$output .= '</table>';
 		echo $output;
}

if(isset($_POST['load_notifikasi'])){
	$stmt = $conn->prepare('SELECT * FROM report where status = :status limit 10');
	$data= [':status' => 1];
	$stmt->execute($data);
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$output['notif'] = count($result);
 	$output['dropdown']="";
 	foreach($result as $row) 
 	{
 	$output['dropdown'] .= '<a class="dropdown-item pesan" data-idterlapor="'.$row["id_user"].'" data-idpelapor="'.$row["id_pelapor"].'" href="#" id="'.$row["id_user"].'"><strong>'.$row["username"].'</strong><br><em>'.$row["ket"].'</em></a>
				<div class="dropdown-divider"></div>';
 	}
 	echo json_encode($output);
}

/*end admin function */

