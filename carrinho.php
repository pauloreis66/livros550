<?php

// inicia sessão 
session_start();

// ligação à base de dados
include("ligar_db.php");

// verifica número de sessão
$sessao = session_id();

// seleciona os livros requisitados temporariamente 	
$sql0 = "SELECT COUNT(idLivro) AS itens FROM temprequisicao WHERE sessao = '".$sessao."'";
$consulta0 = mysqli_query($ligacao, $sql0);
$resultado0 = mysqli_fetch_assoc($consulta2);

// se houver livros já requisitados, extrai o valor da contagem
if (mysqli_num_rows($consulta2) > 0) { 
	$itens = $resultado2['itens']; 
	} 
else {
		$itens = 0;
}
?>