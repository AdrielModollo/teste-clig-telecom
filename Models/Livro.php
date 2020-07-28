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

    public function getLivro(int $livro_id) {
        $sql = 'SELECT id, nome, autor, descricao, categoria_id FROM livros WHERE id = :livro_id';
        $sql = $this->database->prepare($sql);
        $sql->bindValue(':livro_id', $livro_id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return $sql->fetch(\PDO::FETCH_ASSOC);
        }

        return null;
    }

    public function atualizar(int $livro_id, string $nome, string $autor, string $descricao, int $categoria_id) {
        $sql = 'UPDATE livros 
                SET nome = :nome, autor = :autor, descricao = :descricao, categoria_id = :categoria_id 
                WHERE id = :livro_id';
        $sql = $this->database->prepare($sql);
        $sql->bindValue(':nome', $nome);
        $sql->bindValue(':autor', $autor);
        $sql->bindValue(':descricao', $descricao);
        $sql->bindValue(':categoria_id', $categoria_id);
        $sql->bindValue(':livro_id', $livro_id);
        $sql->execute();
    }

    public function excluir(int $id): void
    {
        $sql = 'DELETE FROM livros WHERE id = :id';
        $sql = $this->database->prepare($sql);
        $sql->bindValue(':id', $id);
        $sql->execute();
    }

    public function adicionar(string $nome, string $autor, string $descricao, int $categoria_id): void
    {
        $sql = 'INSERT INTO livros
                    (nome, autor, descricao, categoria_id)
                VALUES
                    (:nome, :autor, :descricao, :categoria_id)';
        $sql = $this->database->prepare($sql);
        $sql->bindValue(':nome', $nome);
        $sql->bindValue(':autor', $autor);
        $sql->bindValue(':descricao', $descricao);
        $sql->bindValue(':categoria_id', $categoria_id); 
        $sql->execute();
    }

}