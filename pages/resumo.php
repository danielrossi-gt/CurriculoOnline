<?php
	session_start();
	require_once("conn.php");
	$usuario = $_SESSION["usuario_chave"];

	if (isset($_GET["apelido"])) {
		$_SESSION["apelido"] = $_GET["apelido"];
		$apelido = $_SESSION["apelido"];
	} 
  
	if (isset($_SESSION["apelido"])) {
		$apelido = $_SESSION["apelido"];
	}
  
    $_SESSION["edicao"] = "SIM";
  
?>

<!DOCTYPE html>
<html lang="pt-br">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="js/cep.js"></script>		
    <script src="js/mascaras.js"></script>	

    <title>Cadastro de Currículo</title>

    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.css" rel="stylesheet">

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

  <body style="padding-top: 0px; margin-top:0px;">

	<!-- Navigation bar -->
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<a class="navbar-brand" href="#">Bem vindo <?php echo " $apelido!" ?></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarText">
			<ul class="navbar-nav mr-auto">
			</ul>
			<span class="navbar-text">
			<ul class="navbar-nav mr-auto">
				<li><hr/></li>
                <li><a href="logout.php" style="text-decoration: none; color:white;">Sair</a></li>
			</ul>
			</span>
		</div>
	</nav>
	<!-- Navigation bar -->
	
    <!-- Page Content -->
    <div class="container" style="margin-top:10px;">

		<div class="col-lg-12">
			<!--<img src="http://via.placeholder.com/1151x250" class="img-fluid" alt="Responsive image"> -->
			<img src="img/trabalhecom.jpg" class="img-fluid" alt="Responsive image">
		</div>  		

		<div class="row" style="margin-top:20px">
			<div class="col-lg-12 text-center">
				<h3>
					<?php 
						if (!isset($_GET["acao"])) { 
							echo "Currículo cadastrado com sucesso!"; } 
						else { 
							echo "Verifique suas informações cadastradas. ";
						} 
					?></h3>
			</div>
		</div>
		
		<div class="col-lg-12" style="margin-top:20px">

			<div class="card">
			
				<div class = "card-header">
					<div class="col-lg-11 float-left">
						<h4> Identificação </h3>
					</div>
					<div class="col-lg-1 float-left">
					    <a href="edit_identificao.php">
						<button type="button" class="btn btn-xs btn-primary">
						  <span class="glyphicon glyphicon-edit"></span>
						</button>
						</a>
					</div>			
				</div>

				<div class="card-body">

					<?php
					
						$sql = "SELECT T.CPF, T.NUMERO_RG, T.NOME, T.ENDERECO, T.NUMERO, T.COMPLEMENTO, T.BAIRRO, T.CIDADE, T.CEP, 
									   T.TELEFONE, T.TELEFONE_CELULAR, T.EMAIL, TO_CHAR(T.DATA_NASCIMENTO, 'DD/MM/YYYY') DATA_NASCIMENTO, T.NACIONALIDADE, T.SEXO, 
									   T.ESTADO_CIVIL, 
									   DECODE(T.PORTADOR_DEFICIENCIA, 'NAO', 'NÃO',
									                                  'FIS', 'FÍSICA',
									                                  'AUD', 'AUDITIVA',
									                                  'VIS', 'VISUAL',
									                                  'MEN', 'MENTAL',
									                                  'MUL', 'MÚLTIPLA',
									                                  'REA', 'REABILITADO') PORTADOR_DEFICIENCIA,
									   C.DESCRICAO TIPO_CARGO, T.DATA_CADASTRO,
									   M.NOME NOME_CIDADE, M.UF, T.PIS	
								  FROM TALENTOS_WEB T, MUNICIPIOS_WEB M, TIPO_CARGO_WEB C
								 WHERE T.CIDADE = M.CHAVE
                                   AND T.TIPO_CARGO = C.CHAVE
								   AND T.CHAVE_USUARIO_WEB = $usuario";
								 
						$ds = oci_parse($conn, $sql);	
						oci_define_by_name($ds, "CPF", $cpf);
						oci_define_by_name($ds, "NUMERO_RG", $rg);
						oci_define_by_name($ds, "NOME", $nome);
						oci_define_by_name($ds, "ENDERECO", $endereco);
						oci_define_by_name($ds, "NUMERO", $numero);
						oci_define_by_name($ds, "COMPLEMENTO", $complemento);
						oci_define_by_name($ds, "BAIRRO", $bairro);
						oci_define_by_name($ds, "NOME_CIDADE", $cidade);
						oci_define_by_name($ds, "UF", $uf);
						oci_define_by_name($ds, "CEP", $cep);
						oci_define_by_name($ds, "TELEFONE", $telefone);
						oci_define_by_name($ds, "TELEFONE_CELULAR", $celular);
						oci_define_by_name($ds, "EMAIL", $email);
						oci_define_by_name($ds, "DATA_NASCIMENTO", $nascimento);
						oci_define_by_name($ds, "NACIONALIDADE", $nacionalidade);
						oci_define_by_name($ds, "SEXO", $sexo);
						oci_define_by_name($ds, "ESTADO_CIVIL", $estadocivil);
						oci_define_by_name($ds, "PORTADOR_DEFICIENCIA", $deficiencia);
						oci_define_by_name($ds, "TIPO_CARGO", $tipocargo);
						oci_define_by_name($ds, "PIS", $pis);
						oci_execute($ds);	
						oci_fetch($ds);
				
						$rg = formatar("rg", $rg);
						$cpf = formatar("cpf", $cpf);
						$cep = formatar("cep", $cep);
				
						echo "<p>
							  <b>Nome:</b> $nome<br/>
							  <b>Data Nasc.:</b> $nascimento <br/><b>RG:</b> $rg <br/><b>CPF:</b> $cpf<br/><b>PIS:</b> $pis<br/><br/>
							  <b>Endereço:</b> $endereco, $numero - $bairro<br/>
							  <b>Cidade:</b> $cidade - $uf<br/>";
							  
						if ($complemento != '') {	  
							echo "<b>Complemento:</b> $complemento ";
						}
						
						echo "<b>CEP:</b> $cep<br/><br/>
							  <b>Telefone Fixo:</b> $telefone <br/><b>Telefone Celular:</b> $celular<br/>
							  <b>E-Mail:</b> $email<br/><br/>
							  <b>Sexo:</b> $sexo <br/><b>Estado Civil:</b> $estadocivil<br/> <b>Tipo do Cargo:</b> $tipocargo<br/>
							  <b>Deficiência:</b> $deficiencia</b>
							  </p>";
				
					?>
				
				</div>

			</div>
		
			<div class="card" style="margin-top:20px">

				<div class = "card-header">
				
					<div class="col-lg-11 float-left">
						<h4> Formação Acadêmica </h3>
					</div>
					<div class="col-lg-1 float-left">
					    <a href="cad_formacao.php">
						<button type="button" class="btn btn-xs btn-primary">
						  <span class="glyphicon glyphicon-edit"></span>
						</button>
						</a>
					</div>					

				</div>

				<div class="card-body">
					
					<?php
					
						$sql = "SELECT F.CHAVE, F.DESCRICAO, F.INSTITUICAO, F.CIDADE, 
									   TO_CHAR(F.DATA_INICIO, 'DD/MM/YYYY') DATA_INICIO, 
									   TO_CHAR(F.DATA_TERMINO, 'DD/MM/YYYY') DATA_TERMINO, M.NOME NOME_CIDADE, M.UF
								  FROM FORMACAO_WEB F, MUNICIPIOS_WEB M
								 WHERE F.CIDADE = M.CHAVE
								   AND F.CHAVE_USUARIO_WEB = $usuario
								   AND TIPO = 'F'";
								 
						$ds = oci_parse($conn, $sql);	
						oci_define_by_name($ds, "CHAVE", $chave);
						oci_define_by_name($ds, "DESCRICAO", $descricao);
						oci_define_by_name($ds, "INSTITUICAO", $instituicao);
						oci_define_by_name($ds, "CIDADE", $cidade);
						oci_define_by_name($ds, "DATA_INICIO", $datainicio);
						oci_define_by_name($ds, "DATA_TERMINO", $datatermino);
						oci_define_by_name($ds, "NOME_CIDADE", $nomecidade);
						oci_define_by_name($ds, "UF", $uf);
						oci_execute($ds);	
						oci_fetch_all($ds, $cont);
						
						$cont = ocirowcount($ds);						
						$i = 0;
						
						if ($cont == 0) {
							echo "<h5>Nenhuma formação cadastrada.</h5>";
							
						}
						else {
							
							oci_execute($ds);
							
							while (oci_fetch($ds)) {
								
								if ($datatermino == '') {
									$datatermino = 'PRESENTE';
								}
								
								$i++;
								
								echo "<h5>$descricao</h5>
   									  <p>
										$instituicao<br/>
										$nomecidade-$uf<br/>
										$datainicio - $datatermino
									  </p>
									  ";
									  
                                if 	($i < $cont) {
									echo "<hr/>";
								}
							}					
					
						}
					
					?>
					
				</div>
		
			</div>
		
			<div class="card" style="margin-top:20px">
			
				<div class = "card-header">
				
					<div class="col-lg-11 float-left">
						<h4> Cursos e Qualificações </h3>
					</div>
					<div class="col-lg-1 float-left">
					    <a href="cad_formacao.php">
						<button type="button" class="btn btn-xs btn-primary">
						  <span class="glyphicon glyphicon-edit"></span>
						</button>
						</a>
					</div>						

				</div>

				<div class="card-body">
				
					<?php
					
						$sql = "SELECT F.CHAVE, F.DESCRICAO, F.INSTITUICAO, F.CIDADE, 
						               TO_CHAR(F.DATA_INICIO, 'DD/MM/YYYY') DATA_INICIO, 
									   TO_CHAR(F.DATA_TERMINO, 'DD/MM/YYYY') DATA_TERMINO, M.NOME NOME_CIDADE, M.UF
								  FROM FORMACAO_WEB F, MUNICIPIOS_WEB M
								 WHERE F.CIDADE = M.CHAVE
								   AND F.CHAVE_USUARIO_WEB = $usuario
								   AND TIPO = 'C'";
								 
						$ds = oci_parse($conn, $sql);	
						oci_define_by_name($ds, "CHAVE", $chave);
						oci_define_by_name($ds, "DESCRICAO", $descricao);
						oci_define_by_name($ds, "INSTITUICAO", $instituicao);
						oci_define_by_name($ds, "CIDADE", $cidade);
						oci_define_by_name($ds, "DATA_INICIO", $datainicio);
						oci_define_by_name($ds, "DATA_TERMINO", $datatermino);
						oci_define_by_name($ds, "NOME_CIDADE", $nomecidade);
						oci_define_by_name($ds, "UF", $uf);
						oci_execute($ds);	
						oci_fetch_all($ds, $cont);

						$cont = ocirowcount($ds);
						$i = 0;

						if ($cont == 0) {
							echo "<h5>Nenhuma formação cadastrada.</h5>";
							
						}
						else {
							
							oci_execute($ds);
							while (oci_fetch($ds)) {
								
								if ($datatermino == '') {
									$datatermino = 'PRESENTE';
								}								
								
								$i++;
								echo "<h5>$descricao</h5>
   									  <p>
										$instituicao<br/>
										$nomecidade-$uf<br/>
										$datainicio - $datatermino
									  </p>";
								
								if 	($i < $cont) {
									echo "<hr/>";
								}							
							
							}					
				
						}
					
					?>	
					
				</div>
			
			</div>		
		
			<div class="card" style="margin-top:20px">

				<div class = "card-header">
				
					<div class="col-lg-11 float-left">
						<h4> Experiência Profissional </h3>
					</div>
					<div class="col-lg-1 float-left">
					    <a href="cad_experiencia.php">
						<button type="button" class="btn btn-xs btn-primary">
						  <span class="glyphicon glyphicon-edit"></span>
						</button>
						</a>
					</div>	
					
				</div>

				<div class="card-body">
					
					<?php
					
						$sql = "SELECT E.CHAVE, E.CHAVE_USUARIO_WEB, E.EMPRESA, E.CIDADE, E.CARGO, 
						               TO_CHAR(E.DATA_INICIO, 'DD/MM/YYYY') DATA_INICIO, 
									   TO_CHAR(E.DATA_TERMINO, 'DD/MM/YYYY') DATA_TERMINO, 
									   E.RESUMO, M.NOME NOME_CIDADE, M.UF  
								  FROM EXPERIENCIA_WEB E, MUNICIPIOS_WEB M
								 WHERE E.CIDADE = M.CHAVE
								   AND CHAVE_USUARIO_WEB = $usuario";
								 
						$ds = oci_parse($conn, $sql);	
						oci_define_by_name($ds, "CHAVE", $chave);
						oci_define_by_name($ds, "EMPRESA", $empresa);
						oci_define_by_name($ds, "CIDADE", $cidade);
						oci_define_by_name($ds, "CARGO", $cargo);
						oci_define_by_name($ds, "DATA_INICIO", $datainicio);
						oci_define_by_name($ds, "DATA_TERMINO", $datatermino);
						oci_define_by_name($ds, "NOME_CIDADE", $nomecidade);
						oci_define_by_name($ds, "UF", $uf);
						oci_define_by_name($ds, "RESUMO", $resumo);
						oci_execute($ds);	
						oci_fetch_all($ds, $cont);
						
						$cont = ocirowcount($ds);
						$i = 0;
						
						if ($cont == 0) {
							echo "<h5>Nenhuma experiência profissional cadastrada.</h5>";
							
						}
						else {
							
							oci_execute($ds);	
							while (oci_fetch($ds)) {
								$i++;
								
								if ($datatermino == '') {
									$datatermino = 'PRESENTE';
								}

								$resumo = strtoupper($resumo);
								
								echo "<h5>$empresa</h5>
   									  <p>
										$cargo<br/>
										$nomecidade-$uf<br/>
										$datainicio - $datatermino<br/><br/>
										$resumo
									  </p>";
								
								if 	($i < $cont) {
									echo "<hr/>";
								}											
							}					
					
						}
					
					?>
					
				</div>
		
			</div>
			
		</div>
		<br/><br/><br/>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="js/validator.min.js"></script>

  </body>
  
</html>
