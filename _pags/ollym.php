<?php if(!isset($pro)){echo 'Página protegida!'; exit;}; ?>
<?php if(!isset($_SESSION[Servername."login"])){
  echo '<div class="alert alert-danger">
        <strong>Acesso Restrito!</strong> Você precisa estar logado para acessar esta pagina.
    </div>';
}else{?>
<br>

<table width="635" border="0" cellspacing="2" style="margin:0px 0;" class="ranking">
  <tr>
    <th width="180" align="center"><strong>Nome</strong></th>
    <th width="180" align="center"><strong>Class</strong></th>
    <th width="180" align="center"><strong>Lutas</strong></th>
    <th width="180" align="center"><strong>Pontos</strong></th>
  </tr>
  <?php
  $sql = $conexao->prepare("SELECT *,(select ClassName from char_templates where o.class_id = ClassId) AS classe FROM olympiad_nobles AS o ORDER BY olympiad_points DESC LIMIT 25");
  $sql->execute();
  while($res = $sql->fetch(PDO::FETCH_ASSOC)){
  ?>
  <tr>
    <td align="center"><?php echo $res['char_name']; ?></td>
    <td align="center"><?php echo $res['classe'] ?></td>
    <td align="center"><?php echo $res['competitions_done'] ?></td>
    <td align="center"><?php echo number_format($res['olympiad_points'],0,'.','.'); ?></td>
  </tr>
  <?php
  }
  ?>
</table>
<?php
}
?>