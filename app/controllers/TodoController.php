<?php
/**
 * Created by PhpStorm.
 * User: connor
 * Date: 2018/6/23
 * Time: 14:58
 */

namespace app\controllers;

use app\models\Todo;

class TodoController extends BaseController
{
	public function index()
	{
		$todos = Todo::all();
		return $this->render('todo/index', ['todos' => $todos]);
	}

	public function create()
	{
		$todo = new Todo();
		$todo->title = $_POST['title'];
		$todo->status = 1;
		$todo->save();
		$this->redirect('todo/index');
	}

	public function remove()
	{
		$todo = Todo::byId($_POST['id']);
		$todo->delete();
		$this->redirect('todo/index');
	}

	public function edit()
	{
		$todo = Todo::byId($_POST['id']);
		$todo->status = 0;
		$todo->save();
		$this->redirect('todo/index');
	}

	public function init()
	{
		$migrations = new \Pheasant\Migrate\Migrator();
		$migrations->initialize(Todo::schema(), 'todo');
		echo 'migrate done';
	}
}