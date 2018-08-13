<?php
  	session_start();
	require_once("conn.php"); 
	require_once("classes/experiencia.php");
	experiencia::deletar($_GET["chave"], $conn, "cad_experiencia.php");
?>