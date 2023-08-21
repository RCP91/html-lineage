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
			<br>
<form action="" method="post" class="change-pass">

    <input type="text" placeholder="Insira seu Login" name="login">
    <input type="password" placeholder="Insira Senha Atual" name="senha">
    <input type="password" placeholder="Insira nova Senha" name="new">
    <input type="password" placeholder="Repetir nova Senha" name="renew">
    
    <input type="hidden" name="change">
    <input type="submit" value="Alterar Senha" class="btn">
    
</form>



<?php

if(isset($_POST['change'])){

	$login = strip_tags($_POST['login']);
	$senha = base64_encode(pack('H*', sha1($_POST['senha'])));	
	$new   = base64_encode(pack('H*', sha1($_POST['new'])));	
	$renew = base64_encode(pack('H*', sha1($_POST['renew'])));	
	
	if($login == false){
		echo '<div class="alert alert-danger">
        <strong>Erro ao alterar!</strong> Preencha o campo Login.
	    </div>';
	}elseif($_POST['senha'] == false){
		echo '<div class="alert alert-danger">
        <strong>Erro ao alterar!</strong> Preencha o campo Senha.
	    </div>';
	}elseif($_POST['new'] == false){
		echo '<div class="alert alert-danger">
        <strong>Erro ao alterar!</strong> Preencha o campo nova Senha.
	    </div>';
	}elseif($_POST['renew'] == false){
		echo '<div class="alert alert-danger">
        <strong>Erro ao alterar!</strong> Preencha o campo confirmar nova Senha.
	    </div>';
	}else{
	
		
		try{
			
			$verifica = $conexao->prepare("SELECT login,password FROM accounts WHERE login = (:login) AND password = (:senha)");
			$verifica->bindValue(':login',$login,PDO::PARAM_STR);
			$verifica->bindValue(':senha',$senha,PDO::PARAM_STR);
			$verifica->execute();
			
			if($verifica->rowCount() == false){
		        echo '<div class="alert alert-danger">
                <strong>Erro ao alterar!</strong> Login ou senha incorretos, tente novamente..
	            </div>';
			}elseif($new != $renew){
		        echo '<div class="alert alert-danger">
                <strong>Erro ao alterar!</strong> Erro ao confirmar senha.
	            </div>';
			}else{
			
				$update = $conexao->prepare("UPDATE accounts SET password = (:senha) WHERE login = (:login)");
				$update->bindValue(':senha',$new,PDO::PARAM_STR);
				$update->bindValue(':login',$login,PDO::PARAM_STR);
				$update->execute();	
				setcookie("change", time(), time()+3600);	
				header("location: index.php?pag=change");
				
			}
			
		}catch(PDOException $ERRO_ALTERARSENHA){
			echo $ERRO_ALTERARSENHA->getMessage();
		}
		
	}
	
	
	
}

if(isset($_COOKIE['change'])){
    echo '<div class="alert alert-success">
              <strong>Sucesso!</strong> Sua senha foi alterada!
          </div>';
	setcookie("change", time(), time()-1);	
}

?>
</hgroup>

<?php
}
?>