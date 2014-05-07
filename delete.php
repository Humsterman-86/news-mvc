<?php

// Подключаем конфиг
require_once('includes/config.inc.php');

// Проверим запрос на наличие числового id
if (isset($_GET['id']) && intval($_GET['id']) > 0) {
	
	// Получим id из запроса
	$id = $_GET['id'];
	
	// Работаем с базой
	$article = new Article();
	$article->id = $id;
	$article->delete();	
}

// Перебросим на главную страницу
redirect_to('.');