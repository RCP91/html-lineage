<form action="" method="post" name="forme" id="do">
      <input type="text" name="account" id="account" placeholder="Login"/>
      <input type="text" name="nome" id="nome" placeholder="Nome atual do Char" />
      <input type="text" name="new" id="new" placeholder="Novo nome do Char" />
      <input type="hidden" name="walker" value="ok" />
      <input type="submit" name="button" id="button" value="Alterar Nick" class="btn"/></td>
</form>

<?php

if(isset($_POST['walker']) && $_POST['walker'] == 'ok'){

  $login = $_POST['account'];
  $char_name = $_POST['nome'];
  $char_name_new = $_POST['new'];

  $verifica_login = $conexao->prepare("SELECT * FROM characters WHERE account_name = (:account_name) AND char_name = (:char_name)");
  $verifica_login->bindValue(':account_name', $login, PDO::PARAM_STR);
  $verifica_login->bindValue(':char_name', $char_name, PDO::PARAM_STR);
  $verifica_login->execute();
  if($verifica_login->rowCount() == '1'){

    $verifica_char_name = $conexao->prepare("SELECT * FROM characters WHERE char_name = (:char_name_new)");
    $verifica_char_name->bindValue(':char_name_new', $char_name_new, PDO::PARAM_STR);
    $verifica_char_name->execute();
    if($verifica_char_name->rowCount() == '0'){

      $char_name_update = $conexao->prepare("UPDATE characters SET char_name = (:new_char_name) WHERE char_name = (:char_nome)");
      $char_name_update->bindValue(':new_char_name', $char_name_new, PDO::PARAM_STR);
      $char_name_update->bindValue(':char_nome', $char_name, PDO::PARAM_STR);
      $char_name_update->execute();
      if($char_name_update >= '1'){
        echo "Seu nick foi alterado com sucesso!";
        echo '<div class="alert alert-success">
              <strong>Sucesso!</strong> Seu nick foi alterado com sucesso.
        </div>';
      }
    }else{
      echo '<div class="alert alert-danger">
            <strong>Erro ao alterar!</strong> Este nick já existe em nosso sistema.
      </div>';
    }
  }else{
    echo '<div class="alert alert-danger">
          <strong>Erro ao alterar!</strong> Dados Incorretos.
    </div>';
  }
}//ISSET
?>
