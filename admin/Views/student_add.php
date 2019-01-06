<header>
    <?php if(!empty($_SESSION['user'])): ?>
        <a href="<?php echo BASE_URL.'login/logout'; ?>">
            Sair
        </a>
    <?php endif; ?>
</header>
<h1>Adicionar aluno</h1>
<form method="POST">
    Nome: <br>
    <input type="text" name="name"><br><br>
    E-mail: <br>
    <input type="email" name="email"><br><br>
    Senha: <br>
    <input type="password" name="password"><br><br>
    <input type="submit" value="Adicionar aluno">
</form>