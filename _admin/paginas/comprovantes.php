<?php if(!isset($pros)){echo 'Pagina Protegida'; exit;};?>
			<table class="doacoes" width="1076">
				<tr>
					<th class="icon">Doação de</td>
					<th class="preco">Pagamento</th>
					<th class="preco">Valor da Doação</th>
					<th class="preco">Autor</th>
					<th class="preco">Quant. de itens</th>
					<th class="nome">Nome dos Itens</th>
					<th class="preco">Data</th>
					<th class="preco">Comprovante</th>
				</tr>
			</table>
<?php
	$pag = isset($_GET['pag']) && !empty($_GET["pag"]) ? $_GET['pag'] : 1;
	$maximo = 10;
	$inicio = ($pag*$maximo)-$maximo;
	$select = $conexao->prepare("SELECT * FROM web_comprovantes ORDER BY id DESC LIMIT $inicio,$maximo");
	$select->execute();
	$array = $select->fetchAll(PDO::FETCH_ASSOC);
	if($select->rowCount() <= 0){
		    echo '<div class="alert alert-danger">
		              <strong>Error!</strong> Nenhum comprovante de doação. </a>
		          </div>';
	}

?>

<?php foreach($array as $res){ ?>
			<table class="doacoes" width="1076">
				<tr>
					<td class="icon"><?php echo $res['char_name'];?></td>
					<td class="preco"><span class="pname"><?php echo $res['forma_pag'];?></i></span></td>
					<td class="preco"><span class="dprice"><i><?php echo $res["valor"];?></i></span></td>
					<td class="preco"><span class="pprice"><i><?php echo $res["nome"] ?></i></span></td>
					<td class="preco"><span class="pprice"><i><?php echo count(explode(',',$res['itens']));?></i></span></td>
					<td class="nome"><span class="pname"><?php echo $res["itens"];?></i></span></td>
					<td class="preco"><span class="pprice"><i><?php echo date("d/m/y", strtotime($res["data"]));?> ás <?php echo date("H:i", strtotime($res["data"]));?></i></span></td>
					<td class="preco"><a href="../_upload/comprovantes/<?php echo $res["comprovante"] ?>" id="deletar2"><span class="glyphicon glyphicon-share-alt"></span> Clique Aqui</a></td>
				</tr>
			</table>

<?php } ?>

<div id="paginacao">
	<?php
	$sql_res = $conexao->prepare("SELECT * FROM web_comprovantes");
	$sql_res->execute();
	$total = $sql_res->rowCount();
	$paginas = ceil($total/$maximo);
	$links = 1;
	
	if($select->rowCount() >= 1){
	for($i = $pag-$links; $i <= $pag-1; $i++){
		if($i <= 0){}else{
			echo "<a class=\"btn-d2\" href=\"?p=comprovantes&pag=$i\"><span class=\"glyphicon glyphicon-chevron-left\"></span> Página Anterior</a>";	
		}	
	}
	}
	
	for($i = $pag+1; $i <= $pag+$links; $i++){
		if($i > $paginas){}else{
			echo "<a class=\"btn-d2\" href=\"?p=comprovantes&pag=$i\">Proxima Página <span class=\"glyphicon glyphicon-chevron-right\"></span> </a>";	
		}
	}


	?>
</div>