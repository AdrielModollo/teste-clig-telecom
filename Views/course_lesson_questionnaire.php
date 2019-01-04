<div class="course_info">
    <img 
        src="<?php echo BASE_URL; ?>assets/images/courses/<?php echo $course->getImage(); ?>" 
        height="60" />
    <h3><?php echo $course->getName(); ?></h3>
    <?php echo $course->getDescription(); ?>
</div>
<div class="course_left">
    <?php foreach($modules as $module): ?>
        <div class="module">
            <?php echo $module['name']; ?>
        </div>
        <?php foreach($module['lessons'] as $lesson): ?>
            <a href="<?php echo BASE_URL; ?>courses/lesson/<?php echo $lesson['id']; ?>">
                <div class="lesson">
                    <?php echo $lesson['name']; ?>
                </div>
            </a>
        <?php endforeach; ?>
    <?php endforeach; ?>
</div>
<div class="course_right">
    <h1>Questionário</h1>
    <h3><?php echo $lesson_info['question']; ?></h3>
    <form method="POST">
        <input type="radio" name="option" value="1" id="option1">
        <label for="option1"><?php echo $lesson_info['option1']; ?></label><br><br>
        <input type="radio" name="option" value="2" id="option2">
        <label for="option2"><?php echo $lesson_info['option2']; ?></label><br><br>
        <input type="radio" name="option" value="3" id="option3">
        <label for="option3"><?php echo $lesson_info['option3']; ?></label><br><br>
        <input type="radio" name="option" value="4" id="option4">
        <label for="option4"><?php echo $lesson_info['option4']; ?></label><br><br>
        <input type="submit" value="Enviar Resposta">
    </form>
    <?php if (isset($answer)): ?>
        <?php if($answer === true): ?>
            <p>Resposta correta!</p>
        <?php else: ?>
            <p>Resposta incorreta!</p>
        <?php endif; ?>
    <?php endif; ?>
</div>