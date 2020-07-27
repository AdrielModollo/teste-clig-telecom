<?php

namespace Models;

use \Core\Model;

class Livro extends Model {
  
    private $info;

    public function getLivros(): array
    {
        $array = [];

        $sql = 'SELECT 
                    id, 
                    nome,
                    autor,
                    descricao,
                    categoria_id
                FROM livros';
        $sql = $this->database->query($sql);

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll(\PDO::FETCH_ASSOC);
        }

        return $array;
    }

}

