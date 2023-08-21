<?php if(!isset($pro)){echo 'Página protegida!'; exit;};?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
<style type="text/css">

	body{
		background-color: #f3f3f3;
		background: url("_imagens/bg.png") no-repeat #000;
		background-size: 100%;
	}
	
	#manutencao{
		width:600px;
		margin:0 auto;
		margin-top:80px;
		background:#FFF;
		padding:0px;
		border:1px solid #CCC;
		border-radius:4px;
		font:13px Arial, Helvetica, sans-serif;
		box-shadow: 1px 1px 10px rgba(0,0,0,0.5);
	}
	
	h2{
		font-weight:9000;
		color:#eee;
		background-color: #bd080b;
		margin:0;
		padding:10px;
		border-radius:5px;
	}
	
	li{
		list-style:none;
		text-align: justify;
		margin: 10px;
		color: #aaa;
	}
	.text{
		background-color: #f1f1f1;
		border: 1px solid #ddd;
		box-shadow: 1px 1px 4px rgba(0,0,0,0.3);
		border-radius: 4px;
		padding: 5px;
	}
	div.footer{
		width: 600px;
		height: 0 auto;

	}
	div.footer li.left{
		float: left;
	}
	div.footer li.right{
		float: right;
	}
	strong{
		color: #666;
		font-weight: bolder;
	}
</style>
</head>
<body>
<?php
$pega = $conexao->prepare("SELECT * FROM web_configs");
$pega->execute();
$r = $pega->fetch(PDO::FETCH_ASSOC);
?>
<div id="manutencao">

	<h2>Estamos em manutenção!</h2>
	<li class="text">
    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
    </li>
    <div class="footer">
    	<li class="left">Data de Inicio: <strong><?php echo date('d/m/Y',strtotime($r['manu_data']));?> ás <?php echo date('H:i', strtotime($r['manu_data']));?></strong></li>
    	<li class="right">Tempo estimado para retorno: <strong><?php echo $r['prevision'];?> </strong></li>
    </div>
    <img width="600" src="_imagens/manutencao.png" alt="">
</div><!--manutenção-->	
	
</body>
</html>

