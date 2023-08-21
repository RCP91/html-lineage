<?php if(!isset($pros)){echo 'Pagina Protegida'; exit;};?>

<?php
	$players_on = $conexao->prepare("SELECT * FROM characters WHERE online <> '0'");
	$players_on->execute();

	$players_account = $conexao->prepare("SELECT * FROM accounts WHERE login <> '0'");
	$players_account->execute();

	$players_char = $conexao->prepare("SELECT * FROM characters WHERE char_name <> '0'");
	$players_char->execute();

	$players_char_1 = $conexao->prepare("SELECT * FROM characters WHERE level = '1' <> '0'");
	$players_char_1->execute();

	$players_char_20 = $conexao->prepare("SELECT * FROM characters WHERE level = '20' <> '0'");
	$players_char_20->execute();

	$players_char_40 = $conexao->prepare("SELECT * FROM characters WHERE level = '40' <> '0'");
	$players_char_40->execute();

	$players_char_52 = $conexao->prepare("SELECT * FROM characters WHERE level = '52' <> '0'");
	$players_char_52->execute();

	$players_char_61 = $conexao->prepare("SELECT * FROM characters WHERE level = '61' <> '0'");
	$players_char_61->execute();

	$players_char_76 = $conexao->prepare("SELECT * FROM characters WHERE level = '76' <> '0'");
	$players_char_76->execute();

	$players_char_80 = $conexao->prepare("SELECT * FROM characters WHERE level = '80' <> '0'");
	$players_char_80->execute();
?>			

<table class="doacoes">
	<tr>
		<tr><td width="250">Players Online</td><td width="50"><?php print $players_on->rowCount();?></td></tr>
		<tr><td>Numero de Contas</td><td><?php print $players_account->rowCount();?></td></tr>
		<tr><td>Numero de Chars</td><td><?php print $players_char->rowCount();?></td></tr>
		<tr><td>Numero de Chars No-Grade</td><td><?php print $players_char_1->rowCount();?></td></tr>
		<tr><td>Numero de Chars Grade-D</td><td><?php print $players_char_20->rowCount();?></td></tr>
		<tr><td>Numero de Chars Grade-C</td><td><?php print $players_char_40->rowCount();?></td></tr>
		<tr><td>Numero de Chars Grade-B</td><td><?php print $players_char_52->rowCount();?></td></tr>
		<tr><td>Numero de Chars Grade-A</td><td><?php print $players_char_61->rowCount();?></td></tr>
		<tr><td>Numero de Chars Grade-S</td><td><?php print $players_char_76->rowCount();?></td></tr>
		<tr><td>Numero de Chars Grade-S Full</td><td><?php print $players_char_80->rowCount();?></td></tr>
	</tr>
</table>