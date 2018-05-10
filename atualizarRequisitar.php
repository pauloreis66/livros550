 <?php
// inicia sessão 
session_start();

// ligação à base de dados
include("ligar_db.php");

// verifica número de sessão
$sessao = session_id();

// captura valores da compra
$quantidade = $_REQUEST['quantidade'];
$idLivro = $_REQUEST['idLivro']; 
$modo = $_REQUEST['submit']; 

switch ($modo) {
case 'Adicionar':
    $sql_adicionar = "INSERT INTO temprequisicao (sessao, idLivro, quantidade) VALUES ('$sessao', '$idLivro', '$quantidade')";
    $consulta = mysqli_query($ligacao, $sql_adicionar); 
    header("Location:".$_SERVER['HTTP_REFERER']);
    exit();
    break;

case 'Alterar':
    if ($quantidade > 0) {
        $sql_alterar1 = "UPDATE temprequisicao SET quantidade = '$quantidade' WHERE sessao = '$sessao' AND idLivro = '$idLivro'";
        $consulta1 = mysqli_query($ligacao, $sql_alterar1); } 
		else {
        $sql_alterar2 = "DELETE FROM temprequisicao WHERE sessao = '$sessao' AND idLivro = '$idLivro'";
		$consulta2 = mysqli_query($ligacao, $sql_alterar2); 
	}
    header("Location:".$_SERVER['HTTP_REFERER']);
    exit();
    break;

case 'Remover':
    $sql_remover = "DELETE FROM temprequisicao WHERE sessao = '$sessao'  AND idLivro = '$idLivro'";
    $consulta = mysqli_query($ligacao, $sql_remover); 
    header("Location:".$_SERVER['HTTP_REFERER']);
    exit();
    break;
}
?>