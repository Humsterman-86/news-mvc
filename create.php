<?php

// Подключаем конфиг
require_once('includes/config.inc.php');

// Инициализируем переменные и обнулим их
$title = NULL;
$content = NULL;

// Проверяем, пришел ли запрос с формы
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	// Возьмем данные, которые ввел пользователь
	$title = $_POST['title'];
	$content = $_POST['content'];

	// Выполним работу с БД
	$article = new Article();
	$article->title = $title;
	$article->content = $content;
	$article->save();
		
	// Переведем пользователя на главную страницу
	redirect_to('.');
}

// Подключаем вьюху
require_once(VIEW_PATH.'upsert.view.php');