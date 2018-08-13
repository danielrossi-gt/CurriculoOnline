<?php

	class formacao {
		
		public $chave;
		public $descricao;
		public $instituicao;
		public $cidade;
		public $inicio;
		public $termino;
		public $tipo;
	
		function inserir($conn, $codigobase, $url) {

			$this->usuario = $_SESSION["usuario_chave"];
			$this->descricao = strtoupper($this->descricao);
			$this->instituicao = strtoupper($this->instituicao);
			$this->inicio = date("Y-m-d", strtotime($this->inicio));

			if ($this->termino != 'NULL') {
				$this->termino = date("Y-m-d", strtotime($this->termino));
			}			
			
			$sql = "INSERT INTO FORMACAO_WEB (
					  CHAVE, CHAVE_USUARIO_WEB, DESCRICAO, INSTITUICAO, CIDADE, 
					  DATA_INICIO, 
					  DATA_TERMINO, 
					  TIPO)
					VALUES (
					  FORMACAO_WEB_SEQ.NEXTVAL, $this->usuario, UPPER('$this->descricao'), UPPER('$this->instituicao'), $this->cidade, 
					  TO_DATE('$this->inicio', 'YYYY-MM-DD'), ";
			if ($this->termino != 'NULL') {
				$sql = $sql . " TO_DATE('$this->termino', 'YYYY-MM-DD'), ";
			}
			else {
				$sql = $sql . " NULL, ";
			}
			
			$sql = $sql . " '$this->tipo')";

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
		
		static function deletar ($chave, $conn, $url) {
			
			$sql = "DELETE FROM FORMACAO_WEB WHERE CHAVE = $chave";
					 
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