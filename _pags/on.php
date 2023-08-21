<?php if(!isset($pro)){echo 'Pagina Protegida!'; exit;}; ?>
<br>

<table width="635" border="0" style="margin:0px 0;" cellspacing="2" class="ranking">
  <tr>
    <th width="241" align="center"><strong>Nome</strong></th>
    <th width="241" align="center"><strong>Clan</strong></th>
    <th width="241" align="center"><strong>Tempo Online</strong></th>
  </tr>
  <?php
  function times($out){
	
	
	$divisao = time() - (time() - $out);
	$calculo1 = ($divisao % 86400);
	$calculo2 = ($divisao % 3600);
	
	$dias = floor($divisao / 86400);
	$horas = floor($calculo1 / 3600);
	$minutos = floor($calculo2 / 60);
	
	$result = "$dias Dias $horas Horas e $minutos Minutos";
	
	return $result;
	
}
$sql = $conexao->prepare("SELECT *,(select clan_name from clan_data where c.clanid = clan_id) AS clan FROM characters as c order by onlinetime DESC LIMIT 25");
$sql->execute();
while($res = $sql->fetch(PDO::FETCH_ASSOC)){
	$res['clan'] = empty($res['clan']) ? 'Não Possui Clan' : $res['clan'];
?>
  <tr>
    <td align="center"><?php echo $res['char_name'];?></td>
    <td align="center"><?php echo $res['clan'];?></td>
    <td align="center"><?php echo times($res['onlinetime']);?></td>
  </tr>
  <?php
  }
  ?>
</table>
