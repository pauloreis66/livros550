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
					<p>Ordem de requisição.</p>
					
					<table><tr><th>Req.</th><th>Data de Requisição:</th><th>Utilizador:</th><th>Estado:</th><th>&nbsp;</th>
<?php
	if(!isset($_GET['id'])) {
		//não existe id
		header("Location: adminpageslistarequisitar.php");
		exit;
	}
	else {
		$idReq = $_GET['id'];
	}
	//Connect To Database
	$servidor="localhost";
	$utilizador="root";
	$password="root";
	$basedados="aeblivros";
	
	$campo1="idReq";
	$campo2="nome";
	$campo3="dataRequisicao";
	$campo4="estado";
	
	$ligacao = mysqli_connect($servidor,$utilizador,$password,$basedados) or die ("<html><script language='JavaScript'>alert('Unable to connect to database! Please try again later.'),history.go(-1)</script></html>");
	mysqli_select_db($ligacao, $basedados);
	mysqli_set_charset($ligacao, "utf8");
	
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
			echo "<tr><td>" .$idR. "</td><td>".$data."</td><td>".$nome."</td><td>".$estadolbl."</td>";
			echo "<td><img src='images/calendar16.png' alt='conferir estado'>";
			echo "<a href='processarConferirRequisicao.php?id=".$idR."'>conferir</a></td></tr>";
		}
	}
?>
					</table>
				</div>	
				
				<div class="clear">&nbsp;</div>
				<div class="clear">&nbsp;</div>

				<div class="gridtable">
					<p>Detalhe da ordem de requisição efetuada.</p>
					<div class="erro">
					<?php
						if (isset($_GET['e'])) {
							$erro = $_GET['e'];
							switch ($erro) {
								case 1: $msge="Operação realizada com sucesso."; break;
								case 2: $msge="Erro ao atualizar registo."; break;
								case 3: $msge="Erro ao eliminar registo."; break;		
								case 4: $msge="Erro ao inserir registo."; break;	
								case 5: $msge="Erro ao aceder ao registo de detalhes."; break;	
								case 6: $msge="Erro ao conferir estado da requisicão."; break;		
								case 7: $msge="Estado conferido e atualizado com sucesso."; break;									
						}
						echo $msge;
						}
						else {
							echo " ";
						}	
					?>
					</div>
					<table><tr><th>Req.</th><th>Titulo:</th><th>Qtd.:</th><th>Entregue em:<th colspan="2">Operações:</th></tr>

<?php
	//navegação de paginas
	$registosPagina = 10;
	if (empty($_GET['pagina'])) {
		$_GET['pagina'] = 1;
		$pagina = 1;
	}
	$primeiroReg = ($_GET['pagina'] * $registosPagina) - $registosPagina;

	$campo1="idReq";
	$campo2="idLivro";
	$campo3="titulo";
	$campo4="quantidade";
	$campo5="dataDevolucao";
			
	# Verificar se existem registos
	$consulta = "SELECT d.idReq, d.idLivro, l.titulo, d.quantidade, d.dataDevolucao 
	FROM detalhesrequisicao AS d INNER JOIN livros AS l ON d.idLivro=l.idLivro WHERE d.idReq = " .$idReq. 
	" ORDER BY 1 ASC LIMIT $primeiroReg, $registosPagina";
	
	$resultado = mysqli_query($ligacao, $consulta);
	
	if(!empty(mysqli_num_rows($resultado))) {

		while($linha = mysqli_fetch_array($resultado)){
			$idR = $linha["$campo1"];
			$idL = $linha["$campo2"];
			$titulo = $linha["$campo3"];
			$qtd = $linha["$campo4"];
			$dataE = $linha["$campo5"];
			
			if(strtotime($linha["$campo5"])>0){
				$dataE = date('d-m-Y', strtotime($linha["$campo5"]));
			}
			
			echo "<tr><td>" .$idR. "</td><td>".$titulo."</td><td>".$qtd."</td><td>".$dataE."</td>";
			echo "<td nowrap><span><a href='adminpageslistarequisitardetalherec.php?idR=".$idR."&idL=".$idL."&q=".$qtd."&mode=edit'><img src='images/edit.png' alt='editar'>editar</a></span></td>";
			echo "<td nowrap><span><a href='adminpageslistarequisitardetalherec.php?idR=".$idR."&idL=".$idL."&q=".$qtd."&mode=delete'><img src='images/trash.png' alt='eliminar'>eliminar</span></td></tr>";
		}
		echo "</table><br>";
		//-----navegação entre páginas
		echo "<table><tr><th>";
		echo "<a href='adminpageslistarequisitar.php'><img src='images/undo.png' alt='voltar'>voltar</a></th>";
		echo "<th><img src='images/calendar.png' alt='conferir estado'><a href='processarConferirRequisicao.php?id=".$idR."'>conferir</a></th>";
		echo "<th><a href='adminpageslistarequisitardetalhenew.php?idR=".$idR."'><img src='images/add.png' alt='novo'>novo registo</a></th>";
		echo "<th><img src='images/pages.png' alt='páginas'> Página:&nbsp;";
		//calcular o numero de registos e numero de paginas necessarias
		$sqlTodosReg = mysqli_query($ligacao, "SELECT r.idReq, r.idUser, u.nome, r.dataRequisicao, r.estado 
	FROM requisicao AS r INNER JOIN utilizadores AS u ON r.idUser=u.idUser ORDER BY 1");
		$totalRegistos = mysqli_num_rows($sqlTodosReg);
		$totalPaginas = ceil($totalRegistos / $registosPagina);
		$totalPaginas++;
		//determinar o valor da pagina atual
		$pagina = $_GET['pagina'];
		//determinar se é a primeira pagina e mostrar numero
		if ($pagina ==1) {
			echo "<a href=?pagina=".($pagina)."></a>";
		}
		else {
			echo "<a href=?pagina=".($pagina-1).">Anterior</a>";
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
				echo "&nbsp;<a href=?pagina=$paginaSeguinte>$pag</a>&nbsp;";
			}
		}
		//determinar se é a ultima pagina
		if (($pagina+1) < $totalPaginas) {
			//se não é ultima, adiciona ligacao para a seguinte
			echo "<a href=?pagina=".($pagina+1).">Seguinte</a>";
		}
		else {
			echo "";
		}
		echo "</th></tr></table>";
	}
	else {
			//caso não existam registos
			echo "<tr><td colspan='6'>Não existem registos.</td></tr></table>";
			echo "<br>";
			echo "<table><tr><th colspan='6'>";
			echo "<a href='adminpageslistarequisitar.php'><img src='images/undo.png' alt='voltar'>voltar</a></th>";
			echo "<th><a href='adminpageslistarequisitardetalhenew.php?idR=".$idR."'><img src='images/add.png' alt='novo'>novo registo</a></th>";
			echo "</tr></table>";
	}
?>
				</div>
			</div>
			
			
    </div>
</div>

</div>

<?php include("footer.php"); ?>

</body>
</html>

