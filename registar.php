<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<head>
<title>CATÁLOGO DE LIVROS TÉCNICOS | Agrupamento de Escolas da Batalha</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script> 
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>


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
				<a href="index.php"><img src="images/aeblogo.png" alt="" /></a>
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
			    	<li class="active"><a href="index.php">Home</a></li>
			    	<li><a href="sobre.php">Sobre</a></li>
			    	<li><a href="listarequisitar.php">Requisitar</a></li>
			    	<li><a href="contacto.php">Contacto</a></li>
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
			<div class="col span_2_of_3">
				<div class="signup">
					<center><img src="images/user75.png" alt="Avatar"></center>
				  	<h2><center>Registo de novo utilizador</center></h2>
					<form name="form_login" method="POST" action="processarRegistar.php">
						<div class ="erro">
						
							<?php
								$msg="";		
								if(isset($_GET['erro'])) { //SE EXISTIR ERRO 
									$erro = $_GET['erro'];
									$campo1 = $_POST['login'];
									$campo2 = $_POST['nome'];
									$campo3 = $_POST['email'];
									$campo4 = $_POST['cargo'];
									$campo5 = $_POST['senha'];
									$campo6 = $_POST['resenha'];
									switch ($erro) {
										case 1: $msg="Todos os campos de preenchimento obrigatório."; break;
										case 2: $msg="Erro ao inserir registo na base de dados."; break;
										case 3: $msg="O login pretendido já está registado!"; break;
										case 4: $msg="O email indicado já está registado!"; break;
										case 5: $msg="A palavra-passe deve ter pelo menos 5 caracteres."; break;
										case 6: $msg="As palavras-passe não coincidem!"; break;
									}
									echo $msg;
								}
								else {
									$campo1 = $campo2 = $campo3 = $campo4 = $campo5 = $campo6 = NULL;
					}								
							?>&nbsp;</div>
							
					    	<div>
						    	<span><label>Utilizador / Nº Cartão:</label></span>
						    	<span><input type="text" name="login" id="login" value="<?php echo $campo1; ?>" placeholder="Insira o seu login de utilizador" required></span>
						    </div>
					    	<div>
						    	<span><label>Nome e Apelido:</label></span>
						    	<span><input type="text" name="nome" id="nome" value="<?php echo $campo2; ?>" placeholder="Insira o seu nome próprio e apelido" required></span>
						    </div>
					    	<div>
						    	<span><label>Email:</label></span>
						    	<span><input type="email" name="email" id="email" value="<?php echo $campo3; ?>" placeholder="Insira um endereço de email válido" required></span>
						    </div>
							<div>
						    	<span><label>Cargo / Função:</label></span>
						    	<span><input type="text" name="cargo" id="cargo" value="<?php echo $campo4; ?>" placeholder="Insira o seu cargo ou função (ex. professor, aluno)"></span>
						    </div>
						    <div>
						    	<span><label>Palavra-passe:</label></span>
						    	<span><input type="password" name="senha" id="senha" placeholder="Insira a sua senha pretendida para acesso" required></span>
						    </div>
						    <div>
						    	<span><label>Repetir Palavra-passe:</label></span>
						    	<span><input type="password" name="resenha" id="resenha" placeholder="Digite novamente a senha pretendida" required></span>
						    </div>

						  <div>
							<span><label>Ao criar uma conta está de acordo com a nossa <a href="#">Privacidade &amp; Termos de Utilização</a>.</label></span>
						  </div>
						  
						  <div>
							<span><input type="reset" value="Cancelar" class="myButton">
							<input type="submit" value="Registar" class="myButton"></span>
						  </div>
						  
					    </form>
				  </div>
  				</div>
				<div class="col span_1_of_3">
					<div class="contact_info">
    	 				<h3>A nossa localização:</h3>
					    	  <div class="map">								
									<iframe width="100%" height="175" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3071.482880427657!2d-8.820538784979828!3d39.661351079460026!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd227543cb0288ad%3A0xb7675d134de618f4!2sAgrupamento+de+escolas+da+Batalha!5e0!3m2!1spt-PT!2spt!4v1526058613970" ></iframe>
									<br><small><a href="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3071.482880427657!2d-8.820538784979828!3d39.661351079460026!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd227543cb0288ad%3A0xb7675d134de618f4!2sAgrupamento+de+escolas+da+Batalha!5e0!3m2!1spt-PT!2spt!4v1526058613970" style="color:#666;text-align:left;font-size:12px">Ver Mapa maior</a></small>
							  </div>
      				</div>
      			<div class="company_address">
				     	<h3>O nosso endereço:</h3>
						<p>Agrupamento de Escolas da Batalha</p>
						<p>Estrada da Freiria</p>
						<p>2440-062 Batalha</p>
				   		<p><img src="images/telefone.png">244 769 290</p>
				 	 	<p><img src="images/email.png">es3batalha@gmail.com</p>
				   </div>
				 </div>
			  </div>		
         </div> 
    </div>

<?php include("footer.php"); ?>

</body>
</html>

