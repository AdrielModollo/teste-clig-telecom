<header>
    <?php if(!empty($_SESSION['usuario'])): ?>
        <a style="float: right;" href="<?php echo BASE_URL.'login/logout'; ?>">
        </a>
        <a href="<?php echo BASE_URL; ?>categorias">Categorias</a>
        <a href="<?php echo BASE_URL; ?>livros">Livros</a>
    <?php endif; ?>
</header>
<h1>Editar livro</h1>
<form method="POST">
    Nome: <br>
    <input type="text" name="nome" value="<?php echo $livro['nome']; ?>"><br>
    Autor: <br>
    <input type="text" name="autor" value="<?php echo $livro['autor']; ?>"><br>
    Categoria: <br>
    <select name="categoria_id">
        <?php foreach($categorias as $categoria): ?>
            <option value="<?php echo $categoria['id']; ?>" <?php echo $livro['categoria_id'] == $categoria['id'] ? 'selected' : '' ?>>
                <?php echo $categoria['nome']; ?>
            </option>
        <?php endforeach; ?>
    </select><br>
    Descricao: <br>
    <textarea name="descricao"><?php echo $livro['descricao']; ?></textarea><br><br>
    
    <?php if(!empty($erros)): ?>
        <div>
            <?php foreach($erros as $erro): ?>
                <span>
                    <?php echo $erro; ?>
                </span> <br>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <input type="submit" value="Editar livro">
</form>