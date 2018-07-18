<?php       //3.1 Главная страница. Выводит все новости

require __DIR__ . '/classes/View.php';
require __DIR__ . '/classes/News.php';

$news = new News(__DIR__ . '/config.php');

$news->getAll();
$data = $news->getAll();

$view = new View(); //выводим через класс View
$view->assign('data', $data );
$view->display(__DIR__ . '/templates/index.php' );