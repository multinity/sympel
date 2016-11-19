<?php
/**
 * Sympel (CMS)
 *
 * Sympel adalah sebuah Content Management System(CMS) sederhana
 * yang dibuat untuk web dengan satu halaman. Tujuan utama
 * dibuatnya CMS ini untuk dipelajari dan dikembangkan kembali.
 *
 * @package  Sympel
 * @author   Multinity
 * @copyright	Copyright (c) 2014 - 2016, Multinity
 * @license	http://www.gnu.org/licenses/gpl-3.0-standalone.html GNU General Public License v3
 * @link	https://multinity.github.io/sympel/
 *
 */

ob_start();
session_start();
error_reporting(0);
include("../config.php");

	$host_ip 		= $_SERVER['HTTP_HOST'];
	$ip_host 		= str_replace(".", "", $host_ip);
	$folder 	= $_SERVER['PHP_SELF'];
	$folder 	= explode("/", $folder);
	$dir	 	= "/".$folder[1]."/";
	if($host_ip == "localhost"){
		$root_ori	 	= "http://".$host_ip.$dir;
	}elseif(is_numeric($ip_host)){
		$root_ori	 	= "http://".$host_ip.$dir;
	}else{
		$root_ori 		= "http://".$host_ip;
	}

?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<title>Pemasangan <?=$site['cms'];?></title>
		<link rel="shortcut icon" href="favicon.png">
		<link rel="stylesheet" type="text/css" href="style.css">
		<script type="text/javascript" src="jquery.js"></script>
	</head>

	<body>
		<div class="container">
			<div class="main">
			<?php
			$step = @$_GET['step'];
			if($step == "awal") {
			?>
				<div class="block">
					<h2>Selamat Datang di <?=$site['cms'];?></h2>

					<div class="bodi">
						<p>Selamat datang di halaman <?=$site['cms'];?> instalasi, klik tombol berikut ini untuk memulai proses memasang <?=$site['cms'];?>.</p>
						<a href="?step=memulai" class="btn">Pasang <?=$site['cms'];?></a>
					</div>
				</div>
			<?php
			}elseif($step == "memulai"){
			?>
				<div class="block">
					<h2>Memulai</h2>

					<div class="bodi">
						<p>Dihalaman ini anda diperkenankan untuk mengisi form yang mengenai database.</p>
						<?php
						if(!file_exists("../db-sample.php")){
							if(file_exists("../db.php")){
								echo "<div class='col error'>File db.php sudah dibuat! <a href='?step=site' class='btn'>Lewati langkah ini</a></div>";
							}else{
								echo "<div class='col error'>File db-sample.php tidak ditemukan.</div>";
							}
						}else{
						?>
						<?php
						$host 	= @$_POST['host'];
						$db 	= @$_POST['database'];
						$user 	= @$_POST['username'];
						$pass  	= @$_POST['password'];
						if(@$_POST['next']) {
							$sql_con = mysql_connect($host,$user,$pass);
							if(!$sql_con){
								echo "<div class='col error'>Tidak dapat melakukan koneksi.</div>";
							}elseif(!mysql_select_db($db,$sql_con)) {
								echo "<div class='col error'>Database <i>$db</i> tidak ditemukan.</div>";
							}else{
								$file_name = "../db-sample.php";
								$file = file_get_contents($file_name);
								$file = str_replace("HOST_DISINI", "$host", $file);
								$file = str_replace("USER_DISINI", "$user", $file);
								$file = str_replace("PASS_DISINI", "$pass", $file);
								$file = str_replace("DB_DISINI", "$db", $file);
								$filedata = $file;
								$file = file_put_contents($file_name, $filedata);
								if(rename($file_name, "../db.php")){
									if(file_exists("../db.php")){
										include("../db.php");
										$sql_file = "sql/sympel.sql";
										$templine = '';
										$lines = file($sql_file);
										foreach ($lines as $line)
										{
											if (substr($line, 0, 2) == '--' || $line == '')
											    continue;

											$templine .= $line;
											if (substr(trim($line), -1, 1) == ';')
											{
											    mysql_query($templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysql_error() . '<br /><br />');
											    $templine = '';
											}
										}
										header("Location: ?step=site");
									}
								}
							}
						}

						if(@$_POST['test']) {
							$conn = mysql_connect($host,$user,$pass);
							if(mysql_select_db($db,$conn)) {
								echo "<div class='col success'>Koneksi berhasil dilakukan.</div>";
							}else{
								echo "<div class='col error'>Tidak dapat melakukan koneksi.</div>";
							}
						}
						?>
						<form method="post" class="form">
							<label>
								Host
								<input type="text" name="host" class="input" value="<?php if(!@$_POST['host']){echo @$host_ip;}else{echo @$_POST['host'];} ?>">
							</label>
							<br>
							<label>
								Database
								<input type="text" name="database" class="input" value="<?php if(!@$_POST['database']){echo @$site['cms'];}else{echo @$_POST['database'];} ?>">
							</label>
							<br>
							<label>
								Username
								<input type="text" name="username" class="input" value="<?php echo @$_POST['username']; ?>">
							</label>
							<br>
							<label>
								Password
								<input type="text" name="password" class="input">
								<input type="submit" name="test" value="Coba Koneksi" class="btn">
							</label>
							<br>
							<a href="index.php" class="btn">&laquo; Kembali</a>
							<input type="submit" class="btn" value="Simpan dan Lanjutkan &raquo;" name="next">
							<br>
						</form>
						<?php } ?>
					</div>
				</div>
			</div>
			<?php
			}elseif($step == "site"){
				if(!file_exists("../db.php")) {
					header("Location: ?step=memulai");
				}
			?>
				<div class="block">
					<h2>Informasi Situs</h2>
					<div class="bodi">
						<p>Sesuaikan dengan informasi situs yang akan anda buat.</p>
						<?php
						if($_POST) {
							$title = mysql_real_escape_string($_POST['title']);
							$tagline = mysql_real_escape_string($_POST['tagline']);
							$root = mysql_real_escape_string($_POST['root']);
							$root_admin = mysql_real_escape_string($_POST['root_admin']);
							if(!$title) {
								$title = $site['cms'];
							}
							if(!$tagline) {
								$tagline = "Saya menggunakan ".$site['cms']." untuk membuat ini";
							}
							if(!$root) {
								$root = $root_ori;
							}
							$kueri = mysql_query("insert into {$tb['setting']} values(NULL, 'site_title','$title')");
							$kueri = mysql_query("insert into {$tb['setting']} values(NULL, 'site_tagline','$tagline')");
							$kueri = mysql_query("insert into {$tb['setting']} values(NULL, 'site_icon','favicon-def.png')");
							$kueri = mysql_query("insert into {$tb['setting']} values(NULL, 'site_root','$root')");
							$kueri = mysql_query("insert into {$tb['setting']} values(NULL, 'site_admin','{$root}{$root_admin}/')");
							$kueri = mysql_query("insert into {$tb['setting']} values(NULL, 'page_intro','Y')");
							$kueri = mysql_query("insert into {$tb['setting']} values(NULL, 'page_portofolio','Y')");
							$kueri = mysql_query("insert into {$tb['setting']} values(NULL, 'page_about','Y')");
							$kueri = mysql_query("insert into {$tb['setting']} values(NULL, 'page_partner','Y')");
							$kueri = mysql_query("insert into {$tb['setting']} values(NULL, 'page_contact','Y')");
							if($kueri) {
								header("Location: ?step=admin");
								rename("../".$admin['url'], "../".$root_admin);
							}else{
								echo "<div class='col error'>Gagal pada saat menyimpan perubahan :(</div>";
							}
						}

						if(itung_row(pilih("* from {$tb['setting']}")) == 10) {
							echo "Situs sudah diatur. <a href='?step=admin' class='btn'>Lewati langkah ini</a>";
						}else{

						?>
						<form method="post" class="form">
							<label>
								Judul Situs
								<input type="text" name="title" class="input" value="<?=$site['cms'];?>">
							</label>
							<br>
							<label>
								Tagline
								<input type="text" name="tagline" class="input" value="Not a friend of the masked hero">
							</label>
							<br>
							<label>
								Root URL
								<input type="text" name="root" class="input" value="<?php echo $root_ori; ?>">
								<div class="des">* berikan tanda / pada akhir url.</div>
							</label>
							<br>
							<label>
								Admin Root URL
								<input type="text" name="root_admin" class="input" value="<?=$admin['url'];?>">
							</label>
							<br>
							<span style="color:red">* Jika semua kolom tidak diisi, maka akan menggunakan informasi situs bawaan.</span>
							<br>
							<a href="index.php" class="btn">&laquo; Kembali</a>
							<input type="submit" class="btn" value="Simpan dan Lanjutkan &raquo;">
							<br>
						</form>
						<?php } ?>
					</div>
				</div>
			<?php }elseif($step == "admin"){
				if(!file_exists("../db.php")) {
					header("Location: ?step=memulai");
				}
			?>
				<div class="block">
					<h2>Buat Pengguna Admin</h2>
					<div class="bodi">
						<p>Buatlah akun admin untuk mengelola situs anda.</p>
						<?php
						if($_POST) {
							$nama = mysql_real_escape_string($_POST['nama']);
							$username = mysql_real_escape_string($_POST['username']);
							$password = mysql_real_escape_string($_POST['password']);
							$password2 = mysql_real_escape_string($_POST['password2']);
							$email = mysql_real_escape_string($_POST['email']);
							$passwordhash = md5($password);
							if(!$nama) {
								echo "<div class='col error'>Harap isi nama lengkap anda.</div>";
							}elseif(!$username) {
								echo "<div class='col error'>Harap isi nama pengguna anda.</div>";
							}elseif(!$password) {
								echo "<div class='col error'>Kata sandi anda masih kosong.</div>";
							}elseif($password2 !== $password) {
								echo "<div class='col error'>Kata sandi tidak cocok.</div>";
							}elseif(!$email) {
								echo "<div class='col error'>Surel anda belum diisi.</div>";
							}elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
								echo "<div class='col error'>Penulisan surel tidak benar (Contoh: johndoe@mail.com).</div>";
							}else{
								if(tambah("{$tb['user']}(id, username, password, passwordnohash, email, nama, tanggal, status) values(NULL, '$username', '$passwordhash', '$password', '$email', '$nama', NOW(), 'Y')")) {
									header("Location: ?step=sukses");
								}else{
									echo "<div class='col error'>Gagal saat menyimpan perubahan :(</div>";
								}
							}
						}
						if(itung_row(pilih("* from {$tb['user']}")) > 0) {
							echo "Pengguna admin sudah diatur. <a href='?step=sukses' class='btn'>Lewati langkah ini</a>";
						}else{
						?>
						<form method="post" class="form">
							<label>
								Nama Lengkap
								<input type="text" class="input" name="nama" value="<?php echo @$_POST['nama']; ?>">
							</label>
							<br>
							<label>
								Nama Pengguna
								<input type="text" class="input" name="username" value="<?php echo @$_POST['username']; ?>">
							</label>
							<br>
							<label>
								Kata Sandi
								<input type="password" class="input" name="password">
							</label>
							<br>
							<label>
								Ulang Kata Sandi
								<input type="password" class="input" name="password2">
							</label>
							<br>
							<label>
								Surat Elektronik
								<input type="text" class="input" name="email" value="<?php echo @$_POST['email']; ?>">
							</label>
							<br>
							<a href="?step=site" class="btn">&laquo; Kembali</a>
							<input type="submit" class="btn" value="Buat Pengguna Admin">
						</form>
						<?php } ?>
					</div>
				</div>
			<?php }elseif($step == "sukses"){ ?>
				<div class="block">
					<h2>Instalasi <?=$site['cms'];?> Selesai</h2>
					<div class="bodi">
						<p><?=$site['cms'];?> telah berhasil diinstal, harap HAPUS folder <i>pasang</i> untuk keamanan.</p>
						<a href="<?php echo $site['admin']; ?>" class="btn">Masuk ke Admin</a>
						<a href="<?php echo $site['root']; ?>" class="btn">Lihat Website</a>
					</div>
				</div>
			<?php }else{ ?>
				<div class="block">
					<h2>Lisensi</h2>

					<div class="bodi">
						<p>Sebelum melangkah lebih jauh harap baca lisensi ini.</p>
						<div id="lisbox" style="width:98%; height:400px; border:1px solid #ddd; overflow:auto; padding:10px;">
							<?php
							$lis = file_get_contents("../LICENSE");
							$lis = str_replace("\n", "<br>", $lis);
							echo $lis;
							?>
						</div>
						<a href="?step=awal" class="btn">Selanjutnya</a>
					</div>
				</div>
			</div>
			<?php } ?>

			<div class="footer">
				<div class="copyright">
					Copyright <?=$site['cms'];?> &copy; <?php echo date('Y'); ?> | Versi <?=$site['version'];?>
				</div>
				<div class="logo">
					<p>Powered By</p>
					<a href="https://multinity.github.io/sympel/">
						<img src="logo.png">
					</a>
				</div>
			</div>
		</div>
	</body>
</html>
