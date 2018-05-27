<?php
	//função para redirecionar com as variáveis para o form anterior
	function FormRedirect($e, $i, $m, $d) {
		
		echo "<form name='fr' action='adminpageusersrec.php?id=".$i."&mode=".$m."&erro=".$e."&msg=".$d."' method='POST'>";
		echo "<input type='hidden' name='login' value='".$_POST['login']."'>";
		echo "<input type='hidden' name='nome' value='".$_POST['nome']."'>";
		echo "<input type='hidden' name='email' value='".$_POST['email']."'>";
		echo "<input type='hidden' name='cargo' value='".$_POST['cargo']."'>";
		echo "<input type='hidden' name='nivel' value='".$_POST['nivel']."'>";
		echo "<input type='hidden' name='ativo' value='".$_POST['ativo']."'>";
		echo "</form>";
		?>
			<script type="text/javascript">
				document.fr.submit();
			</script>
			
		<?php
	}
	//fim da funçao

	
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
		header("Location: adminpageusers.php");
		exit;
    }
	
	if (isset($_POST['doit'])) {
		$modo = $_GET['mode'];
		if ($modo == 'edit') {
			if (!empty($_POST) AND ( empty($_POST['login']) OR empty($_POST['nome']) OR empty($_POST['email']) OR empty($_POST['nivel']) )) {

				$id = $_GET['id'];
				FormRedirect(1, $id, $modo, "Existem campos por preencher.");
				exit;
			}
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
	$login = $_POST['login'];
	$nome = $_POST['nome'];
	$email= $_POST['email'];
	$cargo = $_POST['cargo'];
	$nivel = $_POST['nivel'];
	$ativo = $_POST['ativo'];
	
	//verificar o nome do atributo input
	if (isset($_POST['cancel'])) {
		header("Location: adminpageusers.php");
		exit;
    }
	elseif (isset($_POST['doit'])) {
		$modo = $_GET['mode'];
		$idUser = $_GET['id'];
		if ($modo == 'edit') {
			
			//verificar se o login existe
			$consulta = "SELECT * FROM utilizadores WHERE login LIKE '" .$login. "%' AND NOT idUser=" .$idUser;
			$resultado = mysqli_query($ligacao, $consulta);	
			$linhas = mysqli_num_rows($resultado);
		
			if (($linhas) !=0) {
				FormRedirect(4, $idUser, $modo, $login);
				exit;
			}	
			
			//verificar se o email já está registado
			$consulta = "SELECT * FROM utilizadores WHERE email LIKE '" .$email. "%' AND NOT idUser=" .$idUser;
			$resultado = mysqli_query($ligacao, $consulta);	
			$linhas = mysqli_num_rows($resultado);
		
			if (($linhas) !=0) {
				FormRedirect(4, $idUser, $modo, $email);
				exit;
			}	
			
			$consulta = "UPDATE utilizadores SET login='".$login."',nome='".$nome."',email='".$email."', cargo='".$cargo."',nivel='".$nivel."',ativo='".$ativo."' WHERE idUser=".$idUser;					
			$resultado = mysqli_query($ligacao, $consulta);

			if (($resultado) !=1) {
				$mmm = "Erro: " . $resultado . "<br>" . mysqli_error($ligacao);
				FormRedirect(2, $idUser, $modo, $mmm);
				exit;
			}
			else {
				echo "Registo atualizado com sucesso. ";
				header("Location: adminpageusers.php");
				exit;
			}
		}
		elseif ($modo == 'delete') {
			$consulta = "DELETE FROM utilizadores WHERE idUser=".$idUser;
			$resultado = mysqli_query($ligacao, $consulta);
			if (($resultado) !=1) {
				$mmm = "Erro: " . $resultado . "<br>" . mysqli_error($ligacao);
				FormRedirect(3, $idUser, $modo, $mmm);
				exit;
			}
			else {
				echo "Registo eliminado com sucesso. ";
				header("Location: adminpageusers.php");
				exit;
			}
		}
	}
	
	mysqli_close($ligacao);
	
?>