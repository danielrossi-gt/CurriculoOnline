<?php

	class identificacao {
		
		public $chave;
		public $nome;
		public $sexo;
		public $cpf;
		public $rg;
		public $cep;
		public $rua;
		public $numero;
		public $complemento;
		public $bairro;
		public $cidade;
		public $uf;
		public $telefone;
		public $celular;
		public $email;
		public $nascimento;
		public $estadocivil;
		public $nacionalidade;
		public $deficiencia;
		public $tipocargo;
		public $pis;
		

		function inserir($conn, $codigobase, $url) {
			
			$this->nome = strtoupper($this->nome);
			$this->rua = strtoupper($this->rua);
			$this->complemento = strtoupper($this->complemento);
			$this->bairro = strtoupper($this->bairro);
			$this->nacionalidade = strtoupper($this->nacionalidade);
			$this->sexo = strtoupper($this->sexo);
			$this->estadocivil = strtoupper($this->estadocivil);
			$this->deficiencia = strtoupper($this->deficiencia);
			
			$this->cidade = strtoupper($this->cidade);
			$this->cpf = preg_replace("/[^0-9]/", "", $this->cpf);
			$this->rg = preg_replace("/[^0-9]/", "", $this->rg);
			$this->cep = preg_replace("/[^0-9]/", "", $this->cep);
			$this->nascimento = date("Y-m-d", strtotime($this->nascimento));

			$sql = "SELECT CHAVE FROM MUNICIPIOS_WEB WHERE CEP LIKE '" . substr($this->cep, 0, 5)."%'";
			
			$ds = oci_parse($conn, $sql);	
			oci_define_by_name($ds, "CHAVE", $chavecidade);
			oci_execute($ds);	
			oci_fetch($ds);
			
			if ($this->complemento == '') {
				$this->complemento = 'NULL';				
			}
			else {
				$this->complemento = "UPPER('$this->complemento')";
			}
			
			if ($this->pis == '') {
				$this->pis = 'NULL';
			}

			$sql = "INSERT INTO TALENTOS_WEB (
					  CHAVE, CODIGO_BASE, CHAVE_USUARIO_WEB, CPF, NUMERO_RG, NOME, 
					  ENDERECO, NUMERO, COMPLEMENTO, BAIRRO, CIDADE, CEP, 
					  TELEFONE, TELEFONE_CELULAR, EMAIL, 
					  DATA_NASCIMENTO, NACIONALIDADE, SEXO, ESTADO_CIVIL, 
					  PORTADOR_DEFICIENCIA, TIPO_CARGO, DATA_CADASTRO, PIS)
					VALUES (
					  $this->chave, $codigobase, $this->chave, '$this->cpf', '$this->rg', UPPER('$this->nome'), 
					  UPPER('$this->rua'), UPPER('$this->numero'), " . $this->complemento . ", UPPER('$this->bairro'), $chavecidade, '$this->cep', 
					  '$this->telefone', '$this->celular', '$this->email', 
					  TO_DATE('$this->nascimento', 'YYYY-MM-DD'), UPPER('$this->nacionalidade'), UPPER('$this->sexo'), UPPER('$this->estadocivil'), 
					  UPPER('$this->deficiencia'), '$this->tipocargo', SYSDATE, $this->pis)";

			echo $sql;		  
					  
			$ds = oci_parse($conn, $sql);
			$exec = oci_execute($ds, OCI_NO_AUTO_COMMIT);
			
			$erro = "NAO";
				
			if (!$exec) {
				$e = oci_error($ds);
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
			
			oci_close($conn);
			
			if ($erro == "NAO") {
				header("Location: $url");
			}
					  
		}
		
		function alterar ($conn, $codigobase, $url) {
			
			$this->nome = strtoupper($this->nome);
			$this->rua = strtoupper($this->rua);
			$this->complemento = strtoupper($this->complemento);
			$this->bairro = strtoupper($this->bairro);
			$this->nacionalidade = strtoupper($this->nacionalidade);
			$this->sexo = strtoupper($this->sexo);
			$this->estadocivil = strtoupper($this->estadocivil);
			$this->deficiencia = strtoupper($this->deficiencia);
			
			$this->cidade = strtoupper($this->cidade);
			$this->cpf = preg_replace("/[^0-9]/", "", $this->cpf);
			$this->rg = preg_replace("/[^0-9]/", "", $this->rg);
			$this->cep = preg_replace("/[^0-9]/", "", $this->cep);
			$this->nascimento = date("Y-m-d", strtotime($this->nascimento));

			if ($this->pis == '') {
				$this->pis = 'NULL';
			}

			$sql = "SELECT CHAVE FROM MUNICIPIOS_WEB WHERE CEP LIKE '" . substr($this->cep, 0, 5)."%'";
			$ds = oci_parse($conn, $sql);	
			oci_define_by_name($ds, "CHAVE", $chavecidade);
			oci_execute($ds);	
			oci_fetch($ds);

			
			$sql = "UPDATE TALENTOS_WEB 
			            SET CPF = '$this->cpf', 
							NUMERO_RG = '$this->rg',
							NOME = UPPER('$this->nome'),
							ENDERECO = UPPER('$this->rua'),
							NUMERO = '$this->numero', ";
							
            if ($this->complemento == '') {
				$sql = $sql . "COMPLEMENTO = NULL, ";
			}	
			else {
				$sql = $sql . "COMPLEMENTO = UPPER('$this->complemento'), ";				
			}
							
			$sql = $sql . 				
					"		BAIRRO = UPPER('$this->bairro'),
							CIDADE = $chavecidade,
							CEP = '$this->cep', 
						    TELEFONE = '$this->telefone',
							TELEFONE_CELULAR = '$this->celular',
							EMAIL = '$this->email',
							DATA_NASCIMENTO = TO_DATE('$this->nascimento', 'YYYY-MM-DD'),
							NACIONALIDADE = UPPER('$this->nacionalidade'),
							SEXO = UPPER('$this->sexo'),
							ESTADO_CIVIL = UPPER('$this->estadocivil'),
							PORTADOR_DEFICIENCIA = UPPER('$this->deficiencia'),
							TIPO_CARGO = '$this->tipocargo',
							PIS = $this->pis
					  WHERE CHAVE = $this->chave";

			echo "complemento: " . $this->complemento;	
			
			echo $sql;		  
					  
			$ds = oci_parse($conn, $sql);
			$exec = oci_execute($ds, OCI_NO_AUTO_COMMIT);
			
			$erro = "NAO";
				
			if (!$exec) {
				$e = oci_error($ds);
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
			
			oci_close($conn);
			
			if ($erro == "NAO") {
				header("Location: $url");
			}
					  			
		}
		
	}		
	
?>