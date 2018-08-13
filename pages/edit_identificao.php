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
  
	$sql = "SELECT T.CPF, T.NUMERO_RG, T.NOME, T.ENDERECO, T.NUMERO, T.COMPLEMENTO, T.BAIRRO, T.CIDADE, T.CEP, 
				   T.TELEFONE, T.TELEFONE_CELULAR, T.EMAIL, TO_CHAR(T.DATA_NASCIMENTO, 'YYYY-MM-DD') DATA_NASCIMENTO, T.NACIONALIDADE, T.SEXO, 
				   T.ESTADO_CIVIL, T.PORTADOR_DEFICIENCIA, T.TIPO_CARGO, T.DATA_CADASTRO,
				   M.NOME NOME_CIDADE, M.UF	
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
	oci_execute($ds);	
	oci_fetch($ds);  

  
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

  <body style="padding-top: 0px; margin-top:0px;" onLoad="MascaraCPF(identificacao.cpf, event); 
                                                          MascaraRG(identificacao.rg, event);
														  MascaraCep(identificacao.cep, event);">

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
    <div class="container">

		<div class="col-lg-12">
			<img src="http://via.placeholder.com/1151x250" class="img-fluid" alt="Responsive image">
		</div>  		

		<div class="row" style="margin-top:20px">
			<div class="col-lg-12 text-center">
			
				<?php
			
					if ($_SESSION["edicao"] == 'SIM') {
						echo "<h3> Identificação </h3>";						
					}
					else {
						echo "<h3> Etapa 1: Identificação </h3>";
					}
				
				?>
				
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
								<input name="nome" id="nome" value="<?php echo $nome; ?>" class="form-control text-uppercase" placeholder="" required>
								<div class="help-block with-errors"></div>
							</div>
							</div>

						    <div class="row">
							<div class="form-group col-lg-4 float-left">
								<label for="cpf" >CPF</label>
								<input name="cpf" id="cpf"  class="form-control text-uppercase" value=<?php echo $_SESSION["cpf"]; ?> type="text" onKeyUp="MascaraCPF(identificacao.cpf, event);" required/>
								<div class="help-block with-errors"></div>
							</div>
							
							<div class="form-group col-lg-4 float-left">
								<label for="rg" >RG</label>
								<input id="rg" name="rg" value="<?php echo $rg; ?>" class="form-control text-uppercase" type="text" onKeyUp="MascaraRG(identificacao.rg, event);" required/>
								<div class="help-block with-errors"></div>
							</div>
							
							<div class="form-group col-lg-4 float-left">
								
								<label for="sexo" >Sexo</label>
								<select id="sexo" name="sexo" class="form-control text-uppercase" required>
									<option value="MASCULINO" <?php if ($sexo == 'MASCULINO') { echo "selected"; } ?>>MASCULINO</option>
									<option value="FEMININO" <?php if ($sexo == 'FEMININO') { echo "selected";} ?>>FEMININO</option>
								</select>
								
							</div>

							</div>
							
						    <div class="row">
							<div class="form-group col-lg-3">
								<label for="cep">Cep</label>
								<input id="cep" name="cep" type="text" value="<?php echo $cep; ?>" class="form-control" value="" size="10" maxlength="9" onKeyUp="MascaraCep(identificacao.cep, event);" required/>
								<div class="help-block with-errors"></div>
							</div>
							</div>
							
							<div class="row">
							<div class="form-group col-lg-9 float-left">
								<label for="rua">Rua</label>
								<input id="rua" name="rua" value="<?php echo $endereco; ?>" type="text" class="form-control text-uppercase" size="60" required/>
								<div class="help-block with-errors"></div>
							</div>
							
							<div class="form-group col-lg-3 float-left">
								<label for="numero">Número</label>
								<input id="numero" name="numero" value="<?php echo $numero; ?>" class="form-control text-uppercase" type="text" required/>
								<div class="help-block with-errors"></div>
							</div>
							</div>
							
							<div class="row">
							<div class="form-group col-lg-12 float-left">
								<label for="complemento">Complemento</label>
								<input id="complemento" name="complemento" value="<?php echo $complemento; ?>" type="text" class="form-control text-uppercase" size="60" />
								<div class="help-block with-errors"></div>
							</div>	
							</div>
							
							<div class="row">
							<div class="form-group col-lg-4 float-left">
								<label for="bairro">Bairro</label>
								<input id="bairro" name="bairro" value="<?php echo $bairro; ?>" type="text" class="form-control text-uppercase" size="40" required/>
								<div class="help-block with-errors"></div>
							</div>
							
							<div class="form-group col-lg-4 float-left">
								<label for="cidade">Cidade</label>
								<input id="cidade" name="cidade" type="text" value="<?php echo $cidade; ?>" class="form-control text-uppercase" size="40" required/>
								<div class="help-block with-errors"></div>
							</div>
							
							<div class="form-group col-lg-4">
								<label for="uf">Estado</label>
								<select id="uf" name="uf" class="form-control text-uppercase" required>
											<option value="AC" <?php if ($uf == 'AC') { echo "selected"; } ?>>Acre</option>
											<option value="AL" <?php if ($uf == 'AL') { echo "selected"; } ?>>Alagoas</option>
											<option value="AP" <?php if ($uf == 'AP') { echo "selected"; } ?>>Amapá</option>
											<option value="AM" <?php if ($uf == 'AM') { echo "selected"; } ?>>Amazonas</option>
											<option value="BA" <?php if ($uf == 'BA') { echo "selected"; } ?>>Bahia</option>
											<option value="CE" <?php if ($uf == 'CE') { echo "selected"; } ?>>Ceará</option>
											<option value="DF" <?php if ($uf == 'DF') { echo "selected"; } ?>>Distrito Federal</option>
											<option value="ES" <?php if ($uf == 'ES') { echo "selected"; } ?>>Espírito Santo</option>
											<option value="GO" <?php if ($uf == 'GO') { echo "selected"; } ?>>Goiás</option>
											<option value="MA" <?php if ($uf == 'MA') { echo "selected"; } ?>>Maranhão</option>
											<option value="MT" <?php if ($uf == 'MT') { echo "selected"; } ?>>Mato Grosso</option>
											<option value="MS" <?php if ($uf == 'MS') { echo "selected"; } ?>>Mato Grosso do Sul</option>
											<option value="MG" <?php if ($uf == 'MG') { echo "selected"; } ?>>Minas Gerais</option>
											<option value="PA" <?php if ($uf == 'PA') { echo "selected"; } ?>>Pará</option>
											<option value="PB" <?php if ($uf == 'PB') { echo "selected"; } ?>>Paraíba</option>
											<option value="PR" <?php if ($uf == 'PR') { echo "selected"; } ?>>Paraná</option>
											<option value="PE" <?php if ($uf == 'PE') { echo "selected"; } ?>>Pernambuco</option>
											<option value="PI" <?php if ($uf == 'PI') { echo "selected"; } ?>>Piauí</option>
											<option value="RJ" <?php if ($uf == 'RJ') { echo "selected"; } ?>>Rio de Janeiro</option>
											<option value="RN" <?php if ($uf == 'RN') { echo "selected"; } ?>>Rio Grande do Norte</option>
											<option value="RS" <?php if ($uf == 'RS') { echo "selected"; } ?>>Rio Grande do Sul</option>
											<option value="RO" <?php if ($uf == 'RO') { echo "selected"; } ?>>Rondônia</option>
											<option value="RR" <?php if ($uf == 'RR') { echo "selected"; } ?>>Roraima</option>
											<option value="SC" <?php if ($uf == 'SC') { echo "selected"; } ?>>Santa Catarina</option>
											<option value="SP" <?php if ($uf == 'SP') { echo "selected"; } ?>>São Paulo</option>
											<option value="SE" <?php if ($uf == 'SE') { echo "selected"; } ?>>Sergipe</option>
											<option value="TO" <?php if ($uf == 'TO') { echo "selected"; } ?>>Tocantins</option>
										</select>								
							</div>
							</div>
							
							<div class="row">
							<div class="form-group col-lg-6 float-left">
								<label for="telefone">Telefone Fixo</label>
								<input id="telefone" name="telefone" value="<?php echo $telefone; ?>" type="tel" class="form-control text-uppercase" size="40" onKeyUp="MascaraTelefone(identificacao.telefone, event);" />
								<div class="help-block with-errors"></div>
							</div>
							
							<div class="form-group col-lg-6 float-left">
								<label for="celular">Telefone Celular</label>
								<input id="celular" name="celular" value="<?php echo $celular; ?>" type="tel" class="form-control text-uppercase" size="40" onKeyUp="MascaraCelular(identificacao.celular, event);" required/>
								<div class="help-block with-errors"></div>
							</div>
							</div>
							
							<div class="row">
							<div class="form-group col-lg-12 float-left">
								<label for="email">E-Mail</label>
								<input id="email" name="email" value="<?php echo $email; ?>" type="email" class="form-control" size="40" required/>
								<div class="help-block with-errors"></div>
							</div>
							</div>

							<div class="row">
							<div class="form-group col-lg-4 float-left">
								<label for="nascimento">Data Nascimento</label>
								<input id="nascimento" name="nascimento" value="<?php echo $nascimento; ?>" type="date" class="form-control" size="40" required/>
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
									<option value="NAO" <?php if ($deficiencia == 'NAO') { echo "selected"; } ?>>NÃO</option>
									<option value="FIS" <?php if ($deficiencia == 'FIS') { echo "selected"; } ?>>FÍSICA</option>
									<option value="AUD" <?php if ($deficiencia == 'AUD') { echo "selected"; } ?>>AUDITIVA</option>
									<option value="VIS" <?php if ($deficiencia == 'VIS') { echo "selected"; } ?>>VISUAL</option>
									<option value="MEN" <?php if ($deficiencia == 'MEN') { echo "selected"; } ?>>MENTAL</option>
									<option value="MUL" <?php if ($deficiencia == 'MUL') { echo "selected"; } ?>>MÚLTIPLA</option>
									<option value="REA" <?php if ($deficiencia == 'REA') { echo "selected"; } ?>>REABILITADO</option>							
								</select>
							</div>		

							<div class="form-group col-lg-9 float-left">
								<label for="tipocargo">Tipo do Cargo</label>
								<?php combo_tipo_cargo($_SESSION["codigo_base"], $conn, $tipocargo); ?>
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
