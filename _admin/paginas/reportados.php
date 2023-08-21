<?php if(!isset($pros)){echo 'Pagina Protegida'; exit;};?>
			<table class="doacoes" width="1076">
				<tr>
					<th class="icon">Login</td>
					<th class="preco">Login do Reportado</th>
					<th class="preco">Motivo</th>
					<th class="nome">Descricao</th>
					<th class="botao">Imagem</th>
				</tr>
			</table>
<?php
	$pag = isset($_GET['pag']) && !empty($_GET["pag"]) ? $_GET['pag'] : 1;
	$maximo = 10;
	$inicio = ($pag*$maximo)-$maximo;
	$select = $conexao->prepare("SELECT * FROM web_report ORDER BY id DESC LIMIT $inicio,$maximo");
	$select->execute();
	$array = $select->fetchAll(PDO::FETCH_ASSOC);
	if($select->rowCount() <= 0){
			echo '<div class="alert alert-danger">
			    <strong>Erro!</strong> Nenhum comprovante de doação! </a>
			</div>';
	}

?>

<?php foreach($array as $res){ ?>
			<table class="doacoes" width="1076">
				<tr>
					<td class="icon"><?php echo $res['login'];?></td>
					<td class="preco"><span class="pname"><?php echo $res['reported_login'];?></i></span></td>
					<td class="preco"><span class="dprice"><i><?php echo $res["motivo"];?></i></span></td>
					<td class="nome"><span class="pprice"><i><?php echo $res["descricao"] ?></i></span></td>
					<td class="botao"><a href="../_upload/reportados/<?php echo $res["imagem"] ?>" id="deletar2">Clique Aqui</a></td>
				</tr>
			</table>

<?php } ?>

<div id="paginacao">
	<?php
	$sql_res = $conexao->prepare("SELECT * FROM web_report");
	$sql_res->execute();
	$total = $sql_res->rowCount();
	$paginas = ceil($total/$maximo);
	$links = 1;
	
	if($select->rowCount() >= 1){
	for($i = $pag-$links; $i <= $pag-1; $i++){
		if($i <= 0){}else{
			echo "<a class=\"btn-d2\" href=\"?p=reportados&pag=$i\"><span class=\"glyphicon glyphicon-chevron-left\"></span> Página Anterior</a>";	
		}	
	}
	}
	
	for($i = $pag+1; $i <= $pag+$links; $i++){
		if($i > $paginas){}else{
			echo "<a class=\"btn-d2\" href=\"?p=reportados&pag=$i\">Proxima Página <span class=\"glyphicon glyphicon-chevron-right\"></span> </a>";	
		}
	}


	?>
</div>