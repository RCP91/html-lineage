<?php if(!isset($pros)){echo 'Pagina Protegida'; exit;};?>

<form action="" method="post">

    <input type="text" name="titulo" placeholder="Titulo">
    <input type="text" name="autor" value="" placeholder="Autor">
    <input type="text" name="data" value="<?php echo date('d/m/Y H:i:s'); ?>">
    <select name="destaque">
    	<option>Destacar esta noticia ?</option>
    	<option value="0">Não</option>
        <option value="1">Sim</option>
    </select>
    
    <select name="privar">
    	<option>Privar esta noticia ?</option>
       	<option value="0">Não</option>
        <option value="1">Sim</option>
    </select>
    
    <textarea name="noticia"></textarea>
    
    <input type="submit" name="send" value="Postar Noticia" class="btn" style="margin-top:15px;">
    
    <?php
	if(isset($_POST['send'])){
		
		function slug($str){
		
			$str = strtolower($str);
			$str = preg_replace("/[^a-z0-9]/","-",$str);
			$str = preg_replace("/-+/","-",$str);
			$str = trim($str);
			return $str;	
			
		}
		
		$titulo = strip_tags(trim($_POST['titulo']));
		$autor = strip_tags(trim($_POST['autor']));
		$data = strip_tags(trim($_POST['data']));
		$noticia = $_POST['noticia'];
		$slug = slug($_POST['titulo']);
		$destaque = $_POST["destaque"] == '0' ? 0 : 1;
		$privar = $_POST["privar"] == '0' ? 0 : 1;
		
		if($titulo == false){
		    echo '<div class="alert alert-danger">
		            <strong>Erro ao cadastrar Noticia!</strong> Digite o titulo da noticia.
		          </div>';
		}elseif($autor == false){
		    echo '<div class="alert alert-danger">
		            <strong>Erro ao cadastrar Noticia!</strong> Digite o autor da noticia.
		          </div>';
		}elseif($data == false){
		    echo '<div class="alert alert-danger">
		            <strong>Erro ao cadastrar Noticia!</strong> Digite a data da noticia.
		          </div>';
		}elseif($noticia == false){
		    echo '<div class="alert alert-danger">
		            <strong>Erro ao cadastrar Noticia!</strong> Digite a noticia.
		          </div>';
		}else{
		
			$posta = $conexao->prepare("INSERT INTO web_noticias (titulo,data,autor,noticia,slug,destaque,privado) VALUES (:titulo,:data,:autor,:noticia,(:slug),:destaque, :privar)");
			$posta->bindValue(':titulo',$titulo,PDO::PARAM_STR);
			$posta->bindValue(':data',$data,PDO::PARAM_STR);
			$posta->bindValue(':autor',$autor,PDO::PARAM_STR);
			$posta->bindValue(':noticia',$noticia,PDO::PARAM_STR);
			$posta->bindValue(':slug',$slug,PDO::PARAM_STR);
			$posta->bindValue(':destaque',$destaque,PDO::PARAM_STR);
			$posta->bindValue(':privar',$privar,PDO::PARAM_STR);
			$posta->execute();
	        setcookie("notice", time(), time()+3600);
	        header("location: ?p=notice");
			
			$recuperar = $conexao->prepare("SELECT id FROM web_noticias WHERE titulo = (:titulo) and autor = (:autor) and noticia = (:noticia) ORDER BY id DESC");
			$recuperar->bindValue(':titulo',$titulo,PDO::PARAM_STR);
			$recuperar->bindValue(':autor',$autor,PDO::PARAM_STR);
			$recuperar->bindValue(':noticia',$noticia,PDO::PARAM_STR);
			$recuperar->execute();
			$id = $recuperar->fetch(PDO::FETCH_ASSOC);
			
		}
		
	}
if(isset($_COOKIE['notice'])){
		    echo '<div class="alert alert-success">
		              <strong>Noticia cadastrada com Sucesso!</strong> Clique em Listar para visualizar suas noticias! </a>
		          </div>';
  setcookie("notice", time(), time()-3600);
}
	?>

</form>