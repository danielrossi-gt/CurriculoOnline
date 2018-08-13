<?php
  session_start();
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

    <title>Trabalhe Conosco!</title>

    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

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

    <!--<script src="../vendor/jquery/jquery.min.js"></script> -->
  </head>

  <body>

    <!-- Page Content -->
    <div class="container">

		<div class="row">
			<div class="col-lg-12 text-center">
				<h3> Etapa 1: Identificação </h3>
			</div>
		</div>
		
		<div class="col-lg-12" style="margin-top:50px">
		
		<div class="col-lg-12" style="margin-top:50px">
			<div class="card">
			
				<div class = "card-header">
					<h4> Preenche seus dados pessoais </h3>
				</div>
				
				<div class="card-body">
					<form role="form" method="post" action="login.php" data-toggle="validator">

						<fieldset>
						
							<div class="form-group col-lg-12">
							    <label for="nome">Nome:</label>
								<input class="form-control text-uppercase" placeholder="" name="nome" id="nome" required>
								<div class="help-block with-errors"></div>
							</div>
							<div class="form-group col-lg-6 float-left">
								<label for="cpf" >CPF</label>
								<input id="cpf" class="form-control text-uppercase" value=<?php echo $_SESSION["cpf"]; ?> type="text" required/>
								<div class="help-block with-errors"></div>
							</div>
							<div class="form-group col-lg-6 float-left">
								<label for="rg" >RG</label>
								<input id="rg" class="form-control text-uppercase" type="text" required/>
								<div class="help-block with-errors"></div>
							</div>
						
							<div class="form-group col-lg-3">
								<label for="cep">Cep:</label>
								<input name="cep" type="text" class="form-control" id="cep" value="" size="10" maxlength="9" />
							</div>
							<div class="form-group col-lg-9 float-left">
								<label for="rua">Rua:</label>
								<input name="rua" type="text" class="form-control text-uppercase" id="rua" size="60" />
							</div>
							<div class="form-group col-lg-3 float-left">
								<label for="numero">Número</label>
								<input id="numero" class="form-control text-uppercase" type="text" />
							</div>
							<div class="form-group col-lg-4 float-left">
								<label for="bairro">Bairro:</label>
								<input name="bairro" type="text" class="form-control text-uppercase" id="bairro" size="40" />
							</div>
							<div class="form-group col-lg-4 float-left">
								<label for="cidade">Cidade:</label>
								<input name="cidade" type="text" class="form-control text-uppercase" id="cidade" size="40" />
							</div>
							<div class="form-group col-lg-4 float-left">
								<label for="uf">Estado:</label>
								<input name="uf" type="text" class="form-control text-uppercase" id="uf" size="2" />
							</div>
						  
						</fieldset>
								
  					</form>		
					
				</div>
				
		</div>

	  
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="js/validator.min.js"></script>

<!--	<script type="text/javascript">
		$("#cep").focusout(function(){
			//Início do Comando AJAX
			$.ajax({
				//O campo URL diz o caminho de onde virá os dados
				//É importante concatenar o valor digitado no CEP
				url: 'https://viacep.com.br/ws/'+$(this).val()+'/json/unicode/',
				//Aqui você deve preencher o tipo de dados que será lido,
				//no caso, estamos lendo JSON.
				dataType: 'json',
				//SUCESS é referente a função que será executada caso
				//ele consiga ler a fonte de dados com sucesso.
				//O parâmetro dentro da função se refere ao nome da variável
				//que você vai dar para ler esse objeto.
				success: function(resposta){
					//Agora basta definir os valores que você deseja preencher
					//automaticamente nos campos acima.
					$("#logradouro").val(resposta.logradouro);
					$("#complemento").val(resposta.complemento);
					$("#bairro").val(resposta.bairro);
					$("#cidade").val(resposta.localidade);
					$("#uf").val(resposta.uf);
					//Vamos incluir para que o Número seja focado automaticamente
					//melhorando a experiência do usuário
					//if $("#logradouro").val(resposta.logradouro) != '' { $("#numero").focus() };
				}
			});
		});
	</script>	 -->
	
	
	
	
  </body>
  
</html>
