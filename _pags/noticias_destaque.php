<?php if(!isset($pro)){echo 'Página protegida!'; exit;}; 
	error_reporting(0);
	$Pegaid = explode('/',$_GET['pag']);
	$id = $Pegaid[1];
	try{
	
	$setvisitas = $conexao->prepare("UPDATE web_noticias SET visitas = (visitas+1) WHERE id = (:id)");
	$setvisitas->bindValue(':id',$id,PDO::PARAM_STR);	
	$setvisitas->execute();
	
	$pega_noticia = $conexao->prepare("SELECT * FROM web_noticias WHERE id = (:id)");
	$pega_noticia->bindValue(':id',$id,PDO::PARAM_STR);
	$pega_noticia->execute();
	$res = $pega_noticia->fetch(PDO::FETCH_ASSOC);
	
	
	if($res['privado'] == 1 && !isset($_SESSION[Servername."login"])){
			echo '<div class="alert alert-danger">
		        <strong>Acesso Negado!</strong> Você não tem permissão para acessar esta página, para visualizar a mesma faça o login no painel do usuário, esta noticia é privada então
			só mente usuários logados podem ler se você já tem seu login e sua senha basta logar, se não faça seu cadastro agora mesmo.
		    </div>';
	}else{
	
	if($pega_noticia->rowCount() == false){
		echo '<div class="alert alert-danger">
	        <strong>Página Inexistente!</strong> Selecione uma outra pagina.
	    </div>';
	}else{
		echo "

		<div class=\"bg-news\">
		<ul class=\"boxposts_destaque\">
			<li>
				<span class=\"thumb\">
					<img src=\"_imagens/shield.png\" alt=\"\" width=\"166\" height=\"166\"/>
				</span>
				<span class=\"content\">
					<h1>$res[titulo]</h1>
					<p>$res[noticia]</p>
							<span class=\"datapost\">Publicação: <strong>".date('d/m/Y - H:i', strtotime($res['data']))."</strong></span>
					<div class=\"footerpost\">


		";
		?>
			<span class="post_autor">Postado por : <strong><?php echo $res['autor']; ?></strong></span>
		<span class="datapost">
        <div id="curtir_conteudo">
			<span class="datapost"><strong><?php echo $res[visitas]?> </strong>Visualizações</span>


		<?php } ?>
        </div>
        	</span>
					</div>
				</span>
			</li>
		</ul>
		</div>

        <?php
	}
	
	}catch(PDOException $singleerro){
		echo $singleerro->GetMessage;
	}
	
	
?>