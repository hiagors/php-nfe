<?php

//armazena os nomes dos campos do formulario para inicializacao das variaveis session e verificacao de validacao
    abstract class VariaveisGlobais{
        public const VARIAVEIS_TEXTO = ['regime', 'estorno', 'tipo',  'pagamento', 'finalidade', 'frete', 
                                        'natureza', 'destino', 'emit', 'nome', 'nf_referenciada', 'transportador', 
                                        'placa_veiculo', 'uf_placa', 'consumidor', 'indie', 'ambiente', 'fisco', 
                                        'contribuinte', 'marca_transporte', 'especie_transporte'];
        
        public const VARIAVEIS_DATAS = ['emissao', 'saida'];

        public const VARIAVEIS_INTEIRAS = ['id', 'pedido', 'serie', 'numero', 'codigo_prazo', 'qtd_parcelas',
                                            'qtd_volumes', 'numero_transporte'];

        public const VARIAVEIS_REAIS = ['base_icms', 'icms_destinatario', 'total_prod_serv','valor_icms',
                                        't_impost_import', 'total_desc','total_frete', 't_icms_fcp_destino', 
                                        'total_seguro', 'total_ipi', 'base_icms_subs', 'acrescimo', 'total_pis', 
                                        'valor_icms_subs', 'total_icms_desc', 'total_confins', 'icms_part_remet',
                                        'total_nota', 'valor_nota', 'valor_parcela', 'peso_bruto', 'peso_liquido'
                                        ];

        public const VARIAVEIS = [...self::VARIAVEIS_TEXTO, ...self::VARIAVEIS_INTEIRAS, 
                                  ...self::VARIAVEIS_REAIS, ...self::VARIAVEIS_DATAS];

    }
    
?>