<?php

(!defined('BASEPATH')) ? exit('No direct script access allowed') : NULL;

class Model_tipo extends CI_Model {

    private $_create;
    private $_read;
    private $_update;
    private $_delete;

    public function __construct() {

        parent::__construct();
        $this->str_sistema = ($this->input->cookie('sistema', false)) ? $this->input->cookie('sistema', false) : NULL;
    }

    public function insertSelect() {
        $this->db->truncate('tab_tipo_objeto');
        $query = $this->db->query("INSERT INTO "
                . "tab_tipo_objeto( "
                . "str_tipo_objeto, "
                . "str_responsavel, "
                . "dtm_data, "
                . "dtm_hora "
                . ") "
                . "SELECT "
                . "str_tipo_objeto, "
                . "str_responsavel, "
                . "dtm_data, "
                . "dtm_hora "
                . "FROM tab_equipamento "
                . "GROUP BY str_tipo_objeto "
                . "ORDER BY str_tipo_objeto; "
        );
        $insertSelect = array(
            'qtd' => count($query),
            'result' => $query
        );
        return($insertSelect);
    }
    
    public function upper() {
        $update = array(
            'str_marca' => 'UPDATE tab_equipamento SET str_marca = UPPER(TRIM(str_marca)) WHERE tab_equipamento.str_pk_equipamento =tab_equipamento.str_pk_equipamento;',
            'str_modelo' => 'UPDATE tab_equipamento SET str_modelo = UPPER(TRIM(str_modelo)) WHERE tab_equipamento.str_pk_equipamento =tab_equipamento.str_pk_equipamento;',
            'str_tipo_objeto' => 'UPDATE tab_equipamento SET str_tipo_objeto = UPPER(TRIM(str_tipo_objeto)) WHERE tab_equipamento.str_pk_equipamento =tab_equipamento.str_pk_equipamento;'
        );
        $query[] = $this->db->query($update['str_marca']);
        $query[] = $this->db->query($update['str_modelo']);
        $query[] = $this->db->query($update['str_tipo_objeto']);
    }

}

?>

<?php

$foo = 10;             // $foo é um inteiro
$bar = (boolean) $foo; // $bar é um booleano
/**
  As moldagens permitidas são:

  (int), (integer) - molde para inteiro
  (bool), (boolean) - converte para booleano
  (float), (double), (real) - converte para número de ponto flutuante
  (string) - converte para string
  (binary) - converte para string binária (PHP 6)
  (array) - converte para array
  (object) - converte para objeto
  (unset) - converte para NULL (PHP 5)
  /* */
?>
<?php

/**
  Exemplo:
  SELECT * FROM pessoal LIMIT 3, 1;
  04 Daniel Palmeiras


  FUNÇÕES:

  1. ABS: Valor absoluto do número, ou seja, só considera a parte numérica não se importando com o sinal positivo ou negativo do mesmo.
  Exemplo: ABS(-145) retorna 145

  2. BIN: Binário de número decimal
  Exemplo: BIN(8) retorna 1000

  3. CURDATE() / CURRENTDATE(): Data atual na forma YYYY/MM/DD
  Exemplo: CURDATE() retorna 2002/04/04

  4. CURTIME() / CURRENTTIME(): Hora atual na forma HH:MM:SS
  Exemplo: CURTIME() retorna 13:02:43

  5. DATABASE: Nome do banco de dados atual
  Exemplo: DATABASE() retorna bdteste

  6. DAYOFMONTH: Dia do mês para a data dada, na faixa de 1 a 31
  Exemplo: DAYOFMONTH('2004-04-04') retorna 04

  7. DAYNAME: Dia da semana para a data dada
  Exemplo: DAYNAME('2004-04-04') retorna Sunday

  8. DAYOFWEEK: Dia da semana em número para a data dada, na faixa de 1 a 7, onde o 1 é domingo.
  Exemplo: DAYOFWEEK('2004-04-04') retorna 1

  9. DAYOFYEAR: Dia do ano para a data dada, na faixa de 1 até 366
  Exemplo: DAYOFYEAR('2004-04-04') retorna 95.

  10. FORMAT(NÚMERO, DECIMAIS): Formata o número nitidamente com o número de decimais dado.
  Exemplo: FORMAT(5543.00245, 2) retorna 5.543.002, 45

  11. LIKE: faz uma busca sofisticada por uma substring dentro de uma string informada. Temos, dentro da função LIKE, os seguintes caracteres especiais utilizados em substrings:

  % - Busca zero ou mais caracteres;
  _ - Busca somente um caractere.

  Exemplo 1:
  SELECT nome From pessoal Where nome like ‘F%’;
  Fabricio
  Felipe
  O caracter ‘%’ na consulta acima indica que estamos procurando nomes que possuem a incial F.
  /* */
?>