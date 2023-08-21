<?php if(!isset($pro)){echo 'Página protegida!'; exit;}; ?>
<br>

<table width="635" border="0" cellspacing="2" style="margin:0px 0" class="ranking">
  <tr>
    <th width="227" align="center">Nome</th>
    <th width="203" align="center">Class</th>
    <th width="281" align="center">Vitorias</th>
  </tr>
  <?php
  $sql = $conexao->prepare("SELECT *,(select ClassName from char_templates where h.class_id = ClassId) AS class FROM heroes as h order by count DESC");
  $sql->execute();
  while($res = $sql->fetch(PDO::FETCH_ASSOC)){
  ?>
  <tr>
    <td align="center"><?php echo $res['char_name'];?></td>
    <td align="center"><?php echo $res['class'];?></td>
    <td align="center"><?php echo $res['count'];?></td>
  </tr>
  <?php
  }
  ?>
</table>
