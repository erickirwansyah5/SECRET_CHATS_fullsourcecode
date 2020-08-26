<?php 
include 'koneksi.php';
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
$message = "";
if(isset($_SESSION['user_id'])) {
	header('location: index.php');
}

	// if(isset($_POST['reset'])){
	// 	$email = $_POST['email'];
	// 	// var_dump($email);

	// 	$stmt = $conn->prepare("SELECT * FROM login WHERE email = :email");
	// 	$stmt->execute(['email'=>$email]);
	// 	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	// 	if($stmt->rowCount() > 0){
	// 		//generate code
	// 		// $set='123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	// 		// $code=substr(str_shuffle($set), 0, 15);
	// 		try{
	// 			// $stmt = $conn->prepare("UPDATE login SET reset_code=:code WHERE user_id=:id");
	// 			// $stmt->execute([':code'=>$code, ':user_id'=>$result['id']]);
				
	// 			$pesan = "
	// 				<h2>Forgot Password</h2>
	// 				<p>Your Account:</p>
	// 				<p>Email: ".$email."</p>
	// 				<p>Your Password : ".base64_decode($result['password'])."</br>
	// 			";

	// 			//Load phpmailer
	//     		require './vendor/autoload.php';

	// 	    		$mail = new PHPMailer(true);                             
	// 			    try {
	// 			        //Server settings
	// 			        // $mail->isSMTP();                                     
	// 			     //Server settings
	// 			        $mail->isSMTP();                                     
	// 				    $mail->Host = 'ssl://smtp.gmail.com:587';                      
	// 			        $mail->SMTPAuth = true;                               
	// 			        $mail->Username = 'erickirwansyah5a@gmail.com';     
	// 			        $mail->Password = '085267964065';
	// 			        echo $email->Password;  
	// 			        var_dump($mail->Username);                  
	// 			        var_dump($mail->password);                  
	// 			        $mail->SMTPOptions = array(
	// 			            'ssl' => array(
	// 			            'verify_peer' => false,
	// 			            'verify_peer_name' => false,
	// 			            'allow_self_signed' => true
	// 			            )
	// 			        );                         
	// 			        $mail->SMTPSecure = 'ssl';                           
	// 			        $mail->Port = 587;                                   

	// 			        $mail->setFrom('erickirwansyah5a@gmail.com');
				        
	// 			        //Recipients
	// 			        $mail->addAddress($email);              
	// 			        $mail->addReplyTo('erickirwansyah5a@gmail.com');
				       
	// 			        //Content
	// 			        $mail->isHTML(true);                                  
	// 			        $mail->Subject = 'secretchatapp forgot password';
	// 			        $mail->Body    = $pesan;

	// 		        if($mail->send()){
	// 		        	echo $email->Password;
	// 		        	var_dump($mail);
	// 		        	var_dump($mail->Password);
	// 		        	var_dump($mail->Username);
	// 		        $message='<div class="alert alert-success mt-2" role="alert">
	// 				  <b>Password recover has been send to your email</b>
	// 				</div>';
	// 				}else{
	// 					$message='<div class="alert alert-danger mt-2" role="alert">
	// 					  <b>Password recover has been send to your email</b>
	// 					</div>';
	// 				}
			        
			     
	// 		    } 
	// 		    catch (Exception $e) {
	// 		        $message='<div class="alert alert-danger mt-2" role="alert">
	// 				  <b>Unable to send email '.$mail->ErrorInfo.'</b>
	// 				</div>';
	// 		    }
	// 		}
	// 		catch(PDOException $e){
	// 			$message='<div class="alert alert-danger mt-2" role="alert">
	// 				  <b>'.$e->getMessage().'</b>
	// 				</div>';
	// 		}
	// 	}
	// 	else{
	// 		$message='<div class="alert alert-danger mt-2" role="alert">
	// 				  <b>Email not found</b>
	// 				</div>';
	// 	}
	// }

if(isset($_POST['login'])){
	$query = "SELECT * FROM login WHERE username = :username";
	$stmt = $conn->prepare($query);
	$stmt->execute(
			array(':username' => $_POST['username'])
		);
	$count = $stmt->rowCount();
	if($count > 0) {
		$result = $stmt->fetchAll();
		foreach($result as $row) {
			if(base64_encode($_POST['password']) == $row['password']) {
			 	$_SESSION['user_id'] = $row['user_id'];
			 	$_SESSION['username'] = $row['username'];
			 	$_SESSION['img'] = $row['img'];
			 	$sub_query = "INSERT INTO login_details(user_id) 
			 	VALUES ('".$row['user_id']."')";
			 	$stmt = $conn->prepare($sub_query);
			 	$stmt->execute();
			 	$_SESSION['login_details_id'] = $conn->lastInsertId();
			 	header('location: index.php');

			}else{
				$message='<div class="alert alert-danger mt-2" role="alert">
					  <b>Password Salah</b>
					</div>';
			}
		}
	}else{
		$message='<div class="alert alert-danger mt-2" role="alert">
					  <b>Username dan Password Tidak Tersedia</b>
					</div>';
	}
}
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login To Chat</title>
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
				<p class="text-center">Form Login</p>
				<table class="table">
					<tr>
						<td align="center">
							<a style="text-decoration: none;" href="login admin.php">Masuk Sebagai Admin</a>
						</td>
					</tr>
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
						
						<td class="text-center">Belum Punya Akun? <a href="register.php" class="daftar"><i class="fa fa-register"></i>Daftar</a><br>
						<a data-toggle="modal" data-target="#exampleModal1" style="text-decoration: none;" href="#">Lupa Password?</a> <br>
						
					</td>
					</tr>
					
			</table>
			</div>		
			
		</div>
	</div>
</body>
</html>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script>
	$(document).on('click','#prosess',function() {
		const email = $('#email').val() ;
		if(email == "") {
			alert('Silahkan Masukan Email Anda!');
		}else{
			$.ajax({
				url: 'lupapassword.php',
				method: 'post',
				data: {lupapassword:email},
				dataType: 'json',
				success:function(data){
					if(data.password) {
						$('#password').val(data.password)
					}else {
						alert(data.kosong);
					}
				}
			})
		}
	})
</script>

<!-- modal lupa password -->
<!-- Modal -->
<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<!-- <form action="" method="post"> -->
      Masukan Email Anda:
      <input type="text" id="email"name="email" class="form-control mt-2">	
      <input type="text" id="password" name="password" class="form-control mt-2">	
       </div>
      <div class="modal-footer">
        <button type="submit" name="reset" id="prosess" class="btn btn-primary" >Prosess</button>
       <!-- </form> -->
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
      </div>
    </div>
  </div>
</div>
<!-- end modal lupa password -->
<?php 

 ?>