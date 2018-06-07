<?php
	//verificar o nível da sessão
	session_start();
	if (isset($_SESSION['UserNivel'])) {
		if ($_SESSION['UserNivel']<3) {
			header("Location: login.php");
			exit;
		}
	}
	else {
		header("Location: login.php");
		exit;
	}

	//verificar se a variáveis estão a ser passadas
	if (isset($_GET['id']) AND isset($_GET['op'])) {
		
		$idUser= $_GET['id'];
		$operacao = $_GET['op'];
		
	} else {
		header("Location: adminpageusersblock.php");
		exit;
	}

	//Connect To Database
	$servidor="localhost";
	$utilizador="root";
	$password="root";
	$basedados="aeblivros";
	
	$ligacao = mysqli_connect($servidor,$utilizador,$password,$basedados) or die ("<html><script language='JavaScript'>alert('Unable to connect to database! Please try again later.'),history.go(-1)</script></html>");
	mysqli_select_db($ligacao, $basedados);
	
	$consulta = "UPDATE utilizadores SET ativo=".$operacao." WHERE idUser=".$idUser;
	$resultado = mysqli_query($ligacao, $consulta);
	
	if (($resultado) !=1) {
		echo "Erro ao atualizar registo: " . $resultado . "<br>" . mysqli_error($ligacao);
		header("Location: adminpageusersblock.php");
		exit;
	}
	else {
			echo "Registo atualizado com sucesso. ";
			header("Location: adminpageusersblock.php");
			exit;
	}

	mysqli_close($ligacao);
?>