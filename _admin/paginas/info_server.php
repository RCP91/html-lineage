<?php

	$on = $conexao->prepare("SELECT * FROM characters WHERE online = '1'");
	$on->execute();
	$count_on = $on->rowCount();

	$perso = $conexao->prepare("SELECT * FROM characters");
	$perso->execute();
	$count_perso = $perso->rowCount();

	$contas = $conexao->prepare("SELECT * FROM accounts");
	$contas->execute();
	$count_contas = $contas->rowCount();

	$clans = $conexao->prepare("SELECT * FROM clan_data");
	$clans->execute();
	$count_clans = $clans->rowCount();

	$persoban = $conexao->prepare("SELECT * FROM accounts WHERE access_level = '-100'");
	$persoban->execute();
	$count_persoban = $persoban->rowCount();

	$contasban = $conexao->prepare("SELECT * FROM accounts WHERE access_level = '-100'");
	$contasban->execute();
	$count_contasban = $contasban->rowCount();

	$heroes = $conexao->prepare("SELECT * FROM heroes");
	$heroes->execute();
	$count_hero = $heroes->rowCount();

	$nobre = $conexao->prepare("SELECT * FROM characters WHERE nobless = '1'");
	$nobre->execute();
	$count_nobre = $nobre->rowCount();

	$admin = $conexao->prepare("SELECT * FROM accounts WHERE access_level = 1");
	$admin->execute();
	$count_admin = $admin->rowCount();



?>

<table class="doacoes" width="1076">
	<tr>
		<th class="icon">Players Online</td>
		<th class="preco">Contas Criadas</th>
		<th class="preco">Personagens</th>
		<th class="preco">Clans Criados</th>
		<th class="preco">Players Banidos</th>
		<th class="botao">Contas Ban</th>
		<th class="botao">Player Heros</th>
		<th class="botao">Players Nobles</th>
		<th class="botao">admi / gms</th>
	</tr>
	<tr>
		<td class="icon"><?php echo $count_on ?></td>
		<td class="preco"><span class="pname"><i><?php echo  $count_contas ?></i></span></td>
		<td class="preco"><span class="dprice"><i><?php echo $count_perso ?></i></span></td>
		<td class="preco"><span class="pprice"><i><?php echo $count_clans ?></i></span></td>
		<td class="preco"><span class="pprice"><i><?php echo $count_persoban ?></i></span></td>
		<td class="botao"><span class="pprice"><i><?php echo $count_contasban ?></i></span></td>
		<td class="botao"><span class="pprice"><i><?php echo $count_hero ?></i></span></td>
		<td class="botao"><span class="pprice"><i><?php echo $count_nobre ?></i></span></td>
		<td class="botao"><span class="pprice"><i><?php echo $count_admin ?></i></span></td>
	</tr>
</table>
