<?php
	//Connect To Database
	$servidor="localhost";
	$utilizador="root";
	$password="root";
	$basedados="aeblivros";
	
	$ligacao = mysqli_connect($servidor,$utilizador,$password,$basedados) or die ('Não foi possível ligar à base de dados.');
	
	mysqli_select_db($ligacao, $basedados) or die (mysqli_error($ligacao));
	//mysqli_set_charset($ligacao, "utf8");
?>
