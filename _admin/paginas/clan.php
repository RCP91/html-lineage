<table border="0" width="1076" class="doacoes" cellpadding="1" cellspacing="1" id="on">
  <tr>
    <th class="nome">Clan Name</th>
    <th class="preco">Clan LvL</th>
    <th class="preco">Reputação</th>
    <th class="nome">Lider</th>
    <th class="nome">Aliança</th>
    </tr>
    <?php

        $clan = $conexao->prepare("SELECT * FROM clan_data");
        $clan->execute();
        while($res_clan = $clan->fetch(PDO::FETCH_ASSOC)){
        
        $lider = $conexao->prepare("SELECT * FROM characters WHERE obj_Id = '$res_clan[leader_id]'");
        $lider->execute();
        $res_lider = $lider->fetch(PDO::FETCH_ASSOC);
    ?>
    <tr>
    <td><?php echo $res_clan['clan_name']; ?></td>
    <td><?php echo $res_clan['clan_level']; ?></td>
    <td><?php echo $res_clan['reputation_score']; ?></td>
    <td><?php echo $res_lider['char_name']; ?></td>
    <td><?php echo $res_clan['ally_name']; ?></td>
    </tr>
    <?php } ?>



</table>
