<header>
    <?php if(!empty($_SESSION['user'])): ?>
        <a href="<?php echo BASE_URL.'login/logout'; ?>">
            Sair
        </a>
    <?php endif; ?>
</header>
<h1>Cursos</h1>
<a href="<?php echo BASE_URL; ?>home/add">Adicionar curso</a>
<table border="1" width="100%">
    <tr>
        <th>Imagem</th>
        <th>Nome</th>
        <th>Qt. de Alunos</th>
        <th>Ações</th>
    </tr>
    <?php foreach($courses as $course): ?>
        <tr>
            <td>
                <img 
                    src="/e-learning/assets/images/courses/<?php echo $course['image']; ?>" 
                    height="70">
            </td>
            <td>
                <?php echo $course['name']; ?>
            </td>
            <td>
                <?php echo $course['number_of_students']; ?>
            </td>
            <td>
                <form method="POST">
                    <input type="hidden" name="course_id" value="<?php echo $course['id']; ?>">
                    <input type="hidden" name="image_url" value="<?php echo $course['image']; ?>">
                    <input type="submit" value="Excluir">
                </form>
                <a href="<?php echo BASE_URL; ?>home/edit/<?php echo $course['id']; ?>">
                    <button>Editar</button>
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>