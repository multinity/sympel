<?php
$p = @$_GET['p'];
if($p == ""){
	$p = "home";
}
$fileGet = "pages/{$p}.php";
if(file_exists("$fileGet")){
	include("$fileGet");
}else{
	include("../{$file['error']}");
}
?>