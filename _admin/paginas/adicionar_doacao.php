<form action="" class="doacoes" method="post">
	<input type="text" name="item_id" placeholder="Insira o ID do Item">
	<input type="text" name="preco_antigo" placeholder="Insira o antigo preço" class="dinheiro">
	<input type="text" name="preco_atual" placeholder="Insira o novo preço" class="dinheiro">
	<select name="promocao" id="promocao">
		<option value="" selected>Esta doacão tem desconto?</option>
		<option value="Sim">Sim</option>
		<option value="Nao">Não</option>
	</select>
	<input type="submit" name="criar" value="Criar Doação">
</form>


<?php

	if(isset($_POST['criar'])){

		$id       = trim(strip_tags($_POST['item_id']));
		$apreco	  = $_POST['preco_antigo'];
		$npreco   = $_POST['preco_atual'];
		$promocao = trim(strip_tags($_POST['promocao']));

		if($id == false){
			echo '<div class="alert alert-danger">
			    <strong>Erro ao adicionar item!</strong> Digite o ID do item! </a>
			</div>';
		}elseif($apreco == false){
			echo '<div class="alert alert-danger">
			    <strong>Erro ao adicionar item!</strong> Digite o preço antigo do Item! </a>
			</div>';
		}elseif($npreco == false){
			echo '<div class="alert alert-danger">
			    <strong>Erro ao adicionar item!</strong> Digite o preço atual do Item! </a>
			</div>';
		}elseif($promocao == false){
			echo '<div class="alert alert-danger">
			    <strong>Erro ao adicionar item!</strong> Selecione se o item está ou não em promoção! </a>
			</div>';
		}else{

			$pega_armor = $conexao->prepare("SELECT * FROM armor WHERE $item_id='$id'");
			$pega_armor->execute();
			if($pega_armor->rowCount() <= 0){
			    echo '<div class="alert alert-danger">
			              <strong>Erro ao adicionar item!</strong> Este item não existe! </a>
			          </div>';
			}else{
				while ($all_item = $pega_armor->fetch(PDO::FETCH_ASSOC)){
					$name_item = $all_item['name'];
				}
			}

			$pega_weapon = $conexao->prepare("SELECT * FROM weapon WHERE $item_id='$id'");
			$pega_weapon->execute();
			if($pega_weapon->rowCount() <= 0){
			    echo '<div class="alert alert-danger">
			              <strong>Erro ao adicionar item!</strong> Este item não existe! </a>
			          </div>';
			}else{
				while ($all_item = $pega_weapon->fetch(PDO::FETCH_ASSOC)){
					$name_item = $all_item['name'];
				}
			}

			$pega_etcitem = $conexao->prepare("SELECT * FROM etcitem WHERE $item_id='$id'");
			$pega_etcitem->execute();
			if($pega_etcitem->rowCount() <= 0){
			    echo '<div class="alert alert-danger">
			              <strong>Erro ao adicionar item!</strong> Este item não existe! </a>
			          </div>';
			}else{
				while ($all_item = $pega_etcitem->fetch(PDO::FETCH_ASSOC)){
					$name_item = $all_item['name'];
				}
			}

			$add_etc = $conexao->prepare("INSERT INTO web_doacoes (name, item_id, preco_antigo, preco_atual, promocao) VALUES (:name_item, :item_id, :preco_antigo, :preco_atual, :promocao)");
			$add_etc->bindValue(':name_item', $name_item, PDO::PARAM_STR);
			$add_etc->bindValue(':item_id', $id, PDO::PARAM_STR);
			$add_etc->bindValue(':preco_antigo', $apreco, PDO::PARAM_STR);
			$add_etc->bindValue(':preco_atual', $npreco, PDO::PARAM_STR);
			$add_etc->bindValue(':promocao', $promocao, PDO::PARAM_STR);
			$add_etc->execute();
	        setcookie("doacao", time(), time()+3600);
	        header("location: ?p=adicionar_doacao");
 		}
	}//ISSET


if(isset($_COOKIE['doacao'])){
		    echo '<div class="alert alert-success">
		              <strong>Novo item add com Sucesso!</strong> Voce adicionou o item <strong>  </strong>! </a>
		          </div>';
  setcookie("doacao", time(), time()-3600);
}




?>