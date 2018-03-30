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
	if (!empty($_POST) AND empty($_POST['categoriaNome'])) {
		header("Location: adminpagecategories.php");
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
	$categoria = $_POST['categoriaNome'];
	$categoria2 = utf8_decode($categoria);
	
	//verificar o nome do atributo input
	if (isset($_POST['cancel'])) {
		header("Location: adminpagecategories.php");
		exit;
    }
    elseif (isset($_POST['save'])) {
		$consulta = "INSERT INTO categorias (categoria) VALUES ('$categoria2')";
		$resultado = mysqli_query($ligacao, $consulta);
		if (($resultado) !=1) {
			//caso não tenha sido inseridos com sucesso os dados
			echo "Erro ao inserir novo registo: " . $resultado . "<br>" . mysqli_error($ligacao);
			header("Location: adminpagecategories.php");
			exit;
			}
		else {
			echo "Inserido novo registo com sucesso. ";
			header("Location: adminpagecategories.php");
			exit;
		}
	}
	elseif (isset($_POST['doit'])) {
		$modo = $_GET['mode'];
		$idCat = $_GET['id'];
		if ($modo == 'edit') {
			$consulta = "UPDATE categorias SET categoria='".$categoria2."' WHERE idCat=".$idCat;
			$resultado = mysqli_query($ligacao, $consulta);
			echo $consulta;
			if (($resultado) !=1) {
				echo "Erro ao atualizar registo: " . $resultado . "<br>" . mysqli_error($ligacao);
				header("Location: adminpagecategories.php");
				exit;
			}
			else {
				echo "Registo atualizado com sucesso. ";
				header("Location: adminpagecategories.php");
				exit;
			}
		}
		elseif ($modo == 'delete') {
			$consulta = "DELETE FROM categorias WHERE idCat=".$idCat;
			$resultado = mysqli_query($ligacao, $consulta);
			if (($resultado) !=1) {
				echo "Erro ao eliminar registo: " . $resultado . "<br>" . mysqli_error($ligacao);
				header("Location: adminpagecategories.php");
				exit;
			}
			else {
				echo "Registo eliminado com sucesso. ";
				header("Location: adminpagecategories.php");
				exit;
			}
		}
	}

	mysqli_close($ligacao);
?>