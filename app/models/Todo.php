<?php
/**
 * Created by PhpStorm.
 * User: connor
 * Date: 2018/6/23
 * Time: 16:06
 */

namespace app\models;

use Pheasant\Types;

class Todo extends BaseModel
{

	public function properties()
	{
		return [
			'id' => new Types\SequenceType(),
			'title' => new Types\StringType(255, 'required'),
			'status' => new Types\BooleanType(),
		];
	}
}