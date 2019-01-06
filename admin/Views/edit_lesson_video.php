<header>
    <?php if(!empty($_SESSION['user'])): ?>
        <a href="<?php echo BASE_URL.'login/logout'; ?>">
            Sair
        </a>
    <?php endif; ?>
</header>
<h1>Editar aula</h1>
<form method="POST">
    Título da aula: <br>
    <input type="text" name="name" value="<?php echo $lesson['name']; ?>"><br><br>
    Descrição da aula: <br>
    <textarea name="description"><?php echo $lesson['description']; ?></textarea><br><br>
    Código do vídeo: <br>
    <input type="text" name="url" value="<?php echo $lesson['url']; ?>"><br><br>
    <input type="submit" value="Salvar">
</form>