<h1>Seus cursos</h1>
<?php foreach($courses as $course): ?>
    <a href="<?php echo BASE_URL; ?>courses/learning/<?php echo $course['course_id']; ?>">
        <div class="course_item">
            <img src="<?php echo BASE_URL ?>assets/images/courses/<?php echo $course['image']; ?>" 
                width="260" height="150" /><br><br>
            <strong>
                <?php echo $course['name']; ?>
            </strong><br>
            <?php echo $course['description']; ?>
        </div>
    </a>
<?php endforeach; ?>