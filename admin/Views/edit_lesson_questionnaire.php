<header>
    <?php if(!empty($_SESSION['user'])): ?>
        <a href="<?php echo BASE_URL.'login/logout'; ?>">
            Sair
        </a>
    <?php endif; ?>
</header>
<h1>Editar questionário</h1>
<form method="POST">
    Pergunta: <br>
    <input type="text" name="question" value="<?php echo $lesson['question']; ?>"><br><br>
    Opção 1: <br>
    <input type="text" name="option1" value="<?php echo $lesson['option1']; ?>"><br><br>
    Opção 2: <br>
    <input type="text" name="option2" value="<?php echo $lesson['option2']; ?>"><br><br>
    Opção 3: <br>
    <input type="text" name="option3" value="<?php echo $lesson['option3']; ?>"><br><br>
    Opção 4: <br>
    <input type="text" name="option4" value="<?php echo $lesson['option4']; ?>"><br><br>
    Resposta: <br>
    <select name="answer">
        <option value="1" <?php echo $lesson['answer'] === '1' ? 'selected' : ''; ?>>Opção 1</option>
        <option value="2" <?php echo $lesson['answer'] === '2' ? 'selected' : ''; ?>>Opção 2</option>
        <option value="3" <?php echo $lesson['answer'] === '3' ? 'selected' : ''; ?>>Opção 3</option>
        <option value="4" <?php echo $lesson['answer'] === '4' ? 'selected' : ''; ?>>Opção 4</option>
    </select>
    <input type="submit" value="Salvar">
</form>