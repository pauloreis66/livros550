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
		header("Location: adminpageslistarequisitar.php");
		exit;
    }

	
	if (!empty($_POST) AND (empty($_POST['id'])) OR (empty($_POST['idUser'])) OR (empty($_POST['datae']))) {
	
		header("Location: adminpageslistarequisitar.php");
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
	
	$idReq = $_POST['id'];
	$idUser = $_POST['idUser'];
	$data1 = $_POST['datae'];
	$data = date('Y-m-d', strtotime($data1));
	
	//verificar o nome do atributo input
	if (isset($_POST['cancel'])) {
		header("Location: adminpageslistarequisitar.php");
		exit;
    }
	elseif (isset($_POST['doit'])) {
		
		$modo = $_POST['mode'];
		
		if ($modo == 'edit') {
			//ATUALIZAR
			$consulta = "UPDATE requisicao SET idUser=".$idUser.", dataRequisicao='".$data."' WHERE idReq=".$idReq;					
			$resultado = mysqli_query($ligacao, $consulta);
			echo $consulta;
			if (($resultado) !=1) {
				echo "Erro ao atualizar registo: " . $resultado . "<br>" . mysqli_error($ligacao);
				header("Location: adminpageslistarequisitarrec.php?id=".$idReq."&mode=edit&e=2");
				exit;
			}
			else {
				echo "Registo atualizado com sucesso. ";
				header("Location: adminpageslistarequisitar.php");
				exit;
			}

		}
		//ELIMINAR
		elseif ($modo == 'delete') {
			
			//verificar se existem detalhes
			$detalhes =  mysqli_query($ligacao, "SELECT * FROM detalhesrequisicao WHERE idReq=".$idReq);
			if ($detalhes) {
				echo "Operação inválida. Eliminar primeiro os registos de detalhe.";
				header("Location: adminpageslistarequisitarrec.php?id=".$idReq."&mode=edit&e=3");
				exit;
			}
			else {
					$consulta = "DELETE FROM requisicao WHERE idReq=".$idReq;
					$resultado = mysqli_query($ligacao, $consulta);
					echo $consulta;
					if (($resultado) !=1) {
						echo "Erro ao eliminar registo: " . $resultado . "<br>" . mysqli_error($ligacao);
						header("Location: adminpageslistarequisitarrec.php?id=".$id."&e=3");
						exit;
					}
					else {
							echo "Registo eliminado com sucesso. ";
							header("Location: adminpageslistarequisitar.php");
							exit;
					}
			}
			
		}
	}
	
	mysqli_close($ligacao);
?>