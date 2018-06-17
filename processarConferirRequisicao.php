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
	
	if (isset($_GET['id'])) {
		$idReq = $_GET['id'];
	}
	else {
			header("Location: adminpageslistarequisitar.php");
			exit;
		}
		
	include("ligar_db.php");
	
	//verificar se existe detalhes da requisicao
	$consulta = "SELECT * FROM detalhesrequisicao WHERE idReq=".$idReq;
	$resultado = mysqli_query($ligacao, $consulta);
	if(!empty(mysqli_num_rows($resultado))) {
		$conta_reg = 0;
		$conta_data = 0;
		while($linha = mysqli_fetch_array($resultado)){
			//contar o numero de registos com data e os totais
			//verificar se a data está inserida
			$conta_reg = $conta_reg + 1;
			$data = date('Y-m-d', strtotime($linha['dataDevolucao']));
			if(strtotime($data)>0){
				$conta_data = $conta_data + 1;
			}
		}

		//comparar os totais da contagem
		if ($conta_data >0 AND ($conta_data = $conta_reg)){
			//atualizar o estado da requisicao
			$conferir = "UPDATE requisicao SET estado=2 WHERE idReq=".$idReq;
			$res = mysqli_query($ligacao, $conferir);

			if (($res) !=1) {
				echo "Erro ao atualizar registo: " . $res . "<br>" . mysqli_error($ligacao);
				header("Location: adminpageslistarequisitardetalhe.php?id=".$idReq."&e=6");
				exit;
			}
			else {
				echo "Estado conferido e atualizado com sucesso.";
				header("Location: adminpageslistarequisitardetalhe.php?id=".$idReq."&e=7");
				exit;
			}
		}
		else {
			//forçar a atualização do estado
			$conferir = "UPDATE requisicao SET estado=1 WHERE idReq=".$idReq;
			$res = mysqli_query($ligacao, $conferir);

			if (($res) !=1) {
				echo "Erro ao atualizar registo: " . $res . "<br>" . mysqli_error($ligacao);
				header("Location: adminpageslistarequisitardetalhe.php?id=".$idReq."&e=6");
				exit;
			}
			else {
				header("Location: adminpageslistarequisitardetalhe.php?id=".$idReq);
				exit;
			}
		}
		
	}
	else {
		header("Location: adminpageslistarequisitardetalhe.php?id=".$idReq."&e=5");
		exit;
	}
	
	mysqli_close($ligacao);
	
?>