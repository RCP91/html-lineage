<?php if(!isset($pro)){echo 'Página protegida!'; exit;};?>

		<hgroup>
			<h2>Centro de Informações</h2>

			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

<form action="" method="post" class="recover">

    <input type="text" placeholder="Seu login" name="login" value="<?php if(isset($_POST['login'])){echo $_POST['login'];};?>">
    <input type="text" placeholder="Seu E-mail" name="email" value="<?php if(isset($_POST['email'])){echo $_POST['email'];};?>">
    <input type="text" placeholder="Sua Pergunta Secreta" name="pergunta" value="<?php if(isset($_POST['pergunta'])){echo $_POST['pergunta'];};?>">
    <input type="text" placeholder="Sua Resposta Secreta" name="resposta" value="<?php if(isset($_POST['resposta'])){echo $_POST['resposta'];};?>">
    <input type="password" placeholder="Sua Nova Senha" name="senha" value="<?php if(isset($_POST['senha'])){echo $_POST['senha'];};?>">
    <input type="password" placeholder="Confirmar sua Nova Senha" name="csenha" value="<?php if(isset($_POST['csenha'])){echo $_POST['csenha'];};?>">
    
    <input type="hidden" name="recu">
    <input type="submit" value="Recuperar Senha" class="btn">

</form>

</hgroup>
<?php

	if(isset($_POST['recu'])){
		
	
		$login = strip_tags($_POST['login']);
		$email = $_POST['email'];
		$pergunta = $_POST['pergunta'];
		$resposta = $_POST['resposta'];
		$new = base64_encode(pack('H*', sha1($_POST['senha'])));
		$cnew = base64_encode(pack('H*', sha1($_POST['csenha'])));
		
		if($login == false){
			echo '<div class="alert alert-danger">
		        <strong>Erro ao Recuperar!</strong> Preencha o campo Login.
		    </div>';
		}elseif($email == false){
			echo '<div class="alert alert-danger">
		        <strong>Erro ao Recuperar!</strong> Preencha o campo E-mail.
		    </div>';
		}elseif($pergunta == false){
			echo '<div class="alert alert-danger">
		        <strong>Erro ao Recuperar!</strong> Preencha o campo Pergunta Secreta.
		    </div>';
		}elseif($resposta == false){
			echo '<div class="alert alert-danger">
		        <strong>Erro ao Recuperar!</strong> Preencha o campo Resposta Secreta.
		    </div>';
		}elseif($_POST['senha'] == false){
			echo '<div class="alert alert-danger">
		        <strong>Erro ao Recuperar!</strong> Preencha o campo Senha.
		    </div>';
		}elseif($new != $cnew){
			echo '<div class="alert alert-danger">
		        <strong>Erro ao Recuperar!</strong> Confirmação de Senha falhou.
		    </div>';
		}else{
		
			
			$verifica = $conexao->prepare("SELECT * FROM accounts WHERE login = (:login) AND email = (:email) AND pergunta = (:pergunta) AND resposta = (:resposta)");
			$verifica->bindValue(':login',$login,PDO::PARAM_STR);
			$verifica->bindValue(':email',$email,PDO::PARAM_STR);
			$verifica->bindValue(':pergunta',$pergunta,PDO::PARAM_STR);
			$verifica->bindValue(':resposta',$resposta,PDO::PARAM_STR);
			$verifica->execute();
			
			if($verifica->rowCount() == false){
			echo '<div class="alert alert-danger">
		        <strong>Erro ao Recuperar!</strong> Os dados digitados não são validos.
		    </div>';
			}else{
			
				$update = $conexao->prepare("UPDATE accounts SET password = (:senha) WHERE login = (:login)");	
				$update->bindValue(':senha',$new,PDO::PARAM_STR);
				$update->bindValue(':login',$login,PDO::PARAM_STR);
				$update->execute();
				setcookie("recu", time(), time()+3600);
				header("location: ?pag=recover");
			}
			
		}
		
	}
	
	if(isset($_COOKIE["recu"])){
	    echo '<div class="alert alert-success">
              	<strong>Senha Recuperada com Sucesso!</strong> Sua nova senha já está registrada.
          	  </div>';
		setcookie("recu", time(), time()-1);	
	}

?>