<header>
    <?php if(!empty($_SESSION['usuario'])): ?>
        <a href="<?php echo BASE_URL.'login/logout'; ?>">
        </a>
    <?php endif; ?>
</header>
<h1>Adicionar categoria</h1>
<form method="POST">
    Nome: <br>
    <input type="text" name="nome"><br><br>
    <input type="submit" value="Adicionar categoria">
</form>