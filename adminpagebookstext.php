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
			    	<li><a href="index.php">Home</a></li>
			    	<li><a href="about.html">Sobre</a></li>
			    	<li><a href="delivery.html">Requisitar</a></li>
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
	     		<form method="POST" action="livroscatalogo.php">
					
					<input type="text" name="idSearch" value="Procurar" autocomplete="off" 
								onfocus="this.value = '';" 
								onblur="if (this.value == '') {this.value = 'Procurar';}" />
					<input type="submit" value=""> <!-- mostra a lupa--->
											
	     		</form>
	     	</div>
	     	<div class="clear"></div>
	     </div>	     	
   </div>

<div class="main">
    <div class="content">
    	<div class="section group">
		
			<div class="col span_1_of_3">
				<h3>LIVROS</h3>
				<img src="images/books2.png" alt="">
				<p>Tarefas disponíveis para gestão do catálogo de livros:</p>
				<div class="clear"></div>
				<div class="list">
					<ul>
						<li><a href="adminpagecategories.php">Categorias Técnicas</a></li>
						<li><a href="adminpageeditors.php">Editoras</a></li>
						<li><a href="adminpagelanguages.php">Idiomas</a></li>
						<li><a href="adminpagefinance.php">Origem / Medidas de Financiamento</a></li>
						<li><a href="adminpagebooks.php">Registos de Livros</a></li>
					</ul>
				</div>
				<div class="clear"></div>
			</div>
				
			<div class="col span_2_of_3">
				<h2>Registos de Livros</h2>
				<div class="clear"></div>
				<div class="reccord-form">

<?php
	//verificar qual o id e o mode
	$botao = "";
	if(!isset($_GET['id']) AND !isset($_GET['mode'])) {
		//não existe id nem mode
		header("Location: adminpagebooks.php");
		exit;
	}
	else {
		if(!isset($_GET['id'])) {
			//não existe id
			header("Location: adminpagebooks.php");
			exit;
			}
		else {
			$idLivro = $_GET['id'];
			$modo = $_GET['mode'];
			if ($modo == 'text') { $botao = "Atualizar sinopse"; }
		}
	}

	//Connect To Database
	$servidor="localhost";
	$utilizador="root";
	$password="root";
	$basedados="aeblivros";
		
	$ligacao = mysqli_connect($servidor,$utilizador,$password,$basedados) or die ("<html><script language='JavaScript'>alert('Unable to connect to database! Please try again later.'),history.go(-1)</script></html>");
	mysqli_select_db($ligacao, $basedados);
	mysqli_set_charset($ligacao, "utf8");
	
	$consultaCategorias = "SELECT idCat, categoria FROM categorias ORDER BY 1 ASC";
	$resultadoCategorias = mysqli_query($ligacao, $consultaCategorias);
		
	$consultaEditoras = "SELECT idEditora, editora FROM editoras ORDER BY 1 ASC";
	$resultadoEditoras = mysqli_query($ligacao, $consultaEditoras);
		
	
	# Verificar se o registo existe
	$consulta = "SELECT idLivro, idCat, idEditora, titulo, autor, imgCapa, sinopse FROM livros WHERE idLivro=" .$idLivro;
	$resultado = mysqli_query($ligacao, $consulta);
	
	if($resultado){
		//existe o registo
		while($linha = mysqli_fetch_array($resultado)){
			$campo1= $linha["idLivro"];
			$campo2 = $linha["idCat"];
			$campo3 = $linha["idEditora"];
			$campo4 = $linha["titulo"];
			$campo5 = $linha["autor"];
			//$campo6 = utf8_encode($linha["imgCapa"]);
			$campo6 = ($linha["imgCapa"]);
			$campo7 = ($linha["sinopse"]);
			$pastaCapas = "images/capas/";
		}
		?>
			<p><?php echo $botao. " do livro." ?></p>
			<div class="clear"></div>
			<form id="form_registo" method="POST" action="processarRegistoLivroSinopse.php">
			<!---
				<div>
					<span><label>ID:</label></span>
					<span><input type="text" class="short inactive" value="<?php echo $campo1 ?>" readonly></span>
				</div>
			--->
				<div>
					<span><label>Título:</label></span>
					<span><input type="text" class="inactive2" name="livroNome" value="<?php echo $campo4; ?>" readonly></span>
				</div>
				

				<div>
					<span><label>Autor(es):</label></span>
					<span><input type="text" class="inactive2" name="autorNome" value="<?php echo $campo5; ?>" readonly></span>
				</div>
				
				<div>
					<span><label>Categoria:</label></span>
					<span>
					<?php 
						echo "<select disabled class='inactive' name='categoriaId'>";
						while ($row = mysqli_fetch_array($resultadoCategorias, MYSQLI_ASSOC)) {
								if ($row["idCat"] == $campo2) {
									echo "<option selected value=".$row['idCat'].">".$row['categoria']."</option>";
								}
								else {
									echo "<option value=".$row['idCat'].">".$row['categoria']."</option>";
								}
						}
						echo "</select>";
					?>
					</span>
				</div>
				
				<div>
					<span><label>Editora:</label></span>
					<span>
					<?php 
						echo "<select disabled class='inactive' name='editoraId'>";
						while ($row = mysqli_fetch_array($resultadoEditoras, MYSQLI_ASSOC)) {
								if ($row["idEditora"] == $campo3) {
									echo "<option selected value=".$row['idEditora'].">".$row['editora']."</option>";
								}
								else {
									echo "<option value=".$row['idEditora'].">".$row['editora']."</option>";
								}
						}
						echo "</select>";
					?>
					</span>
				</div>

				
				<div>
					<span><label>Imagem de Capa:</label></span>
					<span><?php 
								echo "<img src='".$pastaCapas.$campo6."' border='0'>"; 
								echo "<p>".$pastaCapas.$campo6."</p>";
							?></span>
				</div>

				<div class="div2">
					<span><label>Sinopse:</label></span>
					<!--- <span> --->
					<script type="text/javascript" src="nicEdit-latest.js"></script>
					<script type="text/javascript">
						bkLib.onDomLoaded(function() {
						new nicEditor({fullPanel : true}).panelInstance('area2');
						new nicEditor({iconsPath : 'nicEdit/nicEditorIcons.gif'}).panelInstance('area2');
						new nicEditor({buttonList : ['fontSize','bold','italic','underline','strikeThrough','subscript','superscript','html','image']}).panelInstance('area2');
	new nicEditor({maxHeight : 100}).panelInstance('area2');
});
</script>
					
					<?php 
						if ($modo=='text') {
							//echo "<input type='text' class='textbox' name='sinopse' value='$campo7'>";
							echo "<textarea id='area2' name='sinopse' style='width: 600px; height: 100px;'>".$campo7."</textarea>";
						}
						else {
							//echo "<input type='text' class='inactive2' name='sinopse' value='$campo7' readonly>";
							echo "<textarea id='area2' name='sinopse' rows='5' cols='40' class='inactive2'>".$campo7."</textarea>";
						}
					?>
					<!--- </span> --->
					
					
					
	
				</div>
				
				<div class="clear"></div>
					<span><input type="submit" name="doit" value="<?php echo $botao ?>">
						<input type="hidden" name="id" value="<?php echo $campo1 ?>">
						<input type="submit" name="cancel" value="Cancelar" ></span>
							
				
	<?php
	}
	else {
			//caso não existam registos
			echo "Não foi encontrado o registo.";
	}
	?>
			</form>
				</div>
			</div>
    </div>
</div>

</div>

<?php include("footer.php"); ?>

</body>
</html>

