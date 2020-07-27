<header>
    <?php if(!empty($_SESSION['usuario'])): ?>
        <a style="float: right;" href="<?php echo BASE_URL.'login/logout'; ?>">
        </a>
        <a href="<?php echo BASE_URL; ?>categorias">Categorias</a>
        <a href="<?php echo BASE_URL; ?>livros">Livros</a>
    <?php endif; ?>
</header>
<h1>Adicionar livro</h1>
<form method="POST">
    Nome: <br>
    <input type="text" name="nome"><br>
    Autor: <br>
    <input type="text" name="autor"><br>
    Descricao: <br>
    <input type="text" name="descricao"><br><br>
    
    <?php if(!empty($erros)): ?>
        <div>
            <?php foreach($erros as $erro): ?>
                <span>
                    <?php echo $erro; ?>
                </span>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <input type="submit" value="Adicionar livro">
</form>