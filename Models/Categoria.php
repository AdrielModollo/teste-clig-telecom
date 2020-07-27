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

    public function excluir(int $categoria_id): void
    {
        $sql = 'DELETE FROM categorias WHERE id = :categoria_id';
        $sql = $this->database->prepare($sql);
        $sql->bindValue(':categoria_id', $categoria_id);
        $sql->execute();
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