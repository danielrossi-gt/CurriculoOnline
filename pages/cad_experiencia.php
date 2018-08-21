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
			<img src="img/trabalhecom.jpg" class="img-fluid" alt="Responsive image">
		</div>  		

		<div class="row" style="margin-top:20px">
			<div class="col-lg-12 text-center">
				<h3> Etapa 3: Experiência Profissional </h3>
			</div>
		</div>
		
		<div class="col-lg-12" style="margin-top:20px">

			<div class="card">

				<div class = "card-header">
				
					<div class="col-lg-11 float-left">
						<h4> Informe sua Experiência Profissional </h3>
					</div>
					<div class="col-lg-1 float-left">
					    <a href="nova_experiencia.php">
						<button type="button" class="btn btn-xs btn-primary">
						  <span class="glyphicon glyphicon-plus"></span>
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
						oci_fetch($ds);
						
						$cont = ocirowcount($ds);
						
						if ($cont == 0) {
							echo "<h5>Nenhuma experiência profissional cadastrada.</h5>";
							
						}
						else {
							
							oci_execute($ds);	
							while (oci_fetch($ds)) {
								echo "<h5>$empresa</h5>
   									  <p>
										$cargo<br/>
										$nomecidade-$uf<br/>
										$datainicio - $datatermino<br/><br/>
										$resumo
									  </p>
  									  <div>
										  <a href='del_experiencia.php?chave=$chave'>
										  <button type='button' class='btn btn-xs btn-danger'>
										  <span class='glyphicon glyphicon-trash'></span>
										  </button>
										  </a>
									  </div>
									  <hr/>
									  ";
							}					
					
						}
					
					?>
					
				</div>
		
			</div>
			
		</div>
	
		<div class="form-group col-lg-12" style="margin-top:20px">
			
			<?php
				
				if ($_SESSION["edicao"] == 'SIM') {
					echo "<a href='resumo.php'>
						  <input type='submit' name='btnOK' id='btnOK' value='Gravar Alterações' class='btn btn-lg btn-primary btn-block'/>		
						  </a>";
				}
				else {
					echo "<a href='resumo.php'>
						  <input type='submit' name='btnOK' id='btnOK' value='Concluir' class='btn btn-lg btn-primary btn-block'/>		
						  </a>";
				}
		
			
			?>
			
		</div>
	
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="js/validator.min.js"></script>

  </body>
  
</html>
