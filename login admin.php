<?php 
include 'koneksi.php';
session_start();
$message = "";
if(isset($_SESSION['user_id'])) {
	header('location: index.php');
}
if(isset($_POST['login'])){
	$query = "SELECT * FROM admin WHERE username = :username";
	$stmt = $conn->prepare($query);
	$stmt->execute(
			array(':username' => $_POST['username'])
		);
	$count = $stmt->rowCount();
	if($count > 0) {
		$result = $stmt->fetchAll();
		foreach($result as $row) {
			if(base64_encode($_POST['password']) == $row['password']) {
			 	$_SESSION['admin_id'] = $row['admin_id'];
				$_SESSION['username'] = $row['username'];
			 	$_SESSION['img'] = $row['img'];
			 	$_SESSION['login_details_id'] = $conn->lastInsertId();
			 	header('location: admin.php');

			}else{
				$message='<div class="alert alert-danger mt-2" role="alert">
					  <b>Password Administrator Salah</b>
					</div>';
			}
		}
	}else{
		$message='<div class="alert alert-danger mt-2" role="alert">
					  <b>Username dan Password Administrator Tidak Tersedia</b>
					</div>';
	}
}
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Administrator Secret Chat</title>
	<link rel="icon" type="image/png" href="img/favicon.ico">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css">
	 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
	<style>
	body,html{
			height: 100%;
			margin: 0;
			background: #7F7FD5;
			/*background: url('https://secretchatapp.000webhostapp.com/Public/img/bg2.jpg');*/
	       background: -webkit-linear-gradient(to right, #91EAE4, #86A8E7, #7F7FD5);
	        background: linear-gradient(to right, #91EAE4, #86A8E7, #7F7FD5);
		}
.box{
	position: absolute;
	top: 50%;
	left: 50%;
	transform: translate(-50%,-50%);
	width: 400px;
	padding:40px;
	background: rgba(0,0,0,0.8);
	box-sizing: border-box;
	box-shadow: 0 15px 25px rgba(0,0,0,0.5);
	border-radius: 10px;

}

.box h2{
	margin:0 0 30px;
	padding: 0;
	color: #fff;
	text-align:center; 
}

.box .inputbox {
	position: relative;
}

.box .inputbox input{
	width: 100%;
	padding: 10px 0;
	font-size: 16px;
	color: #fff;
	letter-spacing: 1px; 
	margin-bottom: 30px;
	border: none;
	border-bottom: 1px solid #fff;
	outline: none;
	background: transparent;
	border-bottom: 
}

.box .inputbox label {
	position: absolute;
	top: 0;
	left: 0;
	letter-spacing: 1px; 
	padding: 10px 0;
	font-size: 16px;
	color: #fff;
	pointer-events: none;
	transition: .5s;
}
.box .inputbox input:focus ~ label,
.box .inputbox input:valid ~ label{
	top: -19px;
	left: 0;
	color: #03a9f4;
	font-size: 12px; 

}
.box button {
	background: transparent;
	border: none;
	outline: none;
	color: #fff;
	background: #03a9f4;
	padding: 10px 20px;
	cursor:pointer;
	border-radius: 5px;

}
.box .inputbox i{
	position: absolute;
	width: 100%;
	right:-300px;
	top:16px;
	color: #fff;
}
.box p {
	color: #fff;
}
.box a {
	text-decoration: none;
	color: #03a9f4;
}
	</style>
</head>
<body>
	<div class="container mt-5">
		<div class="row justify-content-center">
			<div class="col-md-4">
				<p class="text-center">Form Login Administrator</p>
				<table class="table">
				  <form method="post" action="">
				  	<tr>
				  		<td>
				  			<label for=""><?php if(isset($message)){echo $message;} ?></label>
				  		</td>
				  	</tr>
					<tr>
						<td><input type="text" name="username" class="form-control" placeholder="Username.."></td>
					</tr>
					<tr>
						<td><input type="password" name="password" class="form-control" placeholder="Password.."></td>

					</tr>
					<tr>
						<td> <button type="submit" class="btn btn-primary btn-block" name="login" ><i class="fa fa-location-arrow"></i> Login</button></td>
					</tr>
			   </form>
					<tr>
						
						<td class="text-center">
							<a style="text-decoration: none;" href="login.php">Masuk Sebagai User</a>
						
						
					</td>
					</tr>
					
			</table>
			</div>		
			
		</div>
	</div>
</body>
</html>

