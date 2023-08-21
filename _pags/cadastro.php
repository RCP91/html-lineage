<?php if(!isset($pro)){echo 'Página protegida!'; exit;};?>
		<hgroup>
			<h2>Criar Conta</h2>
		</hgroup>
<form action="" class="cadastro" method="post" enctype="multipart/form-data">
	<input type="text" name="nome" id="nome" placeholder="Inserir Nome"/>
	<input type="text" name="usuario" id="usuario" placeholder="Inserir Usuário"/><br>
  <input type="text" name="pergunta" id="pergunta" placeholder="Inserir Pergunta Secreta"/>
  <input type="text" name="resposta" id="resposta" placeholder="Inserir Resposta da pergunta Secreta"/><br>
	<input type="password" name="senha" id="senha" placeholder="Inserir Senha"/>
	<input type="password" name="rsenha" id="rsenha" placeholder="Inserir Senha Novamente"/><br>
	<input type="text" name="email" id="email" placeholder="Inserir E-mail"/>
	<input type="submit" name="cadastrar" id="cadastrar" class="btn-cadastrar" value="Cadastrar"/>
</form>
<?php  
if(isset($_POST['cadastrar'])){
  $nome       = trim(strip_tags($_POST['nome']));
  $usuario    = trim(strip_tags($_POST['usuario']));
  $pergunta   = trim(strip_tags($_POST['pergunta']));
  $resposta   = trim(strip_tags($_POST['resposta']));
  $senha      = base64_encode(pack('H*', sha1($_POST['senha'])));
  $rsenha     = base64_encode(pack('H*', sha1($_POST['rsenha'])));
  $email      = trim(strip_tags($_POST['email']));

  if($nome == false){
    echo '<div class="alert alert-danger">
            <strong>Erro ao cadastrar!</strong> Preencha o campo Nome.
          </div>';
  }elseif($usuario == false){
    echo '<div class="alert alert-danger">
            <strong>Erro ao cadastrar!</strong> Preencha o campo Usuario.
          </div>';
  }elseif($pergunta == false){
    echo '<div class="alert alert-danger">
            <strong>Erro ao cadastrar!</strong> Preencha o campo Pergunta Secreta.
          </div>';
  }elseif($resposta == false){
    echo '<div class="alert alert-danger">
            <strong>Erro ao cadastrar!</strong> Preencha o campo Resposta Secreta.
          </div>';    
  }elseif($_POST['senha'] == false){
    echo '<div class="alert alert-danger">
            <strong>Erro ao cadastrar!</strong> Preencha o campo Senha.
          </div>';
  }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    echo '<div class="alert alert-danger">
            <strong>Erro ao cadastrar!</strong> Este E-mail não é valido.
          </div>';
  }elseif(strlen($_POST['senha']) < 4){
    echo '<div class="alert alert-danger">
            <strong>Erro ao cadastrar!</strong> Sua senha precisar ter no minimo 4 digitos.
          </div>';
  }elseif($senha != $rsenha){
    echo '<div class="alert alert-danger">
            <strong>Erro ao cadastrar!</strong> As senhas digitadas não são iguais.
          </div>';
  }elseif($email == false){
    echo '<div class="alert alert-danger">
            <strong>Erro ao cadastrar!</strong> Preencha o campo E-mail.
          </div>';
  }else{

    try{

      $verifica_usuario = $conexao->prepare("SELECT login FROM accounts WHERE login = (:usuario)");
      $verifica_usuario->bindValue(':usuario', $usuario, PDO::PARAM_STR);
      $verifica_usuario->execute();

      $verifica_email = $conexao->prepare("SELECT email FROM accounts WHERE email = (:email)");
      $verifica_email->bindValue(':email', $email, PDO::PARAM_STR);
      $verifica_email->execute();

      if($verifica_usuario->rowCount() == true){
        echo '<div class="alert alert-danger">
                <strong>Erro ao cadastrar!</strong> Este usuario já está cadastrado, escolha outro e tente novamente.
              </div>';
      }elseif($verifica_email->rowCount() == true){
        echo '<div class="alert alert-danger">
                <strong>Erro ao cadastrar!</strong> Este e-mail já está cadastrado, escolha outro e tente novamente.
              </div>';
      }else{

        $cadastrar = $conexao->prepare("INSERT INTO accounts (nome, login, password, email, pergunta, resposta) VALUES (:nome, :usuario, :senha, :email, :pergunta, :resposta)");
        $cadastrar->bindValue(':nome', $nome, PDO::PARAM_STR);
        $cadastrar->bindValue(':usuario', $usuario, PDO::PARAM_STR);
        $cadastrar->bindValue(':pergunta', $pergunta, PDO::PARAM_STR);
        $cadastrar->bindValue(':resposta', $resposta, PDO::PARAM_STR);
        $cadastrar->bindValue(':senha', $senha, PDO::PARAM_STR);
        $cadastrar->bindValue(':email', $email, PDO::PARAM_STR);
        $cadastrar->execute();
        setcookie("cadastrou", time(), time()+3600);
        header("location: index.php?pag=cadastro");


      }

      }catch(PDOException $erro_cadastro){
        print $erro_cadastro->getMessage();
      }
  }
}

if(isset($_COOKIE['cadastrou'])){
    echo '<div class="alert alert-success">
              <strong>Cadastrado com Sucesso!</strong> Você já pode começar a jogar. Bom jogo!
          </div>';
  setcookie("cadastrou", time(), time()-3600);
}

?>
<section class="termos">
    <h2>Leia os termos de cadastro</h2>
    <p>- <span class="title-termos">Termos e Condições :</span> **Criação de Conta no Lineage 2 Interlude**
  <br><br>
1. **Regras Gerais**
    - Ao criar uma conta no Lineage 2 Interlude, você concorda em cumprir todas as regras e regulamentos do servidor, bem como os termos e condições definidos neste documento.
    - É proibido o uso de programas de terceiros que proporcionem vantagens injustas no jogo, como bots ou cheats. A violação dessa regra pode resultar em suspensão ou banimento permanente da conta.
    - Você é responsável por manter a confidencialidade de suas informações de conta, como senha e nome de usuário. Não compartilhe essas informações com ninguém.
<br><br>
2. **Comportamento Adequado**
    - Respeite todos os jogadores e membros da equipe. Não é permitido assédio, discriminação, linguagem ofensiva ou qualquer forma de comportamento inadequado.
    - Não perturbe o jogo de outros jogadores de forma intencional, como matar jogadores de baixo nível repetidamente.
<br><br>
3. **Política de Pagamento**
    - Se você optar por comprar itens no jogo, esteja ciente das políticas de pagamento e não compartilhe informações financeiras pessoais com outros jogadores.
<br><br>
4. **Suporte Técnico**
    - Em caso de problemas técnicos, entre em contato com nossa equipe de suporte. Não tente resolver problemas técnicos por conta própria usando programas não autorizados.
<br>]<br>
5. **Política de Privacidade**
    - Respeitamos sua privacidade. Suas informações pessoais serão usadas de acordo com nossa política de privacidade.
<br><br>
6. **Suspensões e Banimentos**
    - O não cumprimento desses termos e condições pode resultar em suspensão temporária ou banimento permanente da sua conta, a critério da equipe de administração do servidor.
<br><br>
Ao criar sua conta no Lineage 2 Interlude, você concorda em seguir esses termos e condições. Certifique-se de lê-los atentamente e respeitar as regras do servidor. Boa diversão no jogo!</p>
</section>