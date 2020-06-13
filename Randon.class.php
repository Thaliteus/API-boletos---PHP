<?php

/**
 * ISP
 *
 * @package Randon;
 * @author ALEXANDRE SOUSA <sousa.akira@gmail.com>
 * Copyright União Maker Desenvolvimentos - www.uniaomaker.com - Versão: 2.16
 * CPF 008.086.983-11
 * Date: 20/02/2017
 * Time: 18:59:42
 */
class Randon{
    function geraSenha($tamanho = 8, $minuscula = 1, $maiusculas = 1, $numeros = 1, $simbolos = 1)
        {
        // Caracteres de cada tipo
        $lmin = 'abcdefghijklmnopqrstuvwxyz';
        $lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $num = '1234567890';
        $simb = '!@#$%*-';
        // Variáveis internas
        $retorno = '';
        $caracteres = '';
        // Agrupamos todos os caracteres que poderão ser utilizados
        $caracteres;
        if ($minuscula == 1) $caracteres .= $lmin;
        if ($maiusculas == 1) $caracteres .= $lmai;
        if ($numeros == 1) $caracteres .= $num;
        if ($simbolos == 1) $caracteres .= $simb;
        // Calculamos o total de caracteres possíveis
        $len = strlen($caracteres);
        for ($n = 1; $n <= $tamanho; $n++) {
        // Criamos um número aleatório de 1 até $len para pegar um dos caracteres
        $rand = mt_rand(1, $len);
        // Concatenamos um dos caracteres na variável $retorno
        $retorno .= $caracteres[$rand-1];
        }
            return $retorno;
        }
}
