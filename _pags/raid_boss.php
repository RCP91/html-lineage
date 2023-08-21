<?php if(!isset($pro)){echo 'Página protegida!'; exit;}; ?>
<br>
<!-- Grand RaidBoss -->
		<div class="title">
			<h2>GrandBoss</h2>
		</div>
<table width="635" border="0" cellspacing="2" style="margin:0px 0" class="ranking">
  <tr>
    <th width="314" align="center"><strong>Nome</strong></th>
    <th width="50" align="center"><strong>Level</strong></th>
    <th width="150" align="center"><strong>Status</strong></th>
    <th width="200" align="center"><strong>Respawn</strong></th>
  </tr>
  <?php
  	$verificar_grandboss = $conexao->prepare("SELECT b.*,n.id, n.name,n.level FROM grandboss_data b LEFT JOIN npc n ON b.boss_id = n.id  ORDER BY n.name ASC");
  	$verificar_grandboss->execute();
  	while($res_grandboss = $verificar_grandboss->fetch(PDO::FETCH_ASSOC)){


  ?>
  <tr>
    <td align="center"><?php echo $res_grandboss['name']; ?></td>
    <td align="center"><?php echo $res_grandboss['level']; ?></td>
    <td align="center"><?php if($res_grandboss['respawn_time'] == 0) {
    		echo "Vivo";
    	}else{
    		echo "Morto";} ?></td>
    <td align="center"><?php if($res_grandboss['respawn_time'] == 0) {
    		echo "No respawn";
    	}else{
    		echo date('d/m/Y - H:i:s', strtotime($res_grandboss['respawn_time'] / 1000));     		
    	}
    ?></td>
  </tr>
  <?php
 	}

  ?>
</table>

<!-- RaidBoss -->
		<div class="title">
			<h2>RaidBoss</h2>
		</div>
<table width="635" border="0" cellspacing="2" style="margin:0px 0" class="ranking">
  <tr>
    <th width="314" align="center"><strong>Nome</strong></th>
    <th width="50" align="center"><strong>Level</strong></th>
    <th width="150" align="center"><strong>Status</strong></th>
    <th width="200" align="center"><strong>Respawn</strong></th>
  </tr>
  <?php
  	$verificar_raidboss = $conexao->prepare("SELECT b.*,n.id, n.name,n.level FROM raidboss_spawnlist b LEFT JOIN npc n ON b.boss_id = n.id ORDER BY n.level DESC");
  	$verificar_raidboss->execute();
  	while($res_raidboss = $verificar_raidboss->fetch(PDO::FETCH_ASSOC)){


  ?>
  <tr>
    <td align="center"><?php echo $res_raidboss['name']; ?></td>
    <td align="center"><?php echo $res_raidboss['level']; ?></td>
    <td align="center"><?php if($res_raidboss['respawn_time'] == 0) {
    		echo "Vivo";
    	}else{
    		echo "Morto";} ?></td>
    <td align="center"><?php if($res_raidboss['respawn_time'] == 0) {
    		echo "No respawn";
    	}else{
    		echo date('d/m/Y - H:i:s', strtotime($res_raidboss['respawn_time'] / 1000));     		
    	}
    ?></td>
  </tr>
  <?php
 	}

  ?>
</table>
