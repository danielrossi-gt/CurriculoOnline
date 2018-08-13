<?php
  	session_start();
	require_once("conn.php"); 
	require_once("classes/formacao.php");
	formacao::deletar($_GET["chave"], $conn, "cad_formacao.php");
?>