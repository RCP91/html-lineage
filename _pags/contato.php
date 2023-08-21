<article class="noticiario">
	<hgroup class="title-news">
		<h2>Comunique-se conosco</h2>
		<p>Bem vindos ao <i><?php echo Title ?></i>. Criamos este formulario diminamico para envio de mensagem direcionada ao player, visitante e demais que estejam com necessidade de entrar em contato com o <i><?php echo Servername ?></i></i> </p><br>
		<p>Para que voce possa estar se comunicando conosco, preencha todo o formulario abaixo com informações validas e totalmente relevante, para que possamos retornar seu contato com muita satisfação. Equipe <i><?php echo Servername ?></i> agradece desde já seu contato. Obrigado pela compreenção</p>

<?php if(!isset($_COOKIE["pro"])){ ?>
 		<form action="" class="contato" method="post">

			<input type="text" name="nome" id="nome" class="nome" placeholder="Insira seu Nome">
			<input type="text" name="usuario" id="usuario" class="usuario" placeholder="Insira seu Usuario"><br>
			<select name="server" id="server" class="server" placeholder="Selecione o Servidor">
				<option value="">Selecione o Servidor</option>	
				<option value="Server Low Rate">Low Rate Server</option>
				<option value="Server Right Rate">Right Rate Server</option>
			</select>
			<input type="email" name="email" id="demail" class="cemail" placeholder="Insira um E-mail"><br>
			<textarea name="texto" id="dtexto" cols="30" rows="10" placeholder="Insira sua Mensagem"></textarea><br>
			<input type="submit" name="enviar" value="Enviar Mensagem ao Administrador" class="btn-enviar"></input>

		</form>
<?php } ?>
<?php  
	if(isset($_POST['enviar'])){
		$nome 		= strip_tags($_POST['nome']);
		$usuario 	= strip_tags($_POST['usuario']);
		$server 	= strip_tags($_POST['server']);
		$email 		= strip_tags($_POST['email']);
		$mensagem 	= strip_tags($_POST['texto']);
		$to = email;
		$heads = "Nome: $nome <br> Usuario: $usuario <br> Servidor: $server <br> Email: $email";

        $headers  = 'MIME-Version: 1.1' . PHP_EOL;
        $headers .= 'Content-type: text/html; charset=utf-8' . PHP_EOL;
        $headers .= "From: $nome <$email>" . PHP_EOL;
        $headers .= "Return-Path: $emailTo" . PHP_EOL;
        $headers .= "Reply-To: $email" . PHP_EOL;
        $headers .= "X-Mailer: PHP/". phpversion() . PHP_EOL;

		if($nome == '' or $usuario == '' or $server == '' or $email == '' or $mensagem == ''){
		    echo '<div class="alert alert-danger">
		            <strong>Erro ao Enviar!</strong> Preencha todos os campos.
		          </div>';
		}else{
			if(mail($to,$usuario,$mensagem,$heads)){
				setcookie("pro",time()+1800,time()+1800);
				header("location: index.php?pag=contato");
			}
		}
	}

	if(isset($_COOKIE["pro"])){
		$atual = date('d/m/Y - H:i', $_COOKIE["pro"]);
	    echo "<div class=\"alert alert-success\">
	              <strong>Sucesso ao Enviar!</strong> Sua mensagem foi enviada,você só podera mandar outa em $atual
	          </div>";
	}

?>


	</hgroup>
</article>
