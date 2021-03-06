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

 <!-- Page Content -->
    <div class="container">

		<div class="row">
			<div class="col-lg-12 text-center">
				<h1> Trabalhe Conosco! </h1>
			</div>
		</div>
		<div class="row" style="margin-top:10px">
			<div class="col-lg-12">
				<!--<img src="http://via.placeholder.com/1151x250" class="img-fluid" alt="Responsive image">-->
				<img src="img/trabalhecom.jpg" class="img-fluid" alt="Responsive image">
			</div>  
			
			<div class="col-lg-12" style="margin-top:50px">
<?php

	require_once('conn.php');
	$cpf = $_POST["txtCPF"]; 
	$codigoBase = $_POST["codigoBase"];

	$senha = $_POST["txtSenha"];
	$confSenha = $_POST["txtConfSenha"];

	$senha = base64_encode($senha);
	
	$sql = "SELECT CHAVE, CODIGO_BASE, CPF FROM USUARIOS_WEB WHERE CPF = '$cpf' ";
	//echo $sql;
	
	$ds = oci_parse($conn, $sql);	
	oci_define_by_name($ds, "CHAVE", $chave);
	oci_define_by_name($ds, "CODIGO_BASE", $codigoBase);
	oci_define_by_name($ds, "CPF", $cpf);
	oci_define_by_name($ds, "NOME", $nome);
	oci_execute($ds);
	oci_fetch($ds);
	$cont = ocirowcount($ds);
	
	if ($cont == 0) 
	{
		echo "<h3 align='center'>USUÁRIO INVÁLIDO!</h3><br/>";
		echo "<p align='center'><a href='index.html'>VOLTAR</a></p>";
		$login = "NAO";
	}
	else 
	{	

		$sql = "UPDATE USUARIOS_WEB SET SENHA = '$senha' WHERE CPF = '$cpf'";
		
		$stmt = oci_parse($conn, $sql);
		$exec = oci_execute($stmt);
		$erro = 'NAO';
		
		if (!$exec) {
			$e = oci_error($stmt);
			oci_rollback($conn);
			show_erro($e["message"]);
			$erro = "SIM";
		}
		
		$exec = oci_commit($conn);
		if (!$exec) {
			$e = oci_error($conn);
			show_erro($e["message"]);
			$erro = "SIM";		
		}
		

		if ($erro == 'NAO') {
			echo "<hr />";
			echo "<h3 align='center'>NOVA SENHA CADASTRADA COM SUCESSO!</h3><br/>";
			echo "<p align='center'><a href='index.html'>VOLTAR</a></p>";
			echo "<hr />";			
		}

	}

?>
	</div>

    <!-- Bootstrap core JavaScript -->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="js/validator.min.js"></script>

  </body>
  
</html>