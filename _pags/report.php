<?php if(!isset($pro)){echo 'Página protegida!'; exit;};?>
<?php if(!isset($_SESSION[Servername."login"])){
	echo '<div class="alert alert-danger">
        <strong>Acesso Restrito!</strong> Você precisa estar logado para acessar esta pagina.
    </div>';
}else{?>


		<hgroup>
			<h2>Sistema de Reportagem de Player</h2>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

      <p></p>
			
		</hgroup>

  <section class="termos">
    <h2>Quando reportar um player ?</h2>
    <p>- <span class="title-termos">Termo 1:</span> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

    <p>- <span class="title-termos">Termo 2:</span> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

    <p>- <span class="title-termos">Termo 3:</span> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

    <p>- <span class="title-termos">Termo 4:</span> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>


  </section>

<form action="" class="report" method="post" enctype="multipart/form-data">
	<input type="text" name="login" id="login" placeholder="Inserir Seu login"/>
	<input type="text" name="loginRport" id="loginRport" placeholder="Inserir login a ser reportado"/><br>
	<input type="text" name="motivo" id="motivo" placeholder="Inserir Motivo da Reportagem"/>
	<input type="text" name="imagem" id="imagem" placeholder="Inserir Link da imagem"/><br>
	<textarea name="texto" id="texto" placeholder="Inserir Descrição complementar"></textarea>

	<input type="submit" name="reportar" id="reportar" class="btn-cadastrar" value="Reportar Player"/>
</form>


<?php  
	if(isset($_POST['reportar'])){
		$login = trim(strip_tags($_POST['login']));
		$loginRport = trim(strip_tags($_POST['loginRport']));
		$motivo = trim(strip_tags($_POST['motivo']));
		$imagem = trim(strip_tags($_POST['imagem']));
		$texto  = trim($_POST['texto']);

	if($login == false){
	    echo '<div class="alert alert-danger">
	            <strong>Erro ao reportar player!</strong> Preencha o campo seu Login.
	          </div>';		
	}elseif($loginRport == false){
	    echo '<div class="alert alert-danger">
	            <strong>Erro ao reportar player!</strong> Preencha o campo Login a ser reportado.
	          </div>';				
	}elseif($motivo == false){
	    echo '<div class="alert alert-danger">
	            <strong>Erro ao reportar player!</strong> Preencha o campo Motivo.
	          </div>';		
	}elseif($imagem == false){
	    echo '<div class="alert alert-danger">
	            <strong>Erro ao reportar player!</strong> Preencha o campo Link de Imagem.
	          </div>';		
	}elseif($texto == false){
	    echo '<div class="alert alert-danger">
	            <strong>Erro ao reportar player!</strong> Preencha o campo Descrição Complementar.
	          </div>';		
    }else{

	try{

		$reportar = $conexao->prepare("INSERT INTO web_report (login, reported_login, motivo, imagem, descricao) VALUES (:login, :reported_login, :motivo, :imagem, :descricao)");
		$reportar->bindValue(':login', $login, PDO::PARAM_STR);
		$reportar->bindValue(':reported_login', $loginRport, PDO::PARAM_STR);
		$reportar->bindValue(':motivo', $motivo, PDO::PARAM_STR);
		$reportar->bindValue(':imagem', $imagem, PDO::PARAM_STR);
		$reportar->bindValue(':descricao', $texto, PDO::PARAM_STR);
		$reportar->execute();
		setcookie("reportou", time(), time()+3600);
		header("location: index.php?pag=report");


	}catch(PDOException $erro_report){
		print $erro_report->getMessage();
	}
	}
}

	if(isset($_COOKIE['reportou'])){
	    echo '<div class="alert alert-success">
              <strong>Player reportado com Sucesso!</strong> Obrigado, voce reportou uma player!
          </div>';
    setcookie("reportou", time(), time()-3600);
	}
?>







<?php
}
?>