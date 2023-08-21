<?php
session_start();
include("_config/conexao.php");
include("_config/login.class.php");
include("_config/configuracoes.php");
include("_function/fun.php");
$class = new login();
ob_start();
$manu = $conexao->prepare("SELECT manutencao FROM web_configs WHERE manutencao = 'false'");
$manu->execute();
if($manu->rowCount() == true && !isset($_SESSION['login'])){
	$manu_pro = '';
	include"_pags/manu.php";
	echo '<title>Site em manutenção!</title>';
	exit;	
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Rushera Interlude 10x</title>
	<meta charset="UTF-8"/>
	<link rel="stylesheet" type="text/css" href="_css/estilo.css">
	<link rel="stylesheet" type="text/css" href="_css/classes.css">
	<link rel="stylesheet" type="text/css" href="_css/form.css">
	<link rel="stylesheet" type="text/css" href="_css/slideshow.css"/>
	<link rel="stylesheet" type="text/css" href="_css/user.login.css">
	<link rel="stylesheet" type="text/css" href="_js/lightbox/css/lightbox.css" />
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Tangerine&display=swap" rel="stylesheet">
</head>
<background>
</background>
<header id="cabecalho">
	<nav id="menu">
		<ul>
			<li><a href="index.php?pag=home">Inicio</a></li>
			<li><a href="index.php?pag=cadastro">Cadastro</a></li>
			<li><a href="index.php?pag=info">Informações</a></li>
			<li><a href="index.php?pag=galeria">Galeria</a></li>
			<li><a href="index.php?pag=downloads">Download</a></li>
			<li><a href="index.php?pag=doacoes">Donate</a></li>
			<li><a href="index.php?pag=contato">Contato</a></li>
			<li><a href="#">Ranking</a>
				<ul>
					<li><a href="index.php?pag=clan">Rank Clan</a></li>
					<li><a href="index.php?pag=siege">Rank Siege</a></li>
					<li><a href="index.php?pag=drop">Rank Drops</a></li>
					<li><a href="index.php?pag=hero">Rank Heroes</a></li>
					<li><a href="index.php?pag=ollym">Rank Ollym</a></li>
					<li><a href="index.php?pag=on">Rank Online</a></li>
					<li><a href="index.php?pag=pk">Rank PK</a></li>
					<li><a href="index.php?pag=pvp">Rank PVP</a></li>
					<li><a href="index.php?pag=raid_boss">Rank RaidBoss</a></li>
				</ul>
			</li>
		</ul>
	</nav>
	<div id="banner">
		<img src="_imagens/logo.png" width="500" alt="">
	</div>
	<?php
		$online = $conexao->prepare("SELECT * FROM characters WHERE online <> '0'");
		$online->execute();
	?>
	<div class="bar">
		<div class="cont_bar">
			<ul class="info_server">
				<li>XP: <strong><?php echo xp ?>x</strong></li>
				<li>SP: <strong><?php echo sp ?>x</strong></li>
				<li>DROP: <strong><?php echo drop ?>x</strong></li>
				<li>ADENA: <strong><?php echo adena ?>x</strong></li>
				<li>SPOIL: <strong><?php echo spoil ?>x</strong></li>
				<li>PLAYER ONLINE : <strong><?php print $online->rowCount(); ?></strong></li>
			</ul>
		</div>
	</div>
</header>
<body>

<div id="estrutura">
	<div id="container">
	<section id="conteudo">
		<div class="title">
			<h2>Conteudo</h2>
		</div>
		<div class="tam-conteudo">
		    <?php
			  $pro = 'proteção';
			  
			  $pag = isset($_GET['pag']) ? $_GET['pag'] : 'home';
			  $e = explode('/',$pag);
			  $pg = $e[0];
			  
			 if(file_exists("_pags/$pg.php")){
				include"_pags/$pg.php"; 
			  }else{
				echo '<div class="alert alert-danger">
			        <strong>Página Inexistente!</strong> Desculpe, mas está página não existe.
			    </div>';
				echo '<div class="alert alert-danger">
			        <strong>Por Favor!</strong> Selecione uma opção a partir do menu, caso este erro Persista entre em contato com a administração.
			    </div>';
			  }
			  
			  ?>
	  	</div>
	</section>

	<aside id="conteudo-lateral">
		<div class="title">
			<h2>Acesso Rápido</h2>
		</div>
		<h5 style="margin-left: 20px;">Acesso Login</h5>
		<section class="cont-right">
			
			<?php  
			if(!isset($_SESSION[Servername."login"]) && !isset($_SESSION[Servername."senha"])){	
			?>
			<form action="" class="login" method="post" enctype="multipart/form-data">
				<input type="text" name="usuario" id="usuario" placeholder="Inserir Usuário"/><br>
				<input type="password" name="senha" id="senha" placeholder="Inserir Senha"/>
				<input type="submit" name="logar_usuario" id="cadastrar" class="btn-cadastrar" value="Logar"/>
			</form>
			<a href="index.php?pag=cadastro" class="btn-cad"><i>Não é Cadastrado?</i></a><br>
			<a href="index.php?pag=recover" class="btn-cad"><i>Não lembra sua Senha?</i></a>
			<?php  
			}else{
			?>
            <div id="login_menu">

                <span class="admin"><span class="username">Bem vindo:</span>  <?php echo $_SESSION[Servername."login"]; ?></span>
              <ul>	
            	<li><a href="index.php?pag=user">Minha Conta</a></li>
                <li><a href="index.php?pag=personagens">Meus Personagens</a></li>
            	<li><a href="#">Trocar Senha</a></li>
                <li><a href="index.php?pag=confirm">Confirmar Doação</a></li>
                <li><a href="index.php?pag=report">Reportar Player</a></li>
                <li><a href="index.php?pag=sair">Deslogar</a></li>
              </ul>      
            </div><!--login_menu-->
 			<?php
 			}
			?>

			<?php  
			if(isset($_POST['logar_usuario'])){
				$login = trim(strip_tags($_POST['usuario']));
				$senha = base64_encode(pack("H*", sha1($_POST['senha'])));

				$class->logar($login,$senha,$conexao);
			}	
			?>
		</section>
		<div class="title-2">
			<h2>O Melhores do Server</h2>
		</div>
		<section class="cont-right">
			<h2>Top 5 Player Killer</h2>

			<table class="ranking">
				<tr>
					<th width="50">Rank</th>
					<th width="190">Nome</th>
					<th width="80">Pk</th>
				</tr>
			<?php  
				$i =1;
				$pvp_sql = $conexao->prepare("SELECT char_name,pkkills,level FROM characters WHERE accesslevel = '0' ORDER BY pkkills DESC LIMIT 3");
				$pvp_sql->execute();
				while ($res_pvp = $pvp_sql->fetch(PDO::FETCH_ASSOC)) {

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
					<td><?php echo $img; ?></td>
					<td title="Level: <?php echo $res_pvp['level']; ?>" id="tooltip"><?php echo $res_pvp['char_name']; ?></td>
					<td class="td-right"><?php echo number_format($res_pvp['pkkills'],0,'.','.' ); ?></td>
				</tr>
			<?php
			$i++;
			}
			?>
			</table>
		</section>

		<section class="cont-right">
			<h2>Top 5 Player vs Player</h2>

			<table class="ranking">
				<tr>
					<th width="50">Rank</th>
					<th width="190">Nome</th>
					<th width="80">PvP</th>
				</tr>
			<?php  
				$i =1;
				$pvp_sql = $conexao->prepare("SELECT char_name,pvpkills,level FROM characters WHERE accesslevel = '0' ORDER BY pvpkills DESC LIMIT 3");
				$pvp_sql->execute();
				while ($res_pvp = $pvp_sql->fetch(PDO::FETCH_ASSOC)) {

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
					<td id="rhover"><?php echo $img; ?></td>
					<td title="Level: <?php echo $res_pvp['level']; ?>" id="tooltip"><?php echo $res_pvp['char_name']; ?></td>
					<td id="rhover" class="td-right"><?php echo number_format($res_pvp['pvpkills'],0,'.','.' ); ?></td>
				</tr>
			<?php
			$i++;
			}
			?>
			</table>
		</section>
		<div class="title-2">
			<h2>Nossa Galeria</h2>
		</div>
		<section class="cont-right">
			<div id="gallery2">
			<?php
				$select = $conexao->prepare("SELECT * FROM web_galeria WHERE destaque = '1' ORDER BY id DESC LIMIT 9");
				$select->execute();
				if($select->rowCount() <= 0){
					echo '<div class="alert alert-danger">
				        <strong>Página Inexistente!</strong> Desculpe, mas há fotos no momento.
				    </div>';
				}
				while($res = $select->fetch(PDO::FETCH_ASSOC)){
					echo '<li><a tile="'.$res['titulo'].'" rel="lightbox[roadtrip]" href="'.$res['url'].'"><img src="'.$res['url'].'"></a></li>';	
					
				}
			?>
			</div>
		</section>		
	</aside>
	</div>
	<footer>
	<div id="rodape">
		<?php echo direitos; ?><br>
		<?php echo email; ?>
	</div>
	</footer>
</div>
</body>

</html>
	<script type="text/javascript" src="_js/lightbox/js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="_js/lightbox/js/lightbox.js"></script>
    <script type="text/javascript" src="_js/jquery.js" ></script>
    <script type="text/javascript" src="_js/jquery.maskMoney.js" ></script>
    <script type="text/javascript">
        $(document).ready(function(){
              $("input.dinheiro").maskMoney({showSymbol:true, symbol:"R$", decimal:",", thousands:"."});
        });
    </script>
