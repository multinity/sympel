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
include("config.php");

if(file_exists("db.php")){
	if(file_exists($themes['dir_file'])) {
		include("{$themes['dir_file']}");
	}else{
		include("{$file['error']}");
	}
}else{
	header("Location: $dir[install]/index.php");
}

?>
