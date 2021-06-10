<?php
    include "Classes/Util/VariaveisGlobais.php";
    include "Classes/Util/HandleSubmit.php";
    include "Classes/Validator/FormValidator.php";
    
    //inicializa session para armazenar os valors do formulario
    session_start();
    //inicializa as variavis da session com valores vazios
    foreach (VariaveisGlobais::VARIAVEIS as $variavel){
        if($variavel === 'emissao' || $variavel === 'saida'){
            $_SESSION[$variavel] = date('Y-m-d'); //se for data inicializa com a data atual
            continue;
        }
        $_SESSION[$variavel] = '';
    }
    
    
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        //se houver chamada do tipo post armazena as variaveis do form na session
            foreach (VariaveisGlobais::VARIAVEIS as $variavel){
                $_SESSION[$variavel] = $_POST[$variavel];
            }
        //chama a funcao que ira lidar com o metodo post de acordo com o botao presionado
        $handleSubmite = new HandleSubmite();
        $handleSubmite->handle();
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <link rel="stylesheet" href="style.css">
        <script src="script.js"></script>
    </head>
    <body>
        <div id="container">
            <div id="abas_menu">
                <button class="tab_button1" onclick="setSelected('aba1')"><a>Dados da NFe</a></button> 
                <button class="tab_button1" onclick="setSelected('aba2')">Totais</button>
                <button class="tab_button1" onclick="setSelected('aba3')">Nota Referenciada</button>
                <button class="tab_button1" onclick="setSelected('aba4')">Cobrança</button>
                <button class="tab_button1" onclick="setSelected('aba5')">Transporte</button>
                <button class="tab_button1" onclick="setSelected('aba6')">Informações Adicionais</button>
            </div>
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                <div id="aba1" class="tab" style="display:block">
                    <div>
                        <label>ID</label>
                        <input type="number" name="id" value="<?php echo $_SESSION['id'] ?>">
                        <label>Regime</label> 
                        <select name='regime'>
                            <option <?php echo $_SESSION['regime'] == 'Simples Nacional'?'selected':''?>>Simples Nacional</option>
                            <option <?php echo $_SESSION['regime'] == 'Opcao 2'?'selected':''?>>Opcao 2</option>
                        </select>
                        <label>Estorno</label> 
                        <select name='estorno'>
                            <option <?php echo $_SESSION['estorno'] == 'Sim'?'selected':''?>>Sim</option>
                            <option <?php echo $_SESSION['estorno'] == 'Nao'?'selected':''?>>Nao</option>
                        </select>
                        <label>Pedido</label>
                        <input type="text" name="pedido" value="<?php echo $_SESSION['pedido'] ?>">
                    </div>
                    <div>
                        <label>Série</label>
                        <input type="number" name="serie" value="<?php echo $_SESSION['serie'] ?>">
                        <label>Numero</label>
                        <input type="number" name="numero" value="<?php echo $_SESSION['numero'] ?>"> 
                        <label>Emissao</label>
                        <input type="date" name="emissao" value="<?php echo date('Y-m-d', strtotime($_SESSION['emissao'])) ?>">
                        <label>Tipo</label>
                        <input type="text" name="tipo" value="<?php echo $_SESSION['tipo'] ?>">
                    </div>    
                    <div>
                        <label>Saida</label>
                        <input type="date" name="saida" value="<?php echo date('Y-m-d', strtotime($_SESSION['saida'])) ?>">
                        <label>Pagamento</label>
                        <select name='pagamento'>
                            <option <?php echo $_SESSION['pagamento'] == 'A vista'?'selected':''?>>A vista</option>
                            <option <?php echo $_SESSION['pagamento'] == 'A prazo'?'selected':''?>>A prazo</option>
                        </select>
                        <label>Finalidade</label>
                        <select name='finalidade'>
                            <option <?php echo $_SESSION['finalidade'] == 'NFe-normal'?'selected':''?>>NFe-normal</option>
                            <option <?php echo $_SESSION['finalidade'] == 'Opcao 2'?'selected':''?>>Opcao 2</option>
                        </select>
                    </div>
                    <div>
                        <label>Frete</label>
                        <select name='frete'>
                            <option <?php echo $_SESSION['frete'] == 'Sem frete'?'selected':''?>>Sem frete</option>
                            <option <?php echo $_SESSION['frete'] == 'Opcao 2'?'selected':''?>>Opcao 2</option>
                        </select>
                        <label>Natureza</label>
                        <input type="text" name="natureza" value="<?php echo $_SESSION['natureza'] ?>">
                        <label>Destino</label>
                        <select name='destino'>
                            <option <?php echo $_SESSION['destino'] == 'Operacao interna'?'selected':''?>>Operacao interna</option>
                            <option <?php echo $_SESSION['destino'] == 'Opcao 2'?'selected':''?>>Opcao 2</option>
                        </select>
                    </div>
                    <div>
                        <label>Emit/Dest</label>
                        <input type="text" name="emit" value="<?php echo $_SESSION['emit'] ?>">
                        <label>Nome</label>
                        <input type="text" name="nome" value="<?php echo $_SESSION['nome'] ?>">
                    </div>
                    <div>
                        <label>Consumidor</label>
                        <select name='consumidor'>
                            <option <?php echo $_SESSION['consumidor'] == 'Consumidor Final'?'selected':''?>>Consumidor Final</option>
                            <option <?php echo $_SESSION['consumidor'] == 'Opcao 2'?'selected':''?>>Opcao 2</option>
                        </select>
                        <label>Ind. IE</label>
                        <select name='indie'>
                            <option <?php echo $_SESSION['indie'] == ''?'selected':''?>></option>
                            <option <?php echo $_SESSION['indie'] == 'Opcao 2'?'selected':''?>>Opcao 2</option>
                        </select>
                        <label>Ambiente</label>
                        <select name='ambiente'>
                            <option <?php echo $_SESSION['ambiente'] == 'Em digitacao'?'selected':''?>>Em digitacao</option>
                            <option <?php echo $_SESSION['ambiente'] == 'Opcao 2'?'selected':''?>>Opcao 2</option>
                        </select>
                    </div>
                </div>
                <div id="aba2" class="tab" style="display:none">
                    <div>
                        <label>Base de calculo do ICMS</label>
                        <input type="number" step="0.01" name="base_icms" value="<?php echo $_SESSION['base_icms'] ?>">
                        <label>ICMS part Destinatario</label>
                        <input type="number" step="0.01" name="icms_destinatario" value="<?php echo $_SESSION['icms_destinatario'] ?>">
                        <label>Total dos Produtos/Servicos</label>
                        <input type="number" step="0.01" name="total_prod_serv" value="<?php echo $_SESSION['total_prod_serv'] ?>">
                    </div>
                    <div>
                        <label>Valor do ICMS</label>
                        <input type="number" step="0.01" name="valor_icms" value="<?php echo $_SESSION['valor_icms'] ?>">
                        <label>Total imposto s/ Importacao</label>
                        <input type="number" step="0.01" name="t_impost_import" value="<?php echo $_SESSION['t_impost_import'] ?>">
                        <label>Total Desconto</label>
                        <input type="number" step="0.01" name="total_desc" value="<?php echo $_SESSION['total_desc'] ?>">
                    </div>
                    <div>
                        <label>Total Frete</label>
                        <input type="number" step="0.01" name="total_frete" value="<?php echo $_SESSION['total_frete'] ?>">
                        <label>Total ICMS FCP UF destino</label>
                        <input type="number" step="0.01" name="t_icms_fcp_destino" value="<?php echo $_SESSION['t_icms_fcp_destino'] ?>">
                        <label>Total Seguro</label>
                        <input type="number" step="0.01" name="total_seguro" value="<?php echo $_SESSION['total_seguro'] ?>">
                    </div>
                    <div>
                        <label>Total IPI</label>
                        <input type="number" step="0.01" name="total_ipi" value="<?php echo $_SESSION['total_ipi'] ?>">
                        <label>Base ICMS substituicao</label>
                        <input type="number" step="0.01" name="base_icms_subs" value="<?php echo $_SESSION['base_icms_subs'] ?>">
                        <label>Acrescimo</label>
                        <input type="number" step="0.01" name="acrescimo" value="<?php echo $_SESSION['acrescimo'] ?>">
                    </div>
                    <div>
                        <label>Total do PIS</label>
                        <input type="number" step="0.01" name="total_pis" value="<?php echo $_SESSION['total_pis'] ?>">
                        <label>Valor ICMS substituicao</label>
                        <input type="number" step="0.01" name="valor_icms_subs" value="<?php echo $_SESSION['valor_icms_subs'] ?>">
                        <label>Total ICMS Descontado</label>
                        <input type="number" step="0.01" name="total_icms_desc" value="<?php echo $_SESSION['total_icms_desc'] ?>">
                    </div>
                    <div>
                        <label>Total Cofins</label>
                        <input type="number" step="0.01" name="total_confins" value="<?php echo $_SESSION['total_confins'] ?>">
                        <label>ICMS parte remetente</label>
                        <input type="number" step="0.01" name="icms_part_remet" value="<?php echo $_SESSION['icms_part_remet'] ?>">
                        <label>Total da Nota</label>
                        <input type="number" step="0.01" name="total_nota" value="<?php echo $_SESSION['total_nota'] ?>">
                    </div>
                </div>
                <div id="aba3" class="tab" style="display:none">
                    <div>
                        <label>Nota Fiscal Referenciada</label>
                        <input type="text" name="nf_referenciada" value="<?php echo $_SESSION['nf_referenciada'] ?>">
                    </div>
                </div>
                <div id="aba4" class="tab" style="display:none">
                    <div>
                        <label>Codigo Prazo</label>
                        <input type="number" name="codigo_prazo" value="<?php echo $_SESSION['codigo_prazo'] ?>">
                        <label>Quantidade de Parcelas</label>
                        <input type="number" name="qtd_parcelas" value="<?php echo $_SESSION['qtd_parcelas'] ?>">
                        <label>Valor da Nota</label>
                        <input type="number" step="0.01" name="valor_nota" value="<?php echo $_SESSION['valor_nota'] ?>">
                        <label>Valor da Parcela</label>
                        <input type="number" step="0.01" name="valor_parcela" value="<?php echo $_SESSION['valor_parcela'] ?>">
                    </div>
                </div>
                <div id="aba5" class="tab" style="display:none">
                    <div>
                        <label>Transportador</label>
                        <select name="transportador">
                            <option <?php echo $_SESSION['transportador'] == 'Buscar'?'selected':''?>>Buscar</option>
                            <option <?php echo $_SESSION['transportador'] == 'Opcao 2'?'selected':''?>>Opcao 2</option>
                        </select>
                        <label>Placa Veiculo</label>
                        <input type="text" name="placa_veiculo" value="<?php echo $_SESSION['placa_veiculo'] ?>">
                        <label>UF Placa</label>
                        <select name="uf_placa">
                            <option <?php echo $_SESSION['uf_placa'] == 'AC'?'selected':''?>>AC</option>
                            <option <?php echo $_SESSION['uf_placa'] == 'AM'?'selected':''?>>AM</option>
                            <option <?php echo $_SESSION['uf_placa'] == 'MA'?'selected':''?>>MA</option>
                        </select>
                    </div>
                    <div>
                        <label>Quantidade de Volumes</label>
                        <input type="number" name="qtd_volumes" value="<?php echo $_SESSION['qtd_volumes'] ?>">
                        <label>Peso Bruto</label>
                        <input type="number" step="0.01" name="peso_bruto" value="<?php echo $_SESSION['peso_bruto'] ?>">
                        <label>Peso Liquido</label>
                        <input type="number" step="0.01" name="peso_liquido" value="<?php echo $_SESSION['peso_liquido'] ?>">
                    </div>
                    <div>
                        <label>Numero</label>
                        <input type="number" name="numero_transporte" value="<?php echo $_SESSION['numero_transporte'] ?>">
                        <label>Marca</label>
                        <input type="text" name="marca_transporte" value="<?php echo $_SESSION['marca_transporte'] ?>">
                        <label>Especie</label>
                        <input type="text" name="especie_transporte" value="<?php echo $_SESSION['especie_transporte'] ?>">
                    </div>
                </div>
                <div id="aba6" class="tab" style="display:none">
                    <div>
                        <label>Fisco</label>
                        <input type="text" name="fisco" value="<?php echo $_SESSION['fisco'] ?>">
                        <label>Contribuinte</label>
                        <input type="text" name="contribuinte" value="<?php echo $_SESSION['contribuinte'] ?>">
                    </div>
                </div>
                <div id="s_buttons_div">
                    <button type="submit" name="enviar">Enviar</button>
                    <button type="submit" name="gravar">Gravar</button>
                </div>
            </form>
        </div>
    </body>
</html>

