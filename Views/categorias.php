<header>
    <?php if(!empty($_SESSION['usuario'])): ?>
        <a style="float: right;" href="<?php echo BASE_URL.'login/logout'; ?>">
        </a>
        <a href="<?php echo BASE_URL; ?>categorias">Categorias</a>
        <a href="<?php echo BASE_URL; ?>livros">Livros</a>
    <?php endif; ?>
</header>
<h1>Categorias</h1>
<a href="<?php echo BASE_URL; ?>categorias/add">Adicionar categoria</a>
<table border="1" width="100%">
    <tr>
        <th>Nome</th>
        <th>Ações</th>
    </tr>
    <?php foreach($categorias as $categoria): ?>
        <tr>
            <td><?php echo $categoria['nome']; ?></td>
            <td>
                <form method="POST" action="categorias/delete/<?php echo $categoria['id']; ?>">
                    <input type="submit" value="Excluir categoria">
                    <a href="<?php echo BASE_URL; ?>categorias/edit/<?php echo $categoria['id']; ?>">
                        Editar categoria
                    </a>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>