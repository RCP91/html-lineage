<?php if(!isset($pro)){echo 'Página protegida!'; exit;}; ?>
<br>

<table width="635" border="0" cellspacing="2" style="margin:0px 0" class="ranking">
  <tr>
    <th width="214" align="center"><strong>Posição</strong></th>
    <th width="250" align="center"><strong>Nome</strong></th>
    <th width="250" align="center"><strong>Quantidade</strong></th>
    <th width="40" align="center"><strong>Item</strong></th>
  </tr>
  <?php
  $i = 1;
  $sql = $conexao->prepare("SELECT *,items.* from characters as c inner join items on c.obj_Id = items.owner_id where accesslevel = '0' and items.item_id = ".DropItemId." order by items.count DESC LIMIT 25");
  $sql->execute();
  while($res = $sql->fetch(PDO::FETCH_ASSOC)){

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
    <td align="center"><?php echo $img ;?></td>
    <td align="center"><?php echo $res['char_name']; ?></td>
    <td align="center"><?php echo number_format($res['count'],0,'.','.');?></td>
    <td align="center"><img src="_imagens/itens/<?php echo $res['item_id'];?>.png" alt=""/></td>
  </tr>
  <?php
  $i++;
  }
  ?>
</table>
