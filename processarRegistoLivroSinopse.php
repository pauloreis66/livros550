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

	if (isset($_POST['cancel'])) {
		header("Location: adminpagebooks.php");
		exit;
    }

	
	if (!empty($_POST) AND ( empty($_POST['id']) OR empty($_POST['sinopse']))) {
	
		header("Location: adminpagebooks.php");
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
	
	$sinopse = utf8_decode($_POST['sinopse']);
	
	
	//verificar o nome do atributo input
	if (isset($_POST['cancel'])) {
		header("Location: adminpagebooks.php");
		exit;
    }
    else {
		$idLivro = $_POST['id'];
		$consulta = "UPDATE livros SET sinopse='".$sinopse."' WHERE idLivro=".$idLivro;						
		$resultado = mysqli_query($ligacao, $consulta);
		if (($resultado) !=1) {
			echo "Erro ao atualizar registo: " . $resultado . "<br>" . mysqli_error($ligacao);
			header("Location: adminpagebookstext.php?id=".$idLivro."&mode=text");
			exit;
		}
		else {
			echo "Registo atualizado com sucesso. ";
			header("Location: adminpagebooks.php");
			exit;
			}
	}
	mysqli_close($ligacao);
?>