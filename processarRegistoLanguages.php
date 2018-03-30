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

	//verificar se o campo está preenchido
	if (!empty($_POST) AND empty($_POST['idiomaNome'])) {
		header("Location: adminpagelanguages.php");
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
	$idioma = $_POST['idiomaNome'];
	$idioma2 = utf8_decode($idioma);
	
	//verificar o nome do atributo input
	if (isset($_POST['cancel'])) {
		header("Location: adminpagelanguages.php");
		exit;
    }
    elseif (isset($_POST['save'])) {
		$consulta = "INSERT INTO idiomas (Idioma) VALUES ('$idioma2')";
		$resultado = mysqli_query($ligacao, $consulta);
		if (($resultado) !=1) {
			//caso não tenha sido inseridos com sucesso os dados
			echo "Erro ao inserir novo registo: " . $resultado . "<br>" . mysqli_error($ligacao);
			header("Location: adminpagelanguages.php");
			exit;
			}
		else {
			echo "Inserido novo registo com sucesso. ";
			header("Location: adminpagelanguages.php");
			exit;
		}
	}
	elseif (isset($_POST['doit'])) {
		$modo = $_GET['mode'];
		$idIdioma = $_GET['id'];
		if ($modo == 'edit') {
			$consulta = "UPDATE idiomas SET Idioma='".$idioma2."' WHERE idIdioma=".$idIdioma;
			$resultado = mysqli_query($ligacao, $consulta);
			echo $consulta;
			if (($resultado) !=1) {
				echo "Erro ao atualizar registo: " . $resultado . "<br>" . mysqli_error($ligacao);
				header("Location: adminpagelanguages.php");
				exit;
			}
			else {
				echo "Registo atualizado com sucesso. ";
				header("Location: adminpagelanguages.php");
				exit;
			}
		}
		elseif ($modo == 'delete') {
			$consulta = "DELETE FROM idiomas WHERE idIdioma=".$idIdioma;
			$resultado = mysqli_query($ligacao, $consulta);
			if (($resultado) !=1) {
				echo "Erro ao eliminar registo: " . $resultado . "<br>" . mysqli_error($ligacao);
				header("Location: adminpagelanguages.php");
				exit;
			}
			else {
				echo "Registo eliminado com sucesso. ";
				header("Location: adminpagelanguages.php");
				exit;
			}
		}
	}
	mysqli_close($ligacao);
?>