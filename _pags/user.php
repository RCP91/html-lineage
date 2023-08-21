<?php if(!isset($pro)){echo 'Página protegida!'; exit;};?>
<?php if(!isset($_SESSION[Servername."login"])){
	echo '<div class="alert alert-danger">
        <strong>Acesso Restrito!</strong> Você precisa estar logado para acessar esta pagina.
    </div>';
}else{?>
<span class="admin"><span class="username">Perfil de:</span>  <?php echo $_SESSION[Servername."login"]; ?></span>
<table class="ranking">
	<tr>
		<tr><td>Personagens na conta:</td><td> <?php echo $user->rowCount(); ?></td></tr>
		<tr><td>Acesso Da Conta:</td><td> <?php echo number_format($res_user['access_level']); ?></td></tr>
		<tr><td>Last IP:</td><td> <?php echo $res_user['lastIP'] ?></td></tr>
		<tr><td>Last Server:</td><td> <?php echo $res_user['lastServer']; ?></td></tr>
		<tr><td>Email:</td><td> <?php echo $res_user['email'] ?></td></tr>
		<tr><td>Nome:</td><td> <?php echo $res_user['nome']?></td></tr>
	</tr>
</table>
<?php
}
?>