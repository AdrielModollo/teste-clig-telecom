<header>
    <?php if(!empty($_SESSION['user'])): ?>
        <a href="<?php echo BASE_URL.'login/logout'; ?>">
            Sair
        </a>
    <?php endif; ?>
</header>

<h1>Adicionar curso</h1>

<form method="POST" enctype="multipart/form-data">
    Nome do curso: <br>
    <input type="text" name="name"><br><br>
    Descrição: <br>
    <textarea name="description"></textarea><br><br>
    Imagem: <br>
    <input type="file" name="image"><br><br>
    <input type="submit" value="Adicionar curso">
</form>