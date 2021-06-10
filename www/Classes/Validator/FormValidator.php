<?php

class FormValidator{

    //verifica se todos os campos estao preenchidos e prontos para envio
    public static function validarEnvio(){
        $retorno = [...self::ValidarCamposVazios(),
                    ... self::ValidarCamposInteiros(), 
                    ...self::ValidarCamposNumericos(), 
                    ...self::ValidarCamposDatas()];
        return $retorno;
    }

    //verifica se todos os campos estao de acordo com as especificacoes dos campos
    public static function validarGravar(){
        $retorno = [... self::ValidarCamposInteiros(), 
                    ...self::ValidarCamposNumericos(),
                    ...self::ValidarCamposDatas()];
        return $retorno;
    }
    
    //valida se nao ha campos vazios
    private static function ValidarCamposVazios(){
        $errosCamposVazios = [];
            
        foreach(VariaveisGlobais::VARIAVEIS as $variavel){
            if(isset($_POST[$variavel])){
                $valor = $_POST[$variavel];
                if(empty($valor)){
                    $errosCamposVazios[] = "O campo $variavel nao pode estar vazio";
                }   
            } 
        }

        if(!empty($errosCamposVazios)){
            foreach($errosCamposVazios as $erro){
                echo "<li> $erro </li>";
            }
        }
        return $errosCamposVazios;
    }

    //valida se os campos inteiros estao apenas com valores inteiros
    private static function ValidarCamposInteiros(){
        $errosCamposInteiros = [];

        foreach(VariaveisGlobais::VARIAVEIS_INTEIRAS as $variavel){
            $valor =  $_POST[$variavel];
            if(!empty($valor)){
                if(!$valor = filter_var($valor, FILTER_VALIDATE_INT)){
                    $errosCamposInteiros[] = "$variavel precisa ser um valor inteiro";
                } else {
                    $_POST[$variavel] = $valor;
                    $_SESSION[$variavel] = $valor;
                }
            }
        }
        
        if(!empty($errosCamposInteiros)){
            foreach($errosCamposInteiros as $erro){
                echo "<li> $erro </li>";
            }
        }
        return $errosCamposInteiros;
    }

    //valida se os campos reais estao com valores reais e substitui a , por . 
    private static function ValidarCamposNumericos(){
        $errosCamposNumericos = [];

        foreach(VariaveisGlobais::VARIAVEIS_REAIS as $variavel){
            $valor =  $_POST[$variavel];
            $valor = str_replace(",", ".", $valor);
            if(!empty($valor)){
                if(!$valor = filter_var($valor, FILTER_VALIDATE_FLOAT)){
                    $errosCamposNumericos[] = "$variavel precisa ser um valor real";
                } else {
                    $_POST[$variavel] = $valor;
                    $_SESSION[$variavel] = $valor;
                }
            } 
        }
        
        if(!empty($errosCamposNumericos)){
            foreach($errosCamposNumericos as $erro){
                echo "<li> $erro </li>";
            }
        }
        return $errosCamposNumericos;
    }

    //valida se as variaveis de data estao de acordo com as especificacoes de data 
    //verifica tbm se a data inserida esta dentro do intervalo de um ano
    private static function ValidarCamposDatas(){
        $errosCamposDatas = [];

        foreach(VariaveisGlobais::VARIAVEIS_DATAS as $variavel){
            $valor = date('d-m-Y', strtotime($_POST[$variavel]));
            if(!empty($valor)){
                $menorData = date('d-m-Y', strtotime('01-01-2021'));
                $maiorData = date('d-m-Y', strtotime('31-12-2021'));
                if ($valor <= $menorData || $valor >= $maiorData){
                    $errosCamposDatas[] = "$variavel precisa ser uma data real entre $menorData e $maiorData";  
                } else {
                    $_POST[$variavel] = $valor;
                    $_SESSION[$variavel] = $valor;
                }
            }
        }

        if(!empty($errosCamposDatas)){
            foreach($errosCamposDatas as $erro){
                echo "<li> $erro </li>";
            }
        }
        return $errosCamposDatas;
    }
}
?>