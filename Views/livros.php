<header>
    <?php if(!empty($_SESSION['usuario'])): ?>
        <a style="float: right;" href="<?php echo BASE_URL.'login/logout'; ?>">
        </a>
        <a href="<?php echo BASE_URL; ?>categorias">Categorias</a>
        <a href="<?php echo BASE_URL; ?>livros">Livros</a>
    <?php endif; ?>
</header>
<h1>Livros</h1>
<div>
    <form method="POST" action="/livraria/livros">
        Título: <br>
        <input type="text" name="titulo" value="<?php echo isset($_POST['titulo']) ? $_POST['titulo'] : '' ?>"><br>
        Autor: <br>
        <input type="text" name="autor" value="<?php echo isset($_POST['autor']) ? $_POST['autor'] : '' ?>"><br>
        Categoria: <br>
        <select name="categoria_id">
            <option value=""></option>
            <?php foreach($categorias as $categoria): ?>
                <option value="<?php echo $categoria['id']; ?>" <?php echo isset($_POST['categoria_id']) && $_POST['categoria_id'] == $categoria['id'] ? 'selected' : '' ?>>
                    <?php echo $categoria['nome']; ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>
        <input type="submit" value="Filtrar" /> 
    </form>
    <form method="POST" action="/livraria/livros/reset">
        <input type="submit" value="Limpar" />
    </form>
    <br><br>
</div>
<a href="<?php echo BASE_URL; ?>livros/add">Adicionar livro</a>
<table border="1" width="100%">
    <tr>
        <th>Título</th>
        <th>Autor</th>
        <th>Descrição</th>
        <th>Categoria</th>
        <th>Ações</th>
    </tr>
    <?php foreach($livros as $livro): ?>
        <tr>
            <td><?php echo $livro['titulo']; ?></td>
            <td><?php echo $livro['autor']; ?></td>
            <td><?php echo $livro['descricao']; ?></td>
            <td><?php echo $livro['categoria_nome']; ?></td>
            <td>
                <form method="POST" action="livros/delete/<?php echo $livro['id']; ?>">
                    <input type="hidden" name="livro_id" value="<?php echo $livro['id']; ?>">
                    <input type="submit" value="Excluir livro">
                    <a href="<?php echo BASE_URL; ?>livros/edit/<?php echo $livro['id']; ?>">
                        Editar livro
                    </a>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>