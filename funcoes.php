<?php

use Defuse\Crypto\Crypto;
use Defuse\Crypto\Key;
require './vendor/autoload.php';
function DecToMoeda($valor){
    return number_format($valor, 2, ',', '.');
}
function geraCodigoDeBarras($valor){
    $fino = 1 ;
    $largo = 3 ;
    $altura = 50 ;
    $barcodes[0] = "00110" ;
    $barcodes[1] = "10001" ;
    $barcodes[2] = "01001" ;
    $barcodes[3] = "11000" ;
    $barcodes[4] = "00101" ;
    $barcodes[5] = "10100" ;
    $barcodes[6] = "01100" ;
    $barcodes[7] = "00011" ;
    $barcodes[8] = "10010" ;
    $barcodes[9] = "01010" ;
    for($f1=9;$f1>=0;$f1--){
        for($f2=9;$f2>=0;$f2--){
            $f = ($f1 * 10) + $f2 ;
            $texto = "" ;
            for($i=1;$i<6;$i++){
                $texto .=  substr($barcodes[$f1],($i-1),1) . substr($barcodes[$f2],($i-1),1);
            }
            $barcodes[$f] = $texto;
        }
    }
//Desenho da barra
//Guarda inicial
    ?>
    <img src=img/p.gif width=<?=$fino?> height=<?=$altura?> border=0><img
            src=img/b.gif width=<?=$fino?> height=<?=$altura?> border=0><img
            src=img/p.gif width=<?=$fino?> height=<?=$altura?> border=0><img
            src=img/b.gif width=<?=$fino?> height=<?=$altura?> border=0><img
    <?php

    $texto = $valor ;
    if((strlen($texto) % 2) <> 0){
        $texto = "0" . $texto;
    }

// Draw dos dados
    while (strlen($texto) > 0) {
        $i = round(esquerda($texto,2));
        $texto = direita($texto,strlen($texto)-2);
        $f = $barcodes[$i];
        for($i=1;$i<11;$i+=2){
            if (substr($f,($i-1),1) == "0") {
                $f1 = $fino ;
            }else{
                $f1 = $largo ;
            }
            ?>
            src=img/p.gif width=<?=$f1?> height=<?=$altura?> border=0><img
                <?php
                if (substr($f,$i,1) == "0") {
                    $f2 = $fino ;
                }else{
                    $f2 = $largo ;
                }
                ?>
                    src=img/b.gif width=<?=$f2?> height=<?=$altura?> border=0><img
            <?php
        }
    }

// Draw guarda final
    ?>
    src=img/p.gif width=<?=$largo?> height=<?=$altura?> border=0><img
            src=img/b.gif width=<?=$fino?> height=<?=$altura?> border=0><img
            src=img/p.gif width=<?=1?> height=<?=$altura?> border=0>
    <?php
} //Fim da função

function esquerda($entra,$comp){
    return substr($entra,0,$comp);
}

function direita($entra,$comp){
    return substr($entra,strlen($entra)-$comp,$comp);
}
function modulo_10($num) {
    $numtotal10 = 0;
    $fator = 2;

    // Separacao dos numeros
    for ($i = strlen($num); $i > 0; $i--) {
        // pega cada numero isoladamente
        $numeros[$i] = substr($num,$i-1,1);
        // Efetua multiplicacao do numero pelo (falor 10)
        // 2002-07-07 01:33:34 Macete para adequar ao Mod10 do Itaú
        $temp = $numeros[$i] * $fator;
        $temp0=0;
        foreach (preg_split('//',$temp,-1,PREG_SPLIT_NO_EMPTY) as $k=>$v){ $temp0+=$v; }
        $parcial10[$i] = $temp0; //$numeros[$i] * $fator;
        // monta sequencia para soma dos digitos no (modulo 10)
        $numtotal10 += $parcial10[$i];
        if ($fator == 2) {
            $fator = 1;
        } else {
            $fator = 2; // intercala fator de multiplicacao (modulo 10)
        }
    }

    // várias linhas removidas, vide função original
    // Calculo do modulo 10
    $resto = $numtotal10 % 10;
    $digito = 10 - $resto;
    if ($resto == 0) {
        $digito = 0;
    }

    return $digito;

}
function formata_numero($numero,$loop,$insert,$tipo = "geral") {
    if ($tipo == "geral") {
        $numero = str_replace(",","",$numero);
        while(strlen($numero)<$loop){
            $numero = $insert . $numero;
        }
    }
    if ($tipo == "valor") {
        /*
        retira as virgulas
        formata o numero
        preenche com zeros
        */
        $numero = str_replace(",","",$numero);
        while(strlen($numero)<$loop){
            $numero = $insert . $numero;
        }
    }
    if ($tipo == "convenio") {
        while(strlen($numero)<$loop){
            $numero = $numero . $insert;
        }
    }
    return $numero;
}
function gerar_nossonumero($convenio,$codigo,$loop){
    $numero = $codigo;
    while(strlen($numero)+strlen($convenio)< $loop) {
        $numero = 0 . $numero;
    }
    $nossonumero = $convenio.$numero;
    return $nossonumero;
}

//Entra no formato AAAA-MM-DD  e sai DD/MM/AAAA
function DataPt($data){
    return implode('/',array_reverse(explode('-',$data)));
}
function fator_vencimento($data){
    $one= new DateTime('1997-10-07');
    $two = new DateTime($data);

// Resgata diferença entre as datas
$dateInterval = $one->diff($two);
//aplicar condições,vide documentação
return $dateInterval->days;
}
function mod_11($cod){
    $soma=0;
    if(strlen($cod)==43)
    {
        for($i=42,$y=2;$i>=0;$y++,$i--)
        {
            if($y>9) $y=2;
            $soma =$soma + ( ((int)$cod[$i])*$y);
        }
        echo "soma =".$soma."\n";
        $resto = $soma % 11;
        echo "resto =".$resto."\n";
        $digito = 11 - $resto;
        if ($digito == 0 || $digito == 10 || $digito == 11) {
            $digito = 1;
        }
    
        return $digito;
    
    }
    
}
function set_senha()
{
   $arquivo = fopen('./checkout/chave.txt','w');
   $key = key::createNewRandomKey();
   $key_string = $key->saveToAsciiSafeString();
    fwrite($arquivo,$key_string , strlen($key_string));
    fclose($arquivo);
    
}
function get_senha()
{
    $arquivo = fopen('./checkout/chave.txt','r');
   $key_string = fread($arquivo, T_STRING);
   $key = key::loadFromAsciiSafeString($key_string);
    
    fclose($arquivo);
    return $key;
}
function gera_autenticador($nossonumero){
    $crypto = new Crypto();
    $url = '/checkout/checkout.php?identf=';
    $url = $url.$crypto::encrypt($nossonumero,get_senha(),false);
    return $url;
}

?>
