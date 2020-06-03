<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Guia de Pagamento</title>
<link href="css/padrao.css" rel="stylesheet" type="text/css">
</head>
<body>
<table width="75%" border="0" align="center" cellpadding="0" cellspacing="5">
  <tr>
    <td align="center" height="100">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr align="center">
        <td ><img src="img/logo_Brasao.png" width="60" height="80"></td><br>
        <td >
        <span class="cab01"  >Orgão destinatario</span><br>
        <span class="cab02">Endereço - 00000-000</span><br>
        <span class="cab01"><?php //echo $CONF_SECRETARIA; ?></span><br><br>
        <span class="cab01">GUIA PARA PAGAMENTO DE IMPOSTO</span></td>
      </tr>
    </table>
    </td>
  </tr>
  <tr>
   

<br><br><br>


 <table width="75%"  align="center" cellpadding="1" cellspacing="0" border="1|0">
  <tbody>
    <tr>
      <td colspan="2">
        <p>Código dos Débitos</p>
        <p><?php echo $linhas['id']?></p>
      </td>
      <td>
        <p>Inscrição</p>
        <p><?php echo $Cnpj." - "; echo $cpf;?></p>
      </td>
      <td>
        <p>Nosso Número</p>
        <p><?php echo $nossonumero ?></p>
      </td>
      <td colspan="3">
        <p>Sr. Contribuinte</p>
        <p>PAGUE SEU TRIBUTO ATÉ O VENCIMENTO</p>
      </td>
    </tr>
    <tr>
      <td>
        <p>Exercício</p>
        <p><?php echo $exercicio ?></p>
      </td>
      <td>
        <p>Tipo do Imposto</p>
        <p> </p>
      </td>
      <td>
        <p>Agência/Código Cedente</p>
        <p>0237 - 0/5452</p>
      </td>
      <td colspan="3" rowspan="2">
        <table >
          <tbody>
              <tr>
                <td>
                  GUIA DE ISS
                </td>
                <td class="right">
                 
                </td>
              </tr>

            <tr>
              <td>
                MULTA
              </td>
              <td class="right">
              <?php echo DecToMoeda($valormulta) ?>
              </td>
            </tr>
            <tr>
              <td>
                JUROS
              </td>
              <td class="right">
                0,00
              </td>
            </tr>
            <tr>
              <td>
                CORREÇÃO
              </td>
              <td class="right">
                0,00
              </td>
            </tr>
            <tr>
              <td>
                DESCONTO
              </td>
              <td class="right">
                0,00
              </td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
    <tr>
      <td  colspan="3">
        <p>Contribuinte(s)</p>
          <p><?php echo strtoupper($RazaoSocial); ?></p>

        <p>Fato(s) Gerador(es)</p>
          <p>  -------------- </p>

          <p>Endereço do Fato Gerador</p>
            <?php echo strtoupper($EndSacado.", ".$Numero); ?>
      </td>
    </tr>
    <tr>
      <td colspan="2">
        VALORES EXPRESSOS EM REAIS
      </td>
      <td>
        <p>Data do Processamento</p>
        <p><?php echo $emissao ?></p>
      </td>
      <td>
        <p>Parcela única</p>
      </td>
      <td>
        <p>Vencimento</p>
        <p> <?php echo $vencimento ?> </p>
      </td>
      <td>
        <p>Valor Doc. no Vencimento</p>
        <p><?php echo DecToMoeda($valorbl) ?></p>
      </td>
    </tr>
  </tbody>
</table>
  <br>
 
     <hr class="cut">
    <br>
  
    
     <table border='1' width="75%" align="center" cellpadding="1" cellspacing="0">
    <tr>
      <td>Banco do Brasil  - 001</td>
      <td class="febraban right" colspan="6">
        81610000000-8 77331264201-2 80221001000-4 00002922592-7
      </td>
    </tr>
    <tr>
      <td colspan="6">
        <p>Local de pagamento</p>
      </td>
      <td>
        <p>Vencimento</p>
        <p class="right bigger"><?php echo $vencimento ?></p>
      </td>
    </tr>
    <tr>
      <td colspan="6">
        <p>Cedente: 07.982.036/0001-67</p>
        <p>'Orgão Destinatario', Endereço - 00000-000</p>
      </td>
      <td>
        <p>Agência/Código Cedente</p>
        <p>0237 - 0/5452</p>
      </td>
    </tr>
    <tr>
      <td>
        <p>Data do Documento</p>
        <p><?php echo $dataLocal?> </p>
      </td>
      <td colspan="2">
        <p>Código dos Débitos</p>
        <p><?php echo $linhas['id']?></p>
      </td>
      <td>
        <p>Esp. Docum.</p>
        <p>OU</p>
      </td>
      <td>
        <p>Aceite</p>
        <p>N</p>
      </td>
      <td>
        <p>Data Processamento</p>
        <p><?php echo $emissao ?></p>
      </td>
      <td>
        <p>Nosso Número</p>
        <p><?php echo $nossonumero ?></p>
      </td>
    </tr>
    <tr>
      <td>
        <p>Uso do Banco</p>
        <p>&nbsp;</p>
      </td>
      <td>
        <p>Carteira</p>
        <p></p>
      </td>
      <td>
        <p>Esp. Moeda</p>
        <p>R$</p>
      </td>
      <td colspan="2">
        <p>Quantidade</p>
        <p>&nbsp;</p>
      </td>
      <td>
        <p>Valor</p>
        <p></p>
      </td>
      <td>
        <p>(=) Valor do Documento</p>
        <p class="right bigger"><?php echo DecToMoeda($valorbl) ?></p>
      </td>
    </tr>
    <tr>
      <td class="instructions" rowspan="5" colspan="6">
        <p>Instruções</p>

        <p>Não receber após o vencimento.</p>
      </td>
      <td>
        <p>(-) Desconto/Abatimento</p>
        <p class="right bigger">0,00</p>
      </td>
    </tr>
    <tr>
      <td>
        <p>(-) Outras Deduções</p>
        <p>&nbsp;</p>
      </td>
    </tr>
    <tr>
      <td>
        <p>(+) Mora/Multa</p>
        <p class="right bigger"><?php echo DecToMoeda($valormulta) ?></p>
      </td>
    </tr>
    <tr>
      <td>
        <p>(+) Outros Acréscimos</p>
        <p class="right bigger">0,00</p>
      </td>
    </tr>
    <tr>
      <td>
        <p>(=) Valor Cobrado</p>
        <p class="right bigger"><?php echo DecToMoeda($valorbl+$valormulta); ?></p>
      </td>
    </tr>
    <tr>
      <td colspan="7">
        <p>Sacado:</p>
        <div class="position_relative">
          <p><?php echo strtoupper($RazaoSocial); ?> - <?php echo strtoupper($EndSacado.", ".$Numero); ?> - Crateús - CE - 63700-000
          <div class="right position_absolute_120">CPF: <?php echo $Cnpj; echo $cpf;?></div>
        </div>
        <p>Sacador/Avalista:</p>
        <p>&nbsp;</p>
      </td>
    </tr>
    <tr>
      <td align="center" colspan="7">Autentição Mecânica<br><?php echo $linhad; ?> <br><?php geraCodigoDeBarras($linhad); ?></td>
      
      
    </tr>
  </tbody>
</table>


</body>
</html>
