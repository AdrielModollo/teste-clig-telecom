<?php

namespace Models;

use \Core\Model;

class Livro extends Model {
  
    private $info;

    public function getLivros(): array
    {
        $array = [];

        $sql = 'SELECT l.id, l.titulo, l.autor, l.descricao, c.nome as categoria_nome 
                FROM livros l 
                INNER JOIN categorias c ON c.id = l.categoria_id';
        $sql = $this->database->query($sql);

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll(\PDO::FETCH_ASSOC);
        }

        return $array;
    }

    public function getLivrosPorFiltro(array $filtro): array {
        $array = []; 
        $sql = 'SELECT l.id, l.titulo, l.autor, l.descricao, c.nome as categoria_nome 
                FROM livros l 
                INNER JOIN categorias c ON c.id = l.categoria_id
                WHERE 1 = 1';

        if (isset($filtro['titulo'])) {
            $titulo = $filtro['titulo'];
            $autor = $filtro['autor'];
            $categoria_id = $filtro['categoria_id'];

            if (!empty($titulo))
                $sql = $sql .= " AND titulo LIKE CONCAT('%', :titulo, '%')";
            if (!empty($autor))
                $sql = $sql .= " AND autor LIKE CONCAT('%', :autor, '%')";
            if (!empty($categoria_id))
                $sql = $sql .= ' AND categoria_id = :categoria_id';
            
            $sql = $this->database->prepare($sql);

            if (!empty($titulo))
                $sql->bindValue(':titulo', $titulo);
            if (!empty($autor))
                $sql->bindValue(':autor', $autor);
            if (!empty($categoria_id))
                $sql->bindValue(':categoria_id', $categoria_id);
        } else {
            $sql = $this->database->prepare($sql);
        }
        
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll(\PDO::FETCH_ASSOC);
        }

        return $array;
    }

    public function getLivro(int $livro_id) {
        $sql = 'SELECT id, titulo, autor, descricao, categoria_id FROM livros WHERE id = :livro_id';
        $sql = $this->database->prepare($sql);
        $sql->bindValue(':livro_id', $livro_id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return $sql->fetch(\PDO::FETCH_ASSOC);
        }

        return null;
    }

    public function atualizar(int $livro_id, string $titulo, string $autor, string $descricao, int $categoria_id) {
        $sql = 'UPDATE livros 
                SET titulo = :titulo, autor = :autor, descricao = :descricao, categoria_id = :categoria_id 
                WHERE id = :livro_id';
        $sql = $this->database->prepare($sql);
        $sql->bindValue(':titulo', $titulo);
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

    public function adicionar(string $titulo, string $autor, string $descricao, int $categoria_id): void
    {
        $sql = 'INSERT INTO livros
                    (titulo, autor, descricao, categoria_id)
                VALUES
                    (:titulo, :autor, :descricao, :categoria_id)';
        $sql = $this->database->prepare($sql);
        $sql->bindValue(':titulo', $titulo);
        $sql->bindValue(':autor', $autor);
        $sql->bindValue(':descricao', $descricao);
        $sql->bindValue(':categoria_id', $categoria_id); 
        $sql->execute();
    }

}