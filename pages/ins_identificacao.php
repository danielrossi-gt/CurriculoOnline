<?php
  	session_start();
	require_once("conn.php"); 
    require_once("classes/identificacao.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Trabalhe Conosco!</title>

    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<script src="js/mascaras.js"></script>	

    <!-- Custom styles for this template -->
    <style>
		body {
			padding-top: 54px;
		}
		@media (min-width: 992px) {
			body {
				padding-top: 56px;
			}
		}

    </style>

  </head>

  <body>


<?php

	$id = new identificacao();
	
	$id->chave = $_SESSION["usuario_chave"];
	$id->nome = $_POST["nome"];
	$id->sexo = $_POST["sexo"];
	$id->cpf = $_POST["cpf"];
	$id->rg = $_POST["rg"];
	$id->cep = $_POST["cep"];
	$id->rua = $_POST["rua"];
	$id->numero = $_POST["numero"];
	$id->complemento = $_POST["complemento"];
	$id->bairro = $_POST["bairro"];
	$id->cidade = $_POST["cidade"];
	$id->uf = $_POST["uf"];
	$id->telefone = $_POST["telefone"];
	$id->celular = $_POST["celular"];
	$id->email = $_POST["email"];
	$id->nascimento = $_POST["nascimento"];
	$id->estadocivil = $_POST["estadocivil"];
	$id->nacionalidade = $_POST["nacionalidade"];
	$id->deficiencia = $_POST["deficiencia"];
	$id->tipocargo = $_POST["tipocargo"];
	$id->pis = $_POST["pis"];

	
	$arr = explode(" ", $id->nome);
	$apelido = $arr[0];

	if ($_SESSION["edicao"] == 'SIM') {
		$id->alterar($conn, $_SESSION["codigo_base"], "resumo.php");
	}
	else {
		$id->inserir($conn, $_SESSION["codigo_base"], "cad_formacao.php?apelido=$apelido");
	}

?>

	</body>	
</html>