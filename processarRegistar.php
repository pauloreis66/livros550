<?php

	//função para redirecionar com as variáveis para o form anterior
	function FormRedirect($e) {
		
		echo "<form name='fr' action='registar.php?erro=".$e."' method='POST'>";
		echo "<input type='hidden' name='login' value='".$_POST['login']."'>";
		echo "<input type='hidden' name='nome' value='".$_POST['nome']."'>";
		echo "<input type='hidden' name='email' value='".$_POST['email']."'>";
		echo "<input type='hidden' name='cargo' value='".$_POST['cargo']."'>";
		echo "<input type='hidden' name='senha' value='".$_POST['senha']."'>";
		echo "<input type='hidden' name='resenha' value='".$_POST['resenha']."'>";
		echo "</form>";
		?>
			<script type="text/javascript">
				document.fr.submit();
			</script>
			
		<?php
	}
	//fim da funçao
	
	
	//verificar se os campos do login estão preenchidos
	if (!empty($_POST) AND (empty($_POST['login']) OR empty($_POST['nome']) 
		OR empty($_POST['email']) OR empty($_POST['cargo']) OR empty($_POST['senha']) OR empty($_POST['resenha']))) {
		FormRedirect(1);
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
	$userlogin = $_POST['login'];
	$usernome = $_POST['nome'];
	$email = $_POST['email'];
	$cargo = $_POST['cargo'];
	$password = $_POST['senha'];
	$repassword = $_POST['resenha'];
	
	# Verificar se o login já existe
	$consulta = "SELECT * FROM utilizadores WHERE login LIKE '" .$userlogin. "%'";
	$resultado = mysqli_query($ligacao, $consulta);	
	$linhas = mysqli_num_rows($resultado);
	if (($linhas) !=0) {
		FormRedirect(3);
		exit;
	}
	
	# Verificar se o email já existe
	$consulta = "SELECT * FROM utilizadores WHERE email LIKE '" .$email. "%'";
	$resultado = mysqli_query($ligacao, $consulta);	
	$linhas = mysqli_num_rows($resultado);
	if (($linhas) !=0) {
		FormRedirect(4);
		exit;
	}
	
	if ((strlen($_POST['senha'])<5) OR (empty($_POST['senha']))){
			FormRedirect(5);
			exit;
	}
	elseif (strcmp($_POST['senha'], $_POST['resenha'])!=0) {
			FormRedirect(6);
			exit;
	}
	
	
	$consulta = "INSERT INTO utilizadores (login, nome, senha, email, cargo) VALUES ('$userlogin','$usernome','$password','$email','$cargo')";
	$resultado = mysqli_query($ligacao, $consulta);
	if (($resultado) !=1) {
		//caso não tenha sido inseridos com sucesso os dados
		FormRedirect(2);
		exit;
	}
	else {
		header("Location: login.php");
		exit;
	}
	mysqli_free_result($resultado);
	mysqli_close($ligacao);
?>