<?php 
// date_default_timezone_set('Asia/jakarta');

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
if(isset($_POST['to_user_id'])) {
    echo fetch_user_chat_history($_SESSION['user_id'],$_POST['to_user_id'],$conn);
}

if(isset($_GET['deleteChat'])){
	$query = "DELETE FROM chat_message WHERE chat_message_id= ".$_GET['deleteChat'];
	$stmt = $conn->prepare($query);
	$stmt->execute();
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

if(isset($_POST['lupapassword'])) {
	$query= "SELECT password FROM login WHERE email = :email";
	$stmt = $conn->prepare($query);
	$data= [
		':email' => $_POST['lupapassword']
	];
	$stmt->execute($data);
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	if($stmt->rowCount() > 0) {
		$data['password']= base64_decode($result['password']);	
	}else{
		$data['kosong']="Tidak Ada Data";
	}
    echo json_encode($data);
}

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

/*proses dekripsi*/
if(isset($_POST['dekripsi'])) {
	$plaintext = htmlentities(strip_tags($_POST['dekripsi']));
	$key = htmlentities(strip_tags($_POST['key']));
	echo do_ecrypting($plaintext,26 -$key);
}
/*end proses dekripsi*/

/*hold enkripsi and dekripsi*/
// if(isset($_POST['holdenkripsi'])) {
// 	if($_POST['key'] == "") 
// 		{
// 			echo "<h1 style='text-align:center;'>Pesan Tidak Dienkripsi</h1>";
// 		}else {
// 	$output ="<a target='_blank' href='img/ascii.png'><img src='img/ascii.png' width='70%' height='70%'></a><br/>";
// 		$output .="Proses enkripsi caesar cipher<br>";
// 		$msg = str_split($_POST['holdenkripsi']);
// 		$output .= "<table border='1'>";
// 		foreach($msg as $m)
// 			$output .= "<td>".$m."</td>";
// 			$output.="</table>";
// 			$output .= "<br>karakter yang akan dienkripsi akan dipisahkan dan dirubah kedalam bentuk angka atau karakter ASCII<br/>";
// 			$output .= rubahangka($msg);//outputnya pesan dirubah ke angka
// 			$output .= "<br>kemudian pesan akan digeser kekanan sebanyak kunci, <b>kecuali karakter yang dilewatkan</b>. <em>Kunci yang digunakan = <b>".$_POST['key']."</b></em>, Hasil pergeserannya: <br>";
// 			$output .= geserkanan($_POST['holdenkripsi'],$_POST['key']);//outputnya angka digeser sebanyak kunci kecuali spasi
// 			$output .= "<br/>kemudian angka yang didapat akan kembali rubah ke bentuk huruf alfabet";
// 			$output .= '<table border="1"><td>'.rubahAlfabet($_POST['holdenkripsi'],$_POST['key']).'</td></table>';
// 			echo $output;
// 		}
// }

// if(isset($_POST['holddekripsi'])) {
	
// 		$output ="<a target='_blank' href='img/ascii.png'><img src='img/ascii.png' width='70%' height='70%'></a><br/>";
// 			$output .="Proses dekripsi caesar cipher<br>";
// 			$msg = str_split($_POST['holddekripsi']);
// 			$output .= "<table border='1'>";
// 			foreach($msg as $m)
// 				$output .= "<td>".$m."</td>";
// 			$output.="</table>";
// 			$output .= "<br>karakter yang akan didekripsi akan dipisahkan dan dirubah kedalam bentuk angka atau karakter ASCII<br/>";
// 			$output .= rubahangka($msg);//outputnya pesan dirubah ke angka
// 			$output .= "<br>kemudian pesan akan digeser kekiri sebanyak kunci, <b>kecuali karakter yang dilewatkan</b>. <em>Kunci yang digunakan = <b>".$_POST['key']."</b></em>, Hasil pergeserannya: <br>";
// 			$output .= geserkiri($_POST['holddekripsi'],$_POST['key']);//outputnya angka digeser sebanyak kunci kecuali spasi
// 			$output .= "<br/>kemudian angka yang didapat akan kembali rubah ke bentuk huruf alfabet";
// 			$output .= '<table border="1"><td>'.rubahAlfabet2($_POST['holddekripsi'],$_POST['key']).'</td></table>';

// 			echo $output;
// }

/*end hold enkripsi and dekripsi*/