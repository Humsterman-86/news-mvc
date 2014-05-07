<?php

// Подключаем конфиг
require_once('includes/config.inc.php');

// Проверим запрос на наличие id
if (isset($_GET['id']) && intval($_GET['id']) > 0) {
	
	// Возьмем id из запроса
	$id = $_GET['id'];
	
	// Выполним запрос в базу
	$article = Article::getById($id);
	
} else {

	// Перебросим клиента на главную страницу
	redirect_to('.');
}

// Подключаем вьюху
require_once(VIEW_PATH.'read.view.php');