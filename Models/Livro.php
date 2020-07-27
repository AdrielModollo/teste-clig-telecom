<?php

namespace Models;

use \Core\Model;

class Livro extends Model {
  
    private $info;

    public function getLivros(): array
    {
        $array = [];

        $sql = 'SELECT l.id, l.nome, l.autor, l.descricao, c.nome as categoria_nome 
                FROM livros l 
                INNER JOIN categorias c ON c.id = l.categoria_id';
        $sql = $this->database->query($sql);

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll(\PDO::FETCH_ASSOC);
        }

        return $array;
    }

}

