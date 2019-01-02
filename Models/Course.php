<?php

namespace Models;

use \Core\Model;

class Course extends Model
{
	public function getCoursesByStudent(int $id): array
	{
		$array = [];

		$sql = 'SELECT courses_has_students.course_id,
				       courses.name,
				       courses.image,
				       courses.description
				FROM courses_has_students
				LEFT JOIN courses ON courses.id = courses_has_students.course_id
				WHERE courses_has_students.student_id = :id';

		$sql = $this->database->prepare($sql);
		$sql->bindValue(':id', $id);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$array = $sql->fetchAll(\PDO::FETCH_ASSOC);
		}

		return $array;
	}
}