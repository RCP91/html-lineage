<?php if(!isset($pro)){echo 'Página protegida!'; exit;}; ?>
<?php if(!isset($_SESSION[Servername."login"])){
	echo '<div class="alert alert-danger">
        <strong>Acesso Restrito!</strong> Você precisa estar logado para acessar esta pagina.
    </div>';
}else{?>

<?php
	function online($str){
		$div = time() - (time() - $str);
		$div1 = ($div % 86400);
		$div2 = ($div % 3600);
		
		$dias = floor($div/86400);
		$horas = floor($div1/3600);
		$minutos = floor($div2/60);
		
		return $retotno = "$dias Dias $horas Horas e $minutos Minutos";
		
	}
	$PegaPersonagens = $conexao->prepare("SELECT *,(SELECT ClassName FROM char_templates WHERE characters.classid = ClassId) AS class,(SELECT clan_name FROM clan_data WHERE characters.clanid = clan_id) AS clan FROM characters WHERE account_name = ?");
	$PegaPersonagens->execute(array($res_user['login']));
	if($PegaPersonagens->rowCount() <= 0){
		echo "<div id=\"no\">Você não tem nenhum char</div>";	
	}
	$a = $PegaPersonagens->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($a as $res){
		$res['clan'] = empty($res['clan']) ? 'Sem Clan' : $res['clan'];
		$res['online'] = $res['online'] == 1 ? 'Sim' : 'Não';
		$res['nobless'] = $res['nobless'] == 1 ? 'Sim' : 'Não';
		echo "
			<span class='admin'><span class='username'>Perfil de:</span> $res[account_name]</span>
			<table class='ranking'>
				<tr>
					<tr><td>Personagens na conta:</td><td> $res[char_name]</td></tr>
					<tr><td>Level:</td><td> $res[level]</td></tr>
					<tr><td>Class:</td><td> $res[class]</td></tr>
					<tr><td>Clan:</td><td> $res[clan]</td></tr>
					<tr><td>PvPs:</td><td> $res[pvpkills]</td></tr>
					<tr><td>Pks:</td><td> $res[pkkills]</td></tr>
					<tr><td>Titulo:</td><td> $res[title]</td></tr>
					<tr><td>Recomendações:</td><td> $res[rec_have]</td></tr>
					<tr><td>Online:</td><td> $res[online]</td></tr>
					<tr><td>Tempo Online:</td><td> ".online($res['onlinetime'])."</td></tr>
					<tr><td>Nobless:</td><td> $res[nobless]</td></tr>
				</tr>
			</table>";
	}
	
?>
	

<?php
}
?>