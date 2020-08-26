<?php 
// header('Access-Control-Allow-Origin:index.php');
include 'koneksi.php';
session_start();
if(!isset($_SESSION['user_id'])) {
	header('location: login.php');
}
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="icon" type="image/png" href="img/favicon.ico">
		<title>Chat</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" href="styles.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css">
		 <link rel="stylesheet" type="text/css" href=" https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/base/jquery-ui.css">
		 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.1/emojionearea.min.css">
		 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">

	<style>
		#progress2{
			width: 100%;
		}
	</style>
	</head>
	<!--Coded With Love By Mutiullah Samim-->
	<body>

		<div class="container-fluid h-100">
			<div class="row justify-content-center h-100">
				<div class="col-md-4 col-xl-3 chat"><div class="card mb-sm-3 mb-md-0 contacts_card">
					<div class="card-header">
						
						<div class="input-group">
							<input type="text" placeholder="Search..." name="search" id="searchUser" class="form-control search">
							<div class="input-group-prepend">
								<span class="input-group-text search_btn"><i class="fas fa-search"></i></span>
							</div>
						</div>
					</div>
					<div class="card-body contacts_body">
						<ui class="contacts">
       <input type="hidden" value="<?= $_SESSION['img'] ?>" id="senderImg">
						<li class="active" id="self_info">
						
						</li>
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
								<div class="group_info">
									<span>Group Chat</span>
									<p>Messages</p> 
								</div>
								<!-- <div class="video_cam">
									<span><i class="fas fa-video"></i></span>
									<span><i class="fas fa-phone"></i></span>
								</div> -->
							</div>
							<a class="logout" onclick="return confirm('Are you sure want to exit?')" href="logout.php"><i class="fas fa-sign-out-alt float-right" style="position:absolute;top:10px;right:40px;font-size: 24px; color: white;"></i></a>
							<span id="action_menu_btn"><i class="fas fa-ellipsis-v" data-target=""></i></span>

							<div class="action_menu">
								<ul>
								<li id="history" data-toggle="modal" data-target="#exampleModal3"><i class="fas fa-user-circle"></i> History Cipher</li>
									<li class="about" data-toggle="modal" data-target="#exampleModal4"><i class="fas fa-users"></i> About Author</li>
									<li><i class="fas fa-ban"></i> <a onclick="return confirm('Are you sure want to exit?')" href="logout.php" style="text-decoration: none; color: #fff;">Logout</a></li>
								</ul>
							</div>
						</div>
						<div class="card-body msg_card_body">

							
							<!-- <div class="d-flex justify-content-end mb-4">
								<div class="msg_cotainer_send">
									test
									<span class="msg_time_send mt-2">8:55 AM, Today</span>
								</div>
								<div class="img_cont_msg">
							<img src="img/IMG_5365.JPG" class="rounded-circle user_img_msg">
								</div>
							</div> -->
						</div>
						<div class="card-footer">
							<div id="imgBox">
									
								</div>
								<div class="justify-content-end">
								<div class="col-md-3 progress mb-2 mt-2">
								<progress value="0" max="100%" id="progress">0%</progress>
								</div>
							</div>
							<div class="input-group">
								<div class="input-group-append" >
									<span class="input-group-text attach_btn"><label id="insPic" class="fas fa-camera" for="pic"></label>
									<input type="file" id="pic" style="display: none;" name="imgFile" accept="image/*">
									</span>
								</div>
								<textarea style="color: white;" id="emoji" name="pesan" data-userid="<?= $_SESSION['user_id'] ?>" data-username="<?= $_SESSION['username'] ?>" placeholder="Type your message..."class="form-control"></textarea>
								<div class="input-group-append">
									<span class="input-group-text send_btn"><i class="fas fa-location-arrow"></i></span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div></div>
				<div class="col-md-4 col-xl-3 chat"><div class="card mb-sm-3 mb-md-0 cipher_card">
					<div class="card-header">
							<span><i class="fas fa-cogs" id="setting" style="color: #fff;text-align: center;"></i></span>
					</div>
					<div class="card-body contacts_body">
						<ui class="contacts">
						<li class="active">
							<div class="d-flex bd-highlight">
								<textarea class="form-control cipertext" name="cipertext" id="plaintext" cols="30" rows="10"></textarea>
							</div>
							<input name="key" id="decriptkey" type="number" min="1" max="255" class="form-control mt-2 cipertext">
						</li>	
						<button class="btn btn-primary btn-block"  id="decrypt"><i class="fas fa-papper-plane">Dekripsi</i></button>	
						<!-- data-toggle="modal" data-target="#exampleModal8" -->
					</ui>
		</div>
	</div>
	
</div>
</div>

	<div id="kotak-dialog"></div>
</div>
 
	</body>
</html>
<script src="https://www.gstatic.com/firebasejs/5.8.6/firebase.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.1/emojionearea.min.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.8.6/firebase.js"></script>
<script>
	$('#action_menu_btn').click(function(){
		$('.action_menu').toggle();
	});
	var selectedFile,img,fileURL;
	$(document).ready(function() {

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
		  var rootchatref = firebase.database().ref('/');
                var chatref = firebase.database().ref('/Chat');
                chatref.on('child_added', function(snapshot) {
                  var data = snapshot.val();
                  var user_id = $('textarea[name=pesan]').data('userid');
                  var row ='';
                  var documents="";
                  var senderImg="";
                   if(user_id == data.uid) {
                   	var username = "Me";
                   	if(data.img !== "") {
                      documents =`<a href="${data.img}" target="_blank" ><img src="${data.img}" width="160px" height="160px"></a><br>`;
                    }else{
                       documents ="";
                    }
                    if(data.senderImg !== '') {
                      senderImg = `<div class="img_cont_msg">
                          <img src="${data.senderImg}" class="rounded-circle user_img_msg">
                           </div>`;
                    }else {
                      senderImg=`<div class="img_cont_msg">
                          <img src="img/group.png" class="rounded-circle user_img_msg">
                           </div>`;
                    }
                   			row += `
                           <span class="name_send">`+username+`</span>
                           <div class="d-flex justify-content-end mb-4">	
																											<div class="msg_cotainer_send">
																											`+documents+`
																												`+data.msg+`
																												<span class="msg_time_send">`+data.date+`</span>
																											</div>
																											`+senderImg+`
																										</div>`;
						                   	
						                   	
                       }else{
                       			if(data.img !== "") {
                            documents =`<a href="${data.img}" target="_blank"><img src="${data.img}" width="160px" height="160px"></a><br>`;
                         }else{
                           documents="";
                         }
                         if(data.senderImg !== '') {
                            senderImg = `<img src="${data.senderImg}" class="rounded-circle user_img_msg">`;
                         }else{
                           senderImg = `<img src="img/group.png" class="rounded-circle user_img_msg">`;
                         }
                          row += `
                           <span class="name_rec">`+data.nama+`</span>
                          <div class="d-flex justify-content-start mb-4">
                          <div class="img_cont_msg">
                          `+senderImg+`
                           </div>
                           <div class="msg_cotainer_">
                            `+documents+`
                            `+data.msg+`
                            <span class="msg_time_">`+data.date+`</span>
                           </div>
                          </div>`;
                       			
                       }
                          $('.msg_card_body').append(row);
                          scrollToBottom2();
                          $('#msg').val("");
                  
                });
		  function writeChat(uid,nama,msg,date,img="",senderImg="") {
            // A post entry.
              var postData = {
                uid:uid,
                nama:nama,
                msg:msg,
                date:date,
                img:img,
                senderImg:senderImg
                };
                             // Get a key for a new Post.
                    var newPostKey = firebase.database().ref().child('Chat').push().key;
                    // Write the new post's data simultaneously in the posts list and the user's post list.
                    var updates = {};
                    updates['/Chat/'+newPostKey] = postData;
                    return firebase.database().ref().update(updates);
           }
           let database = firebase.database()
           let storage = firebase.storage();
           	
           	// function largeURL(snap) {
           	// 		let url = snap.downloadURL;
           	// 		$('#picBox').val(url);
           	// }
           	$('#progress').hide();

           	function getTimeInfo(){
           		var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum&#39;at', 'Sabtu'];
                  var time = new Date(),
                      day = time.getDay(),
                      day = myDays[day];
                      date = day + ', '+time.toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true })
               return date;
           	}

           $('#pic').on('change',function(e){
           	$('#progress').show();
           	 var selectedFile = e.target.files[0];
           	 var fileName = selectedFile.name;
           	 let time = getTimeInfo();
           	 var storageRef = storage.ref('/imgShare/'+fileName+time);
           	 let uploadTask = storageRef.put(selectedFile)
           	 uploadTask.on('state_changed',
           	 	function progress(snapshot) {
           	 		var percentage = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
           	 		$('#progress').val(percentage);
           		},function(error){

           		}, function(){
           			uploadTask.snapshot.ref.getDownloadURL().then(function(downloadURL) {
           				let img = `<img src="${downloadURL}" id="imgChild" width="160px" height="160px">`;
           				$('#imgBox').html(img);
           				
           			})
           		})
           });

     

            $(".send_btn").on('click',function(e){
            	var msg,user_id,username,senderImg;
            	img = $('#imgChild').attr('src');
                msg = $('textarea[name=pesan]').val();
                user_id =$('textarea[name=pesan]').data('userid');
                username = $('textarea[name=pesan]').data('username');
                senderImg= $('#senderImg').val()
                if(msg !== "") {
                  
           							date = getTimeInfo();
                   writeChat(user_id,username,msg,date,img,senderImg);
                   var element = $('#emoji').emojioneArea();
                   element[0].emojioneArea.setText('');
                   $('textarea[name=pesan]').val("");
                   $('textarea[name=pesan]').focus();
                   $('#imgBox').html('');
                   $('#progress').hide();
                }else {
                  alert('at least write some messages!');
                }
               
           }) 


            function scrollToBottom2(){
			var cc = $('.msg_card_body');
            var dd = cc[0].scrollHeight;
            cc.animate({
               scrollTop: dd
                }, 500);
		}
/*--------------------*/

			$('#emoji').emojioneArea({
				pickerPosition:'top',
				toneStyle:'bullet'
			})

		fetch_user();
		setInterval(function(){
			update_chat_history()
			current_activity();
			fetch_user();
			loadSelf_info();
		},5000);

		function fetch_user() {
			var data ="fetch_user";
			$.ajax({
				url : 'fetch_all_data.php',
				method: "POST",
				data:{data:data},
				success:function (data) {
					$('#kontak').html(data);
				}
			})
		}
		function current_activity() {
			$.ajax({
				url: "current_activity.php",
				success:function() {

				}
			});
		}
		function private_chat_dialog(to_user_id,to_user_name) {
			var modal_content = '<div id="user_dialog_'+to_user_id+'" class="user_dialog ui-widget-header cardDialog" title="You have chat with '+to_user_name+'">';
		modal_content += '<div style="height:300px;overflow-y: scroll; margin-bottom:7px;border-bottom:1px solid purple;" class="chat_history cardDialog" data-touserid="'+to_user_id+'" id="chat_history_'+to_user_id+'">';
		modal_content += fetch_user_chat_history(to_user_id);
		modal_content += '</div>';
			modal_content += '<div class="mb-2" id="private_picBox"></div>';
			modal_content += '<input type="hidden" id="private_pictextBox">';
			
		modal_content += `<div class="input-group">`;
		modal_content += `<div class="input-group-append">
									<span class="input-group-text attach_btn"><label class="fas fa-camera" for="private_pic"></label></span>
									<input type="file" name="private_pic" accept="image/*" style="display:none" id="private_pic" data-touserid="`+to_user_id+`">
								</div>`;
		modal_content += '<textarea name="chat_message_'+to_user_id+'" id="chat_message_'+to_user_id+'" class="form-control chat_message "></textarea>';
		modal_content += `<div class="input-group-append">
									<span name="send_chat"  class="input-group-text send_btn send_chat" id="`+to_user_id+`"><i class="fas fa-location-arrow"></i></span>
								</div></div>`;
		modal_content += '<div><input type="number" min="1" max="255" class="key form-control mt-2" id="key" placeholder="Masukan Key" required>'
		modal_content += '<p class="text-right"><progress value="0" max="100%" style="width:100%" class="mt-1" id="progress1">0%</progress></p></div>';
			 
			$('#kotak-dialog').html(modal_content);
			// data-toggle="modal" data-target="#exampleModal7"
		}

			$(document).on('change','#private_pic',function(e){
				//const reader = new FileReader();
					// reader.onload = function() {
					// 	const img = new Image();
					// 	img.src = reader.result;
					// 	img.height= "160"
					// 	img.width='200';
					// 	$('#private_picBox').html(img);
					// }
					// reader.readAsDataURL(e.target.files[0]);
						var selectedFile = e.target.files[0];
      var fileName = selectedFile.name;
      let time = getTimeInfo();
      var storageRef = storage.ref('/private_pic/'+fileName+time);
      let uploadTask = storageRef.put(selectedFile)
      uploadTask.on('state_changed',
      function progress(snapshot) {
     	var percentage = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
      	$('#progress1').val(percentage);
      },function(error){

      	}, function(){
      	uploadTask.snapshot.ref.getDownloadURL().then(function(downloadURL) {
      	let img = `<img src="${downloadURL}" id="imgChild2" width="160px" height="160px">`;
       $('#private_picBox').html(img);
       })
					// ========
					
			});
		});

	

		$(document).on('click','.user_info',function() {
			var to_user_id = $(this).data('touserid');
			var to_user_name = $(this).data('tousername');
			$.ajax({
				url: 'removeNotif.php',
				method: 'post',
				data: {to_user_id:to_user_id,to_user_name:to_user_name},
				success:function(){

				}
			});
			// alert(to_user_id);
			private_chat_dialog(to_user_id,to_user_name);
			$('#user_dialog_'+to_user_id).dialog({
				autoOpen:false,
			    show:"highlight",
			    hide:"fold",
			    width: 325, // overcomes width:'auto' and maxWidth bug
			    maxWidth: 400,
			    height: 600,
			    modal: true,
			    resizable: false
			}).prev(".ui-dialog-titlebar").css({
			"background": "#7F7FD5",
	    	"background": "-webkit-linear-gradient(to right, #91EAE4, #86A8E7, #7F7FD5)",
	    	"background": "linear-gradient(to right, #91EAE4, #86A8E7, #7F7FD5)"
			});
			$('#user_dialog_'+to_user_id).dialog('open');
			$('#chat_message_'+to_user_id).emojioneArea({
				pickerPosition:"top",
				toneStyle:"bullet",

			})

		})
		function scrollToBottom(){
			var cc = $('.chat_history');
            var dd = cc[0].scrollHeight;
            cc.animate({
               scrollTop: dd
                }, 500);
		}
		$(document).on('click','.send_chat',function() {
			var to_user_id = $(this).attr('id');
			var imgsrc = $('#imgChild2').attr('src'); 
			var key = $('#key').val();
			var msg = $('#chat_message_'+to_user_id).val();
			if(msg == '') {
				alert('At Least Write Some Messages');
			}else{
				$.ajax({
					url: 'fetch_all_data.php',
					method: 'post',
					data: {to_user_id1:to_user_id,msg1:msg,imgsrc1:imgsrc,key1:key},
					success:function(data) {
						// $('#chat_message_'+to_user_id).val('');
						var element = $('#chat_message_'+to_user_id).emojioneArea();
						element[0].emojioneArea.setText('');
						$('#private_picBox').html('');
						$('#progress1').val('0')
						$('#chat_history_'+to_user_id).html(data);
					}
				});
			}
		})

/*proses dekripsi*/
$('#decrypt').on('click',function() {
			const plaintext = $('#plaintext').val();
			const decriptkey = $('#decriptkey').val();
			$.ajax({
				method: 'POST',
				url: "fetch_all_data.php",
				data: {dekripsi:plaintext,key:decriptkey},
				success:function(data) {
					console.log(data);
					$('#plaintext').val(data);
				}
			});
		});
/*end proses dekripsi*/


/*hold enkripsi and dekripsi*/

// $(document).on('click','.send_chat',function () {
// 			const to_user_id = $(this).attr('id');
// 			// const img = $('#imgChild2').attr('src');
// 			const msg = $('#chat_message_'+to_user_id).val();
// 			// console.log(msg);
// 			const key = $('#key_'+to_user_id).val();
// 			$.ajax({
// 				url: 'fetch_all_data.php',
// 				method: "post",
// 				data: {holdenkripsi:msg,key:key},
// 				success:function(data){
// 						$('.hold').html(data)
// 				}
// 			})
// 		})


		$('#decrypt').on('click',function() {
			const plaintext = $('#plaintext').val();
			const decriptkey = $('#decriptkey').val();
			$.ajax({
				method: 'POST',
				url: "fetch_all_data.php",
				data: {holddekripsi:plaintext,key:decriptkey},
				success:function(data) {
					$('.hold2').html(data);
				}
			});
		});


/*end hold enkripsi and dekripsi*/

		function fetch_user_chat_history(to_user_id) {
			$.ajax({
				url: 'fetch_all_data.php',
				method: 'post',
				data: {to_user_id:to_user_id},
				success:function(data) {
					$('#chat_history_'+to_user_id).html(data);
					scrollToBottom();
				}
			});
		}

		function update_chat_history() {
			$('.chat_history').each(function() {
				var to_user_id = $(this).data('touserid');
				fetch_user_chat_history(to_user_id);
			});
		}

		
		
		$(document).on('click','.removeChat',function() {
				const chat_message_id = this.id;
				if(confirm('Apakah Anda Ingin Menghapus Chat Ini?')) {
							$.ajax({
							url:"fetch_all_data.php",
							method: "get",
							data: {deleteChat:chat_message_id},
							success:function() {

							}
					});
				}
				
		})

		$(document).on('click','.self_info',function() {
			const user_id = this.id;
			$.ajax({
					url: 'fetch_all_data.php',
					method: 'POST',
					data: {self_info:user_id},
					dataType: 'json',
					success:function(data) {
						console.log(data);
						$('#email').val(data.email)
						$('#user_id').val(data.user_id)
						$('#namauser').val(data.username)
						$('#pwduser').val(data.password)
						$('#imgCard').attr('src',data.img)

					}
			});
		})

$(document).on('change','#uploadFoto',function(e) {
		const selectedFile = e.target.files[0];
		const fileName = selectedFile.name;
		const time = getTimeInfo();
		const storageRef = storage.ref('/user_img/'+fileName+time);
		const uploadTask = storageRef.put(selectedFile);
		uploadTask.on('state_changed',
			function progress(snapshot){
					const percentage = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
					$('#progress2').val(percentage);
			},function(error){

			},function(){
					uploadTask.snapshot.ref.getDownloadURL().then(function(downloadURL){
							$('#imgCard').attr('src',downloadURL);
					});
			})
})

$(document).on('click','#simpan',function() {
	 const username = $('#namauser').val();
	 const email = $('#email').val();
	 const pwd = $('#pwduser').val();
	 const img = $('#imgCard').attr('src');
	 $.ajax({
	 				url: 'fetch_all_data.php',
	 				method: 'post',
	 				data: {ubah_data:username,pwd:pwd,img:img,email:email},
	 				success:function(data) {
	 					alert(data);
	 					loadSelf_info();
	 					setEmpty();
	 				}
	 })
})
function setEmpty() {
	$('#uploadFoto').val('');
	$('#progress2').val(0);
}
function loadSelf_info() {
	const load_self_info = "load_self_info";
	$.ajax({
			url: 'fetch_all_data.php',
			method: 'post',
			data: {load_self_info:load_self_info},
			success:function(data) {
				$('#self_info').html(data)
			}
	});
}

$('#searchUser').on('keyup',function() {
		const keyword = $(this).val();
		$.ajax({
					url: 'fetch_all_data.php',
					method:'post',
					data: {searchUser:keyword},
					success:function(data) {
						$('#kontak').html(data);
					}
		});
})

$(document).on('click','#report',function() {
	const id_user = $(this).data('touserid');
	$('#ket').val("");
	$('#report_username').val("");
	$('#report_user_id').val("");
	$.ajax({
		url: "fetch_all_data.php",
		method: "post",
		data: {select_report_user:id_user},
		success:function(Alldata) {
			const data = JSON.parse(Alldata);
			$('#report_username').val(data.username);
			$('#report_user_id').val(data.user_id);
		}
	});
})

$(document).on('click','#BTNreport',function() {
	const username = $('#report_username').val();
	const user_id = $('#report_user_id').val();
	const ket = $('#ket').val();
	$.ajax({
		url: "fetch_all_data.php",
		method: "post",
		data: {laporkan:username,user_id:user_id,ket:ket},
		success:function(data) {
			if(data !== '') {
				alert(data);
			}
		}
	});
})

// fetch history cipher 
$(document).on('click','#history',function() {
	const fetch_userhistorycipher = 'fetch_userhistorycipher';
			$.ajax({
					url: 'fetch_all_data.php',
					method: 'post',
					data:{fetch_userhistorycipher:fetch_userhistorycipher},
					success:function(data) {
							$('.cipher').html(data)
					}
			})
})

$(document).on('change','#user',function() {
	const uid = $(this).val();
	const historycipher = '';
	$.ajax({
			url: 'fetch_all_data.php',
			method: 'post',
			data: {uid:uid,historycipher:historycipher},
			success:function(data) {
				$('#hisTab').html(data);
			}
	})
})


});

</script>


<!-- Modal -->
<!-- Modal Edit and View Profil -->
<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">User Info</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div class="row">
       	<div class="col-md-6"  style="background: gray">
       		<img id="imgCard" src="" alt="foto" style="width: 100%;height: 100%">
       	</div>
       	<div class="col-md-6">
			  <div class="form-group">
			    <label for="exampleInputEmail1">Email address</label>
			    <input type="hidden" name="user_id" id="user_id">
			    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email" placeholder="Enter email">
			    <small id="emailHelp" class="form-text text-muted">Email Ini Digunakan Untuk Melakukan Pemulihan Password</small>
			  </div>
			  <div class="form-group">
			    <label for="exampleInputEmail1">Username</label>
			    <input type="text" class="form-control" id="namauser"aria-describedby="usernamelHelp" placeholder="Enter Username" name="ubah_data">
			  </div>
			  <div class="form-group">
			    <label for="exampleInputPassword1">Password</label>
			    <input type="password" class="form-control" id="pwduser" placeholder="Password" name="password">
			    <small id="emailHelp" class="form-text text-muted">Biarkan Password Jika Tidak Diganti!</small>
			  </div>
			 <div class="form-group">
			    <label for="exampleFormControlFile1">Ubah Foto Anda</label>
			    <input type="hidden" id="hidgambar" name="hidgambar">
			    <input type="file" class="form-control-file" id="uploadFoto" accept="image/*" name="fotoProfil">
			     <progress value="0" max="100%" id="progress2">0%</progress>	
			  </div>
       	</div>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" data-dismiss="modal" name="ubah" id="simpan" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>

<!-- modal hostory cipher -->
<!-- Modal -->
<div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document" id="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div class="row" id="contenya">
			<div class="col-md-6">
				<div class="cipher"></div>
			</div>
       </div>
       <div class="row mt-2">
       	<div class="col-md-6">
       	</div>
       		<div class="col-md-12">		
				<div class="tablecipher">
					<table class="table table-bordered" id="hisTab">
						<thead>
							<tr>
								<th>Pilih</th>
								<th>Salah Satu</th>
								<th>User</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Pilih</td>
								<td>Salah Satu</td>
								<td>User</td>
							</tr>
						</tbody>
					</table>
				</div>
       		</div>
       </div>
       		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- end modal hostory cipher and about author -->


<!-- modal hostory cipher -->
<!-- Modal -->
<div class="modal fade" id="exampleModal4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" id="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<div class="row">
      		<div class="col-md-6" id="fotoAuthor">
      			<img src="https://firebasestorage.googleapis.com/v0/b/secretchat-33d70.appspot.com/o/private_pic%2Fpp2.PNGMinggu%2C%206%3A03%20AM?alt=media&amp;token=849c61c1-5081-416a-8c35-9b0fed116235" alt="erick" width="213" height="330">
      		</div>
      		<div class="col-md-6" id="bioAuthor" style="height: 450px;">
      			<ul class="list-group">
				  <li class="list-group-item">Nama, Saya Erick Irwansyah</li>
				    <li class="list-group-item">Alamat, Lubuk Sahung, Kec Sukaraja</li>
				    <li class="list-group-item">TTL, Lubuk Sahung 12-Mei-1997</li>
				    <li class="list-group-item">Hobi, Ngoding;Travelling;Belajar Hal Yang Baru</li>
				    <li class="list-group-item">Motto, Man Shobaro Dzofiro(Barangsiapa Yang Sabar Maka, dia Yang Beruntung)</li>
				</ul> 			
      		</div>
      	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- end modal hostory cipher and about author -->

<!-- Modal -->
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content modal-sm">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">LAPORKAN USER</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<input type="hidden" id="report_user_id">
      	Laporkan
        <input type="text" id="report_username" class="form-control mb-2">
		Keterangan
		<select name="ket" id="ket" class="form-control">
			<option value="">-Pilih Alasan-</option>
			<option value="SPAM">SPAM</option>
			<option value="SARA">SARA</option>
			<option value="PORNOGRAFI">PORNOGRAFI</option>
		</select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="BTNreport">Report</button>
      </div>
    </div>
  </div>
</div>

<!-- modal hold cipher -->
<!-- Modal -->
<div class="modal fade" id="exampleModal7" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document" id="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<div class="row">		
      	<div class="col-md-12">
	      	<div style="overflow: scroll;" class="hold">
	      		
	      	</div>
      	</div>
      </div>
      	</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="exampleModal8" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document" id="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<div class="row">		
      	<div class="col-md-12">
	      	<div style="overflow: scroll;" class="hold2">
	      		
	      	</div>
      	</div>
      </div>
      	</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="send_chat" class="btn btn-primaryf" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>
<!-- end modal hold cipher -->