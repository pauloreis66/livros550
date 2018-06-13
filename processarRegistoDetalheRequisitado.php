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

	//verificar se os campos do formulário estão preenchidos
	if (!empty($_POST) AND empty($_POST['idLivro']) OR empty($_POST['quantidade'])) {	
		if (isset($_POST['id'])) {
			header("Location: adminpageslistarequisitardetalhe.php?id=".$_POST['id']);
			exit;
		} else {
				header("Location: adminpageslistarequisitar.php");
				exit;
		}
	}

	//Connect To Database
	$servidor="localhost";
	$utilizador="root";
	$password="root";
	$basedados="aeblivros";
	
	$ligacao = mysqli_connect($servidor,$utilizador,$password,$basedados) or die ("<html><script language='JavaScript'>alert('Unable to connect to database! Please try again later.'),history.go(-1)</script></html>");
	
	mysqli_select_db($ligacao, $basedados);
	
	//definir variáveis para escrever no registo
	//estas variáveis são as do formulário
	$idLivro= $_POST['idLivro'];
	$qtd = $_POST['quantidade'];
	
	//obter as variáveis ocultas passadas para controlar o registo
	$modo = $_POST['mode'];
	$id= $_POST['id'];
	
	if ($modo=='delete' OR $modo=='edit') {
			$idRi= $_POST['idRi'];
			$idLi= $_POST['idLi'];
			$qtdi = $_POST['qtdi'];
	}

	
	//verificar o nome do atributo input
	if (isset($_POST['cancel'])) {
		if (isset($_POST['id'])) {
			header("Location: adminpageslistarequisitardetalhe.php?id=".$id);
			exit;
		}
		else {
				header("Location: adminpageslistarequisitar.php");
				exit;			
			}
    }
    elseif (isset($_POST['save'])) {
		//INSERIR
		//verificar se existe algum registo com o mesmo idlivro para a requisição em tratamento
		$existe = "SELECT * FROM detalhesrequisicao WHERE idReq=".$id." AND idLivro=".$idLivro;
		$contagem = mysqli_query($ligacao, $existe);
		if (mysqli_num_rows($contagem) == 1) {
			//já existe um registo
			mysqli_free_result($contagem);
			header("Location: adminpageslistarequisitardetalhenew.php?idR=".$id);
			exit;
		}
		elseif (mysqli_num_rows($contagem) == 0) {
					//vai ser inserido num novo registo
					mysqli_free_result($contagem);
					$consulta = "INSERT INTO detalhesrequisicao (idReq, idLivro, quantidade) VALUES (".$id.",".$idLivro.",".$qtd.")";
					$resultado = mysqli_query($ligacao, $consulta);
					echo $consulta;
					if (($resultado) !=1) {
						//caso não tenha sido inseridos com sucesso os dados
						echo "Erro ao inserir novo registo: " . $resultado . "<br>" . mysqli_error($ligacao);
						header("Location: adminpageslistarequisitardetalhe.php?id=".$id."&e=4");
						exit;
					}
					else {
							echo "Inserido novo registo com sucesso. ";
							header("Location: adminpageslistarequisitardetalhe.php?id=".$id."&e=1");
							exit;
					}
		}
	}
	elseif (isset($_POST['doit'])) {
		
		if ($modo == 'edit') {
			//ATUALIZAR
			//verificar se existe alteração do livro ou da qtd
			if ($idLi == $idLivro) {
				if ($qtdi != $qtd) {
					//existe atualização para a quantidade
					$consulta = "UPDATE detalhesrequisicao SET quantidade=".$qtd." WHERE idReq=".$idRi." AND idLivro=".$idLi;
					$resultado = mysqli_query($ligacao, $consulta);
					if (($resultado) !=1) {
						echo "Erro ao atualizar registo: " . $resultado . "<br>" . mysqli_error($ligacao);
						header("Location: adminpageslistarequisitardetalhe.php?id=".$id."&e=2");
						exit;
					}
					else {
						echo "Registo atualizado com sucesso. ";
						header("Location: adminpageslistarequisitardetalhe.php?id=".$id."&e=1");
						exit;
					}
				}
				else {
					//nada a fazer
					header("Location: adminpageslistarequisitardetalhe.php?id=".$id);
					exit;
				}
			}
			else {
				//verificar se existe algum registo com o mesmo idlivro para a requisição em tratamento
				$existe = "SELECT * FROM detalhesrequisicao WHERE idReq=".$idRi." AND idLivro=".$idLivro;
				$contagem = mysqli_query($ligacao, $existe);
				if (mysqli_num_rows($contagem) == 1) {
					//já existe um registo
					mysqli_free_result($contagem);
					header("Location: adminpageslistarequisitardetalherec.php?idR=".$idRi."&idL=".$idLi."&q=".$qtdi."&mode=".$modo);
					exit;
				}
				elseif (mysqli_num_rows($contagem) == 0) {
					//vai ser atualizado o registo
					mysqli_free_result($contagem);
					$consulta = "UPDATE detalhesrequisicao SET idLivro=".$idLivro.", quantidade=".$qtd." WHERE idReq=".$idRi." AND idLivro=".$idLi;
					$resultado = mysqli_query($ligacao, $consulta);
			
					if (($resultado) !=1) {
						echo "Erro ao atualizar registo: " . $resultado . "<br>" . mysqli_error($ligacao);
						header("Location: adminpageslistarequisitardetalhe.php?id=".$id."&e=2");
						exit;
					}
					else {
						echo "Registo atualizado com sucesso. ";
						header("Location: adminpageslistarequisitardetalhe.php?id=".$id."&e=1");
						exit;
					}
				}
			}

		}		
		//ELIMINAR
		elseif ($modo == 'delete') {
			$consulta = "DELETE FROM detalhesrequisicao WHERE idReq=".$idRi." AND idLivro=".$idLi;
			$resultado = mysqli_query($ligacao, $consulta);
			if (($resultado) !=1) {
				echo "Erro ao eliminar registo: " . $resultado . "<br>" . mysqli_error($ligacao);
				header("Location: adminpageslistarequisitardetalhe.php?id=".$id."&e=3");
				exit;
			}
			else {
				echo "Registo eliminado com sucesso. ";
				header("Location: adminpageslistarequisitardetalhe.php?id=".$id."&e=1");
				exit;
			}
		}
	}

	mysqli_close($ligacao);
?>