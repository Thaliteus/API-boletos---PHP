<?php

/**
 * classe para ler o arquivo de retorno enviado pelo banco
 * 
 * @author Jean Farias Roldao
 */
require '../Conn.ini.php';
class ArquivoRetorno
{
	public $conn;
	function __construct()
	{
		$this->conn = new conn();
	}
	function codigoGuiaPeloNossonumero($nossonumero)
	{


		$result = $this->conn->db->query("SELECT id FROM wiss_emitir_cancelar_guia_iss WHERE nossonumero = '$nossonumero'");
		if ($result->num_rows == 0) {
			return 0;
		} else {
			$cod_guia = $result->fetch_assoc();
			return $cod_guia['id'];
		}
	}

	function registrarPagamentoGuia($codguia)
	{
		$result = $this->conn->db->query("UPDATE wiss_emitir_cancelar_guia_iss SET stt = 'S' WHERE id = '$codguia'");
		if ($result->affected_rows == 0) {
			return false;
		}
		return true;
	}

	function lerTxtRetorno($arquivo_txt_upload)
	{
		$arquivo_txt = $arquivo_txt_upload;
		//pega o endereco da pasta para guardar o aruivo de retorno
		$target_path = dirname(__FILE__) . "/arquivosretorno/";

		if (!is_dir($target_path)) {
			mkdir($target_path);
		}

		//monta o endereco onde vai ficar os arquivos de retorno
		$target_path = $target_path . basename($arquivo_txt['name']);
		$arquivo = $target_path;

		if (move_uploaded_file($arquivo_txt['tmp_name'], $target_path)) {
			//echo "The file ".  basename( $arquivo_txt['name']). " has been uploaded";
			//echo "Sucesso!";
		} else {
			echo "Ocorreu um erro durante o upload, favor tentar novamente!";
			//se ocorrer um erro para o script
			return;
		}

		//le o arquivo em forma de array
		$arq_array = file($target_path);

		//tira a primeira linha que � a identificacao do banco
		$dados_banco = array_shift($arq_array);

		//tira a ultima que nao sei para que serve
		$dados_foot = array_pop($arq_array);

		$total_guias = count($arq_array);

		$cont_guias = 0;

		$cont_notas = 0;

		foreach ($arq_array as $lin) if ($lin) {
			//o nosso numero esta na posisao 56 e tem 25 caracteres de tamanho
			$nossonumero = substr($lin, 56, 25);
			$cod_guia = self::codigoGuiaPeloNossonumero($nossonumero);
			if ($cod_guia != 0) {
				//conta as guias atualizadas com sucesso
				$reg_guias = self::registrarPagamentoGuia($cod_guia);

				if ($reg_guias == true) {
					$cont_guias++;
				}

				$cont_notas++;
			}
		}
		//echo "<br>{$cont_guias}/{$total_guias} guias pagas <br>{$cont_notas} notas escrituradas";

		//retorna um resumo da operacao de leitura do arquivo
		echo "ok";
		return array(
			'guias confirmadas' => $cont_guias,
			'total_guias'	=> $total_guias
		);
	}
}
