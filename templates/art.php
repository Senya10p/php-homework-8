<html>
<head>
    <title><?php echo $article->getHeader(); ?></title>
</head>
    <body>
        <h2>Новости</h2>
        <h3><?php echo $article->getHeader(); ?></h3>
        <article><?php echo $article->getText();?></article>
        <p>Автор статьи: <?php echo $article->getAuthor(); ?></p>
        <br>
        <a href="/index.php">На главную страницу</a>
    </body>
</html>