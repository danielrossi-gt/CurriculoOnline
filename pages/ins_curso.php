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
	$f->tipo = 'C';
	
    if ($f->termino == '')  {
		$f->termino = 'NULL';
	}	
	
	$f->inserir($conn, $_SESSION["codigo_base"], "cad_formacao.php");
	
	


?>