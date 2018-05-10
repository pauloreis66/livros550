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
<script src="js/easyResponsiveTabs.js" type="text/javascript"></script>
<link href="css/easy-responsive-tabs.css" rel="stylesheet" type="text/css" media="all"/>
<link rel="stylesheet" href="css/global.css">
<script src="js/slides.min.jquery.js"></script>
<script>
		$(function(){
			$('#products').slides({
				preload: true,
				preloadImage: 'img/loading.gif',
				effect: 'slide, fade',
				crossfade: true,
				slideSpeed: 350,
				fadeSpeed: 500,
				generateNextPrev: true,
				generatePagination: false
			});
		});
	</script>
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
						<li><a href='#'>Checkout</a></li>
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
			    	<li class="active"><a href="index.php">Home</a></li>
			    	<li><a href="about.html">Sobre</a></li>
			    	<li><a href="delivery.html">Requisitar</a></li>
			    	<li><a href="contacto.php">Contacto</a></li>
					<?php
						//verificar se é administrador
						if (isset($_SESSION['UserNivel'])) {
							if ($_SESSION['UserNivel']>2) {
								echo "<li><a href='adminpages.php'>Administração</a></li>";
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
			<div class="col span_2_of_3">
				<div class="contact-form"><h2><center>Lista de Requisição</h2></center></div>
				<div class="listagrid">
				<?php
					$idUser = $_SESSION['UserID'];
					$sqlUser = "SELECT * FROM utilizadores WHERE idUser=".$idUser;
					$consultaUser = mysqli_query($ligacao, $sqlUser);
					$dados = mysqli_fetch_array($consultaUser);
					extract($dados);
				?>
				<table>
					<th>Os seus dados pessoais</th>
					<tr><td><?php echo $nome ?><br /><?php echo $nome ?><br /><?php echo $email ?></td></tr>
					
				</table>
				</div>
				<br />
				
				<div class="listagrid">
				<table>
					<th>&nbsp;</th><th>Livro:</th><th width="15%">Qtd.:</th>				
				<?php 
				
				//pesquisar dados sobre os livros no carrinho
				$sql_carrinho = "SELECT * FROM temprequisicao tmp JOIN livros liv ON tmp.idLivro = liv.idLivro WHERE sessao ='".$sessao. "' ORDER BY tmp.idLivro ASC";
				$consulta = mysqli_query($ligacao, $sql_carrinho);
				$resultado = mysqli_num_rows($consulta);
				$pastaCapas = "images/capas/";
					
				if ($resultado > 0) {
					while ($mostrar = mysqli_fetch_array($consulta)) {
						
							extract($mostrar);
							$quantidade = $mostrar['quantidade'];
							
							echo "<tr><td align='center'>";
							echo "<img src='$pastaCapas".$mostrar['imgCapa']."' border='0' width='50%' height='50%'></td>";
							
							$categoriaID = $mostrar["idCat"];
							$editoraID = $mostrar["idEditora"];
							$obterCat = mysqli_query($ligacao, "SELECT * FROM categorias WHERE idCat='$categoriaID'");
							$categoria = mysqli_fetch_array($obterCat);
							$obterEdit = mysqli_query($ligacao, "SELECT * FROM editoras WHERE idEditora='$editoraID'");
							$editora = mysqli_fetch_array($obterEdit);
							
							echo "<td>".$titulo."<br />".$autor."<br />".$editora[1]."<br />".$categoria[1]."</td>";
							
							echo "<td align='center'>".$quantidade."</td></tr>";
							
						}
						echo "<tr><td colspan='3' align='center'>";
						
						//registar nova requisição na base de dados
						//estado: 1 - livros requisitados, 2 - livros entregues
						$sql_regista = "INSERT INTO requisicao(idUser, dataRequisicao, estado) VALUES ('".$idUser."', NOW(),1)";
						$consulta3 = mysqli_query($ligacao, $sql_regista);
						$idReq = mysqli_insert_id($ligacao);
						
						$sql_regista_detalhes = "INSERT INTO detalhesrequisicao(idReq, idLivro, quantidade) 
								SELECT ".$idReq.", quantidade, idLivro FROM temprequisicao WHERE sessao ='".$sessao."'";
	
						$consulta4 = mysqli_query($ligacao, $sql_regista_detalhes);
	
						//eliminar dados temporarios da requisição
						$sql_elimina_temp = "DELETE FROM temprequisicao WHERE sessao='".$sessao."'";
						$consulta5 = mysqli_query($ligacao, $sql_elimina_temp);
						
						echo "<p>A sua requisição foi efetuada com sucesso e ficou registada com o número: ".$idReq."</p>";
						echo "<p>Será enviada uma cópia dos detalhes da compra para o seu e-mail.</p>";
						
						echo "</td></tr>";
					}
					else {
						echo "<tr><td colspan='3' align='center'>Não existem livros no seu carrinho.</td></tr>";
					}
				?>
				</table>
				</div>
				  
  			</div>
			
			<div class="col span_1_of_3">
				<div class="contact_info">
    	 			<h3>LEGAL NOTICE</h3>
					<div>loren ipsum</div>

      			</div>
      			<div class="company_address">
				     	<h3>Company Information :</h3>
						    	<p>500 Lorem Ipsum Dolor Sit,</p>
						   		<p>22-56-2-9 Sit Amet, Lorem,</p>
						   		<p>USA</p>
				   		<p>Phone:(00) 222 666 444</p>
				   		<p>Fax: (000) 000 00 00 0</p>
				 	 	<p>Email: <span><a href="mailto:@example.com">info@mycompany.com</a></span></p>
				   		<p>Follow on: <span>Facebook</span>, <span>Twitter</span></p>
				   </div>
			</div>
		</div>
    </div>
 </div>
 
   <div class="footer">
   	  <div class="wrap">	
	     <div class="section group">
				<div class="col_1_of_4 span_1_of_4">
						<h4>Information</h4>
						<ul>
						<li><a href="about.html">About Us</a></li>
						<li><a href="contact.html">Customer Service</a></li>
						<li><a href="#">Advanced Search</a></li>
						<li><a href="delivery.html">Orders and Returns</a></li>
						<li><a href="contact.html">Contact Us</a></li>
						</ul>
					</div>
				<div class="col_1_of_4 span_1_of_4">
					<h4>Why buy from us</h4>
						<ul>
						<li><a href="about.html">About Us</a></li>
						<li><a href="contact.html">Customer Service</a></li>
						<li><a href="#">Privacy Policy</a></li>
						<li><a href="contact.html">Site Map</a></li>
						<li><a href="#">Search Terms</a></li>
						</ul>
				</div>
				<div class="col_1_of_4 span_1_of_4">
					<h4>My account</h4>
						<ul>
							<li><a href="contact.html">Sign In</a></li>
							<li><a href="index.html">View Cart</a></li>
							<li><a href="#">My Wishlist</a></li>
							<li><a href="#">Track My Order</a></li>
							<li><a href="contact.html">Help</a></li>
						</ul>
				</div>
				<div class="col_1_of_4 span_1_of_4">
					<h4>Contact</h4>
						<ul>
							<li><span>+91-123-456789</span></li>
							<li><span>+00-123-000000</span></li>
						</ul>
						<div class="social-icons">
							<h4>Follow Us</h4>
					   		  <ul>
							      <li><a href="#" target="_blank"><img src="images/facebook.png" alt="" /></a></li>
							      <li><a href="#" target="_blank"><img src="images/twitter.png" alt="" /></a></li>
							      <li><a href="#" target="_blank"><img src="images/skype.png" alt="" /> </a></li>
							      <li><a href="#" target="_blank"> <img src="images/dribbble.png" alt="" /></a></li>
							      <li><a href="#" target="_blank"> <img src="images/linkedin.png" alt="" /></a></li>
							      <div class="clear"></div>
						     </ul>
   	 					</div>
				</div>
			</div>			
        </div>
        <div class="copy_right">
				<p>&copy; 2013 home_shoppe. All rights reserved | Design by <a href="http://w3layouts.com/">W3layouts</a></p>
		   </div>
    </div>
   <script type="text/javascript">
		$(document).ready(function() {			
			$().UItoTop({ easingType: 'easeOutQuart' });
			
		});
	</script>
    <a href="#" id="toTop"><span id="toTopHover"> </span></a>
</body>
</html>

