<?php if(!isset($pros)){echo 'Pagina Protegida'; exit;};?>

<div id="gallery">

<?php

	if(isset($_GET['action']) && $_GET['action'] == true){
		$id = intval($_GET['id']);	
		$deleta = $conexao->prepare("SELECT * FROM web_galeria WHERE id = (:id)");
		$deleta->bindValue(':id',$id,PDO::PARAM_STR);
		$deleta->execute();
		$recupera = $deleta->fetch(PDO::FETCH_ASSOC);
		$url = "../$recupera[url]";
		
		if(file_exists("$url")){
			unlink($url);
		}
		
		$de = $conexao->prepare("DELETE FROM web_galeria WHERE id = (:id)");
		$de->bindValue(':id',$id,PDO::PARAM_STR);
		$de->execute();
		header("location: ?p=gallery");
	}
	
	$select = $conexao->prepare("SELECT * FROM web_galeria ORDER BY id DESC");
	$select->execute();
	
	while($res = $select->fetch(PDO::FETCH_ASSOC)){
		echo '<a href="?p=gallery&action=deletar&id='.$res['id'].'" id="deletars"><span class="glyphicon glyphicon-remove"></span>  Del</a>';
		echo '<li><a tile="'.$res['titulo'].'" rel="lightbox[roadtrip]" href="../'.$res['url'].'"><img src="../'.$res['url'].'"></a></li>';	
		
	}

?>