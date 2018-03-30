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
			  	   <p><span><img src="images/bcart48.png" alt="Carrinho"></span><div id="dd" class="wrapper-dropdown-2"> 0 livro(s)
			  	   	<ul class="dropdown">
							<li>Não tem qualquer livro no seu carrinho.</li>
					</ul></div></p>
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
	<div class="header_slide">
			<div class="header_bottom_left">				
				<div class="categories">
				  <ul>
				  	<h3>Categorias</h3>
<?php
	include("ligar_db.php");
	mysqli_set_charset($ligacao, "utf8");
	
	$campo1="idCat";
	$campo2="categoria";
	
	# Verificar se o registo existe
	$consulta = "SELECT idCat, categoria FROM categorias ORDER BY 2 ASC";
	$resultado = mysqli_query($ligacao, $consulta);
	
	if($resultado){
		while($linha = mysqli_fetch_array($resultado)){
			$id = $linha["$campo1"];
			$nome = $linha["$campo2"];
			echo "<li><a href='?id=" .$id. "'>".$nome."</a></li>";
		}
	}
?>
				  </ul>
				</div>					
	  	     </div>
			<div class="header_bottom_right">

<div class="content">
    	<div class="content_top">
			<div class="back-links">
	<?php
		if(!isset($_GET['id'])) {
			//não existe id
			$mode=0;
			$categoriaLink = "Todo o cátalogo";
		}
		else {
			$idCat = $_GET['id'];
			$mode=1;
			$categoriaID = $idCat;
			$obterCat = mysqli_query($ligacao, "SELECT * FROM categorias WHERE idCat='$categoriaID'");
			$categoriaLink = mysqli_fetch_array($obterCat)[1];
			if (strlen($categoriaLink)==0) {
				//se o id passado por url é inexistente
				$categoriaLink = "Todo o cátalogo";
				$mode=0;
			}
		}
	?>
					<p><a href="index.php">Home</a> > <?php echo "<a href='?id=" .$id. "'>".$categoriaLink."</a>"; ?></p>
			</div>
			<div class="see">
    			<p><a href="livroscatalogo.php">Ver todo o catálogo</a></p>
    		</div>
			<div class="clear"></div>
    	</div>
		<div class="section group">
		
	<?php
	
	//NAVEGAÇÃO DE PÁGINAS
	//fixar número de registos mostrados por página
	$registosPagina = 8;
	
	//caso seja a primeira página, é atribuído o valor de página=1
	if (empty($_GET['pagina'])) {
		$_GET['pagina'] = 1;
		$pagina = 1;
	}
	//calcular o valor do primeiro registo a solicitar
	$primeiroReg = ($_GET['pagina'] * $registosPagina) - $registosPagina;
	
	//criar a consulta à base de dados
	if ($mode !=0) {
		$consulta = "SELECT * FROM livros1 WHERE idCat='$categoriaID' ORDER BY titulo ASC LIMIT $primeiroReg, $registosPagina";
	}
	else {
		$consulta = "SELECT * FROM livros1 ORDER BY titulo ASC LIMIT $primeiroReg, $registosPagina";
	}
	$resultado = mysqli_query($ligacao, $consulta);
	
	//verificar se existem resultados a exibir
	if(!empty(mysqli_num_rows($resultado))){
	
		//exibir os registos
		while ($linha = mysqli_fetch_array($resultado)){
			$id = $linha["idLivro"];
			$nome = $linha["titulo"];
			$categoriaID = $linha["idCat"];
			$editoraID = $linha["idEditora"];
			$obterCat = mysqli_query($ligacao, "SELECT * FROM categorias WHERE idCat='$categoriaID'");
			$categoria = mysqli_fetch_array($obterCat);
			$obterEdit = mysqli_query($ligacao, "SELECT * FROM editoras WHERE idEditora='$editoraID'");
			$editora = mysqli_fetch_array($obterEdit);
			$autor = $linha["autor"];
			$capa = $linha["imgCapa"];
			$pastaCapas = "images/capas/";
			$ano = $linha["anoEdicao"];
		?>
				<div class="grid_1_of_4 images_1_of_4">
					 <?php 	echo "<a href='preview.php?id=".$id."'>";
							echo "<img src='".$pastaCapas.$capa."' border='0'></a>"; ?>
					 <h2><?php echo $nome; ?></h2>
					 <h3><?php echo $autor; ?></h3>
					 <h4><?php echo $categoria[1]; ?></h4>
					<div class="price-details">
						<div class="price-number">
							<p><span class="escudos">
									<?php echo $editora[1];
										echo "<br>Ano de edição: ";
										echo $ano; ?>
							</span></p>
						</div>
						<div class="add-cart2">
							<h4><?php echo "<a href='preview.php?id=".$id."'>"; ?>
								<img src="images/bcart24.png" alt="Carrinho"></a></h4>
						</div>
						<div class="clear"></div>
					</div>
				</div>
			<?php
			//fim do ciclo de exibir os registos
			}
			?>
			<div class="clear"></div>
			<div class="content_top">
				<div class="gridtable">
					<p class="navreg">Registos:&nbsp;
<?php
		//calcular o numero de registos e numero de paginas necessarias
		if ($mode !=0) {
			$sqlTodosReg = mysqli_query($ligacao, "SELECT * FROM livros1 WHERE idCat='$categoriaID' ORDER BY titulo ASC");
		}
		else {
			$sqlTodosReg = mysqli_query($ligacao, "SELECT * FROM livros1 ORDER BY titulo ASC");
		}
		$totalRegistos = mysqli_num_rows($sqlTodosReg);
		$totalPaginas = ceil($totalRegistos / $registosPagina);
		$totalPaginas++;
		//determinar o valor da pagina atual
		$pagina = $_GET['pagina'];
		//determinar se é a primeira pagina e mostrar numero
		if ($pagina ==1) {
			if ($mode==0) {
				echo "<a href=?pagina=".($pagina)."></a>";
			}
			else {
				echo "<a href=?id=".($idCat)."&pagina=".($pagina)."></a>";
			}
		}
		else {
			if ($mode==0) {
				echo "<a href=?pagina=".($pagina-1).">Anterior</a>";
			}
			else {
				echo "<a href=?id=".($idCat)."&pagina=".($pagina-1).">Anterior</a>";
			}
		}
		//determinar numero de paginas e coloca-los
		for ($pag=1; $pag<$totalPaginas; $pag++) {
			//determinar a pagina atual
			if ($pagina == $pag) {
				//apresentar os numeros restantes
				echo "&nbsp;[$pag]&nbsp;";
			}
			else {
				$paginaSeguinte = $pag;
				if ($mode==0) {
					echo "&nbsp;<a href=?pagina=$paginaSeguinte>$pag</a>&nbsp;";
				}
				else {
					echo "&nbsp;<a href=?id=".($idCat)."&pagina=$paginaSeguinte>$pag</a>&nbsp;";
				}
			}
		}
		//determinar se é a ultima pagina
		if (($pagina+1) < $totalPaginas) {
			//se não é ultima, adiciona ligacao para a seguinte
			if ($mode==0) {
				echo "<a href=?pagina=".($pagina+1).">Seguinte</a>";
			}
			else {
				echo "<a href=?id=".($idCat)."&pagina=".($pagina+1).">Seguinte</a>";
			}
		}
		else {
			echo "";
		}
		echo "</p>";
		?>
				</div>
			<div class="clear"></div>
			</div>
		
		<?php
		//fim do ciclo de consulta à bd
	}
	else {
			//caso não existam registos
			echo "<div class='clear'></div>";
			echo "<div class='clear'>&nbsp;</div>";
			echo "<div class='content_top'>";
			echo "<div class='gridtable'><p >Registos:&nbsp;Não existem registos.</p></div>";
			echo "<div class='clear'></div></div>";
	}
			?>
		</div>
		<div class="clear"></div>
</div>
			</div>
		   <div class="clear"></div>
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
					<h4>Contacto</h4>
						<ul>
							<li><span>Estrada da Freiria 2440-062 Batalha</span></li>
							<li><span><img src="images/telefone.png">244 769 290</span></li>
							<li><span><img src="images/email.png">es3batalha@gmail.com</span></li>
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
				<p>&copy; 2018 All rights reserved | Design by <a href="http://w3layouts.com/">W3layouts</a> adaptado para o AEB</p>
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

