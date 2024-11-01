<?php
    require "Automato.php";

    class Analisador{

        private $automato;
        private $tokens = [
            // Identificadores
            'q1' => 'ID', 
            
            // Palavras reservadas
            'q3' => 'SE', 'q6' => 'SENAO', 'q10' => 'FACA', 'q18' => 'ENQUANTO', 'q24' => 'ESCREVA', 'q31' => 'IMPRIMA', 'q34' => 'VAR', 'q38' => 'LEIA',
            'q42' => 'LEIA', 'q49' => 'ESCREVA', 'q56' => 'ENQUANTO', 'q58' => 'SE', 'q61' => 'SENAO', 'q65' => 'FACA', 'q72' => 'IMPRIMA', 'q75' => 'VAR',

            // Constantes
            'q76' => 'CONST',

            // Operadores
            'q77' => 'ABRE_PARENTESES', 'q78' => 'FECHA_PARENTESES', 'q79' => 'ABRE_COLCHETES', 'q80' => 'FECHA_COLCHETES', 'q81' => 'ABRE_CHAVES', 'q82' => 'FECHA_CHAVES', 'q83' => 'VIRGULA', 'q84' => 'PONTO', 'q85' => 'PONTO_VIRGULA', 
            'q86' => 'ASPAS_DUPLAS', 'q87' => 'NEGACAO', 'q88' => 'MULTIPLICACAO', 'q89' => 'ADICAO', 'q90' => 'SUBTRACAO', 'q91' => 'DIVISAO', 'q92' => "RESTO_DIVISAO", 'q93' => 'ATRIBUICAO', 'q94' => 'IGUALDADE', 'q95' => 'AND' 
        ];

        public function __construct(){
            $this->automato = new Automato();
        }

        public function executar($entrada){
            $vetorTokens = [];
            
            $linha = 1;
            $coluna = 0;

            $estadoAtual = "q0";
            $lexema = "";

            for($i = 0; $i < strlen($entrada); $i++){
                $coluna++;
                
                $proximoCaracter = isset($entrada[$i + 1]) ? $entrada[$i + 1] : null;

                if(isset($this->automato->transicoes[$estadoAtual][$entrada[$i]])){
                    $estadoAtual = $this->automato->transicoes[$estadoAtual][$entrada[$i]];
                    $lexema .= $entrada[$i];
                }

                if(!isset($this->automato->transicoes[$estadoAtual][$proximoCaracter])){
                    $vetorTokens[] = [$this->tokens[$estadoAtual], $lexema]; // Ao invés de um vetor dentro de outro, token pode ser um objeto com seu nome, seu lexema e a posição (linha e coluna) do token
                    
                    $estadoAtual = "q0";
                    $lexema = "";
                }

                // Para identificar os espaços em branco, pode ser criado um novo estado (q99) para armazenar os tokens dos espaços e, à minha escolha, ignorá-los ou não
            }

            return $vetorTokens;
        }

    }
?>