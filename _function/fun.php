<?php
//NÃO MEXER EM NADA NESTA PARTE, CODIGOS PARA TRATAR E CHAMATAR INFORMAÇÕES DE USUARIOS E DEMAIS.


	if(isset($_SESSION[Servername."login"])){
	$user = $conexao->prepare("SELECT a.*,c.char_name,c.account_name,c.accesslevel,c.classid,'.Charid.' FROM accounts AS a, characters AS c WHERE a.login = ? AND c.account_name = ?");
	$user->execute(array($_SESSION[Servername."login"],$_SESSION[Servername."login"]));
	$res_user = $user->fetch(PDO::FETCH_ASSOC);
	}
	
$code = 'PD9waHANCmlmKCFpc3NldCgkX0NPT0tJRVsidmlzaXRvdSJdKSl7DQoJJHNldF92aXNpdGEgPSAkcGRvLT5wcmVwYXJlKCJVUERBVEUgd2ViX2NvbmZpZ3Mgc2V0IHZpc2l0YXMgPSAodmlzaXRhcysxKSIpOw0KCSRzZXRfdmlzaXRhLT5leGVjdXRlKCk7DQoJc2V0Y29va2llKCJ2aXNpdG91IiwgdGltZSgpLCB0aW1lKCkrOTAwKTsJDQp9DQokcGVnYV92aXNpdGFzID0gJHBkby0+cHJlcGFyZSgiU0VMRUNUIHZpc2l0YXMgRlJPTSB3ZWJfY29uZmlncyIpOw0KJHBlZ2FfdmlzaXRhcy0+ZXhlY3V0ZSgpOw0KJHYgPSAkcGVnYV92aXNpdGFzLT5mZXRjaChQRE86OkZFVENIX0FTU09DKTsNCj8+DQoNCjxkaXYgaWQ9ImZvb3RlciI+DQogICAgPD9waHAgZWNobyBTZXJ2ZXJuYW1lID8+IDw/cGhwIGVjaG8gZGF0ZShZKTs/PiBUb2RvcyBvcyBEaXJlaXRvcyBSZXNlcnZhZG9zIC0gV2ViIFNpdGUgRGVzZW52b2x2aWRvIFBvciA8YSBocmVmPSJtYWlsdG86bWFyY29zX3c5QGhvdG1haWwuY29tLmJyIj5NYXJjb3MgSGVucmlxdWU8L2E+IFZpc2l0YXM6IDw/cGhwIGVjaG8gbnVtYmVyX2Zvcm1hdCgkdlt2aXNpdGFzXSwwLCwpOz8+DQogICAgPC9kaXY+PCEtLWZvb3Rlci0tPg0KICAgICAgICANCjwvZGl2PjwhLS1ib3gtLT4NCg0KPC9ib2R5Pg0KPC9odG1sPg==';
	
?>