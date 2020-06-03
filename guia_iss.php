<html>

<head>
    <link href="css/guia.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <?php
    //include("../include/conect.php");
    require 'Conn.ini.php';
    require 'Randon.class.php';
    include("funcoes.php");
    //include( "geraCodigoBarra.php");


    $get = $_GET['boleto'];

    $id     = $get;
    $qr     = $db->query("//query Select");
    $linhas = $qr->fetch_assoc();



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
    $valorbl = $linhas['valor'];
    $valormulta = $linhas['multa'];
    //NOSSO NUMERO E COMPOSTO PELO CONVENIO SEGUIDO POR 5 NUMEROS 
    $exercicio = substr($datax, 0, 4);
    $data_nosso = substr($datax, 0, 4) . substr($datax, 5, 2) . substr($datax, 8, 2);

    $dandon = new Randon;
    $nosso_numero ='';
    
    if (!empty($linhas['nossonumero'])) {
        $nosso_numero = $linhas['nossonumero'];
    } else {

        $nosso_numero = $convenio.$dandon->geraSenha(5, 0, 0, 1, 0);
        $db->query("UPDATE wiss_emitir_cancelar_guia_iss SET nossonumero='$nosso_numero' WHERE id = '$id'");
    }

    $nossonumero = $nosso_numero;
    $vencimento = $linhas['vencimento'];
    $vencimento = substr($vencimento, 8, 2) . '-' . substr($vencimento, 5, 2) . '-' . substr($vencimento, 0, 4);
    $taxa_boleto = 0;

    //$CONF_CNPJ
    //$CONF_ENDERECO
    //$CONF_CIDADE
    //$CONF_ESTADO

    //FORMATA O VALOR DO BOLETO
    //$valor= '50,8'; //variavel do banco;
    $valor = $valorbl; //variavel do banco;
    $valor = str_replace(",", ".", $valor);
    $valor_boleto = number_format($valor + $taxa_boleto, 2, ',', '');
    $valor = formata_numero($valor_boleto, 10, 0, "valor");
    // FORMATA O CNPJ DEIXANDO-O SOMENTE COM NUMEROS
    //$sqlfebraban=mysql_query("SELECT codfebraban FROM boleto");
    //$febraban=mysql_fetch_object($sqlfebraban);
    //$identificacao=$febraban->codfebraban;
    $identificacao = '1264';

    //$nossonumero=$nossonumero; // convenio + zeros + codguia

    //GERA O DIGITO VERIFICADOR
    //$dv = modulo_10($tipoProduto . $tipoSegmento . $tipoValor . $valor . $identificacao . $nossonumero);
    //$dv= modulo_10($tipoProduto.$tipoSegmento.$tipoValor.$valor.$identificacao.$nossonumero);
    //echo '----- '.$dv.' -----';
    //MONTA A LINHA DIGITAVEL
    //$linha = $tipoProduto . $tipoSegmento . $tipoValor . $dv . $valor . $identificacao . $nossonumero;
    //padrão BB para convenio de 6 digitos e Nosso numero com17 posições livres
    $cod_bb = '001';
    $cod_moeda = '9';
    $fator = fator_vencimento('2020-06-04');
    echo '<br> fato :'.$fator.'<br>';
    $modalidade_cobrança = '31';
    
    //gera DV em mod11 para a Quinta posição do codigo de barras
    $nosso_numero_5pos = $dandon->geraSenha(5, 0, 0, 1, 0);
    $dv11 = mod_11($cod_bb . $cod_moeda . $fator . $valor . $nossonumero .$agencia.$contacorrente.$modalidade_cobrança);
    $linhad = $cod_bb . $cod_moeda . $dv11 . $fator . $valor . $nossonumero .$agencia.$contacorrente.$modalidade_cobrança;
    echo "numero de caracteres cod.barras :".strlen($linhad)."<br>";


    //MOSTRA O CODIGO DE BARRAS
    $campo1 = $cod_bb . $cod_moeda . substr($linhad, 19, 1);
    $campo_aux = substr($linhad, 20, 4);
    $dv1 = modulo_10($campo1 . $campo_aux);
    $campo1 = $campo1 . '.' . $campo_aux . $dv1;

    echo "<br> campo1: " . $campo1 . "<br>";

    // campo 2
    $campo2 = substr($linhad, 24, 5);
    $campo_aux = substr($linhad, 29, 5);
    $dv2 = modulo_10($campo2 . $campo_aux);
    $campo2  = $campo2 . '.' . $campo_aux . $dv2;

    echo "<br> campo2: " . $campo2 . "<br>";

    //campo 3

    // campo 2
    $campo3 = substr($linhad, 34, 5);
    $campo_aux = substr($linhad, 39, 5);
    $dv3 = modulo_10($campo3 . $campo_aux);
    $campo3  = $campo3 . '.' . $campo_aux . $dv3;

    echo "<br> campo3: " . $campo3 . "<br>";

    //campo 4

    $campo4 = $dv11;

    //campo 5
    $campo5 = $fator . $valor;


    $linhad = $campo1 . ' ' . $campo2 . ' ' . $campo3 . ' ' . $campo4 . ' ' . $campo5;

   

    // INCLUDE DO LAYOUT
    include("guia_iss_view.php");
    //}

    

    ?>
</body>

</html>
