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

    public function delete(int $categoria_id): void
    {
        die('text');
        $params = func_get_args();

        $queries = [
            'DELETE FROM categoria WHERE id = ?'
        ];

        foreach($queries as $query) {
            $sql = $this->database->prepare($query);
            $sql->execute($params);
        }
    }

    public function adicionar_categoria(string $nome): void
    {
        $sql = 'INSERT INTO categoria
                    (nome)
                VALUES
                    (:nome)';
        $sql = $this->database->prepare($sql);
        $sql->bindValue(':nome', $nome);
        $sql->execute();
    }

}