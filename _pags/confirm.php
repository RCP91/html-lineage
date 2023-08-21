<?php if(!isset($pro)){echo 'Página protegida!'; exit;};?>
<?php if(!isset($_SESSION[Servername."login"])){
	echo '<div class="alert alert-danger">
        <strong>Acesso Restrito!</strong> Você precisa estar logado para acessar esta pagina.
    </div>';
}else{?>
		<hgroup>
			<h2>Centro de Informações</h2>

			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

  <section class="termos">
    <h2>Como confirmar minha doação ?</h2>
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
			<form action="" class="donate" method="post" enctype="multipart/form-data" name="enviar">

				<input type="text" placeholder="Insira seu Nome" name="nome" value="<?php if(isset($_POST['enviar'])){echo $_POST['nome'];};?>" />
			    <input type="text" placeholder="Insira seu E-mail" name="email" value="<?php if(isset($_POST['enviar'])){echo $_POST['email'];};?>"/>
				<select name="forma_pag" id="promocao">
					<option value="" selected>Qual a forma de pagamento utilizada??</option>
					<option value="PayPal">PayPal</option>
					<option value="PagSeguro">PagSeguro</option>
					<option value="Deposito">Deposito Bancario</option>
				</select>
			    <input type="text" placeholder="Insira o Valor Doado" name="valor" value="<?php if(isset($_POST['enviar'])){echo $_POST['valor'];};?>" />
			    <input type="text" placeholder="Insira Recompença, (Separar por virgulas)" name="pacote_nome" value="<?php if(isset($_POST['enviar'])){echo $_POST['pacote_nome'];};?>" />
			    <input type="file" name="img" class="custom-file-input" />
			    <input type="text" placeholder="Inserir nome do Char" name="char_nome" value="<?php if(isset($_POST['enviar'])){echo $_POST['char_nome'];};?>" />
			    
			    <input type="hidden" name="enviar" />
			    <input type="submit" value="Enviar Dados" class="btn" />
			    
			</form>


			<?php

				if(isset($_POST['enviar'])){
				
					$meu_nome =  strip_tags(trim($_POST['nome']));	
					$email =  strip_tags(trim($_POST['email']));
					$forma_pag = strip_tags(trim($_POST['forma_pag']));
					$valor =  strip_tags(trim($_POST['valor']));
					$itens =  strip_tags(trim($_POST['pacote_nome']));
					$arquivo = $_FILES['img'];
					$char_name =  strip_tags(trim($_POST['char_nome']));
					$extensao = strtolower(end(explode('.',$arquivo['name'])));
					$nome = md5(uniqid(rand())).".$extensao";
					$pasta = "_upload/comprovantes/".$nome;
					$permitido = array('image/png','image/jpg','image/jpeg','image/pjpeg');
					$data = date('Y/m/d H:i:s');
					
					if($meu_nome == false){
						echo '<div class="alert alert-danger">
				        <strong>Erro ao Confirmar!</strong> Preencha o campo nome.
					    </div>';
					}elseif($email == false){
						echo '<div class="alert alert-danger">
				        <strong>Erro ao Confirmar!</strong> Preencha o campo email.
					    </div>';
					}elseif($forma_pag == false){
						echo '<div class="alert alert-danger">
				        <strong>Erro ao Confirmar!</strong> Preencha o campo forma de pagamento.
					    </div>';
					}elseif($valor == false){
						echo '<div class="alert alert-danger">
				        <strong>Erro ao Confirmar!</strong> Preencha o campo valor de doação.
					    </div>';
					}elseif($itens == false){
						echo '<div class="alert alert-danger">
				        <strong>Erro ao Confirmar!</strong> Preencha o campo quantidade de itens.
					    </div>';
					}elseif($arquivo['name'] == false){
						echo '<div class="alert alert-danger">
				        <strong>Erro ao Confirmar!</strong> Preencha todos os campos.
					    </div>';
					}elseif($char_name == false){
						echo '<div class="alert alert-danger">
				        <strong>Erro ao Confirmar!</strong> Preencha o campo nome do char a receber doação.
					    </div>';
					}elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
						echo '<div class="alert alert-danger">
				        <strong>Erro ao Confirmar!</strong> Este E-mail não é válido.
					    </div>';
					}elseif(!in_array($arquivo['type'],$permitido)){
						echo '<div class="alert alert-danger">
				        <strong>Erro ao Confirmar!</strong> Arquivo .$extensao não é permitido.
					    </div>';
					}else{
					
						$upload = move_uploaded_file($_FILES['img']['tmp_name'], $pasta);	
						if($upload){
							$insert = $conexao->prepare("INSERT INTO web_comprovantes VALUES ('', ?, ?, ?, ?, ?, ?, ?,?)");
							$insert->execute(array($meu_nome,$email,$forma_pag,$valor,$itens,$nome,$char_name,$data));
							setcookie("comprovou",time(), time()+3600);
							header("location: index.php?pag=confirm");
						}else{
							echo '<div class="alert alert-danger">
					        <strong>Erro ao Confirmar!</strong> Arquivos com mais de 2 MB não são permitidos.
						    </div>';
						}			
					}
					
				}
				
				if(isset($_COOKIE["comprovou"])){
				    echo '<div class="alert alert-success">
				              <strong>Sucesso!</strong> Doação confirmada com sucesso.!
				          </div>';
					setcookie("comprovou",time(), time()-3600);
				}

			?>

			</hgroup>

<?php
}
?>