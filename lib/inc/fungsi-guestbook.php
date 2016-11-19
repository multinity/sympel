<?php
if($_POST){
	$nama = htmlentities(mysql_real_escape_string(trim(@$_POST['nama'])));
	$email = htmlentities(mysql_real_escape_string(trim(@$_POST['email'])));
	$web = htmlentities(mysql_real_escape_string(trim(@$_POST['web'])));
	$subjek = htmlentities(mysql_real_escape_string(trim(@$_POST['subject'])));
	$pesan = htmlentities(mysql_real_escape_string(trim(@$_POST['pesan'])));
	$redirect = @$_POST['redirect'];
	$ip = ambilIP();
	$domain = email($email);
	if(!$nama) {
		echo "<div class='panel panel-warning'>Mohon isi nama anda !</div>";
	}elseif(!$email) {
		echo "<div class='panel panel-warning'>Mohon cantumkan surel anda !</div>";
	}elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
		echo "<div class='panel panel-warning'>Penulisan surel tidak benar !</div>";
	// }elseif(!checkdnsrr($domain)){
	// 	echo "<div class='panel panel-warning'>Domain pada alamat surel anda bermasalah !</div>";
	}elseif(!$pesan) {
		echo "<div class='panel panel-warning'>Tidak ada pesan yang akan dikirim !</div>";
	}else{
		if(!$subjek){
			$subjek = "Tidak ada subjek";
		}
		if(!$redirect) {
			$redirect = "{$site['root']}";
		}
		if(tambah("{$tb['gbook']} values(NULL, '$ip', '$nama', '$email', '$web', '$subjek', '$pesan', NOW(),'Y')")){
			echo "<script>alert('Terima kasih telah mengirim pesan :D');</script>";
			header("Location: $redirect");
		}else{
			echo "<div class='panel panel-warning'>Kesalahan terjadi pada saat menyimpan data !</div>";
		}
	}
}
?>

<style type="text/css">
	.panel {
		padding: 10px;
	}
</style>