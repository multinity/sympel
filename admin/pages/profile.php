<?php
$titleNow = "Profile";
include("header.php");
?>
<h1>Profile</h1>

<div class="blok">
	<?php
	if($_POST){
		$username = mysql_real_escape_string($_POST['username']);
		$nama 	= mysql_real_escape_string($_POST['nama']);
		$email = mysql_real_escape_string($_POST['email']);
		$web = mysql_real_escape_string($_POST['web']);
		$password = mysql_real_escape_string($_POST['password']);
		$password2 = mysql_real_escape_string($_POST['password2']);
		$password_hash = mysql_real_escape_string(md5($_POST['password']));
		if(!$nama) {
			echo "<div class='block error'>Nama anda harus diisi !</div>";
		}elseif(!$email) {
			echo "<div class='block error'>Surat elektronik anda kosong !</div>";
		}else{
			if($password){
				if($password2 !== $password) {
					echo "<div class='block error'>Kata sandi tidak cocok !</div>";
				}else{
					update("{$tb['user']} set nama = '$nama', email = '$email', website = '$web', password = '$password_hash', passwordnohash = '$password' where id = '{$user['id']}'");
				}
			}
			if(update("{$tb['user']} set nama = '$nama', email = '$email', website = '$web' where id = '{$user['id']}'")){
				header("Location: {$admPage['profile']}");
			}
		}
	}
	?>
	<h2 class="mini-title">Ubah Profile</h2>

	<div class="bodi">
		<form class="form" method="post">
			<label>
				Nama Pengguna
				<br>
				<input type="text" class="input" name="username" disabled="" value="<?php echo $user['username']; ?>">
				<div class="des">
					* Nama pengguna tidak bisa diubah
				</div>
			</label>
			<br>
			<label>
				Nama Lengkap
				<br>
				<input type="text" class="input" name="nama" value="<?php echo $user['nama']; ?>">
			</label>
			<br>
			<label>
				Surat Elektronik
				<br>
				<input type="text" class="input" name="email" value="<?php echo $user['email']; ?>">
			</label>
			<br>
			<label>
				Situs Web
				<br>
				<input type="text" class="input" name="web" value="<?php echo $user['website']; ?>">
			</label>
			<br>

			<h2 class="mini-title">Ubah Kata Sandi</h2>
			<label>
				Kata Sandi Baru
				<br>
				<input type="password" class="input" name="password">
				<div class="des">* isi jika ingin diubah</div>
			</label>
			<br>
			<label>
				Ulang Kata Sandi
				<br>
				<input type="password" class="input" name="password2">
			</label>
			<br>

			<button type="submit" class="button"><i class="fa fa-save"></i> Simpan Perubahaan</button>
		</form>
	</div>
</div>
<?php
include("footer.php");
?>