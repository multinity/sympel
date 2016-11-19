<?php
$titleNow = "Tema Editor";
include("header.php");
?>

<?php
$temaPilih 	= @$_GET['tema'];
$scrollto 	= @$_GET['scrollto']; 
if(!$temaPilih) {
	$temaPilih = "{$themes['id']}";
}else{
	$temaPilih;
}
$sql_temaSelect = pilih("* from {$tb['themes']} where id = '{$temaPilih}' or tema = '{$temaPilih}'");
$themesJml 		= itung_row($sql_temaSelect);
if($themesJml < 1) {
	echo "<div class='block error'>Tema tidak ditemukan !</div>";
}else{
	$themesRow 		= tampilinO($sql_temaSelect);
	$fileTema 		= @$_GET['file'];
	$fileNameTema 	= $fileTema;
	$exFileTema 	= strtolower(end(explode(".", $fileTema)));
	if(!$fileTema or !$fileNameTema) {
		$fileTema = "main.php";
		$fileNameTema = "main.php";
	}else{
		$fileTema;
		if($exFileTema == "css"){
			$fileTema 	= "css/$fileTema";
		}else{
			$fileTema;
		}
	}
	

	$fileTemaReal = "../{$dir['themes']}/{$themesRow->tema}/$fileTema";
	if(!file_exists($fileTemaReal)) {
		echo "<div class='block error'>Berkas tidak ditemukan !</div>";
	}else{
?>

	<?php
	if($_POST) {
		$scrollto 	= $_POST['scrollto'];
		$updateFile = $_POST['code'];
		if(file_put_contents($fileTemaReal, $updateFile)){
			header("location: {$site['admin']}{$admPage['editor']}&file=$fileNameTema&tema={$themesRow->tema}&scrollto={$scrollto}");
		}
	}
	?>
<h1>Tema Editor: <?php echo $themesRow->nama; ?> (<?php echo $fileNameTema; ?>)</h1>

	<div class="blok">
		<div class="tema-list">
			<select name="tema" class="select" onchange="document.location.href='<?php echo "{$admPage['editor']}&file=$fileNameTema&scrollto=$scrollto&tema="; ?>'+this.options[this.selectedIndex].value;">
				<?php
				$sql_themesList 	= pilih("* from {$tb['themes']}");
				while($themesList 	= tampilinO($sql_themesList)){
				?>
				<option value="<?php echo $themesList->tema; ?>" <?php if($themesRow->id == $themesList->id){echo "selected";} ?>><?php echo $themesList->nama; ?></option>
				<?php } ?>
			</select>
		</div>

		<div class="file-list">
			<li><a href="<?php echo "{$admPage['editor']}&file=main.php&tema={$themesRow->tema}"; ?>" class="<?php if($fileNameTema == "main.php"){echo "selected";} ?>">main.php</a></li>
			<li><a href="<?php echo "{$admPage['editor']}&file=index.php&tema={$themesRow->tema}"; ?>" class="<?php if($fileNameTema == "index.php"){echo "selected";} ?>">index.php</a></li>
			<li><a href="<?php echo "{$admPage['editor']}&file=header.php&tema={$themesRow->tema}"; ?>" class="<?php if($fileNameTema == "header.php"){echo "selected";} ?>">header.php</a></li>
			<li><a href="<?php echo "{$admPage['editor']}&file=footer.php&tema={$themesRow->tema}"; ?>" class="<?php if($fileNameTema == "footer.php"){echo "selected";} ?>">footer.php</a></li>
			<li><a href="<?php echo "{$admPage['editor']}&file=style.css&tema={$themesRow->tema}"; ?>" class="<?php if($fileNameTema == "style.css"){echo "selected";} ?>">style.css</a></li>
		</div>

		<div class="bodi">
			<form method="post" class="form" id="editor-form">
				<textarea class="editor" name="code" id="editor"><?php echo trim(htmlentities(file_get_contents($fileTemaReal))); ?></textarea>
				<br>
				<input type="hidden" name="scrollto" value="0" id="scrollto">
			<button type="submit" class="button"><i class="fa fa-save"></i> Simpan Perubahaan</button>
			</form>
		</div>
	</div>
		<script type="text/javascript">
		$(function(){
			$("#editor").scroll(function(){
				$("#scrollto").val( $("#editor").scrollTop() );
			});
			$("#editor").scrollTop(<?php echo $scrollto; ?>);
		});
		</script>
<?php
	}
}
include("footer.php");
?>