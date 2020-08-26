<?php 

header('Access-Control-Allow-Origin:*');
$conn = new PDO("mysql:host=sql309.epizy.com;dbname=epiz_23640433_updatedb;charset=utf8mb4","epiz_23640433","YLDVi3WJKe");
// $conn = mysqli_connect('sql309.epizy.com','epiz_23640433','YLDVi3WJKe','epiz_23640433_secret_chat');

function fetch_user_last_activity($user_id,$conn) {
	$query = "SELECT * FROM login_details WHERE user_id = '$user_id'
		ORDER BY last_activity DESC LIMIT 1
	";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	$result=$stmt->fetchAll();
	foreach($result as $row) {
		return $row['last_activity'];
	}
}

function fetch_user_chat_history($from_user_id,$to_user_id,$conn) {
	$query = "SELECT * FROM chat_message WHERE (from_user_id='".$from_user_id."' AND to_user_id = '".$to_user_id."')
		OR (from_user_id='".$to_user_id."' AND to_user_id = '".$from_user_id."')
		ORDER BY chat_message_id ASC";
	$stmt= $conn->prepare($query);
	$stmt->execute();
	$result = $stmt->fetchAll();
	$output = "<ul class='list-unstyled'>";
	
	foreach($result  as $row) {
		$user_name ='';
		if($row['from_user_id'] == $from_user_id) {
			$query2="SELECT * FROM login WHERE user_id=:user_id";
			$stmt= $conn->prepare($query2);
			$data=array(':user_id'=>$from_user_id);
			$stmt->execute($data);
			$result1 = $stmt->fetch(PDO::FETCH_ASSOC);
			$imgSender = $result1['img'];
			$profil =$imgSender;
			$user_name ='<b class="text-success">You</b>';
			$purpose='self';
			$content='end';
			$container='send';
			$removeChattButton='<span class="btn_removeChat"><a href="#" id="'.$row["chat_message_id"].'" class="removeChat">Delete Chat</a></span>';
		}else{
			$query3= "SELECT * FROM login WHERE user_id=:user_id";
			$stmt= $conn->prepare($query3);
			$data=array(':user_id'=>$to_user_id);
			$stmt->execute($data);
			$result2= $stmt->fetch(PDO::FETCH_ASSOC);
			$imgReciver = $result2['img'];
			$profil= $imgReciver;
			$container='';
			$removeChattButton="";
			$purpose='friend';
			$content='start';
			$user_name = '<b class="text-danger">'.get_user_name($row['from_user_id'],$conn).'</b>';
		}
		if($row['imgsrc'] !== null) {
			$img='<a href='.$row["imgsrc"].' target="_blank"><img src='.$row["imgsrc"].' width="100" height="100"></a><br>';
			
		}else{
			$img='';
		}
		if($profil =="" ){
			$profil="img/group.png";
		}
		$output .='<div class="chat">
			<div class="chats '.$purpose.'">
				<div class="user-photo" ><img src="'.$profil.'" class="rounded-circle user_img text-center" style="margin-top:0px;width:100%;height:100%"></div>
				<p class="chat-message">'.$row["chat_message"].'<br>
				'.$img.'
				</p><br>'.$removeChattButton.'
				<span class="msg_time2_'.$container.'">'.$row["waktustamp"].'</span>
			</div>';
	}
	$output .= "</ul>";
	// $query ="
	// 	UPDATE chat_message SET status='0'
	// 	WHERE from_user_id ='".$to_user_id."' AND to_user_id = '".$from_user_id."' AND status= '1'";
	// $stmt = $conn->prepare($query);
	// $stmt->execute();
	return $output;
}

function get_user_name($user_id,$conn) {
	$query = "SELECT username FROM login WHERE user_id='$user_id'";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	$result = $stmt->fetchAll();
	foreach($result as $row) {
		return $row['username'];
	}
}

function count_unseen_message($from_user_id,$to_user_id,$conn) {
	$query = "SELECT * FROM chat_message WHERE from_user_id = '$from_user_id' AND to_user_id ='$to_user_id' AND status='1'";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	$count = $stmt->rowCount();
	$output="";
	if($count > 0) {
		$output = '<span class="badge badge-success">'.$count.'</span>';
	}
	return $output;
}

function fetch_is_type_status($user_id,$conn) {
	$query ="SELECT is_type FROM login_details WHERE user_id = '".$user_id."' ORDER BY last_activity DESC LIMIT 1";
	$stmt= $conn->prepare($query);
	$stmt->execute(); 
	$output ="";
	$result = $stmt->fetchAll();
	foreach($result as $row) {
		if($row['is_type'] == 'yes') {
			$output .= '<small><em><span style="font-size:10px;color:#fff;">Sedang Menulis Pesan...</span></em></small>';
		}
	}
	return $output;
}
function fetch_user_activity($conn){
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
		if($user_last_activity> $current){
			$status="Memasuki Obrolan";
			$color="in";
		}else {
			$status="Meniggalkan Obrolan";		
			$color="out";
		}
		$output .= '<div class="d-flex justify-content-center mb-3">
								<div class="msg_container_'.$color.'">'.$row["username"].' '.$status.'</div>
							</div>';
	}
	return $output;
}


/*do_chat*/


	function encrypt($data,$key) {

		if(!ctype_alpha($data))
			return $data;
		$offset = ord(ctype_upper($data) ? 'A':'a');
		$hasil = chr(fmod(((ord($data) + $key) - $offset), 26) + $offset);
		return $hasil;

	}

	function do_ecrypting($plaintext,$key)
    {
    	$output ='';
    	$input = str_split($plaintext);
    	foreach($input as $data) 
    		$output .= encrypt($data,$key);
    	return $output;
	}

	

/*end do_chat*/


/*proses enkripsi dan dekripsi*/


	function rubahangka($msg)
	{
		$output ="<table border='1'>";
		foreach($msg as $m)
		$output .= "<td>".ord($m)."</td>";
		$output .= "</table>";
		return $output;
	}

	function geserkanan($msg,$key)
	{
		$output ='<table border="1">';
    	$input = str_split($msg);
    	foreach($input as $data) 
    		$output .= "<td>".ord(encrypt2($data,$key))."</td>";
    	$output .="</table>";
    	return $output;
	}

	function encrypt2($data,$key) {

		if(!ctype_alpha($data))
			return $data;
		$offset = ord(ctype_upper($data) ? 'A':'a');
		$hasil = chr(fmod(((ord($data) + $key) - $offset), 26) + $offset);
		return $hasil;

	}

	function rubahAlfabet($plaintext,$key)
    {
    	$output ='';
    	$input = str_split($plaintext);
    	foreach($input as $data) 
    		$output .= encrypt2($data,$key);
    	return $output;
	}


	function rubahAlfabet2($plaintext2,$key) 
	{
		return rubahAlfabet($plaintext2,26 -$key);
	}

	function dekrip($data,$key) {

		if(!ctype_alpha($data))
			return $data;
		$offset = ord(ctype_upper($data) ? 'A':'a');
		$hasil = chr(fmod(((ord($data) + $key) - $offset), 26) + $offset);
		return $hasil;

	}

	function geserkiri($plaintext,$key)
    {
    	$output ='<table border="1">';
    	$input = str_split($plaintext);
    	foreach($input as $data) 
    		$output .= "<td>".ord(dekrip($data,26 -$key))."</td>";
    	$output .="</table>";
    	return $output;
	}