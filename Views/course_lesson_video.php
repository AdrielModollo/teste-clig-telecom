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
    <h1>Vídeo - <?php echo $lesson_info['name']; ?></h1>
    <iframe 
        width="640" 
        height="300" 
        frameborder="0" 
        src="http://player.vimeo.com/video/<?php echo $lesson_info['url']; ?>">
     </iframe><br><br>
     <?php echo $lesson_info['description']; ?>
     <br><br>
     <form method="POST">
         <input 
            type="submit" 
            name="mark_assisted" 
            value="<?php echo $lesson_info['watched'] === '1' ? 'Desmarcar aula' : 'Marcar como assistida'; ?>">
     </form>
     <hr>
     <h3>Dúvidas? Envie sua pergunta!</h3>
     <form method="POST" class="form_question">
         <textarea name="question"></textarea><br><br>
         <input type="submit" value="Enviar dúvida">
     </form>
</div>