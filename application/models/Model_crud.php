<?php

(!defined('BASEPATH')) ? exit('No direct script access allowed') : NULL;
// *
class Model_crud extends CI_Model {

    private $_create;
    private $_read;
    private $_update;
    private $_delete;

    public function __construct() {

        parent::__construct();
        $this->str_sistema = ($this->input->cookie('sistema', false)) ? $this->input->cookie('sistema', false) : NULL;
    }

    public function create($tabela, $dados = NULL) {
        if ($dados !== NULL) {
            $query = $this->db->insert("{$tabela}", $dados);
            $this->_create = array(
                'qtd' => count($query),
                'result' => $query,
            );
            return($this->_create);
        } else {
            return(NULL);
        }
    }

    public function read($tabela = NULL, $where = array(NULL), $order_by = NULL, $offset = NULL, $limit = NULL) {
        ($limit !== NULL) ? ($this->db->limit($limit, $offset)) : (NULL);
        ($order_by == NULL) ? (NULL) : ($this->db->order_by($order_by));
        ($where == array(NULL)) ? ($query = $this->db->get($tabela)->result()) : ($query = $this->db->get_where($tabela, $where)->result());
        $qtd = count($this->db->get($tabela)->result());
        if ($limit == NULL) {
            $this->_read = array(
                'qtd' => $qtd,
                'result' => $query
            );
        } else {
            $this->_read = array(
                'qtd' => $qtd,
                'result' => $query
            );
        }
        //$this->dc->ep($this->db, TRUE);
        return($this->_read);
    }

    public function update($tabela = NULL, $dados = array(NULL), $where = array(NULL), $limit = 1) {
        $this->tabelaExiste($tabela);
        ($limit !== 1) ? ($this->db->limit($limit)) : ($this->db->limit(1));
        ($where == array(NULL)) ? (NULL) : ($this->db->where($where[0], $where[1]));
        $query = ($dados !== array(NULL)) ? ($this->db->update($tabela, $dados)) : (exit("Faltou o array(dados)"));
        $qtd = count($query);
        $this->_update = array(
            'qtd' => $qtd,
            'result' => $query
        );

        return($this->_update);
    }

    public function updateAll($tabela = NULL, $dados = array(NULL)) {
        $this->tabelaExiste($tabela);
        $this->dc->ep($dados, TRUE);
        $query = $this->db->update($tabela, $dados);
        $$this->_update = array(
            'qtd' => count($query),
            'result' => $query,
        );
        return($this->_update);
    }

    public function delete($tabela, $where = array(), $limit = 1) {
        $this->tabelaExiste($tabela);
        $this->_delete = $where;
        ($limit !== 1) ? ($this->db->limit($limit)) : ($this->db->limit(1));
        ($where !== array(NULL)) ? ($this->db->delete($tabela, array($where[0] => $where[1]))) : (NULL);
        return($this->_delete);
    }

    public function like($tabela, $like) {
        $indices = array_keys($like);
        $valores = array_values($like);
        for ($i = 0; $i < count($like); $i++) {
            $this->db->like($indices[$i], $valores[$i]);
        }
        $query = $this->db->get($tabela)->result();
        $qtd = count($query);
        $this->_read = array(
            'qtd' => $qtd,
            'result' => $query
        );
        return($this->_read);
    }

    public function tabelaExiste($tabela = NULL) {
        ($tabela !== NULL && $this->db->table_exists($tabela)) ? (NULL) : (exit("Faltou a tabela ou a Tebela n&atilde;o existe"));
    }

    public function nomeColunas($tabela) {
        $query = $this->db->query("SELECT column_name as 'coluna' FROM information_schema.columns WHERE table_name ='{$tabela}'")->result();
        $colunas = NULL;
        foreach ($query as $value) {
            $colunas .= $value->coluna . ' ';
        }
        $comma_separated = explode(" ", $colunas);
        array_pop($comma_separated);
        return($comma_separated);
    }

    public function exibeColunas($param) {
        $array = (array) $param;
        $keys = array_keys($array);
        $implode = implode(", ", $keys);
        return($implode);
    }

    public function showColunas($tabela) {
        $query = $this->db->query("SHOW COLUMNS FROM {$tabela}; ")->result();
        $show_coluna = array(
            'qtd' => count($query),
            'result' => $query
        );
        return($show_coluna);
    }

    public function truncate($tabela) {
        $query = $this->db->query("TRUNCATE `{$tabela}`;");
        $truncate = array(
            'qtd' => count($query),
            'result' => $query
        );
        return($truncate);
    }

    public function groupBy($tabela = NULL, $campos = NULL, $where = array(NULL), $orderBy = NULL) {
        ($orderBy !== NULL) ? ($this->db->order_by($orderBy)) : (NULL); //('title desc, name asc');
        $this->db->select($campos);
        $this->db->group_by($campos, "ASC");
        $query = ($where == array(NULL)) ? ($this->db->get($tabela)->result()) : ($this->db->get_where($tabela, $where)->result());
        $groupByAssunto = array(
            'qtd' => count($query),
            'result' => $query
        );
        return($groupByAssunto);
    }

    public function join($tabela = array(NULL), $chave = NULL, $where = array(NULL), $orderBy = NULL, $limit = 1) {
        ($orderBy !== NULL) ? ($this->db->order_by($orderBy)) : (NULL); //('title desc, name asc');
        ($limit !== 1) ? ($this->db->limit($limit)) : ($this->db->limit(1));
        $this->db->select('*');
        $this->db->from($tabela[0]);
        for ($i = 1; $i < count($tabela); $i++) {
            $this->db->join($tabela[$i], $tabela[$i] . '.' . $chave . '=' . $tabela[0] . '.' . $chave);
        }
        ($where == NULL) ? ($query = $this->db->get($tabela)->result()) : ($query = $this->db->get_where(NULL, $where)->result());
        $join = array(
            'qtd' => count($query),
            'result' => $query
        );
        return($join);
        //$this->dc->ep($this->db);
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