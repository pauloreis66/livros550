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
				<h3>REQUISIÇÕES</h3>
				<img src="images/calendar2.png" alt="">
				<p>Tarefas disponíveis para gestão de requisições:</p>
				<div class="clear"></div>
				<div class="list">
					<ul>
						<li><a href="adminpageslistarequisitar.php">Registos de Requisições</a></li>
						<li><a href="adminpageslistadevolver.php">Registos de Devoluções</a></li>
						<li><a href="#">Estatísticas</a></li>
						<li><a href="#">Relatórios</a></li>
					</ul>
				</div>
				<div class="clear"></div>
			</div>
			
			<div class="col span_2_of_3">
				<h2>Registos de Requisições</h2>
				<div class="clear"></div>
					
				<div class="gridtable">
					<p>Ordem de Requisição inicial:</p>
					
					<table><tr><th>Req.</th><th>Data de Requisição:</th><th>Estado:</th><th>Utilizador:</th>
<?php
	if(!isset($_GET['id'])) {
		//não existe id
		header("Location: adminpageslistarequisitar.php");
		exit;
	}
	else {
		$idReq = $_GET['id'];
	}
	
	$campo1="idReq";
	$campo2="nome";
	$campo3="dataRequisicao";
	$campo4="estado";
	
	$consulta = "SELECT r.idReq, r.idUser, u.nome, r.dataRequisicao, r.estado 
	FROM requisicao AS r INNER JOIN utilizadores AS u ON r.idUser=u.idUser WHERE r.idReq =" .$idReq;
	$resultado = mysqli_query($ligacao, $consulta);
	if(!empty(mysqli_num_rows($resultado))) {
		
		while($linha = mysqli_fetch_array($resultado)){
			$idR = $linha["$campo1"];
			$nome = $linha["$campo2"];
			$data = date('d-m-Y', strtotime($linha["$campo3"]));
			$estado = $linha["$campo4"];
			if ($estado == 1) { $estadolbl = "Requisitado"; } else { $estadolbl = "Entregue";}
			echo "<tr><td>" .$idR. "</td><td>".$data."</td><td>".$estadolbl."</td><td>".$nome."</td></tr>";
		}
	}
?>
					</table>
				</div>	
									
				<div class="clear">&nbsp;</div>
				<div class="clear">&nbsp;</div>
						
				<div class="reccord-form">

<?php
	//verificar qual os ids e o mode
	$botao = "";
	if(!isset($_GET['mode'])) {
		//não existe mode
		header("Location: adminpageslistarequisitar.php");
		exit;
	}
	else {
		$modo = $_GET['mode'];
		if ($modo == 'edit') { $botao = "Atualizar"; }
		if ($modo == 'delete') { $botao = "Eliminar"; }
	}
	
	
	# obter id de utilizador
	$obterUser = mysqli_query($ligacao, "SELECT idUser, nome FROM utilizadores ORDER BY nome ASC");
	
	# Verificar se o registo existe
	$consulta = "SELECT * FROM requisicao WHERE idReq=".$idReq;
	$resultado = mysqli_query($ligacao, $consulta);

	
	if($resultado){
		//existe o registo
		while($linha = mysqli_fetch_array($resultado)){
			$campo1= $linha["idReq"];
			$campo2 = $linha["idUser"];
			//$campo3 = date('d-m-Y', strtotime($linha["dataRequisicao"]));
			$campo4 = $linha["estado"];
			
			$campo3 = $linha["dataRequisicao"];

		}
		?>
			<p><?php echo $botao. " registo de requisição. Só é possível alterar utilizador e data." ?></p>
			<div class="clear"></div>
			<div class="erro">
				<?php
					if (isset($_GET['e'])) {
						$erro = $_GET['e'];
						switch ($erro) {
							case 1: $msge="Operação realizada com sucesso."; break;
							case 2: $msge="Erro ao atualizar registo."; break;
							case 3: $msge="Operação não válida. É primeiro necessário eliminar os registos de detalhe."; break;											
						}
						echo $msge;
						}
					else {
							echo " ";
						}	
				?>
			</div>
			
			
			
			<form id="form_registo" method="POST" action="processarRegistoRequisicao.php">
				
				<div>
					<span><label>ID Req.:</label></span>
					<span><input type="text" class="short inactive" value="<?php echo $campo1; ?>" readonly></span>
				</div>
				
				<?php
					if ($modo=='edit') {
						echo "<div><span><label>Utilizador:</label></span><span>";
						echo "<select name='idUser'>";
						while ($row = mysqli_fetch_array($obterUser, MYSQLI_ASSOC)) {
								if ($row["idUser"] == $campo2) {
									echo "<option selected value=".$row['idUser'].">".$row['nome']."</option>";
								}
								else {
									echo "<option value=".$row['idUser'].">".$row['nome']."</option>";
								}
						}
						echo "</select>";
					}
					else {
						$botao = "Eliminar";
						echo "<input type='hidden' value=".$campo2." name='idUser' />";
					}
				?>
				
				
				<div>
					<span><label>Data de requisição:</label></span>
					<span>
					<?php
					if ($modo=='edit') {
						echo "<input type='date' name='datae' value='".$campo3."'>";
					}
					else {
						echo "<input type='date' class='inactive' name='datae' value='".$campo3."' readonly>";
					}
					
					?>
					</span>
				</div>				
				
				<div class="clear"></div>
				<span><input type="submit" name="doit" value="<?php echo $botao ?>">
							<input type="submit" name="cancel" value="Cancelar" >
							<input type="hidden" value="<?php echo $modo; ?>" name="mode" />
							<input type="hidden" value="<?php echo $campo1; ?>" name="id" />
				</span>
				
	<?php
	}
	else {
			//caso não existam registos
			echo "<p class='erro'>Não foi encontrado o registo.</p>";
			echo "<p><img src='images/undo.png'>&nbsp;<a href='adminpageslistarequisitar.php'>Voltar</a></p>";
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
