<?php
$titleNow = "Intro";
include("header.php");
$sql_Intro 	= pilih("* from {$tb['halaman']} where status = 'INTRO'");
$IntroRow	= tampilinO($sql_Intro);
?>
<h1>Intro</h1>

<div class="blok">
<?php
if($_POST){
	$judul 	= mysql_real_escape_string($_POST['judul']);
	$isi 	= mysql_real_escape_string($_POST['isi']);
	$menu 	= mysql_real_escape_string($_POST['menu']);
	if(!$judul) {
		echo "<div class='block error'>Harap isi judul intro !</div>";
	}elseif(!$isi) {
		echo "<div class='block error'>Isi pada intro kosong !</div>";
	}elseif(!$menu) {
		echo "<div class='block error'>Harap isi teks untuk menu !</div>";
	}else{
		if(update("{$tb['halaman']} set judul = '$judul', isi = '$isi', menu = '$menu' where status = 'INTRO'")) {
			header("Location: {$admPage['hlm-depan']}");
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
				<input type="text" name="judul" value="<?php echo $IntroRow->judul; ?>" class="input lebar">
			</label>
			<br>
			<label>
				Deskripsi
				<br>
				<textarea class="ckeditor" name="isi"><?php echo $IntroRow->isi; ?></textarea>
				<div class="des">* Biasanya diisi dengan kata - kata sambutan</div>
			</label>
			<br>
			<label>
				Teks Menu
				<br>
				<input type="text" name="menu" value="<?php echo $IntroRow->menu; ?>" class="input">
				<div class="des">* Teks ini ditampilkan pada menu navigasi</div>
			</label>
			<br>
			<button type="submit" class="button"><i class="fa fa-save"></i> Simpan Perubahaan</button>
		</form>
	</div>
</div>

<?php
include("footer.php");
?>