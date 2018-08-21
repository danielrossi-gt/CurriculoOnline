<?php
  session_start();
  require_once("conn.php");
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

  </head>

  <body onLoad="MascaraCPF(identificacao.cpf, event);">

    <!-- Page Content -->
    <div class="container">

		<div class="col-lg-12">
			<img src="http://via.placeholder.com/1151x250" class="img-fluid" alt="Responsive image">
		</div>  		

		<div class="row" style="margin-top:20px">
			<div class="col-lg-12 text-center">
				<h3> Etapa 1: Identificação </h3>
			</div>
		</div>
		
		<div class="col-lg-12" style="margin-top:20px">
		
			<div class="card">
			
				<div class = "card-header">
					<h4> Preencha seus dados pessoais </h3>
				</div>
				
				<div class="card-body">
					<form method="post" action="ins_identificacao.php" data-toggle="validator" name="identificacao">

						<fieldset>
						    <div class="row">
							<div class="form-group col-lg-12">
							    <label for="nome">Nome</label>
								<input name="nome" id="nome" class="form-control text-uppercase" placeholder="" required>
								<div class="help-block with-errors"></div>
							</div>
							</div>

						    <div class="row">
							<div class="form-group col-lg-3 float-left">
								<label for="cpf" >CPF</label>
								<input name="cpf" id="cpf"  class="form-control text-uppercase" value=<?php echo $_SESSION["cpf"]; ?> type="text" onKeyUp="MascaraCPF(identificacao.cpf, event);" required/>
								<div class="help-block with-errors"></div>
							</div>
							<div class="form-group col-lg-3 float-left">
								<label for="rg" >RG</label>
								<input id="rg" name="rg" class="form-control text-uppercase" type="text" onKeyUp="MascaraRG(identificacao.rg, event);" required/>
								<div class="help-block with-errors"></div>
							</div>
							<div class="form-group col-lg-3 float-left">
								<label for="pis" >PIS</label>
								<input name="pis" id="pis"  class="form-control text-uppercase" type="text" maxlength="11"/>
								<div class="help-block with-errors"></div>
							</div>								
							
							<div class="form-group col-lg-3 float-left">
								<label for="sexo" >Sexo</label>
								<select id="sexo" name="sexo" class="form-control text-uppercase" required>
											<option value="MASCULINO">MASCULINO</option>
											<option value="FEMININO">FEMININO</option>
										</select>
								
							</div>

							</div>
							
						    <div class="row">
							<div class="form-group col-lg-3">
								<label for="cep">Cep</label>
								<input id="cep" name="cep" type="text" class="form-control" value="" size="10" maxlength="9" onKeyUp="MascaraCep(identificacao.cep, event);" required/>
								<div class="help-block with-errors"></div>
							</div>
							</div>
							
							<div class="row">
							<div class="form-group col-lg-9 float-left">
								<label for="rua">Rua</label>
								<input id="rua" name="rua" type="text" class="form-control text-uppercase" size="60" required/>
								<div class="help-block with-errors"></div>
							</div>
							
							<div class="form-group col-lg-3 float-left">
								<label for="numero">Número</label>
								<input id="numero" name="numero" class="form-control text-uppercase" type="text" required/>
								<div class="help-block with-errors"></div>
							</div>
							</div>
							
							<div class="row">
							<div class="form-group col-lg-12 float-left">
								<label for="complemento">Complemento</label>
								<input id="complemento" name="complemento" type="text" class="form-control text-uppercase" size="60" />
								<div class="help-block with-errors"></div>
							</div>	
							</div>
							
							<div class="row">
							<div class="form-group col-lg-4 float-left">
								<label for="bairro">Bairro</label>
								<input id="bairro" name="bairro" type="text" class="form-control text-uppercase" size="40" required/>
								<div class="help-block with-errors"></div>
							</div>
							
							<div class="form-group col-lg-4 float-left">
								<label for="cidade">Cidade</label>
								<input id="cidade" name="cidade" type="text" class="form-control text-uppercase" size="40" required/>
								<div class="help-block with-errors"></div>
							</div>
							
							<div class="form-group col-lg-4">
								<label for="uf">Estado</label>
								<select id="uf" name="uf" class="form-control text-uppercase" required>
											<option value="AC">Acre</option>
											<option value="AL">Alagoas</option>
											<option value="AP">Amapá</option>
											<option value="AM">Amazonas</option>
											<option value="BA">Bahia</option>
											<option value="CE">Ceará</option>
											<option value="DF">Distrito Federal</option>
											<option value="ES">Espírito Santo</option>
											<option value="GO">Goiás</option>
											<option value="MA">Maranhão</option>
											<option value="MT">Mato Grosso</option>
											<option value="MS">Mato Grosso do Sul</option>
											<option value="MG">Minas Gerais</option>
											<option value="PA">Pará</option>
											<option value="PB">Paraíba</option>
											<option value="PR">Paraná</option>
											<option value="PE">Pernambuco</option>
											<option value="PI">Piauí</option>
											<option value="RJ">Rio de Janeiro</option>
											<option value="RN">Rio Grande do Norte</option>
											<option value="RS">Rio Grande do Sul</option>
											<option value="RO">Rondônia</option>
											<option value="RR">Roraima</option>
											<option value="SC">Santa Catarina</option>
											<option value="SP">São Paulo</option>
											<option value="SE">Sergipe</option>
											<option value="TO">Tocantins</option>
										</select>								
							</div>
							</div>
							
							<div class="row">
							<div class="form-group col-lg-6 float-left">
								<label for="telefone">Telefone Fixo</label>
								<input id="telefone" name="telefone" type="tel" class="form-control text-uppercase" size="15" maxlength="15" onKeyUp="MascaraTelefone(identificacao.telefone, event);" />
								<div class="help-block with-errors"></div>
							</div>
							
							<div class="form-group col-lg-6 float-left">
								<label for="celular">Telefone Celular</label>
								<input id="celular" name="celular" type="tel" class="form-control text-uppercase" size="15" maxlength="15" onKeyUp="MascaraCelular(identificacao.celular, event);" required/>
								<div class="help-block with-errors"></div>
							</div>
							</div>
							
							<div class="row">
							<div class="form-group col-lg-12 float-left">
								<label for="email">E-Mail</label>
								<input id="email" name="email" type="email" class="form-control" size="40" required/>
								<div class="help-block with-errors"></div>
							</div>
							</div>

							<div class="row">
							<div class="form-group col-lg-4 float-left">
								<label for="nascimento">Data Nascimento</label>
								<input id="nascimento" name="nascimento" type="date" class="form-control" size="40" required/>
								<div class="help-block with-errors"></div>
							</div>

							<div class="form-group col-lg-4 float-left">
								<label for="estadocivil">Estado Civil</label>
								<select id="estadocivil" name="estadocivil" class="form-control text-uppercase" required>
											<option value="SOLTEIRO">SOLTEIRO(A)</option>
											<option value="CASADO">CASADO(A)</option>
											<option value="DESQUITADO">DESQUITADO(A)</option>
											<option value="DIVORCIADO">DIVORCIADO(A)</option>
											<option value="VIUVO">VIUVO(A)</option>
											<option value="MARITAL">MARITAL</option>
											<option value="SEP. JUDICIAL">SEP. JUDICIAL</option>
										</select>
							</div>

							<div class="form-group col-lg-4 float-left">
								<label for="nacionalidade">Nacionalidade</label>
								<select id="nacionalidade" name="nacionalidade" class="form-control text-uppercase" required>
									<option value="Brasileiro">Brasileiro</option>
									<option value="Naturalizado Brasileiro">Naturalizado Brasileiro</option>
									<option value="Argentino">Argentino</option>
									<option value="Boliviano">Boliviano</option>
									<option value="Chileno">Chileno</option>
									<option value="Paraguaio">Paraguaio</option>
									<option value="Uruguaio">Uruguaio</option>
									<option value="Alemao ">Alemao</option>
									<option value="Belga">Belga</option>
									<option value="Britanico">Britanico</option>
									<option value="Canadense">Canadense</option>
									<option value="Espanhol">Espanhol</option>
									<option value="Norte-Americano (EUA)">Norte-Americano (EUA)</option>
									<option value="Frances">Frances</option>
									<option value="Suico">Suico</option>
									<option value="Italiano">Italiano</option>
									<option value="Japones">Japones</option>
									<option value="Chines">Chines</option>
									<option value="Coreano">Coreano</option>
									<option value="Portugues">Portugues</option>
									<option value="Outros Latino-Americanos">Outros Latino-Americanos</option>
									<option value="Outros Asiaticos">Outros Asiaticos</option>
									<option value="Outros">Outros</option>
								</select>

							</div>
							</div>
							
							<div class="row">
							<div class="form-group col-lg-3 float-left">
								<label for="deficiencia">Portador de Deficiência</label>
								<select id="deficiencia" name="deficiencia" class="form-control text-uppercase" required>
									<option value="NAO">NÃO</option>
									<option value="FIS">FÍSICA</option>
									<option value="AUD">AUDITIVA</option>
									<option value="VIS">VISUAL</option>
									<option value="MEN">MENTAL</option>
									<option value="MUL">MÚLTIPLA</option>
									<option value="REA">REABILITADO</option>							
								</select>
							</div>		

							<div class="form-group col-lg-9 float-left">
								<label for="tipocargo">Tipo do Cargo</label>
								<?php combo_tipo_cargo($_SESSION["codigo_base"], $conn); ?>
							</div>							
							</div>
							
						</fieldset>
						<div class="form-group col-lg-12">
							<input type="submit" name="btnOK" id="btnOK" value="Gravar" class="btn btn-lg btn-primary btn-block"/>		
						</div>
						
  					</form>		
					
				</div>
				
		</div>
	  
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="js/validator.min.js"></script>

  </body>
  
</html>
