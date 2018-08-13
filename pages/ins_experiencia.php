<?php

  	session_start();
	require_once("conn.php"); 
	require_once("classes/experiencia.php");

    $e = new experiencia();
	
	$e->empresa = $_POST["empresa"];
	$e->cidade = $_POST["cidade"];
	$e->cargo = $_POST["cargo"];
	$e->inicio = $_POST["inicio"];
	$e->termino = $_POST["termino"];
	$e->resumo = $_POST["resumo"];

    if ($e->termino == '')  {
		$e->termino = 'NULL';
	}
	
	//echo $e->termino;
	
	if ($_SESSION["edicao"] == 'SIM') {
		$url = "resumo.php";
	}
	else {
		$url = "cad_experiencia.php";
	}
	
	$e->inserir($conn, $_SESSION["codigo_base"], $url);

?>