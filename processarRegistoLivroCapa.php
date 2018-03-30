<?php
	header('Content-type: text/html; charset=utf-8');
	
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

	//verificar se a imagem foi carregada
	if (!empty($_POST) AND ( empty($_FILES['imagemCapa']['name'])) ) {
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
	//$imgNome = utf8_encode($_FILES['imagemCapa']['name']);
	$imgNome = $_FILES['imagemCapa']['name'];
	echo "<p>Nome da imagem:".$imgNome."</p>";
	
	//verificar o nome do atributo input
	if (isset($_POST['cancel'])) {
		header("Location: adminpagebooks.php");
		exit;
    }
    elseif (isset($_POST['doit'])) {
		$modo = $_GET['mode'];
		$idLivro = $_GET['id'];
		if ($modo == 'cover') {
			//determinar o tamanho e o tipo do ficheiro enviado
			$imgTamanho = round($_FILES['imagemCapa']['size'] / 1000);
			$imgTipo = $_FILES['imagemCapa']['type'];
			$imgExt = pathinfo($imgNome, PATHINFO_EXTENSION);

			//obter um novo nome para a imagem
			$consultaLivro = "SELECT idLivro, titulo FROM livros1 WHERE idLivro=" .$idLivro;
			$resultadoLivro = mysqli_query($ligacao, $consultaLivro);
			while ($row = mysqli_fetch_array($resultadoLivro, MYSQLI_ASSOC)) {
					if ($row["idLivro"] == $idLivro) {
						//$imgNovoNome = "000".$idLivro." - ".$row['titulo'].".".$imgExt;
						$unicode=utf8_encode($row['titulo']);
						$imgNovoNome = "000".$idLivro." - ".$unicode.".".$imgExt;
					}
					else {
						$imgNovoNome = "000".$idLivro." - sem_titulo.".$imgExt;
					}
			}
			//
			$imgPasta = "images/capas/";
			$imgLocal = $imgPasta.$imgNovoNome;
			echo "<p>Pasta:".$imgLocal."</p>";
			
			if ($imgTamanho < 350 && ($imgTipo == "image/jpeg" OR $imgTipo == "image/pjpeg")) {
				//copiar ficheiro para o destino
				//mysqli_set_charset($ligacao, "utf8");
				(move_uploaded_file($_FILES['imagemCapa']['tmp_name'], $imgLocal));
			
				$consulta = "UPDATE livros1 SET imgCapa='".$imgNovoNome."' WHERE idLivro=".$idLivro;
								
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
			//caso o upload não foi efetuado
			else {
				echo "<p>Não foi possível registar a imagem de capa.</p>";
				if ($imgTamanho > 350) {
					echo "<p>O tamanho do ficheiro é ".$imgTamanho." kB!</p>";
					header("Location: adminpagebookscover.php?id=".$idLivro."&mode=cover");
					exit;
				}
				else {
					echo "<p>O ficheiro do tipo ".$imgTipo." não é suportado!</p>";
					header("Location: adminpagebookscover.php?id=".$idLivro."&mode=cover");
					exit;
				}
			}
		}
	}
	mysqli_close($ligacao);
?>