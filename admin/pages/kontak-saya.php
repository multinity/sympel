<?php
$titleNow = "Kontak Saya";
include("header.php");
$sql_kontak 	= pilih("* from {$tb['halaman']} where status = 'KONTAK'");
$kontakRow	= tampilinO($sql_kontak);
?>
<h1>Kontak Saya</h1>

<div class="blok">
<?php
if($_POST){
	$judul 	= mysql_real_escape_string($_POST['judul']);
	$isi 	= mysql_real_escape_string($_POST['isi']);
	$informasi 	= mysql_real_escape_string($_POST['informasi']);
	$menu 	= mysql_real_escape_string($_POST['menu']);
	$url 	= mysql_real_escape_string($_POST['url']);
	$facebook = mysql_real_escape_string($_POST['facebook']);
	$twitter = mysql_real_escape_string($_POST['twitter']);
	$gplus = mysql_real_escape_string($_POST['gplus']);
	if(!$judul) {
		echo "<div class='block error'>Harap isi judul kontak !</div>";
	}elseif(!$isi) {
		echo "<div class='block error'>Field isi masih kosong !</div>";
	}elseif(!$informasi){
		echo "<div class='block error'>Kontak informasi masih kosong !</div>";
	}elseif(!$menu) {
		echo "<div class='block error'>Harap isi teks untuk menu !</div>";
	}else{
		if(update("{$tb['halaman']} set judul = '$judul', isi = '$isi', informasi = '$informasi', menu = '$menu', url = '$url', facebook = '$facebook', twitter = '$twitter', gplus = '$gplus' where status = 'KONTAK'")) {
			header("Location: {$admPage['kontak']}");
		}else{
			echo "<div class='block error'>Kegagalan terjadi pada saat menyimpan perubahaan !</div>";
		}
	}
}
?>
	<div class="bodi">
		<form class="form" method="post">
			<label>
				Judul
				<br>
				<input type="text" name="judul" value="<?php echo $kontakRow->judul; ?>" class="input lebar">
			</label>
			<br>
			<label>
				Deskripsi
				<br>
				<textarea class="ckeditor" name="isi"><?php echo $kontakRow->isi; ?></textarea>
			</label>
			<br>
			<label>
				Kontak Informasi
				<br>
				<textarea class="ckeditor" name="informasi"><?php echo $kontakRow->informasi; ?></textarea>
				<div class="des">* Isi dengan informasi tentang anda</div>
			</label>
			<br>
			<label>
				<i class="fa fa-facebook-square"></i> Facebook
				<br>
				<input type="text" class="input" name="facebook" value="<?php echo $kontakRow->facebook; ?>">
			</label>
			<br>
			<label>
				<i class="fa fa-twitter-square"></i> Twitter
				<br>
				<input type="text" class="input" name="twitter" value="<?php echo $kontakRow->twitter; ?>">
			</label>
			<br>
			<label>
				<i class="fa fa-google-plus"></i> +Google
				<br>
				<input type="text" class="input" name="gplus" value="<?php echo $kontakRow->gplus; ?>">
			</label>
			<br>
			<label>
				<i class="fa fa-globe"></i> URL
				<br>
				<input type="text" class="input" name="url" value="<?php echo $kontakRow->url; ?>">
			</label>
			<br>
			<label>
				Teks Menu
				<br>
				<input type="text" name="menu" value="<?php echo $kontakRow->menu; ?>" class="input">
				<div class="des">* Teks ini ditampilkan pada menu navigasi</div>
			</label>
			<br>
			<button type="submit" class="button"><i class="fa fa-save"></i> Simpan Perubahaan</button>
			<button type="reset" class="button red"><i class="fa fa-times"></i> Reset</button>
		</form>
	</div>
</div>

<?php
include("footer.php");
?>