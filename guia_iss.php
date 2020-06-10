<html>

<head>
    <link href="css/guia.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <?php

    //include("../include/conect.php");
    require 'Conn.ini.php';
    require 'Randon.class.php';
    require 'geraCodigoBarra.php';
    include("funcoes.php");
    //include( "geraCodigoBarra.php");

	$conn = new conn;
    $get = $_GET['boleto'];
   
  
    if(is_numeric($get)==false){
        echo '<h2> Erro de parametro <h2>';
    }
    else{

    $id     = $get;
    $qr     = $conn->db->query("SELECT cad_contribuintes.nome,  wiss_emitir_cancelar_guia_iss.* FROM `cad_contribuintes`,wiss_emitir_cancelar_guia_iss WHERE cad_contribuintes.id = wiss_emitir_cancelar_guia_iss.id_contribuinte AND wiss_emitir_cancelar_guia_iss.id = '$id'");
    $linhas = $qr->fetch_assoc();
    $qr = $conn->db->query("SELECT * FROM param_prefeitura_prefeitura");
    $prefeitura = $qr->fetch_assoc();




    // $data_v = $get['competencia'];
    $datax = $linhas['emissao'];

    // $guia = base64_decode($_GET['guia']);
    $agencia = '0237';
    $contacorrente = '00005452';
    $convenio = '761421';
    $contrato = '';
    $carteira = '';
    $codigoboleto = 589;

    // DEFINE O FUSO HORARIO COMO O HORARIO DE BRASILIA
    date_default_timezone_set('America/Sao_Paulo');
    // CRIA UMA VARIAVEL E ARMAZENA A HORA ATUAL DO FUSO-HORÀRIO DEFINIDO (BRASÍLIA)
    $dataLocal = date('d/m/Y H:i:s', time());

    //DEFININDO VARIAVEIS E O NOSSO NUMERO
    $Cnpj = '000000/000-00';
    $cpf = '00808698311';
    $RazaoSocial = $linhas['nome'];
    $EndSacado = 'Rua a 17';
    $Numero  = '12';
    $codrel = '1';
    $Receita = $linhas['valor'];;
    $emissao = date('d/m/Y', strtotime($datax));
    $valorbl = 100;
    $valormulta = $linhas['multa'];
    //NOSSO NUMERO E COMPOSTO PELO CONVENIO SEGUIDO POR 5 NUMEROS 
    $exercicio = substr($datax, 0, 4);
    $data_nosso = substr($datax, 0, 4) . substr($datax, 5, 2) . substr($datax, 8, 2);

    $dandon = new Randon;
    $nosso_numero ='';
    if(!empty($linhas['nossonumero'])){
        $nosso_numero = $linhas['nossonumero'];
    }else{
        $nosso_numero = $data_nosso.$dandon->geraSenha(17,0,0,1,0);
        $conn->db->query("UPDATE wiss_emitir_cancelar_guia_iss SET nossonumero='$nosso_numero' WHERE id = '$id'");
    }
    $nossonumero = $nosso_numero;
    $vencimento = date('d/m/Y',strtotime($linhas['vencimento']));;
    $taxa_boleto =0;

   //DEFINE OS 3 PRIMEIROS CARACTERES DA LINHA DIGITAVEL
   $tipoProduto="8"; // para definir como arrecadação
   $tipoSegmento="1"; //para definir como prefeitura
   $tipoValor="6"; // Define o modulo de geração do digito verificador


   //$CONF_CNPJ
   //$CONF_ENDERECO
   //$CONF_CIDADE
   //$CONF_ESTADO

   //FORMATA O VALOR DO BOLETO
   //$valor= '50,8'; //variavel do banco;
   $valor= $valorbl; //variavel do banco;
   $valor = str_replace(",", ".",$valor);
   $valor_boleto=number_format($valor+$taxa_boleto, 2, ',', '');
   $valor = formata_numero($valor_boleto,11,0,"valor");

   // FORMATA O CNPJ DEIXANDO-O SOMENTE COM NUMEROS
   //$sqlfebraban=mysql_query("SELECT codfebraban FROM boleto");
   //$febraban=mysql_fetch_object($sqlfebraban);
   //$identificacao=$febraban->codfebraban;
   $identificacao = '1264';

   //$nossonumero=$nossonumero; // convenio + zeros + codguia

   //GERA O DIGITO VERIFICADOR
   $dv= modulo_10($tipoProduto.$tipoSegmento.$tipoValor.$valor.$identificacao.$nossonumero);
   //$dv= modulo_10($tipoProduto.$tipoSegmento.$tipoValor.$valor.$identificacao.$nossonumero);
   
   //MONTA A LINHA DIGITAVEL
   $linha = $tipoProduto.$tipoSegmento.$tipoValor.$dv.$valor.$identificacao.$nossonumero;
   
   //$linha = $tipoProduto.$tipoSegmento.$tipoValor.$dv.$valor.$identificacao.$nossonumero;
   //print($linha);


   //MOSTRA O CODIGO DE BARRAS
   $linha01= substr($linha,0,11);
       $dv01=modulo_10($linha01);

   $linha02= substr($linha,11,11);
       $dv02=modulo_10($linha02);

   $linha03= substr($linha,22,11);
       $dv03=modulo_10($linha03);


   $linha04= substr($linha,33,11);
       $dv04=modulo_10($linha04);

   $linhad = $linha01.'-'.$dv01.' '.$linha02.'-'.$dv02.' '.$linha03.'-'.$dv03.' '.$linha04.'-'.$dv04;
   //$sql_instrucoes_boleto = mysql_query("SELECT instrucoes FROM boleto");
   //list($Instrucoes_boleto) = mysql_fetch_array($sql_instrucoes_boleto);

    // INCLUDE DO LAYOUT
    include("guia_iss_view.php");
    //}
}
    

    ?>
</body>

</html>
