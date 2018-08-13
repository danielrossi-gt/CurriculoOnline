<?php

  	session_start();
	require_once("conn.php"); 
	require_once("classes/formacao.php");

    $f = new formacao();
	
	$f->descricao = $_POST["descricao"];
	$f->instituicao = $_POST["instituicao"];
	$f->cidade = $_POST["cidade"];
	$f->inicio = $_POST["inicio"];
	$f->termino = $_POST["termino"];
	$f->tipo = "F";
	
    if ($f->termino == '')  {
		$f->termino = 'NULL';
	}	
	
	if ($_SESSION["edicao"] == 'SIM') {
		$url = "resumo.php";
	}
	else {
		$url = "cad_formacao.php";		
	}
	
	$f->inserir($conn, $_SESSION["codigo_base"], $url);

?>