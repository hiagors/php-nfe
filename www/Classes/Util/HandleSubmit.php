<?php

include "Classes/Util/JsonGenerator.php";


class HandleSubmite{
    private $formValidator;

    public function __construct(){
        $this->formValidator = new FormValidator();
    }

    public function handle(){
        $retorno = '';
        //se o metodo post foi ativado pelo botao enviar executa a funcao de envio do formulario
        if(isset($_POST['enviar'])){
            //verifica se nao ha nenhum erro na validacao dos formularios
            if(empty( $this->formValidator->validarEnvio())){
                $retorno = $this->handleEnviar();
            }
        }
        //se o metodo post foi ativado pelo botao gravar executa funcao de gravar os dados e exibir json com os valores
        if(isset($_POST['gravar'])){
            //verifica se nao ha nenhum erro na validacao dos formularios
            if(empty( $this->formValidator->validarGravar()) ){
                $retorno = $this->handleGravar();
            }                
        }
        return $retorno;
    }

    private function handleEnviar(){
        //gera o arquivo json e retorna um json para ser exibido em tela
        $retorno = JsonGenerator::GerarArquivoJson();
        echo $retorno;
        return $retorno;
    }

    private function handleGravar(){
            //exibe em tela arquivo json com as variaveis preenchidas ate o momento
            echo JsonGenerator::getJson();
            return JsonGenerator::getJson();
    }
}
?>