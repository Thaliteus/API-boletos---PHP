<?php

use Defuse\Crypto\Crypto;
use Defuse\Crypto\Key;
require '../vendor/autoload.php';
require '../Conn.ini.php';
$identf = $_GET['identf'];
    $crypto = new Crypto;
  
    $target_path = dirname(__FILE__) . "/chave.txt";
    $arq_array = file($target_path);
   
    $key = key::loadFromAsciiSafeString($arq_array[0]);

   $nosso_numero= $crypto::decrypt($identf,$key,false);
   $conn =new conn();
   $db = $conn->db;
   $result = $db->query("SELECT * FROM wiss_emitir_cancelar_guia_iss WHERE nossonumero = '$nosso_numero'");
		if ($result->num_rows == 0) {
      echo '<h2> Boleto não encontrado <h2>';
			return 0;
		} else {
      $guia = $result->fetch_assoc();
      
      //return $cod_guia['id'];
      $qr = $db->query("SELECT * FROM param_prefeitura_prefeitura");
      $instituicao = $qr->fetch_assoc();
      include('checkout_view.php');
		}
   
    //echo $identf;

?>