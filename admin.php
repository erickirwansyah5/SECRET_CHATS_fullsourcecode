<?php 
include 'koneksi.php';

 ?>
<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Administrator Secret Chat</title>
	 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
	<!-- <script type="text/javascript" src="js/jquery.js"></script> -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.1/emojionearea.min.css">
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
	 <link rel="stylesheet" type="text/css" href=" https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/base/jquery-ui.css">
	 <link rel="stylesheet" href="styles.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<style type="text/css">
		.notif{
			position: absolute;
			right: 50px;
			color: #fff;
			top: 7px;
			cursor: pointer;
		}
	</style>
	</head>
	<!--Coded With Love By Mutiullah Samim-->
	<body>
		<div id="chattingan" class="container-fluid h-100">
			<div class="row justify-content-center h-100">
				<div class="col-md-4 col-xl-3 chat"><div class="card mb-sm-3 mb-md-0 contacts_card">
					<div class="card-header">
						<div class="input-group">
							<input type="text" placeholder="Search..." name="" class="form-control search" id="searchUser">
							<div class="input-group-prepend">
								<span class="input-group-text search_btn"><i class="fas fa-search"></i></span>
							</div>
						</div>
					</div>
					
					<div class="card-body contacts_body">
						<ui class="contacts">
							<li id="kontak">
								
							</li>
						</ui>
					</div>
			    
					<div class="card-footer"></div>
				</div></div>
				<div class="col-md-8 col-xl-6 chat">
					<div class="card">
						<div class="card-header msg_head">
							<div class="d-flex bd-highlight">
								<div class="img_cont">
									<img src="img/group.png" class="rounded-circle user_img">
									<span class="online_icon"></span>
								</div>
								<div class="user_info" id="totalChat">
									<span>Administrator Chat</span>
									<p id="total_messages"></p>
								</div>
							</div>
		
										
							<div class="dropdown notif mb-2" id="notif" style="position: absolute; right: 75px; top: 45px;" >
								  <a class="btn btn-custom dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								  	<i class="fas fa-bell" style="font-size: 24px; color: #fff"><span class="badge badge-primary notifikasi m-1"></span></i>
								  </a>
									<span class="badge badge-light" id="badge"></span>
								  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">

								  </div>
								</div>			


							
							<span id="action_menu_btn"><i class="fas fa-ellipsis-v"></i></span>
							<div class="action_menu">
								<ul>
									<li id="history" data-toggle="modal" data-target="#exampleModal2"><i class="fas fa-user-circle"></i> History Laporan</li>
									<li><i class="fas fa-ban"></i> <a onclick="return confirm('Are you sure want to exit?')" style="text-decoration: none; color: #fff;" href="logoutadm.php">Logout</a></li>
								</ul>
							</div>
						</div>
						<div class="card-body msg_card_body"></div>
					</div>
				</div>



 
	</body>
</html>
<script>
	$(document).ready(function() {

$('#action_menu_btn').click(function(){
		$('.action_menu').toggle();
});

setInterval(function(){
	loadAktifitas()
	load_notifikasi();
	loadDataUser();
},5000)

function scrollToBottom(){
			var cc = $('.msg_card_body');
            var dd = cc[0].scrollHeight;
            cc.animate({
               scrollTop: dd
                }, 500);
		}
$(document).on('click','#banned',function() {
			const fetch_banned_user = $(this).data('id');
			$.ajax({
				url: 'admin_proses.php',
				method: "POST",
				data: {fetch_banned_user:fetch_banned_user},
				dataType: "json",
				success:function(data) {
					console.log(data);
					$('#user_id').val(data.user_id)
	            	$('#username').val(data.username)
		            $('#email').val(data.email);
				}
			});
		})

$(document).on('click','#bannedbutton',function() {
	const deleteUser = $('#user_id').val(); 
	$.ajax({
		url:"admin_proses.php",
		method: "post",
		data:{deleteUser:deleteUser},
		dataType: 'json',
		success:function(data) {
			if(data.pesan == 'berhasil')
			{
			   alert('User Dengan ID '+ deleteUser + " Berhasil Dibanned");
			}else {
				alert('User Dengan ID '+ deleteUser + " Gagal Dibanned");
			}

		}
	});

	
})

$('#history').on('click',function() {
	const hislap = 'history laporan';
	$.ajax({
		url: "admin_proses.php",
		method: "post",
		data:{hislap:hislap},
		success:function(data)
		{
			$('.hislap').html(data);
		}
	});
});

function loadDataUser() {
			const user ="fetch_all_user";
			$.ajax({
				url: 'fetch_all_user.php',
				method: 'post',
				data: {fetch_all_user:user},
				success:function(data) {
					// const data = JSON.parse(Alldata);
					$('#kontak').html(data);
					// $('.msg_card_body').html(data.infoLog);
				}
			});
		}

function loadAktifitas() {
			const fetch_chat ="fetch_all_chat";
			$.ajax({
				url: 'admin_proses.php',
				method:'post',
				data: {fetch_all_chat:fetch_chat},
				success:function(Alldata) {
					const data = JSON.parse(Alldata);
					$('.msg_card_body').html(data.chat_traffic);
					$('#total_messages').html(data.total_message);
					scrollToBottom();
				}
			});
		}

		$('#searchUser').on('keyup',function() {
			const keyword = $(this).val();
			$.ajax({
				url: 'pencarian.php',
				method:'post',
				data: {keyword:keyword},
				success:function(data) {
					$('#kontak').html(data);
				}
			});
		});


function load_notifikasi()
{
	const load_notifikasi = 'load_notifikasi';
	$.ajax({
		url: 'admin_proses.php',
		method: 'POST',
		data:{load_notifikasi:load_notifikasi},
		dataType:'json',
		success:function(data) {
			$('.dropdown-menu').html(data.dropdown);
			$('#badge').html(data.notif);
		}
	})
}


});
</script>
<!-- model banned -->
<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Banned User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <b>Banned This User</b><br>

       User Id
       <input type="text" class="form-control mt-2" id="user_id" disabled>
       Username
       <input type="text" class="form-control mt-2" id="username" disabled>
       Email
       <input type="text" class="form-control mt-2" id="email" disabled>
       Pilihan Banned
       <select name="ket" id="ket" class="form-control mt-2">
       			<option value="">-Pilihan Banned-</option>
				<option value="1">Satu Minggu</option>
				<option value="2">Hapus Permanen</option>
       </select>
       	</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" id="bannedbutton" class="btn btn-primary" data-dismiss="modal">Proses</button>
      </div>
    </div>
  </div>
</div>
<!-- end model banned -->


<!-- modal history laporan -->
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">History Laporan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       	<p><b>History Laporan</b></p>
       	<div class="hislap">
       		
       	</div>
       	</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      <!--   <button type="submit" id="bannedbutton" class="btn btn-primary" data-dismiss="modal">Proses</button> -->
      </div>
    </div>
  </div>
</div>
<!-- end modal history report -->