<?php if(!isset($pros)){echo 'Pagina Protegida'; exit;};?>


<form action="" method="post">
    <input type="text" name="data" value="<?php echo date('Y/m/d H:i:s');?>">
    <input type="text" name="tempo" placeholder="Tempo estimado">
    <select name="op">
    	<option>Desativar</option>
        <option>Ativar</option>
    </select>
    <input type="submit" name="send" value="Ativar/Desativar Manutenção" class="btn">
</form>

<?php

	if(isset($_POST['send'])){
	
		try{
			
			if($_POST['op'] == 'Desativar'){
				$_POST['op'] = 'false';	
			}else{
				$_POST['op'] = 'true';	
			}
						
			$mod = $conexao->prepare("UPDATE web_configs SET manutencao = (:status), manu_data = (:data), prevision = (:previsao)");
			$mod->bindValue(':status',$_POST['op'],PDO::PARAM_STR);
			$mod->bindValue(':data',$_POST['data'],PDO::PARAM_STR);
			$mod->bindValue(':previsao',$_POST['tempo'],PDO::PARAM_STR);
			$mod->execute();
		    echo '<div class="alert alert-success">
		              <strong>Sucesso!</strong> Voce alterou o modoulo de manutenção.
		          </div>';
			
		}catch(PDOException $errou){
			print $errou->getMessage();	
		}
		
	}

?>