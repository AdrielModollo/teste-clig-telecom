<?php

namespace Models;

use \Core\Model;

class Categoria extends Model {
  
    private $info;

    public function getCategorias(): array
    {
        $array = [];

        $sql = 'SELECT 
                    id, 
                    nome
                FROM categorias';
        $sql = $this->database->query($sql);

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll(\PDO::FETCH_ASSOC);
        }

        return $array;
    }

}