<?php

	//putenv("NLS_LANG=BRAZILIAN PORTUGUESE_BRAZIL.WE8ISO8859P1") or die("Falha ao inserir a variavel de ambiente");
	putenv("NLS_LANG=AMERICAN_AMERICA.AL32UTF8") or die("Falha ao inserir a variavel de ambiente");
	$conn = oci_connect('MPH_CLOUD', 'sah', '192.170.10.8:1521/ORCL');
	header('Content-Type: text/html; charset=utf-8'); 
	
	/*error_reporting(E_ERROR);*/
	
	function show_erro($erro) 
	{
		echo "<table width='100%' border='0' cellspacing='0' cellpadding='0' align='center'>";
		echo "<tr><td><div align='center'>";
		echo "<b>$erro</b>";
		echo "</div></td></tr>";
	    echo "</table>";		
	}
	
	function combo_tipo_cargo($codigobase, $conn, $selecao=0)
	{
		
		$sql = "SELECT CHAVE, CODIGO ||' - '|| DESCRICAO CARGO FROM TIPO_CARGO_WEB WHERE CODIGO_BASE = $codigobase";
		$ds = oci_parse($conn, $sql);	
		oci_define_by_name($ds, "CHAVE", $chave);
		oci_define_by_name($ds, "CARGO", $cargo);
		oci_execute($ds);	

		echo "<select id='tipocargo' name='tipocargo' class='form-control text-uppercase' required>";
		
		while (oci_fetch($ds)) {
			echo "<option value='$chave'";
			
			if ($chave == $selecao) {
				echo " selected";
			}
			
			echo ">$cargo</option>";
		}
		
		echo "</select>";
		
	}
	
	function combo_cidade($conn)
	{
		
		$sql = "SELECT CHAVE, NOME ||' - '||UF CIDADE FROM MUNICIPIOS_WEB ORDER BY NOME, UF";
		$ds = oci_parse($conn, $sql);	
		oci_define_by_name($ds, "CHAVE", $chave);
		oci_define_by_name($ds, "CIDADE", $cidade);
		oci_execute($ds);	

		echo "<select id='cidade' name='cidade' class='form-control text-uppercase' required>";
		
		while (oci_fetch($ds)) {
			echo "<option value='$chave'>$cidade</option>";
		}
		
		echo "</select>";
		
	}	
	
	function formatar ($tipo = "", $string, $size = 10)
	{
		$string = preg_replace("[^0-9]", "", $string);
		
		switch ($tipo)
		{
			case 'fone':
				if($size === 10){
				 $string = '(' . substr($tipo, 0, 2) . ') ' . substr($tipo, 2, 4) 
				 . '-' . substr($tipo, 6);
			 }else
			 if($size === 11){
				 $string = '(' . substr($tipo, 0, 2) . ') ' . substr($tipo, 2, 5) 
				 . '-' . substr($tipo, 7);
			 }
			 break;
			case 'cep':
				$string = substr($string, 0, 5) . '-' . substr($string, 5, 3);
			 break;
			case 'cpf':
				$string = substr($string, 0, 3) . '.' . substr($string, 3, 3) . 
					'.' . substr($string, 6, 3) . '-' . substr($string, 9, 2);
			 break;
			case 'cnpj':
				$string = substr($string, 0, 2) . '.' . substr($string, 2, 3) . 
					'.' . substr($string, 5, 3) . '/' . 
					substr($string, 8, 4) . '-' . substr($string, 12, 2);
			 break;
			case 'rg':
				$string = substr($string, 0, 2) . '.' . substr($string, 2, 3) . 
					'.' . substr($string, 5, 3) .'-'.substr($string, 8, 1);
			 break;
			default:
			 $string = 'É ncessário definir um tipo(fone, cep, cpg, cnpj, rg)';
			 break;
		}
		return $string;
	}	
	
?>