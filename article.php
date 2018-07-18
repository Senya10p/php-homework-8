<?php   //3.2 Делаем страницу /article.php?id=N отображает одну новость с id=N
require __DIR__ . '/classes/News.php';
require __DIR__ . '/classes/View.php';

if ( isset($_GET['id']) ) { //если такой id существует

    $news = new News(__DIR__ . '/config.php');

    $art = $news->getOneArticle( $_GET['id'] );

}

if ( !isset($art) ) { //если не существует объект $art, либо равен null
    header('Location: /index.php');
    exit;
}

$header = $art->getHeader();
$text = $art->getText();
$author = $art->getAuthor();

$v = new View();
$v->assign('header', $header );
$v->assign('text', $text );
$v->assign('author', $author );

$v->display( __DIR__ . '/templates/art.php');