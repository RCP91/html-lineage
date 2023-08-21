<?php if(!isset($pro)){echo 'Página protegida!'; exit;};?>
<br>

<table width="635" border="0" cellspacing="2" style="margin:0px 0" class="ranking">
  <tr>
    <th width="100" align="center"><strong>Castle Name</strong></th>
    <th width="180" align="center"><strong>Siege Date</strong></th>
    <th width="180" align="center"><strong>Clan</strong></th>
    <th width="180" align="center"><strong>Lord Castle</strong></th>
    <th width="180" align="center"><strong>Aliance</strong></th>
  </tr>
  <?php
    $siege = $conexao->prepare("SELECT * FROM castle ORDER BY id");
    $siege->execute();
    while ($res_siege = $siege->fetch(PDO::FETCH_ASSOC)){

      $cl = $conexao->prepare("SELECT * FROM clan_data WHERE hasCastle = '".$res_siege['id']."'");
      $cl->execute();
      $clan = $cl->fetch(PDO::FETCH_ASSOC);

      $l = $conexao->prepare("SELECT * FROM characters WHERE obj_Id = '".$clan['leader_id']."'");
      $l->execute();
      $lord = $l->fetch(PDO::FETCH_ASSOC);
  ?>
  <tr>
    <td align="center"><?php echo $res_siege['name'] ?></td>
    <td align="center"><?php echo date('d/m/Y - H:i', strtotime($res_siege['siegeDate'])); ?></td>
    <td align="center"><?php echo !empty($clan['clan_name']) ? $clan['clan_name'] : "Nenhum Clan"; ?></td>
    <td align="center"><?php echo !empty($lord['char_name']) ? $lord['char_name'] : "Nenhum Lord"; ?></td>
    <td align="center"><?php echo !empty($clan['ally_name']) ? $clan['ally_name'] : "Nenhuma Ally"; ?></td>
  </tr>
  <?php
  }
  ?>
</table>
