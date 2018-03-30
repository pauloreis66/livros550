<?php
	//verificar se os campos do registo estão preenchidos
	if (!empty($_POST) AND (empty($_POST['login']) OR empty($_POST['senha']))) {
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
	
	//definir variáveis $username e $password
	$userlogin = $_POST['login'];
	$password = $_POST['senha'];
	
	# Verificar se o registo existe
	
	$consulta = "SELECT idUser, Login, Senha, Nome, Nivel FROM utilizadores1 WHERE Login='$userlogin' AND Senha='$password' ";
	$resultado = mysqli_query($ligacao, $consulta);
	
	//verificar se foram devolvidos dados
	if (mysqli_num_rows($resultado) == 1) {
		//vamos remeter o utilizador para a página principal
		session_start();
		
		// Salva os dados encontados na variável $registo
		$registo = mysqli_fetch_array($resultado, MYSQLI_ASSOC);
		
		// Guarda os dados encontrados na sessão
		$_SESSION['UserID'] = $registo['idUser'];
		$_SESSION['UserLogin'] = $registo['Login'];
		$_SESSION['UserNivel'] = $registo['Nivel'];
		
		mysqli_free_result($resultado);
		mysqli_close($ligacao);
		// Redireciona o utilizador
		header("Location: index.php");
		exit;
	}
	else {
		//se não existem dados, remeter para a página de login
		mysqli_free_result($resultado);
		mysqli_close($ligacao);
		header("Location: login.php?erro=1&user=".$userlogin);
		exit;
		}
?>