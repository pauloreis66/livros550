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

	
	if (!empty($_POST) AND (empty($_POST['idUser']) OR empty($_POST['datae']))) {
	
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
	$idUser = $_POST['idUser'];
	$data1 = $_POST['datae'];
	$data = date('Y-m-d', strtotime($data1));
	
	//verificar o nome do atributo input
	if (isset($_POST['cancel'])) {
		header("Location: adminpageslistarequisitar.php");
		exit;
    }
	elseif (isset($_POST['save'])) {
		
		$regista = "INSERT INTO requisicao(idUser, dataRequisicao, estado) VALUES ('".$idUser."','".$data."',1)";
		$resultado = mysqli_query($ligacao, $regista);
		echo $regista;
		if (($resultado) !=1) {
				echo "Erro ao inserir registo: " . $resultado . "<br>" . mysqli_error($ligacao);
				header("Location: adminpageslistarequisitarnew.php");
				exit;
		}
		else {
				echo "Registo atualizado com sucesso. ";
				header("Location: adminpageslistarequisitar.php");
				exit;
		}

	}
	
	mysqli_close($ligacao);
?>