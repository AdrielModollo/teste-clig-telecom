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
</fieldset><br>
<fieldset>
    <legend>Adicionar aula</legend>
    <form method="POST">
        Nome da aula: <br>
        <input type="text" name="add_lesson_name"><br><br>
        Módulo: <br>
        <select name="add_lesson_module">
            <?php foreach($modules as $module): ?>
                <option value="<?php echo $module['id']; ?>">
                    <?php echo $module['name']; ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>
        Tipo: <br>
        <select name="add_lesson_type">
            <option value="video">Vídeo</option>
            <option value="questionnaire">Questionário</option>
        </select><br><br>
        <input type="submit" value="Adicionar aula">
    </form>
</fieldset>
<?php foreach($modules as $module): ?>
    <h4>
        <?php echo $module['name']; ?>    
    </h4>
    <form method="POST">
        <input type="hidden" name="module_id" value="<?php echo $module['id']; ?>">
        <button type="submit">X</button>
        <a href="<?php echo BASE_URL; ?>home/edit_module/<?php echo $module['id']; ?>">Editar</a>
    </form>
    <?php foreach($module['lessons'] as $lesson): ?>
        <h5><?php echo $lesson['name']; ?></h5>
        <form method="POST">
            <input type="hidden" name="lesson_id" value="<?php echo $lesson['id']; ?>">
            <input type="submit" value="Excluir aula">
            <a href="<?php echo BASE_URL; ?>home/edit_lesson/<?php echo $lesson['id']; ?>">Editar aula</a>
        </form>
    <?php endforeach; ?>
<?php endforeach; ?>