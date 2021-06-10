<?php

class JsonGenerator{
    
    public static function getJson(){
        //retorna um  json com os valores contidos na variavel POST recebida pelo submit do formulario
        return json_encode($_POST);
    }

    public static function GerarArquivoJson(){
        //retorna um json com os valores contidos na variavel POST recebida pelo submit do formulario
        $response = json_encode($_POST);
        //cria um arquivo .json com os dados da variavel response
        $fp = fopen('results.json', 'w');
        fwrite($fp, $response);
        fclose($fp);
        return $response;
    }
}
?>