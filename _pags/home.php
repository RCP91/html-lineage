
<?php if(!isset($pro)){echo 'Página protegida!'; exit;};?>


<?php

$p = isset($_GET['pag']) ? $_GET['pag'] : 1;
$explode = explode('/',$p);
$pg = isset($explode[1]) ? intval($explode[1]) : 1;
$maximo = intval(4);
$inicio = intval(($maximo*$pg) - $maximo);
if($inicio < 0){
	echo '<div class="alert alert-danger">
        <strong>Página Inexistente!</strong> Desculpe, mas está página não existe.
    </div>';
	echo '<div class="alert alert-danger">
        <strong>Por Favor!</strong> Selecione uma opção a partir do menu, caso este erro Persista entre em contato com a administração.
    </div>';
}else{

$destaque = $conexao->prepare("SELECT * FROM web_noticias WHERE destaque = '1' LIMIT 5");
$destaque->execute();
if($destaque->rowCount() >= 1){
	while($res_destaque = $destaque->fetch(PDO::FETCH_ASSOC)){
	$noticia = substr($res_destaque['noticia'],0,310);
?>

		<div class="bg-news">
		<ul class="boxposts_destaque">
			<li>
				<span class="thumb">
					<img src="_imagens/shield.png" alt="" width="166" height="166"/>
				</span>
				<span class="content">
					<h1><?php echo $res_destaque['titulo'];?></h1>
					<p><?php echo $noticia; if(strlen($noticia) >= '310'){echo '...';}?></p>
					<span class="datapost">Postado por : <strong><?php echo $res_destaque['autor'];?></strong></span>
					<div class="footerpost">
							<a href="index.php?pag=noticias_destaque/<?php echo $res_destaque['id'] ?>">Leia o arquivo completo</a>
							<span class="datapost">Publicação: <strong><?php echo date('d/m/Y - H:i', strtotime($res_destaque['data']));?></strong></span>
					</div>
				</span>
			</li>
		</ul>
		</div>

<?php
}
}
if(!isset($_SESSION[Servername."login"])){
$sql = $conexao->prepare("SELECT * FROM web_noticias WHERE destaque = '0' AND privado = '0' ORDER BY id DESC LIMIT $inicio,$maximo");
}else{
$sql = $conexao->prepare("SELECT * FROM web_noticias WHERE destaque = '0' ORDER BY id DESC LIMIT $inicio,$maximo");
}
$sql->execute();
if($sql->rowCount() ==  false){
	echo '<div class="alert alert-danger">
        <strong>Desculpe!</strong> Não temos nenhuma noticia no momento.
    </div>';
}else{
while($res = $sql->fetch(PDO::FETCH_ASSOC)){
	$noticia = substr($res['noticia'],0,310);
?>
		<div class="bg-news">
		<ul class="boxposts">
			<li>
				<span class="thumb">
					<img src="_imagens/shield.png" alt="" width="166" height="166"/>
				</span>
				<span class="content">
					<h1><?php echo $res['titulo'];?></h1>
					<p><?php echo $noticia; if(strlen($noticia) >= '310'){echo '...';}?></p>
					<span class="datapost">Postado por : <strong><?php echo $res['autor'];?></strong></span>
					<div class="footerpost">
							<a href="index.php?pag=noticias/<?php echo $res['id']; ?>">Leia o arquivo completo</a>
							<span class="datapost">Publicação: <strong><?php echo date('d/m/Y - H:i', strtotime($res['data']));?></strong></span>
					</div>
				</span>
			</li>
		</ul>
		</div>

<?php
}
}
?>

<div id="paginacao">

	<?php
	$sql_res = $conexao->prepare("SELECT * FROM web_noticias");
	$sql_res->execute();
	$paginas = ceil($sql_res->rowCount()/$maximo);
	$links = 1;
	
	if($sql->rowCount() >= 1){
	for($i = $pg-$links; $i <= $pg-1; $i++){
		if($i <= 0){}else{
			echo '<div class="prev"><a href="index.php?pag=home/'.$i.'">Página Anterior</a></div>';		
		}	
	}
	}
	
	for($i = $pg+1; $i <= $pg+$links; $i++){
		if($i > $paginas){}else{
			echo '<div class="next"><a href="index.php?pag=home/'.$i.'">Próxima Página</a></div>';	
		}
	}
	
	?>
    </div>
    <?php
	
}
	?>

