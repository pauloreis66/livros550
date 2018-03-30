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
	//livroNome
	//autorNome
	//categoriaId
	//editoraId
	//isbnNumero
	//edicaoAno
	//idiomaId
	//origemId
	//exemplarNrs
	
	if (!empty($_POST) AND ( empty($_POST['livroNome']) OR empty($_POST['autorNome']) OR empty($_POST['categoriaId']) OR empty($_POST['editoraId']) OR empty($_POST['isbnNumero']) OR empty($_POST['edicaoAno']) OR empty($_POST['idiomaId']) OR empty($_POST['origemId']) AND empty($_POST['exemplarNrs'])) ) {
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
	$titulo = $_POST['livroNome'];
	$titulo2 = utf8_decode($titulo);
	$autor = $_POST['autorNome'];
	$autor2 = utf8_decode($autor);
	$categoria = $_POST['categoriaId'];
	$editora = $_POST['editoraId'];
	$isbn = $_POST['isbnNumero'];
	$ano = $_POST['edicaoAno'];
	$idioma = $_POST['idiomaId'];
	$origem = $_POST['origemId'];
	$exemplares = $_POST['exemplarNrs'];
	
	//verificar o nome do atributo input
	if (isset($_POST['cancel'])) {
		header("Location: adminpagebooks.php");
		exit;
    }
    elseif (isset($_POST['save'])) {
		$consulta = "INSERT INTO livros1 (idCat, idEditora, titulo, autor, isbn, anoEdicao, idIdioma, idOrigem, exemplares) VALUES ('$categoria','$editora','$titulo2','$autor2','$isbn','$ano','$idioma','$origem','$exemplares')";
		$resultado = mysqli_query($ligacao, $consulta);
		if (($resultado) !=1) {
			//caso não tenha sido inseridos com sucesso os dados
			echo "Erro ao inserir novo registo: " . $resultado . "<br>" . mysqli_error($ligacao);
			header("Location: adminpagebooks.php");
			exit;
			}
		else {
			echo "Inserido novo registo com sucesso. ";
			header("Location: adminpagebooks.php");
			exit;
		}
	}
	elseif (isset($_POST['doit'])) {
		$modo = $_GET['mode'];
		$idLivro = $_GET['id'];
		if ($modo == 'edit') {
			$consulta = "UPDATE livros1 SET idCat='".$categoria."',idEditora='".$editora."',titulo='".$titulo2."',autor='".$autor."',isbn='".$isbn."',anoEdicao='".$ano."', idIdioma='".$idioma."', idOrigem='".$origem."', exemplares='".$exemplares."' WHERE idLivro=".$idLivro;
								
			$resultado = mysqli_query($ligacao, $consulta);
			echo $consulta;
			if (($resultado) !=1) {
				echo "Erro ao atualizar registo: " . $resultado . "<br>" . mysqli_error($ligacao);
				header("Location: adminpagebooks.php");
				exit;
			}
			else {
				echo "Registo atualizado com sucesso. ";
				header("Location: adminpagebooks.php");
				exit;
			}
		}
		elseif ($modo == 'delete') {
			$consulta = "DELETE FROM livros1 WHERE idLivro=".$idLivro;
			$resultado = mysqli_query($ligacao, $consulta);
			if (($resultado) !=1) {
				echo "Erro ao eliminar registo: " . $resultado . "<br>" . mysqli_error($ligacao);
				header("Location: adminpagebooks.php");
				exit;
			}
			else {
				echo "Registo eliminado com sucesso. ";
				header("Location: adminpagebooks.php");
				exit;
			}
		}
	}
	mysqli_close($ligacao);
?>