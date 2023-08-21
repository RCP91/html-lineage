
  <form action="" method="post" name="hero" id="do" enctype="multipart/form-data">

    <input type="text" name="rec_usuarios" id="rec_usuarios" placeholder="Login" />
    <input type="text" name="rec_nome" id="rec_nome" placeholder="Char Name" />
    <input name="rec" type="text" id="rec" maxlength="3" placeholder="Recomendações" />
    <input type="hidden" name="reco" value="su" />
    <input name="button" type="submit" class="btn" id="button" value="Atualizar" />

  </form>


<?php
if(isset($_POST['reco']) && $_POST['reco'] == 'su'){
	
$rec_user = $_POST['rec_usuarios'];
$rec_nome = $_POST['rec_nome'];
$recs = $_POST['rec'];

$verifica_rec = $conexao->prepare("SELECT * FROM characters WHERE account_name = (:account_name) AND char_name = (:char_name)");
$verifica_rec->bindValue(':account_name', $rec_user, PDO::PARAM_STR);
$verifica_rec->bindValue(':char_name', $rec_nome, PDO::PARAM_STR);
$verifica_rec->execute();
if($verifica_rec->rowCount() >= '1'){

  $altera_rec = $conexao->prepare("UPDATE characters SET rec_have = (:recs) WHERE account_name = (:account_name) AND char_name = (:char_name)");
  $altera_rec->bindValue(':recs', $recs, PDO::PARAM_STR);
  $altera_rec->bindValue(':account_name', $rec_user, PDO::PARAM_STR);
  $altera_rec->bindValue(':char_name', $rec_nome, PDO::PARAM_STR);
  $altera_rec->execute();
  if($altera_rec == '1'){
      echo "<div class=\"alert alert-danger\">
          <strong>Erro ao adicionar Recs!</strong> Não foi possivel alterar os recs de $rec_nome. </a>
      </div>";
  }else{
      echo "<div class=\"alert alert-success\">
          <strong>Sucesso!</strong> $rec_nome Agora tem $recs Recs. </a>
      </div>";
  }

}else{
      echo "<div class=\"alert alert-danger\">
          <strong>Erro ao adicionar Recs!</strong> Este character não existe. </a>
      </div>";
}
}


?>
