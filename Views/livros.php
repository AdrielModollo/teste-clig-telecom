<header>
    <?php if(!empty($_SESSION['usuario'])): ?>
        <a style="float: right;" href="<?php echo BASE_URL.'login/logout'; ?>">
        </a>
        <a href="<?php echo BASE_URL; ?>categorias">Categorias</a>
        <a href="<?php echo BASE_URL; ?>livros">Livros</a>
    <?php endif; ?>
</header>
<h1>Livros</h1>
<a href="<?php echo BASE_URL; ?>livros/add">Adicionar livros</a>
<table border="1" width="100%">
    <tr>
        <th>Nome</th>
        <th>Autor</th>
        <th>Descrição</th>
        <th>Categoria</th>
        <th>Ações</th>
    </tr>
    <?php foreach($livros as $livro): ?>
        <tr>
            <td><?php echo $livro['nome']; ?></td>
            <td><?php echo $livro['autor']; ?></td>
            <td><?php echo $livro['descricao']; ?></td>
            <td><?php echo $livro['categoria_nome']; ?></td>
            <td>
                <form method="POST">
                    <input type="hidden" name="livro_id" value="<?php echo $livro['id']; ?>">
                    <input type="submit" value="Excluir categoria">
                    <a href="<?php echo BASE_URL; ?>livros/edit/<?php echo $livro['id']; ?>">
                        Editar categoria
                    </a>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>