<?php 

// Подключаем конфиг
require_once('includes/config.inc.php');

// Получим все новости из БД
$articles = Article::getAll();

// Подключим вьюху
require_once(VIEW_PATH.'index.view.php');