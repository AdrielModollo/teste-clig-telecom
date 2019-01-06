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
    <input type="text" name="name" value="<?php echo $course['name']; ?>"><br><br>
    Descrição: <br>
    <textarea name="description"><?php echo $course['description']; ?></textarea><br><br>
    Imagem: <br>
    <input type="file" name="image"><br>
    <img src="/e-learning/assets/images/courses/<?php echo $course['image']; ?>"><br>
    <input type="submit" value="Adicionar curso">
</form>

<hr>
<h2>Aulas</h2>
<fieldset>
    <legend>Adicionar módulo</legend>
    <form method="POST">
        Nome do módulo: <br>
        <input type="text" name="module_name">
        <input type="submit" value="Adicionar módulo">
    </form>
</fieldset>
<?php foreach($modules as $module): ?>
    <h4><?php echo $module['name']; ?></h4>
    <form method="POST">
        <input type="hidden" name="module_id" value="<?php echo $module['id']; ?>">
        <button type="submit">X</button>
    </form>
    <a href="<?php echo BASE_URL; ?>home/edit_module/<?php echo $module['id']; ?>">Editar</a>
<?php endforeach; ?>