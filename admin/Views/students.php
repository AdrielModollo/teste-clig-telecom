<header>
    <?php if(!empty($_SESSION['user'])): ?>
        <a style="float: right;" href="<?php echo BASE_URL.'login/logout'; ?>">
            Sair
        </a>
        <a href="<?php echo BASE_URL; ?>">Cursos</a>
        <a href="<?php echo BASE_URL; ?>students">Alunos</a>
    <?php endif; ?>
</header>
<h1>Alunos</h1>
<a href="<?php echo BASE_URL; ?>students/add">Adicionar aluno</a>
<table border="1" width="100%">
    <tr>
        <th>Nome</th>
        <th>Qt. de cursos</th>
        <th>Ações</th>
    </tr>
    <?php foreach($students as $student): ?>
        <tr>
            <td><?php echo $student['name']; ?></td>
            <td><?php echo $student['number_of_courses']; ?></td>
            <td>
                <form method="POST">
                    <input type="hidden" name="student_id" value="<?php echo $student['id']; ?>">
                    <input type="submit" value="Excluir aluno">
                    <a href="<?php echo BASE_URL; ?>students/edit/<?php echo $student['id']; ?>">
                        Editar aluno
                    </a>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>