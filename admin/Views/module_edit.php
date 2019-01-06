<header>
    <?php if(!empty($_SESSION['user'])): ?>
        <a href="<?php echo BASE_URL.'login/logout'; ?>">
            Sair
        </a>
    <?php endif; ?>
</header>
<h2>Editar módulo</h2>
<form method="POST">
    <input type="text" name="module_name" value="<?php echo $module['name']; ?>">
    <input type="submit" value="Editar módulo">
</form>