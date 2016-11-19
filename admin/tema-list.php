	<?php
	$sql_temaAll = pilih("* from {$tb['themes']} order by status");
	if(itung_row($sql_temaAll) < 1) {
		echo "<i>Tidak ada tema !</i>";
	}
	while($temaRow = tampilinO($sql_temaAll)) {
	?>
		<div class="thumb">
			<div class="gambar">
				<img src="<?php echo "{$site['root']}{$dir['themes']}/{$temaRow->tema}/thumb.jpg"; ?>">
			</div>
			<div class="nama">
				<?php echo $temaRow->nama; ?>
			</div>
			<div class="des">
				<?php echo "{$temaRow->author}({$temaRow->tahun})"; ?>
			</div>
			<div class="footer">
				<div class="button-group">
				<?php
				if($temaRow->status == "Y") {
				?>
					<a class="btn aktif" title="Sedang Digunakan"><i class="fa fa-check"></i></a>
				<?php }else{ ?>
					<a href="<?php echo "{$admPage['tema-act']}{$temaRow->id}"; ?>" title="Aktifkan" class="btn"><i class="fa fa-check"></i></a>
				<?php } ?>
				<a href="<?=$admPage['editor'];?>&file=main.php&tema=<?=$temaRow->tema;?>" title="Edit Tema" class="btn"><i class="fa fa-pencil"></i></a>
				<?php
				if($temaRow->status == "N") {
				?>
					<a href="<?php echo "{$admPage['tema']}&del={$temaRow->id}"; ?>" class="btn red"title="Hapus" onclick="return confirm('Tema akan dihapus secara permanent, tetap lanjutkan?');"><i class="fa fa-trash"></i></a>
				<?php } ?>
				</div>
			</div>
		</div>
	<?php } ?>
