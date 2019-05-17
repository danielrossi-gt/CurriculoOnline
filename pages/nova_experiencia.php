<?php
  session_start();
  require_once("conn.php");
  
  $usuario = $_SESSION["usuario_chave"];
  $apelido = $_SESSION["apelido"];
  
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
			<img src="http://via.placeholder.com/1151x250" class="img-fluid" alt="Responsive image">
		</div>  		

		<div class="col-lg-12" style="margin-top:20px">

			<div class="card">

				<div class = "card-header">
				
					<div class="col-lg-12 float-left">
						<h4> Informe uma nova Experiência Profissional </h3>
					</div>
				</div>

				<div class="card-body">

					<form method="post" action="ins_experiencia.php" data-toggle="validator" name="identificacao">

						<fieldset>
						
						    <div class="row">
							<div class="form-group col-lg-12">
							    <label for="empresa">Empresa</label>
								<input name="empresa" id="empresa" class="form-control text-uppercase" placeholder="" required>
								<div class="help-block with-errors"></div>
							</div>
							</div>
							
							<div class="row">
							<div class="form-group col-lg-12 float-left">
								<label for="cidade">Cidade</label>
								<?php combo_cidade($conn); ?>
							</div>									
							</div>
							
						    <div class="row">
							<div class="form-group col-lg-12">
							    <label for="cargo">Cargo Ocupado</label>
								<input name="cargo" id="cargo" class="form-control text-uppercase" placeholder="" size="50" 
									   maxlength="50" required>
								<div class="help-block with-errors"></div>
							</div>
							</div>							

							<div class="row">
							<div class="form-group col-lg-6 float-left">
								<label for="inicio">Data de Entrada</label>
								<input id="inicio" name="inicio" type="date" class="form-control" size="40" required/>
								<div class="help-block with-errors"></div>
							</div>

							<div class="form-group col-lg-6 float-left">
								<label for="termino">Data de Saída (Não obrigatório)</label>
								<input id="termino" name="termino" type="date" class="form-control" size="40" />
								<div class="help-block with-errors"></div>
							</div>
							
							</div>

						    <div class="row">
							<div class="form-group col-lg-12">
							    <label for="resumo">Resumo das Funções</label>
								<input name="resumo" id="resumo" class="form-control text-uppercase" placeholder="" required>
								<div class="help-block with-errors"></div>
							</div>
							</div>							
							
						</fieldset>

						<div class="row">
						<div class="form-group col-lg-12">
							<input type="submit" name="btnOK" id="btnOK" value="Gravar" class="btn btn-lg btn-primary btn-block"/>		
						</div>
						</div>
						
					</form>
					
				</div>
		
			</div>
				
		</div>
	
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="js/validator.min.js"></script>

  </body>
  
</html>
