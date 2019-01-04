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

</div>