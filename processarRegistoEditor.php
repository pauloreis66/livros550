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

	//verificar se os campos estão preenchidos
	//o URL é opcional
	if (!empty($_POST) AND empty($_POST['editoraNome'])) {
		header("Location: adminpageeditors.php");
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
	$editora = $_POST['editoraNome'];
	$editora2 = utf8_decode($editora);
	$url = $_POST['editoraUrl'];
	
	//verificar o nome do atributo input
	if (isset($_POST['cancel'])) {
		header("Location: adminpageeditors.php");
		exit;
    }
    elseif (isset($_POST['save'])) {
		$consulta = "INSERT INTO editoras (editora, url) VALUES ('$editora2','$url')";
		$resultado = mysqli_query($ligacao, $consulta);
		if (($resultado) !=1) {
			//caso não tenha sido inseridos com sucesso os dados
			echo "Erro ao inserir novo registo: " . $resultado . "<br>" . mysqli_error($ligacao);
			header("Location: adminpageeditors.php");
			exit;
			}
		else {
			echo "Inserido novo registo com sucesso. ";
			header("Location: adminpageeditors.php");
			exit;
		}
	}
	elseif (isset($_POST['doit'])) {
		$modo = $_GET['mode'];
		$idEditora = $_GET['id'];
		if ($modo == 'edit') {
			$consulta = "UPDATE editoras SET editora='".$editora2."', url='".$url."' WHERE idEditora=".$idEditora;
			$resultado = mysqli_query($ligacao, $consulta);
			echo $consulta;
			if (($resultado) !=1) {
				echo "Erro ao atualizar registo: " . $resultado . "<br>" . mysqli_error($ligacao);
				header("Location: adminpageeditors.php");
				exit;
			}
			else {
				echo "Registo atualizado com sucesso. ";
				header("Location: adminpageeditors.php");
				exit;
			}
		}
		elseif ($modo == 'delete') {
			$consulta = "DELETE FROM editoras WHERE idEditora=".$idEditora;
			$resultado = mysqli_query($ligacao, $consulta);
			if (($resultado) !=1) {
				echo "Erro ao eliminar registo: " . $resultado . "<br>" . mysqli_error($ligacao);
				header("Location: adminpageeditors.php");
				exit;
			}
			else {
				echo "Registo eliminado com sucesso. ";
				header("Location: adminpageeditors.php");
				exit;
			}
		}
	}

	mysqli_close($ligacao);
?>