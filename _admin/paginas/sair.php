<?php if(!isset($pros)){echo 'Pagina Protegida'; exit;};

session_start();
unset($_SESSION["logins"]);
header("location: ../_admin");

?>