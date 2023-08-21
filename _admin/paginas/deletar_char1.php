<form action="" method="post" name="de" id="do">
<input type="submit" name="excluir" value="Deletar" class="btn"/>
</form>
<br />
<?php

	if(isset($_POST['excluir']) && $_POST['excluir'] == 'Deletar'){

	$selecionar_char = $conexao->prepare("SELECT * FROM characters WHERE level = '1'");
	$selecionar_char->execute();
	$count = $selecionar_char->rowCount();

	$deletar_char = $conexao->prepare("DELETE FROM characters WHERE level = '1'");
	$deletar_char->execute();
	if($deletar_char == '1'){
		echo "$count Characters foram excluidos";
	}else{
    echo "<div class=\"alert alert-success\">
          <strong>Sucesso!</strong> $count Characters foram excluidos.
    </div>";
	}

	}
?>