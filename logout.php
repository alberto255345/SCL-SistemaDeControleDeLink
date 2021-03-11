<?php
error_reporting(E_ERROR | E_PARSE);
session_start();
unset($_SESSION['usuario_log']);
unset($_SESSION['nome_1']);
unset($_SESSION['avatar']);
unset($_SESSION['telecom']);
unset($_SESSION['tipo']);
unset($_SESSION['email']);
unset($_SESSION['changepass']);

session_destroy();
?>
<script>location.href='../';</script>
<?php exit('Redirecionando...'); ?>
