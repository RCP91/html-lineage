<?php if(!isset($pros)){echo 'Pagina Protegida'; exit;};?>


<?php

	try{
		
	
	if(isset($_GET['action']) && $_GET['action'] == 'deletar'){
		
		$deleta = $conexao->prepare("DELETE FROM web_noticias WHERE id = (:id)");
		$deleta->bindValue(':id',intval($_GET['id']),PDO::PARAM_STR);
		$deleta->execute();
		$curtir_delete = $conexao->prepare("DELETE FROM web_curtir WHERE post_id = ?");
		$curtir_delete->execute(array($_GET["id"]));
		header("location: ?p=listar");
	}
	
	if(isset($_GET["action"])&& $_GET["action"] == 'editar'){
	
	$sss = $conexao->prepare("SELECT * FROM web_noticias WHERE id = (:id)");
	$sss->bindValue(':id',intval($_GET['id']),PDO::PARAM_STR);
	$sss->execute();
	$a = $sss->fetch(PDO::FETCH_ASSOC);
	?>
	
	<form action="" method="post">
	
		<input type="text" name="titulo" value="<?php echo $a["titulo"] ?>">
	    <select name="destaque">
			<?php
			if($a["destaque"] == 0){
			?>
	    	<option value="0">Não</option>
	        <option value="1">Sim</option>
	        <?php
			}else{
			?>
	        <option value="1">Sim</option>
	        <option value="0">Não</option>
	        <?php	
			}
			?>
	    </select>    
	    <select name="privar">
	    	<?php
			if($a["privado"] == 0){
			?>
	    	<option value="0">Não</option>
	        <option value="1">Sim</option>
	        <?php
			}else{
			?>
	        <option value="1">Sim</option>
	        <option value="0">Não</option>
	        <?php	
			}
			?>
	    </select>
	    </select>
		<textarea name="noticia"><?php echo $a["noticia"] ?></textarea>
		<input type="submit" value="Salvar" class="btn" style="margin-top:15px;">
	
	</form>
    
    <?php
	
	if(isset($_POST['titulo'])){
		$altera = $conexao->prepare("UPDATE web_noticias set titulo = (:titulo), noticia = (:noticia), destaque = (:destaque), privado = (:privado) where id = (:id)");
		$altera->bindValue(':titulo',$_POST['titulo'],PDO::PARAM_STR);
		$altera->bindValue(':noticia',$_POST['noticia'],PDO::PARAM_STR);
		$altera->bindValue(':id',$_GET['id'],PDO::PARAM_STR);
		$altera->bindValue(':destaque',$_POST["destaque"],PDO::PARAM_STR);
		$altera->bindValue(':privado',$_POST["privar"],PDO::PARAM_STR);
		$altera->execute();
		header("location: ?p=listar");	
	}
	
	exit;	
}

	if(isset($_GET['pg'])){
		$pg = intval($_GET['pg']);	
	}else{$pg = 1;}
	
	$maximo = 9;
	
	$inicio = ($pg * $maximo) - $maximo;
	$inicio = $inicio <= '0' ? $inicio = 0 : $inicio = $inicio;

	$seleciona = $conexao->prepare("SELECT * FROM web_noticias ORDER BY id DESC LIMIT $inicio,$maximo");
	$seleciona->execute();
	if($seleciona->rowCount() <= 0){
    echo '<div class="alert alert-danger">
          <strong>Error!</strong> Não há noticias para lista no momento. </a>
          </div>';
	}else{
	
	while($res = $seleciona->fetch(PDO::FETCH_ASSOC)){
		$res['noticia'] = substr($res['noticia'],0,140);
	?>
    
    <div id="listar">

	<a href="?p=listar&action=deletar&id=<?php echo $res['id'];?>" id="deletar"><span class="glyphicon glyphicon-remove"></span> Deletar</a>
	<a href="?p=listar&action=editar&id=<?php echo $res['id'];?>" id="deletar"><span class="glyphicon glyphicon-edit"></span> Editar</a>
	<div id="listar_title"><?php echo $res['titulo']; ?></div><!--listar_title-->
    <div id="listar_web_noticias"><?php echo $res['noticia']; if(strlen($res['noticia']) >= '140'){echo '...';}?></div><!--listar_noticia-->
	
	</div>

    
    <?php	
	}
	}
	
	}catch(PDOException $seleciona_erro){
		print $seleciona_erro->getMessage();
	}
	

?>

<div id="paginacao">
	
    <?php
	$sql_res = $conexao->prepare("SELECT * FROM web_noticias");
	$sql_res->execute();
	$total = $sql_res->rowCount();
	$paginas = ceil($total/$maximo);
	$link = 1;
	
	if($seleciona->rowCount() >= 1){
		for($i = $pg-$link; $i <= $pg-1;$i++){
		if($i <= 0){}else{
			echo '<a class="btn-d2" href="?p=listar&pg='.$i.'"><span class="glyphicon glyphicon-chevron-left"></span>  Página Anterior</a>';	
		}	
	}
	}
	
	for($i = $pg+1; $i <= $pg+$link; $i++){
		if($i > $paginas){}else{
		echo '<a class="btn-d2" href="?p=listar&pg='.$i.'">Próxima Página <span class="glyphicon glyphicon-chevron-right"></span></a>';	
		}
	}
	
	?>
    
</div><!--paginacao-->
