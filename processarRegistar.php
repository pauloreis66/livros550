<?php
	//verficar se os campos do login estão preenchidos
	if (!empty($_POST) AND (empty($_POST['login']) OR empty($_POST['nome']) 
		OR empty($_POST['email']) OR empty($_POST['senha']) OR empty($_POST['resenha']))) {
		header("Location: login.php");
		exit;
	}
	//Connect To Database
	
	$servidor="localhost";
	$utilizador="root";
	$password="root";
	$basedados="aeblivros";
	
	$ligacao = mysqli_connect($servidor,$utilizador,$password,$basedados) or die ("<html><script language='JavaScript'>alert('Unable to connect to database! Please try again later.'),history.go(-1)</script></html>");
	
	mysqli_select_db($ligacao, $basedados);
	
	//definir variáveis para escrever no registo
	$userlogin = $_POST['login'];
	$usernome = $_POST['nome'];
	$email = $_POST['email'];
	$password = $_POST['senha'];
	$repassword = $_POST['resenha'];
	
	# Verificar se o registo existe
	
	$consulta = "INSERT INTO utilizadores1 (Login, Nome, Senha, Email) VALUES ('$userlogin','$usernome','$password','$email')";
	$resultado = mysqli_query($ligacao, $consulta);
	if (($resultado) !=1) {
		//caso não tenha sido inseridos com sucesso os dados
		header("Location: registar.php");
		exit;
	}
	else {
		header("Location: index.php");
		exit;
	}
	mysqli_free_result($resultado);
	mysqli_close($ligacao);
?>