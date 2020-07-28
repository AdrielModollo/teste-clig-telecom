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

    public function getCategoria(int $categoria_id) {
        $sql = 'SELECT id, nome FROM categorias WHERE id = :categoria_id';
        $sql = $this->database->prepare($sql);
        $sql->bindValue(':categoria_id', $categoria_id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return $sql->fetch(\PDO::FETCH_ASSOC);
        }

        return null;
    }

    public function atualizar(int $categoria_id, string $nome) {
        $sql = 'UPDATE categorias SET nome = :nome WHERE id = :id';
        $sql = $this->database->prepare($sql);
        $sql->bindValue(':nome', $nome);
        $sql->bindValue(':id', $categoria_id);
        $sql->execute();
    }

    public function excluir(int $categoria_id): void
    {
        $sql = 'DELETE FROM categorias WHERE id = :categoria_id';
        $sql = $this->database->prepare($sql);
        $sql->bindValue(':categoria_id', $categoria_id);
        $sql->execute();
    }

    public function adicionar(string $nome): void
    {
        $sql = 'INSERT INTO categorias
                    (nome)
                VALUES
                    (:nome)';
        $sql = $this->database->prepare($sql);
        $sql->bindValue(':nome', $nome);
        $sql->execute();
    }

}