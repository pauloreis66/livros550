<?php
	//função para redirecionar com as variáveis para o form anterior
	function FormRedirect($e, $d) {
		
		echo "<form name='fr' action='adminpageusersnew.php?erro=".$e."&msg=".$d."' method='POST'>";
		echo "<input type='hidden' name='login' value='".$_POST['login']."'>";
		echo "<input type='hidden' name='nome' value='".$_POST['nome']."'>";
		echo "<input type='hidden' name='email' value='".$_POST['email']."'>";
		echo "<input type='hidden' name='cargo' value='".$_POST['cargo']."'>";
		echo "<input type='hidden' name='nivel' value='".$_POST['nivel']."'>";
		echo "<input type='hidden' name='ativo' value='".$_POST['ativo']."'>";
		echo "<input type='hidden' name='senha' value='".$_POST['senha']."'>";
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
	
		
	if (!empty($_POST) AND ( empty($_POST['login']) OR empty($_POST['nome']) OR empty($_POST['email']) OR empty($_POST['nivel']) )) {

			FormRedirect(1, "Existem campos obrigatórios por preencher.");
			exit;
	}
	elseif ((strlen($_POST['senha'])<5) OR (empty($_POST['senha']))){
			FormRedirect(1, "A palavra-passe deve ter pelo menos 5 caracteres.");
			exit;
	}
	elseif (strcmp($_POST['senha'], $_POST['resenha'])!=0) {
			FormRedirect(1, "As palavras-passe não coincidem!");
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
    elseif (isset($_POST['save'])) {
		
		//verificar se o login existe
		$consulta = "SELECT * FROM utilizadores WHERE login LIKE '" .$login. "%'";
		$resultado = mysqli_query($ligacao, $consulta);	
		$linhas = mysqli_num_rows($resultado);
		
		if (($linhas) !=0) {
			FormRedirect(3, $login);
			exit;
		}
		
		//verificar se o email já está registado
		$consulta = "SELECT * FROM utilizadores WHERE login LIKE '" .$email. "%'";
		$resultado = mysqli_query($ligacao, $consulta);	
		$linhas = mysqli_num_rows($resultado);
		
		if (($linhas) !=0) {
			FormRedirect(4, $email);
			exit;
		}
		
		
		$consulta = "INSERT INTO utilizadores (login, nome, email, cargo, nivel, ativo) VALUES ('$login','$nome','$email','$cargo','$nivel','$ativo')";
		$resultado = mysqli_query($ligacao, $consulta);
		if (($resultado) !=1) {
			//caso não tenha sido inseridos com sucesso os dados
			$mmm = "Erro: " . $resultado . "<br>" . mysqli_error($ligacao);
			FormRedirect(2, $mmm);
			exit;
			}
		else {
			echo "Inserido novo registo com sucesso. ";
			header("Location: adminpageusers.php");
			exit;
		}
	}
	
	mysqli_close($ligacao);
	
?>