<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<head>
<title>CATÁLOGO DE LIVROS TÉCNICOS | Agrupamento de Escolas da Batalha</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/slider.css" rel="stylesheet" type="text/css" media="all"/>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script> 
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
<script type="text/javascript" src="js/startstop-slider.js"></script>

<style type="text/css">
input:invalid {
  border: 2px dashed red;
}

input:valid {
  border: 2px solid black;
}
</style>

</head>
<body>
  <div class="wrap">
	<div class="header">
		<div class="headertop_desc">
			<div class="call">
				 <h3>CATÁLOGO DE LIVROS TÉCNICOS</h3>
			</div>
			<div class="account_desc">
				<ul>
				<?php 
					//verificar se está autenticado
					//A sessão precisa ser iniciada em cada página diferente
					session_start();
					//verificar nivel
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
					
					//Verifica se não há a variável da sessão que identifica o utilizador
					if (!isset($_SESSION['UserID'])) {
						// Destrói a sessão por segurança
						session_destroy();
						//Apresenta os links para Registar ou para Login
						?>
						<li><a href='registar.php'>Registar</a></li>
						<li><a href='login.php'>Login</a></li>
					<?php
					}
					 else {
						//Apresenta os links para Checkout ou para Conta
						?>
						<li><a href='listarequisitar.php'>Checkout</a></li>
						<li><a href='logout.php'>Logout</a></li>
						<li><div class='dropdownmenu'>
							<span><a href='#'><?php echo $_SESSION['UserLogin']?></a>&nbsp;<img src='images/user18.png'></span>
							<div class="dropdownmenu-content">
								<p><a href='#'>Editar perfil</a></p>
								<p><hr noshade></p>
								<p><a href='#'>Administração</a></p>
							</div>
						</div></li>
					<?php
					}
				?>
				</ul>
			</div>
			<div class="clear"></div>
		</div>
		<div class="header_top">
			<div class="logo">
				<a href="index.php"><img src="images/aeblogo.png" alt="Agrupamento de Escolas da Batalha" /></a>
			</div>
			  <div class="cart">
					<p><span><img src="images/bcart48.png" alt="Carrinho"></span>
					<?php 
				   	//abrir ligação à bd
					include("ligar_db.php");
					mysqli_set_charset($ligacao, "utf8");
					
					// prepara sessão de requisição
					$sessao = session_id();
					
					// seleciona os livros requisitados temporariamente 	
					$sql0 = "SELECT COUNT(idLivro) AS itens FROM temprequisicao WHERE sessao = '".$sessao."'";
					$consulta0 = mysqli_query($ligacao, $sql0);
					$resultado0 = mysqli_fetch_assoc($consulta0);

					// se houver livros já requisitados, extrai o valor da contagem
					if (mysqli_num_rows($consulta0) > 0) { 
							$itens = $resultado0['itens']; 
							$msg = "Tem ".$itens." livros no seu carrinho.";
					} else {
							$itens = 0;
							$msg = "Não tem qualquer livro no seu carrinho.";
					}
					?>
						<div id="dd" class="wrapper-dropdown-2"><?php echo $itens ?> livro(s)
							<ul class="dropdown">
								<li><?php echo $msg ?></li>
						</ul>
						</div>
					</p>
			  </div>
			  <script type="text/javascript">
			function DropDown(el) {
				this.dd = el;
				this.initEvents();
			}
			DropDown.prototype = {
				initEvents : function() {
					var obj = this;

					obj.dd.on('click', function(event){
						$(this).toggleClass('active');
						event.stopPropagation();
					});	
				}
			}

			$(function() {

				var dd = new DropDown( $('#dd') );

				$(document).click(function() {
					// all dropdowns
					$('.wrapper-dropdown-2').removeClass('active');
				});

			});

		</script>
	 <div class="clear"></div>
  </div>
	<div class="header_bottom">
	     	<div class="menu">
	     		<ul>
			    	<li><a href="index.php">Home</a></li>
			    	<li><a href="sobre.php">Sobre</a></li>
			    	<li><a href="listarequisitar.php">Requisitar</a></li>
			    	<li><a href="contacto.php">Contacto</a></li>
					<?php
						//verificar se é administrador
						if (isset($_SESSION['UserNivel'])) {
							if ($_SESSION['UserNivel']>2) {
								echo "<li class='active'><a href='adminpages.php'>Administração</a></li>";
							}
						}
					?>
			    	<div class="clear"></div>
     			</ul>
	     	</div>
	     	<div class="search_box">
	     		<form>
	     			<input type="text" value="Procurar" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search';}"><input type="submit" value="">
	     		</form>
	     	</div>
	     	<div class="clear"></div>
	     </div>	     	
   </div>

<div class="main">
    <div class="content">
    	<div class="section group">
		
			<div class="col span_1_of_3">
				<h3>UTILIZADORES</h3>
				<img src="images/userProfile.png" alt="">
				<p>Tarefas disponíveis para gestão de utilizadores:</p>
				<div class="clear"></div>
				<div class="list">
					<ul>
						<li><a href="adminpageusers.php">Lista de Utilizadores</a></li>
						<li><a href="adminpageusersearch.php">Procurar um utilizador</a></li>
						<li><a href="adminpageusersnew.php">Inserir um novo utilizador</a></li>
						<li><a href="adminpageusersblock.php">Bloquear/Remover utilizador</a></li>
					</ul>
				</div>
				<div class="clear"></div>
			</div>
				
			<div class="col span_2_of_3">
				<h2>Utilizadores >> Novo Registo</h2>
				<div class="clear"></div>
				<div class="reccord-form">
					<p>Digite os dados solicitados nos campos seguintes.</p>
					<div class="clear"></div>
					<div class="clear"></div>
					
				<form id="form_registo" name="form_registo" method="POST" action="processarRegistoUserNew.php">
				
				<div class="erro"><?php
					if (isset($_POST['cancel'])) {
						header("Location: adminpageusersnew.php");
						exit;
					}
					
					if(isset($_GET['erro'])) { //SE EXISTIR ERRO 
						$erro = $_GET['erro'];
						$msge = $_GET['msg'];
						$msgw = "";
						$campo2 = $_POST['login'];
						$campo3 = $_POST['nome'];
						$campo4 = $_POST['email'];
						$campo5 = $_POST['cargo'];
						$campo6 = $_POST['nivel'];
						$campo7 = $_POST['ativo'];
						switch ($erro) {
							case 1: $msgw="Os dados inseridos não são válidos."; break;
							case 2: $msgw="Erro ao inserir registo na base de dados."; break;
							case 3: $msgw="O login pretendido já está registado!"; break;
							case 4: $msgw="O email indicado já está registado!"; break;							
						}
						echo $msgw;
						echo "<br>".$msge;
					}
					else {
						$campo2 = $campo3 = $campo4 = $campo5 = $campo6 = $campo7 = NULL;
					}
				?>&nbsp;</div>
				
				<!---
					<div>
						<span><label>ID:</label></span>
						<span><input type="text" class="short inactive" readonly></span>
					</div>
				--->
					<div>
						<span><label>* Utilizador / Nº Cartão:</label></span>
						<span><input type="text" class="textbox" name="login" value="<?php echo $campo2; ?>" placeholder="Insira o login de utilizador"></span>
					</div>
					
					<div>
						<span><label>* Nome e Apelido:</label></span>
						<span><input type="text" class="textbox" name="nome" value="<?php echo $campo3; ?>" placeholder="Insira o nome próprio e apelido"></span>
					</div>
					
					<div>
						<span><label>* Email:</label></span>
						<span><input type="email" name="email" id="email" value="<?php echo $campo4; ?>" placeholder="Insira um endereço de email válido"></span>
					</div>
					
					<div>
						<span><label>Cargo / Função:</label></span>
						<span><input type="text" name="cargo" id="cargo" value="<?php echo $campo5; ?>" placeholder="Insira o seu cargo ou função (ex. professor, aluno)"></span>
					</div>
					
					<div>
						<span><label>* Palavra-passe:</label></span>
						<span><input type="password" name="senha" id="senha" placeholder="Insira a senha pretendida para acesso"></span>
					</div>
					
					<div>
						<span><label>* Repetir Palavra-passe:</label></span>
						<span><input type="password" name="resenha" id="resenha" placeholder="Digite novamente a senha pretendida"></span>
					</div>		

					<div>
						<span><label>Nível:</label></span>
						<span>
						<?php 
							$niveis = array('Aluno', 'Professor', 'Admin');
							echo "<select name='nivel'>";
							for ($i = 0; $i < count($niveis); $i++) {  
								$k = $i + 1;
								if ($k == $campo6) {
									echo "<option selected value='$k'>$niveis[$i]</option>";
								}
								else {
									echo "<option value='$k'>$niveis[$i]</option>";
								}
							}
							echo "</select>";
						?>
						</span>
					</div>		

					<div>
						<span><label>Ativo:</label></span>
						<span>
						<?php 
							$estado = array('Não', 'Sim');
							echo "<select name='ativo'>";
							for ($i = 0; $i < count($estado); $i++) {  
								if ($i == $campo7) {
									echo "<option selected value='$i'>$estado[$i]</option>";
								}
								else {
									echo "<option value='$i'>$estado[$i]</option>";
								}
							}
							echo "</select>";
						?>
						</span>
					</div>					
				<div class="clear"></div>
				<small><label>Campos assinalados com asterisco (*) são de preenchimento obrigatório.</label></small>
				<div class="clear"></div>					
					<span><input type="submit" name="save" value="Guardar">
							<input type="submit" name="cancel" value="Cancelar" ></span>
							
				</form>
				</div>
			</div>
    </div>
</div>

</div>

<?php include("footer.php"); ?>

</body>
</html>

