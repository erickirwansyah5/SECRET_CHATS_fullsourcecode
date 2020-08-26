<?php 
session_start();
include 'koneksi.php';
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

 ?>