<?php

// Подключаем конфиг
require_once('includes/config.inc.php');

// Все как и в предыдущих случаях - проверяем
if (isset($_GET['id']) && intval($_GET['id']) > 0) {

	// Инициализируем переменные
	$title = NULL;
	$content = NULL;

	// Получим ID из запроса
	$id = $_GET['id'];
		
	// Проверим тип запроса
	if ($_SERVER['REQUEST_METHOD'] == 'GET') {

		// Выполним запрос
		$article = Article::getById($id);
							
		// Установим значения в форму
		$title = $article->title;
		$content = $article->content;
	} 
	
	// Проверим, что запрос POST
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				
		// Возьмем пользовательские данные из формы
		$title = $_POST['title'];
		$content = $_POST['content'];

		// Занесем данные в базу
		$article = new Article();
		$article->id = $id;
		$article->title = $title;
		$article->content = $content;
		$article->save();
					
		// Перебросим пользователя
		redirect_to('.');	
	} 

} else {

	// Перебросим пользователя на главную
	redirect_to('.');	
}

// Подключим вьюху
require_once(VIEW_PATH.'upsert.view.php');