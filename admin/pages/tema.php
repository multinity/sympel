<?php
$titleNow = "Tema";
include("header.php");
?>
<h1>Tema 
	<a href="<?=$admPage['tema'];?>&upload=true" class="btn right primary">+ Tambah Tema Baru</a>
</h1>

<?php
$getAct = mysql_real_escape_string(@$_GET['act']);
$upload = mysql_real_escape_string(@$_GET['upload']);
$del = mysql_real_escape_string(@$_GET['del']);
if($getAct) {
	$sql_temaS 		= pilih("* from {$tb['themes']} where id = '$getAct'");
	$cek_tema 		= itung_row($sql_temaS);
	if($cek_tema == 1){
		$sql_temaAktif 	= update("{$tb['themes']} set status = 'N' where status = 'Y'");
		$sql_temaAktif 	= update("{$tb['themes']} set status = 'Y' where id = '$getAct'");
		if($sql_temaAktif) {
			header("Location: {$admPage['tema']}");			
		}
	}else{
		header("Location: {$admPage['tema']}");
	}
}

if($del) {
	$sql_temaS 		= pilih("* from {$tb['themes']} where id = '$del'");
	$cek_tema 		= itung_row($sql_temaS);
	$rtema 			= tampilinO($sql_temaS);
	if($cek_tema == 1){	
		// if(rmdir(ROOTPATH . "/" . $dir['themes'] . "/" . $rtema->tema)){
			if(hapus("{$tb['themes']} where id = '$del'")) {
				header("Location: {$admPage['tema']}");
			}
		// }
	}else{
		header("Location: {$admPage['tema']}");
	}
}

if(@$_POST) {
	$nama = mysql_real_escape_string(@$_POST['nama']);
	$tema = mysql_real_escape_string(@$_POST['dir']);
	$author = mysql_real_escape_string(@$_POST['author']);
	$tahun = mysql_real_escape_string(@$_POST['tahun']);

	$dest = ROOTPATH.'/'.$dir['themes']."/";
	if(move_uploaded_file($_FILES['tema']['tmp_name'], $dest.$_FILES['tema']['name'])){
		$zip = new ZipArchive();
		$zip->open($dest.$_FILES['tema']['name']);
		$zip->extractTo($dest.'/');
		$zip->close();
		if(unlink($dest.$_FILES['tema']['name'])){
			if(tambah($tb['themes']." VALUES(NULL, '$nama', '$tema', '$author', '$tahun', 'N')")){
				header('Location: '.$admPage['tema']);
			}else{
				echo '<div class="panel error">Kesalahan saat menambahkan tema.</div>';
			}
		}
	}
}

if($upload == 'true') {
?>
<div class="blok">
	<form method="post" class="form-horizontal" enctype="multipart/form-data">
		<label>
			Nama Tema
			<br>
			<input type="text" name="nama" class="input">
		</label>

		<label>
			Nama Folder
			<br>
			<input type="text" name="dir" class="input">
		</label>

		<label>
			Tema
			<br>
			<input type="file" name="tema" class="input">
		</label>

		<label>
			Author
			<br>
			<input type="text" name="author" class="input">
		</label>

		<label>
			Tahun Publish
			<br>
			<input type="text" name="tahun" class="input">
		</label>

		<input type="submit" class="btn green" value="Tambah Tema">
	</form>
</div>
<?php
}else{
?>

<div class="blok">
	<div class="bodi">
	<div class="tema">
	<?php include("tema-list.php"); ?>
	</div>
	</div>
</div>
<?php } ?>

<?php
include("footer.php");
?>