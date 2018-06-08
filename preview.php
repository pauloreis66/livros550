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
			    	<li><a href="sobre.php">Sobre</a></li>
			    	<li><a href="listarequisitar.php">Requisitar</a></li>
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
    	<div class="content_top">
    		<div class="back-links">
	<?php
		////abrir ligação à bd
		//include("ligar_db.php");
		//mysqli_set_charset($ligacao, "utf8");
		if(!isset($_GET['id'])) {
			//não existe id
			header("Location: index.php");
			exit;
		}
		else {
			$idLivro = $_GET['id'];
			$obterDados = mysqli_query($ligacao, "SELECT * FROM livros WHERE idLivro='$idLivro'");
			$categoriaID = mysqli_fetch_array($obterDados)[1];
			$obterDados = mysqli_query($ligacao, "SELECT * FROM livros WHERE idLivro='$idLivro'");
			$tituloLink = mysqli_fetch_array($obterDados)[3];
			$obterCat = mysqli_query($ligacao, "SELECT * FROM categorias WHERE idCat='$categoriaID'");
			$categoriaLink = mysqli_fetch_array($obterCat);
		}

		//// prepara sessão de requisição
		//$sessao = session_id();
		
		$consulta = "SELECT * FROM livros WHERE idLivro='$idLivro'";
		$resultado = mysqli_query($ligacao, $consulta);
		if(empty(mysqli_num_rows($resultado))){
			//não foi encontrado o registo
			//falta colocar aqui o link para uma pagina 404
			header("Location: index.php");
			exit;
		}
		else {
			//dados do registo
			while ($linha = mysqli_fetch_array($resultado)){
				$id = $linha["idLivro"];
				$nome = $linha["titulo"];
				$categoriaID = $linha["idCat"];
				$editoraID = $linha["idEditora"];
				$obterEdit = mysqli_query($ligacao, "SELECT * FROM editoras WHERE idEditora='$editoraID'");
				$editora = mysqli_fetch_array($obterEdit);
				$autor = $linha["autor"];
				$capa = $linha["imgCapa"];
				$pastaCapas = "images/capas/";
				$ano = $linha["anoEdicao"];
				$sinopse = $linha["sinopse"];
			}
		}
	?>
			
    		<p><a href="index.php">Home</a> > <?php 
					echo "<a href='livroscatalogo.php?id=" .$categoriaID. "'>".$categoriaLink[1]."</a> > "; 
					echo "<a href='preview.php?id=".$idLivro."'>".$tituloLink."</a>"; 
					?></p>
    	    </div>
    		<div class="clear"></div>
    	</div>
    	<div class="section group">
				<div class="cont-desc span_1_of_2">
				  <div class="product-details">
					<div class="grid images_3_of_2">
						<div id="container">
						   <div id="products_example">
							   <div id="products">
								<div class="slides_container">
									<?php 	echo "<img src='".$pastaCapas.$capa."' border='0'>"; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="desc span_3_of_2">
					<h2><?php echo $nome; ?></h2>
					<h3><?php echo $autor; ?></h3>
					<h3><?php echo $editora[1] ?></h3>
					<h3><?php echo "Ano de edição: ".$ano; ?></h3>
					<?php
						// seleciona a quantidade temporaria 	
						$sql2 = "SELECT quantidade FROM temprequisicao WHERE sessao = '".$sessao."' AND idLivro = '".$idLivro. "'";
						$consulta2 = mysqli_query($ligacao, $sql2);
						$resultado2 = mysqli_fetch_assoc($consulta2);
						// se houver quantidades já inseridas, extrai valores para os mostrar
						if (mysqli_num_rows($consulta2) > 0) { 
							$quantidade = $resultado2['quantidade']; 
							}
						// se não houver quantidade já inserida, atribui valor zero
						else {
							$quantidade = 0;
						}
					?>
					<div class="share-desc">
						<div class="share">
							<form method="POST" action="atualizarRequisitar.php">
						
							<p>Quantidade:</p>
							<p>
								<input type="text" name="quantidade" id="quantidade" size="10" value="<?php echo $quantidade ?>"/>
								<?php
										if ($quantidade > 0) {
											echo "<input type='submit' name='submit' value='Alterar' />&nbsp;&nbsp;";
											echo "<input type='submit' name='submit' value='Remover' />";
										// se a quantidade for nula, permite adicionar artigo
										} else {
											echo "<input type='submit' name='submit' value='Adicionar' />";
										}
										echo "<input type='hidden' name='idLivro' value='".$idLivro."'/>";	
									?>
							</p>
							</form>
						</div>
						<div class="clear"></div>
					</div>
					<div class="wish-list">
						<ul>
							<li class="wish"><a href="listarequisitar.php">Ver lista de requisição</a></li>
							<li class="wish"><a href="#">Finalizar</a></li>
						</ul>
					</div>
				</div>
			<div class="clear"></div>
		  </div>
		<div class="product_desc">	
			<div id="horizontalTab">
				<ul class="resp-tabs-list">
					<li>Sinopse</li>
					<li>Comentários</li>
					<div class="clear"></div>
				</ul>
				<div class="resp-tabs-container">
					<div class="product-desc">
						<p><?php echo $sinopse; ?></p>
					</div>


				<div class="review">
					<h4>Lorem ipsum Review by <a href="#">Finibus Bonorum</a></h4>
					 <ul>
					 	<li>Price :<a href="#"><img src="images/price-rating.png" alt="" /></a></li>
					 	<li>Value :<a href="#"><img src="images/value-rating.png" alt="" /></a></li>
					 	<li>Quality :<a href="#"><img src="images/quality-rating.png" alt="" /></a></li>
					 </ul>
					 <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
				  <div class="your-review">
				  	 <h3>How Do You Rate This Product?</h3>
				  	  <p>Write Your Own Review?</p>
				  	  <form>
					    	<div>
						    	<span><label>Nickname<span class="red">*</span></label></span>
						    	<span><input type="text" value=""></span>
						    </div>
						    <div><span><label>Summary of Your Review<span class="red">*</span></label></span>
						    	<span><input type="text" value=""></span>
						    </div>						
						    <div>
						    	<span><label>Review<span class="red">*</span></label></span>
						    	<span><textarea> </textarea></span>
						    </div>
						   <div>
						   		<span><input type="submit" value="SUBMIT REVIEW"></span>
						  </div>
					    </form>
				  	 </div>				
				</div>
			</div>
		 </div>
	 </div>
	    <script type="text/javascript">
    $(document).ready(function () {
        $('#horizontalTab').easyResponsiveTabs({
            type: 'default', //Types: default, vertical, accordion           
            width: 'auto', //auto or any width like 600px
            fit: true   // 100% fit in a container
        });
    });
   </script>		
   <div class="content_bottom">
    		<div class="heading">
    		<h3>Livros Relacionados</h3>
    		</div>
    		<div class="see">
    			<p><?php 
					echo "<a href='livroscatalogo.php?id=" .$categoriaID. "'>Ver outros títulos desta categoria</a>"; 
				?></p>
    		</div>
    		<div class="clear"></div>
    	</div>
   <div class="section group">
	<?php
		//procurar 4 livros aleatoriamente para exibir aqui
		$consulta="SELECT * FROM livros WHERE (idCat=$categoriaID AND idLivro<>$idLivro) ORDER BY RAND() LIMIT 4";
		$resultado = mysqli_query($ligacao, $consulta);
		
		while ($linha = mysqli_fetch_array($resultado)){
			$id = $linha["idLivro"];
			$nome = $linha["titulo"];
			$autor = $linha["autor"];
			$capa = $linha["imgCapa"];
			$pastaCapas = "images/capas/";
			$ano = $linha["anoEdicao"];
	?>
	
				<div class="grid_1_of_4 images_1_of_4">
					 <?php 	echo "<a href='preview.php?id=".$id."'>";
							echo "<img src='".$pastaCapas.$capa."' border='0'></a>"; ?>
					 <h2><?php echo str_pad($nome, 100, ' '); ?></h2>
					 <h3><?php echo str_pad($autor, 60, ' '); ?></h3>
					<div class="price-details">
				       <div class="price-number">
							<p><span class="escudos">
									<?php echo "Ano de edição:".$ano; ?>
								</span></p>
					    </div>
					    <div class="add-cart">								
								<h4><?php echo "<a href='preview.php?id=".$id."'>"; ?>
									<img src="images/bcart24.png" alt="Carrinho"></a></h4>
						</div>
						<div class="clear"></div>
					</div>
				</div>
			<?php
			//fim do ciclo
			}
			?>
			</div>
        </div>
		<div class="rightsidebar span_3_of_1">
			<div class="categories">
				<ul class="side-w3ls">
					<h3>Categorias</h3>
<?php
	$campo1="idCat";
	$campo2="categoria";
	
	# Verificar se o registo existe
	$consulta = "SELECT idCat, categoria FROM categorias ORDER BY 2 ASC";
	$resultado = mysqli_query($ligacao, $consulta);
	
	if($resultado){
		while($linha = mysqli_fetch_array($resultado)){
			$id = $linha["$campo1"];
			$nome = $linha["$campo2"];
			echo "<li class='side-w3ls'><a href='livroscatalogo.php?id=" .$id. "'>".$nome."</a></li>";
		}
	}
?>
    				</ul>

 				</div>
 		</div>
 	</div>
    </div>
 </div>
 
<?php include("footer.php"); ?>

</body>
</html>

