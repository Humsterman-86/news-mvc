<?php

// Переадресация на заданный адрес
function redirect_to($url) {
	if (isset($url)) {
		header("Location: " . $url);
	}
}
// Обработка выводимих данных
function sanitize_output($string) {
	return htmlspecialchars($string);
}