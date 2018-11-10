<?php
namespace App\Transformers;

use App\Student;
use League\Fractal\TransformerAbstract;

class StudentTransformer extends TransformerAbstract
{
	public function transform(Student $student)
	{
		return [
			'id' 			=> $student->id,
			'name' 			=> $student->name,
			'fathername' 	=> $student->fathername,
			'class' 		=> $student->class,
			'published' 	=> $student->created_at,
		];
		
	}
}