
# API-boletos---PHP
Uma API capaz de  gerar e retornar um boleto para convenio de 6 digitos do Banco do Brasil.

## Getting Started
- Clone o repositorio
```
git clone https://github.com/Thaliteus/API-boletos---PHP.git
```


### Prerequisites and libraries  

- PHP 7.2 ou superior
- mysqli
- xml


### Installing

- Instale as dependencias via composer
```
composer install
```
- Modifique o arquivo Conn.ini.php para apontar para a sua base de dados
- Atualize as variaveis do arquivo [guia_iss.php](/guia_iss.php) de acordo com as nescessidades 

## Running the tests



### Geração de Boletos
- *ATENÇÃO, GARANTA ACOMPATIBILIDADE DOS OBJETOS PROVIDOS PELO SEU BANCO DE DADOS NO SELECT NO ARQUIVO _guias_iss.php_*

Após subir o projeto em seu servidor apache(php):
```
$qr     = $conn->db->query("SELECT ... WHERE suatabela.id = '$id'");
```
- Acesse via
> localhost/API-boletos---PHP/guia_iss.php?boleto=_identificador do boleto na sua base de dados_


### Leitura arquivo RET
- *ATENÇÃO, GARANTA ACOMPATIBILIDADE DOS OBJETOS PROVIDOS PELO SEU BANCO DE DADOS  NO ARQUIVO _arquivoretorno.php_*
```
function codigoGuiaPeloNossonumero($nossonumero)
	{....}
```
and
```
function registrarPagamentoGuia($codguia)
	{...}
```

Após subir o projeto em seu servidor apache(php):
- Acesse via
> localhost/API-boletos---PHP/ret/arquivoretorno.view.php


## Authors

* **Guilherme Rodrigues** - *GIT* - [Thaliteus](https://github.com/Thaliteus)



