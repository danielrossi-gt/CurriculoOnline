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
				<div class="row">
				<div class="col-lg-3 float-left" style="margin-top:10px">
				</div>
				<!-- Me cadastrar -->
				<div class="col-lg-6 float-center" style="margin-top:10px">
					<div class="card">
						<div class = "card-header">
							<h4> Recuperar Senha </h4>
						</div>
						<div class="card-body">
							Informe o seu CPF e informe uma nova senha. <br/><br/>
							
							<form role="form" method="post" action="alterar_senha.php" name="cadastro" data-toggle="validator">
								<fieldset>
									<div class="form-group">
										<input class="form-control" placeholder="CPF (Apenas números)" name="txtCPF" id="txtCPF" onKeyUp="MascaraCPF(cadastro.txtCPF, event);" required>
										<div class="help-block with-errors"></div>
									</div>
									<div class="form-group">
										<input class="form-control" placeholder="Senha (Mínimo de seis caracteres)" name="txtSenha" id="txtSenha" type="password" value="" data-minlength="6" required>
										<div class="help-block with-errors"></div>
									</div>
									<div class="form-group">
										<input class="form-control" placeholder="Confirmar Senha" name="txtConfSenha" id="txtConfSenha" type="password" value="" 
										data-match="#txtSenha" data-match-error="Atenção! As senhas não estão iguais." required>
										<div class="help-block with-errors"></div>
									</div>
									<input type="submit" name="btnOKCadastro" id="btnOKCadastro" value="Cadastrar nova senha" class="btn btn-lg btn-primary btn-block"/>
								</fieldset>
								<input type="hidden" name="codigoBase" value="900010">
							</form>
							
						</div>
					</div>
				</div>
			</div>
			</div>
		</div>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="js/validator.min.js"></script>

  </body>
  
</html>
