<?php 
session_start();
header('Access-Control-Allow-Origin:http:*');
include 'koneksi.php';
// fetch history cipher 
if(isset($_POST['fetch_userhistorycipher'])) {
	$stmt = $conn->prepare('SELECT * from login WHERE user_id != :user_id order by user_id ASC');
	$data= [':user_id' => $_SESSION['user_id']];
	$stmt->execute($data);
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$output ='<select name="user" id="user" class="form-control">
       					<option selected>-Pilih User-</option>';
	foreach($result as $row) {
		$output .='
       				<option value="'.$row["user_id"].'">'.$row["username"].'</option>
       			';
	}
	$output .='
       			</select>';
    echo $output;
}
if(isset($_POST['historycipher'])) {
	$stmt = $conn->prepare("SELECT * from chat_message WHERE (from_user_id = :from_user_id AND to_user_id = :to_user_id and kunci != :kunci) OR (from_user_id = :to_user_id AND to_user_id = :from_user_id and kunci != :kunci) ORDER BY chat_message_id ASC");
	$data  = [
		':to_user_id' => $_POST['uid'],
		':from_user_id'=> $_SESSION['user_id'],
		':kunci'=> 0
	];
	$stmt->execute($data);
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$output = "
		<table class='table table-bordered table-striped'>
		<tr>
					<th>message</th>
					<th>Key</th>
					<th>timestamp</th>
		</tr>	
	    	";
		foreach($result as $row)
		{
			$output .= '<tr>
				<td>'.$row["chat_message"].'</td>
				<td>'.$row["kunci"].'</td>
				<td>'.$row["waktustamp"].'</td>
			</tr>
			';
		}
		$output .= '</table>';
		echo $output;
}

 ?>