<?php 

$message = "";
include 'koneksi.php';
session_start();
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;
if(isset($_SESSION['user_id'])) {
	header('location: index.php');
}
if(isset($_GET['mode'])) {
	$message .= '<div class="alert alert-success mt-2" role="alert">
						  <b>Account activated, Please <a href="login.php"> Login</a></b>
						</div>';
// 	$code = htmlentities(strip_tags($_GET['code']));
// 	$user_id = $_GET['user'];
// 	$query = "SELECT * FROM login WHERE (user_id = :user_id and activate_code = :activate_code)";
// 	$stmt = $conn->prepare($query);
// 	$data = [':activate_code' => $code,':user_id' => $user_id];
// 	$stmt->execute($data);
// 	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
// 	if($stmt->rowCount() > 0) 
// 	{
// 		foreach($result as $row) {
// 		if($row['status'])
// 		{
// 			$message .= '<div class="alert alert-warning mt-2" role="alert">
// 						  <b>Account already activated, Please <a href="login.php"> Login</a></b>
// 						</div>';
// 		}else {
// 			$query = "UPDATE login SET status = :status WHERE user_id = :user_id";
// 			$stmt = $conn->prepare($query);
// 			if($stmt->execute([':status' => 1,':user_id' => $user_id]))
// 			{
// 				$message .= '<div class="alert alert-success mt-2" role="alert">
// 						  <b>Account activated - Email: <b>'.$row['email'].' Please <a href="login.php"> Login</a></b>
// 						</div>';
// 			}else {
// 				$message .= '<div class="alert alert-danger mt-2" role="alert">
// 						  <b>	Account is not activated </b>
// 						</div>';
// 			}
//     }
// }
// }else {
// 	$message .= '<div class="alert alert-danger mt-2" role="alert">
// 						  <b>Cannot activate account. Wrong code.</b>
// 						</div>';
// }
}

if(isset($_POST['register'])) {
	$username = htmlentities(strip_tags(
		ucwords($_POST['username'])));
	$password = htmlentities(strip_tags($_POST['password']));
	$email = htmlentities(strip_tags(strtolower($_POST['email'])));

	$query="SELECT username,email FROM login";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	foreach($result as $row) {
		if($row['username'] == $username) {
			$message .= '<div class="alert alert-danger mt-2" role="alert">
					  <b>Username Sudah Tersedia, Coba Yang Lain!</b>
					</div>';
		}else if($row['email'] == $email) {
			$message .= '<div class="alert alert-danger mt-2" role="alert">
					  <b>Email Sudah Tersedia, Coba Yang Lain!</b>
					</div>';
		}
	}
	if($message ==''){
	$set='123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$code=substr(str_shuffle($set), 0, 12);
	$stmt = $conn->prepare("INSERT INTO login (username, password, email, activate_code) VALUES (:username, :password, :email, :code)");
	$Newuser = [':username'=> $username,':email'=>$email, ':password'=>base64_encode($password),':code'=>$code];
				   
	if($stmt->execute($Newuser)){
		$message = '<div class="alert alert-success mt-2" role="alert">Data Berhasil Disimpan,Silahkan <a href="login.php" class="fas fa-register">Login</a>
					</div>';
	}else{
		$message = '<div class="alert alert-success mt-2" role="alert">Data Gagal Disimpan,Silahkan Coba Lagi Dalam Beberapa Saat!
				</div>';
		}
	}

}			   

	// //Load phpmailer


 //   }

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Sign Up To Chat</title>
	<link rel="icon" type="image/png" href="favicon.ico">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css">
	 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
	 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<style>
		body{
	margin:0;
	padding: 0;
	font-family: sans-serif;
	background: #7F7FD5;
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
.loader {
	position: fixed;
	display: none;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: url('img/ajax-loader3.gif') 50% 50% no-repeat rgb(249,249,249);
    opacity: .8;
}
	</style>
	</style>
</head>
<body>
<div class="container mt-5">
	<div class="loader"></div>
		<div class="row justify-content-center">
			<div class="col-md-4">
				<p class="text-center">Form Registrasi</p>
				<table class="table">
				  <form method="post" action="">
				  	<tr>
				  		<td>
				  			<label for=""><?php if(isset($message)){echo $message;} ?></label>
				  		</td>
				  	</tr>
					<tr>
						<td>
							<span class="tersedia"></span>
							<input type="text" name="username" class="form-control" placeholder="Username.." autocomplete="off" id="username" required></td>
					</tr>
					<tr>
						<td>
							<span class="tersedia2"></span>
							<input type="email" name="email" class="form-control" id="email" autocomplete="off" placeholder="Email.." required></td>
					</tr>
					<tr>
						<td>
							<span class="tersedia3"></span>
							<input type="password" name="password" class="form-control" id="password" placeholder="Password.." required></td>
					</tr>
					<tr>
						<td class="verif"><input type="checkbox" id="verif">Send Email Verification</td>
					</tr>
					<tr>
						<td> <button type="submit" class="btn btn-primary btn-block" id="register" name="register" ><i class="fa fa-location-arrow"></i> Registrasi</button></td>
					</tr>
			   </form>
					<tr>
						<td class="text-center">Sudah Punya Akun? <a href="login.php" class="daftar"><i class="fa fa-register"></i>Login</a></td>
						
					</tr>
			</table>
			</div>		
	</div>

	</div>
</body>
</html>
<script src="https://smtpjs.com/v3/smtp.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://www.gstatic.com/firebasejs/5.8.6/firebase.js"></script>
<script>
$('.verif').css('display','none')

	/*firebase initialization*/
 var config = {
		    apiKey: "AIzaSyALRGeFnQQ7tQDSpQRjtCjLbs4CYALkPXs",
		    authDomain: "secretchat-33d70.firebaseapp.com",
		    databaseURL: "https://secretchat-33d70.firebaseio.com",
		    projectId: "secretchat-33d70",
		    storageBucket: "secretchat-33d70.appspot.com",
		    messagingSenderId: "927419318874"
		  };
		  firebase.initializeApp(config);

		  function saveemail(email,password) {
			  firebase.auth().createUserWithEmailAndPassword(email, password).catch(function(error) {
					  // Handle Errors here.
					  var errorCode = error.code;
					  var errorMessage = error.message;
					  // ...
				});

			    
		  }


	$('#verif').on('change',function(){
		const email = $('#email').val()
		const pass = $('#password').val()
		saveemail(email,pass);
		$('.loader').css('display','block')
		setTimeout(function(){
			var user = firebase.auth().currentUser;

				user.sendEmailVerification().then(function() {
				alert('Email Verifikasi Berhasil Dikirim')
				}).catch(function(error) {
					  // An error happened.
				});	
			$('.loader').css('display','none')
			},5000)
		
	})	 
	$('#register').prop('disabled',true);
	$('#username').blur(function(){
		$('.tersedia').html('<img style="margin-left:10px; width:20px" src="img/ajax-loader2.gif">');
		var username = $(this).val();
		if(username !=='') {
				$.ajax({
				url: 'live_check.php',
				method: 'post',
				data: 'value='+username,
				dataType: 'json',
				success:function(data){
					$('.tersedia').html(data.pesan)
					if(data.info == 'tersedia'){
						$('#register').prop('disabled',false);
					}else {
						$('#register').prop('disabled',true);
					}
				}
				})	
		}else {
			$('.tersedia').html("<i style='color:red;'>❌ Username Is Required</i>")
		}

		
	})

	$('#email').blur(function(){
			$('.tersedia2').html('<img style="margin-left:10px; width:20px" src="img/ajax-loader2.gif">');
			var email = $(this).val();
			if(email !=='') {
					$('.verif').css({
						'display':'block',
						'transition':'0.1s'
					})
					$.ajax({
					url: 'live_check.php',
					method: 'post',
					data: 'value2='+email,
					dataType: 'json',
					success:function(data){
						 var atpos=email.indexOf("@");
						 var dotpos=email.lastIndexOf(".");
						 if (atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length)
						 {
						   $('.tersedia2').html("<i style='color:red;'>❌ Isi Email Dengan Benar</i>")
						 }else {
							$('.tersedia2').html(data.pesan)
							if(data.info == 'tersedia'){
								$('#register').prop('disabled',false);
							}else {
								$('#register').prop('disabled',true);
							}
						 }
						

					}
					})	
			}else {
				$('.tersedia2').html("<i style='color:red;'>❌ Email Is Required</i>")
			}

	})

	$('#email').blur(function(){
		var x=$(this).val()
		 var atpos=x.indexOf("@");
		 var dotpos=x.lastIndexOf(".");
		 if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
		 {
		   $('.tersedia2').html("<i style='color:red;'>❌ Isi Email Dengan Benar</i>")
		 }
	})

	$('#password').on('input',function(){
			if(this.value.length < 8) {
				$('.tersedia3').html("<i style='color:red;'>❌ Password Kurang Dari 8 Karakter</i>")
				$('#register').prop('disabled',true);
			}else {
				$('.tersedia3').html("<i style='color:darkgreen;'>✔ Password Siap</i>")
				$('#register').prop('disabled',false);
			}
		})

</script>