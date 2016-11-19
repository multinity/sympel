<!DOCTYPE HTML>
<html>
	<head>
		<title><?php echo "{$site['title']}{$site['tanda']}{$admin['title']}"; ?></title>
		<link rel="stylesheet" href="<?php echo "{$admin['css-login']}"; ?>">
		<link rel="stylesheet" href="<?php echo "{$admin['fonts']}"; ?>">
		<script src="<?php echo "{$admin['js']}"; ?>"></script>
	</head>

	<body>
		<div id="container">
			<div id="main-login">
				<a href="<?=$site['link'];?>" target="_blank"><img src="<?php echo $site['root'].$site['cms_logo']; ?>" width="200"></a>
				<?php
				$type = @$_GET['type'];
				if($type == "lupa-password"){
				?>
				<?php
				if($_POST){
					$username 	= mysql_real_escape_string($_POST['username']);
					$sql_poho 	= pilih("* from {$tb['user']} where username = '$username' or email = '$username'");
					$row 		= tampilinO($sql_poho);
					if(itung_row($sql_poho) == 1) {
						$from = "From: $row->email \n";
						$isi = "Berikut adalah kata sandi anda : \n\n Kata sandi : $row->passwordnohash \n Terima Kasih !";
						if(mail($row->email, "Lupa Kata Sandi !", $isi, $from)){
							echo "<div class='block success'>Kata sandi sudah dikirim ke surel anda.</div>";
						}
					}else{
						echo "<div class='block error'>Username atau surel salah !</div>";
					}
				}
				?>
				<form method="post" id="form">
					<div class="group">
						<label for="username">Nama Pengguna atau Surel</label>
						<input type="text" name="username" class="input" id="username" value="<?=(@$_POST['username']) ? $_POST['username'] : "";?>">
					</div>
					<input type="submit" name="login" class="btn" value="Kirim Kata Sandi">
					<a href="index.php">&laquo; Masuk</a>
				</form>
				<?php
				}else{
				?>

				<?php
				if($_POST){
					$username = mysql_real_escape_string($_POST['username']);
					$password = mysql_real_escape_string(md5($_POST['password']));
					$sql_login = mysql_query("select * from {$tb['user']} where username = '$username' and password = '$password'");
					if(mysql_num_rows($sql_login) == 1) {
						header("Location: index.php");
						$_SESSION['usadm'] 	= $username;
					}else{
						echo "<div class='block error'>Username atau password salah !</div>";
					}
				}
				?>
				<form method="post" id="form">
					<div class="group">
						<label for="username">Nama Pengguna</label>
						<input type="text" id="username" name="username" class="input" value="<?=(@$_POST['username']) ? $_POST['username'] : "";?>" autofocus="true">
					</div>
					<div class="group">
						<label for="password">Kata Sandi</label>
						<input type="password" id="password" name="password" class="input" value="<?=(@$_POST['password']) ? $_POST['password'] : "";?>">
					</div>
					<input type="submit" name="login" class="btn" value="Masuk">
					<a href="?type=lupa-password">Lupa Kata Sandi ?</a>
				</form>
				<?php } ?>
				<div class="footer">
					<div class="copyright">
						Copyright &copy; <?=$site['title']. " " . date('Y');?>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>