<?php if(!isset($pros)){echo 'Pagina Protegida'; exit;};?>


<form action="" method="post" enctype="multipart/form-data">

	<input type="text" name="titulo" placeholder="Titulo da imagem">
	<select name="destaque" id="">
		<option value="">Deseja destacar esta imagem?</option>
		<option value="1">Sim</option>
		<option value="0">Nao</option>
	</select>    
    <input type="file" name="arquivo" id="file">
    
    <input type="submit" name="send" value="Adicionar Imagem" class="btn">
    
</form>

<?php

	if(isset($_POST['send'])){
		
	$titulo = strip_tags(trim($_POST['titulo']));
	$destaque = $_POST['destaque'];
	$file = $_FILES['arquivo'];
	$extensao = strtolower(end(explode('.', $file['name'])));
	$tamanho = ceil($file['size'] / 1024);
	if($tamanho <= '1000'){
		$tamanho = "$tamanho KB";	
	}else{
		$tamanho = number_format($tamanho)." MB";	
	}
	$name = time().".$extensao";
	$pasta = "../_upload/galeria/$name";
	
	$permitido = array('image/jpg','image/png','image/jpeg','image/pjpeg','image/gif');
	
	if(!in_array($file['type'],$permitido)){
		    echo '<div class="alert alert-danger">
		              <strong>Error!</strong> Tipo de arquivo não permitido. </a>
		          </div>';
	}else{
	
	$upload = move_uploaded_file($_FILES['arquivo']['tmp_name'],$pasta);
	if($upload){
		$insert = $conexao->prepare("INSERT INTO web_galeria (titulo,url,tamanho,destaque) VALUES (:titulo,:url,:tamanho,:destaque)");	
		$insert->bindValue(':titulo',$titulo,PDO::PARAM_STR);
		$insert->bindValue(':url',"_upload/galeria/$name",PDO::PARAM_STR);
		$insert->bindValue(':tamanho',$tamanho,PDO::PARAM_STR);
		$insert->bindValue(':destaque',$destaque,PDO::PARAM_STR);
		$insert->execute();
        setcookie("foto", time(), time()+3600);
        header("location: ?p=screen");

	}else{
		    echo '<div class="alert alert-danger">
		              <strong>Error!</strong> Sua imagem não foi cadastrada. </a>
		          </div>';
	}
	
	}
	}

if(isset($_COOKIE['foto'])){
		    echo '<div class="alert alert-success">
		              <strong>Imagem cadastrada com Sucesso!</strong> Sua imagem foi postada em sua pagina. </a>
		          </div>';
  setcookie("foto", time(), time()-3600);
}

?>