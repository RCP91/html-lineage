<?php
// Connect PHP PDO
$host	= "localhost"; //IP da hospedagem, dedicado ou servidor Local
$dbname	= "l2jmobiusc6"; //Nome do banco de dados
$user	= "";//usuario do Mysql (Padrao = root)
$senha	= "";//senha do mysql (padrao sem senha)
//Para melhor segunrança coloque um nome de usuario bem dificil, e uma senha contendo numeros e letras

//Não mecher daqui para baixo (conexao com banco de dados)
try {
	$conexao = new PDO ("mysql:host=$host;dbname=$dbname", "$user", "$senha");
	$conexao->setattribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	echo $e->getMessage();
}

?>
