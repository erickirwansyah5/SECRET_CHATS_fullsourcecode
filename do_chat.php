<?php 
header('Access-Control-Allow-Origin: *');
session_start();
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


 ?>