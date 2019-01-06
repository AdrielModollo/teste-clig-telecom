<header>
    <?php if(!empty($_SESSION['user'])): ?>
        <a href="<?php echo BASE_URL.'login/logout'; ?>">
            Sair
        </a>
    <?php endif; ?>
</header>
<h1>Editar aluno</h1>
<form method="POST">
    Nome: <br>
    <input type="text" name="name" value="<?php echo $student['name']; ?>"><br><br>
    E-mail: <br>
    <input type="email" name="email" value="<?php echo $student['email']; ?>"><br><br>
    Cursos inscritos: <br>
    <select name="courses[]" multiple>
        <?php foreach($courses as $course): ?>
            <option 
                value="<?php echo $course['id']; ?>"
                <?php echo in_array($course['id'], $courses_by_student) ? 'selected' : ''; ?>>
                <?php echo $course['name']; ?>
            </option>
        <?php endforeach; ?>
    </select>
    <input type="submit" value="Adicionar aluno">
</form>