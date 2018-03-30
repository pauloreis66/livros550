<?php
//credenciais de acesso
$servidor = "localhost";
$utilizador = "root";
$password = "root";
$basedados = "aeb_livros";
$yourfield = "categoria";


//ligação considerando os parâmetros anteriores
$ligacao = mysqli_connect($servidor, $utilizador, $password, $basedados) or exit ('Erro de ligação à bd');
mysqli_select_db($ligacao, $basedados);

mysqli_set_charset($ligacao, "utf8");

$consulta = "SELECT * FROM categorias";
$resultado = mysqli_query($ligacao, $consulta);

while ($registo = mysqli_fetch_assoc($resultado)) {
	echo $registo["categoria"];
	echo "<br/>";
}
?>
