<div class="bg-news">
	<ul class="boxposts3">
		<li>
			<table class="doacoes" width="625">
				<tr>
					<th class="icon2">Icon</td>
					<th class="nome2">Nome</th>
					<th class="preco2">De</th>
					<th class="preco2">Por</th>
				</tr>
			</table>

<?php if(!isset($pro)){echo 'Página protegida!'; exit;}; 
	error_reporting(0);
	$Pegaid = explode('/',$_GET['pag']);
	$id = $Pegaid[1];
	try{
	
	$pega_noticia = $conexao->prepare("SELECT * FROM web_doacoes WHERE id = (:id)");
	$pega_noticia->bindValue(':id',$id,PDO::PARAM_STR);
	$pega_noticia->execute();
	$res = $pega_noticia->fetch(PDO::FETCH_ASSOC);
	
	
	if($res['promocao'] == 1 && !isset($_SESSION[Servername."login"])){
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


			<table class=\"doacoes\" width=\"625\">
				<tr>
					<td class=\"icon\"><img src=\"_imagens/itens/$res[item_id].png\" alt=\"\"/></td>
					<td class=\"nome\"><span class=\"pname\"><i>$res[name]</i></span></td>
					<td class=\"preco\"><span class=\"dprice\"><i>$res[preco_antigo]</i></span></td>
					<td class=\"preco\"><span class=\"pprice\"><i>$res[preco_atual]</i></span></td>
				</tr>
			</table>

		";
		?>

  <section class="termos">
    <h2>Leia como fazer uma doação, é muito simples.</h2>
    <p>- <span class="title-termos">Passo 1:</span> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

    <p>- <span class="title-termos">Passo 2:</span> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

    <p>- <span class="title-termos">Passo 3:</span> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

    <p>- <span class="title-termos">Passo 4:</span> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

    <p>- <span class="title-termos">Passo 5:</span> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>


  </section>
			<table class="doacoes" width="625">
				<tr>
					<th class="icon2">Banco</td>
					<th class="nome2">Nome Favorecido</th>
					<th class="preco2">Agencia</th>
					<th class="preco2">Conta</th>
				</tr>
				<tr>
					<td class="icon">Bradesco</td>
					<td class="nome"><span class="pname"><i>Ex: Lineage II Private Server</i></span></td>
					<td class="preco"><span class="dprice"><i>Ex: 0000-0</i></span></td>
					<td class="preco"><span class="pprice"><i>Ex: 00000-0</i></span></td>
				</tr>
				<tr>
					<td class="icon">Itau</td>
					<td class="nome"><span class="pname"><i>Ex: Lineage II Private Server</i></span></td>
					<td class="preco"><span class="dprice"><i>Ex: 0000-0</i></span></td>
					<td class="preco"><span class="pprice"><i>Ex: 00000-0</i></span></td>
				</tr>
				<tr>
					<td class="icon">Caixa Federal</td>
					<td class="nome"><span class="pname"><i>Ex: Lineage II Private Server</i></span></td>
					<td class="preco"><span class="dprice"><i>Ex: 0000-0</i></span></td>
					<td class="preco"><span class="pprice"><i>Ex: 00000-0</i></span></td>
				</tr>
				<tr>
					<td class="icon">Banco Brasil</td>
					<td class="nome"><span class="pname"><i>Ex: Lineage II Private Server</i></span></td>
					<td class="preco"><span class="dprice"><i>Ex: 0000-0</i></span></td>
					<td class="preco"><span class="pprice"><i>Ex: 00000-0</i></span></td>
				</tr>
				<tr>
					<td class="icon">Santander</td>
					<td class="nome"><span class="pname"><i>Ex: Lineage II Private Server</i></span></td>
					<td class="preco"><span class="dprice"><i>Ex: 0000-0</i></span></td>
					<td class="preco"><span class="pprice"><i>Ex: 00000-0</i></span></td>
				</tr>
			</table>

		<?php } ?>


		<div class="pagmento">
			<ul>
				<li><a class="pagseguro" href="#">Doar com PagSeguro</a></li>	
				<li><a class="paypal" href="#">Doar com Paypal</a></li>
			</ul>
		</div>



			</li>
		</ul>
		</div>

        <?php
	}
	
	}catch(PDOException $singleerro){
		echo $singleerro->GetMessage;
	}
	
	
?>