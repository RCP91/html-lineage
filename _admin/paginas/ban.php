<form action="" method="post" name="va" id="do">
      <input type="text" name="usuario" id="usuario" placeholder="Char Name" />
      <select name="assao" id="select">
      	<option value="-100">Banir</option>   
        <option value="0">Desbanir</option>   
      </select>
    <input type="hidden" name="ban" value="banido" />
    <input type="submit" name="button" id="button" value="Atualizar" class="btn"/>
</form>


<?php
if(isset($_POST['ban']) && $_POST['ban'] == 'banido'){

  $char = $_POST['usuario'];
  $ban  = $_POST['assao'];

  $selecionar = $conexao->prepare("SELECT * FROM characters WHERE char_name = (:char_name)");
  $selecionar->bindValue(':char_name', $char, PDO::PARAM_STR);
  $selecionar->execute();
  if($selecionar->rowCount() >= '1'){
    $alterar = $conexao->prepare("UPDATE accounts SET access_level = (:access_level)");
    $alterar->bindValue(':access_level', $ban, PDO::PARAM_STR);
    $alterar->execute();
    if($_POST['assao'] == '-100'){
      $retornar = "$char Banido com Sucesso!";
    }elseif($_POST['assao'] == '0'){
      $retornar = "$char Desbanido com Sucesso!";
    }
    if($alterar >= '1'){
      echo "<div class=\"alert alert-success\">
            <strong>Sucesso!</strong> $retornar
      </div>";
    }else{
      echo '<div class="alert alert-danger">
            <strong>Erro!</strong> Não foi possivel banir este character.
      </div>';
    }
  }else{
      echo '<div class="alert alert-danger">
            <strong>Erro!</strong> Character não existe.
      </div>';
  }
  
}

?>