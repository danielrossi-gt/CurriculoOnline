<?php

	class experiencia {

		public $chave;
		public $empresa;
		public $cidade;
		public $cargo;
		public $inicio;
		public $termino;
		public $resumo;
	
		function inserir($conn, $codigobase, $url) {

			$this->usuario = $_SESSION["usuario_chave"];
			$this->empresa = strtoupper($this->empresa);
			$this->cargo = strtoupper($this->cargo);
			$this->inicio = date("Y-m-d", strtotime($this->inicio));
			
			if ($this->termino != 'NULL') {
				$this->termino = date("Y-m-d", strtotime($this->termino));
			}
			
			$this->resumo = strtoupper($this->resumo);

			$sql = "INSERT INTO EXPERIENCIA_WEB (
					  CHAVE, CHAVE_USUARIO_WEB, EMPRESA, CIDADE, CARGO, 
					  DATA_INICIO, 
					  DATA_TERMINO, 
					  RESUMO)
					VALUES (
					  EXPERIENCIA_WEB_SEQ.NEXTVAL, $this->usuario, UPPER('$this->empresa'), $this->cidade, UPPER('$this->cargo'), 
					  TO_DATE('$this->inicio', 'YYYY-MM-DD'), ";

            if ($this->termino != 'NULL') {
			  $sql = $sql . " TO_DATE('$this->termino', 'YYYY-MM-DD'), ";
			}
			else {
			  $sql = $sql . " NULL, ";
			}
			 
			$sql = $sql . " '$this->resumo')";

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
			
			$sql = "DELETE FROM EXPERIENCIA_WEB WHERE CHAVE = $chave";
					 
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