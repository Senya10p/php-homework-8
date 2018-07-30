<?php   //3.2 Делаем страницу /article.php?id=N отображает одну новость с id=N

require __DIR__ . '/classes/News.php';

require __DIR__ . '/classes/View.php';

if ( isset($_GET['id']) ) { //если такой id существует

    $news = new News(__DIR__ . '/config.php');
    $article = $news->getOneArticle( $_GET['id'] );
}

if ( !isset($article) ) { //если не существует объект $article, либо равен null

    die('Такой новости нет');
}

$v = new View();
$v->assign('article', $article );
$v->display( __DIR__ . '/templates/art.php');