<?php if(!isset($pro)){echo 'Página protegida!'; exit;};?>
<br>

<table width="635" border="0" cellspacing="2" style="margin:0px 0" class="ranking">
  <tr>
    <th width="60" align="center"><strong>Posição</strong></th>
    <th width="180" align="center"><strong>Clan Name</strong></th>
    <th width="180" align="center"><strong>Level</strong></th>
    <th width="172" align="center"><strong>Reputação</strong></th>
    <th width="111" align="center"><strong>Kills</strong></th>
  </tr>
  <?php
  $i = 1;
  $s = $conexao->prepare("SELECT cl.*,(SELECT SUM(pvpkills) FROM characters WHERE cl.clan_id = clanid) AS pvps,(SELECT SUM(pkkills) FROM characters where cl.clan_id = clanid) AS pks FROM clan_data AS cl ORDER BY pvps+pks DESC LIMIT 25");
  $s->execute();
  while($res = $s->fetch(PDO::FETCH_ASSOC)){
	  $res['pvps'] = empty($res['pvps']) ? $res['pvps'] = '0' : $res['pvps'];
	  $res['pks'] = empty($res['pks']) ? $res['pks'] = '0' : $res['pks'];

  if($i == 1){
    $img = "<img src=\"_imagens/top1.gif\" alt=\"\">";
  }elseif($i == 2){
    $img = "<img src=\"_imagens/top2.gif\" alt=\"\">";
  }elseif($i == 3){
    $img = "<img src=\"_imagens/top3.gif\" alt=\"\">";
  }else{
    $img = $i."&ordm;";
  }

  ?>
  <tr>
    <td align="center"><?php echo $img ?></td>
    <td align="center"><?php echo $res['clan_name'];?></td>
    <td align="center"><?php echo $res['clan_level'];?></td>
    <td align="center"><?php echo number_format($res['reputation_score'],0,'.','.');?></td>
    <td align="center"><?php echo number_format($res['pvps']+$res['pks'],0,'.','.')?></td>
  </tr>
  <?php
  $i++;
  }
  ?>
</table>
