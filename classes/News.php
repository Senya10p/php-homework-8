<?php

require __DIR__ . '/Article.php';
require __DIR__ . '/DB.php';

class News                          //Создаём класс News
{
    protected $data;
    protected $articles;

    public function __construct($path)
    {
       $this->data = new DB($path);
    }

    public function getAll() //метод получения всех новостей
    {
       if ( isset($this->articles) ) {
           return $this->articles;
       }
       $sql = 'SELECT * FROM news ORDER BY id DESC'; //запрос. самая последняя новость сверху
       $ret = [];
       $arts = $this->data->query($sql, $ret);
       $this->articles = [];

        if ( false !== $arts ) {
            foreach ($arts as $article) {
                if ( is_array($article) ) {
                    $this->articles[$article['id']] = new Article( $article['header'], $article['text'], $article['author'] );
                }
            }
            return $this->articles;
        }
    }

    public function getOneArticle(string $id) //метод получения новости по id
    {
       $sql = 'SELECT * FROM news WHERE id=:id';
       $ret = [':id' => $id];
       $arr = $this->data->query($sql, $ret);

       if ( isset($arr[0]) ) {
           return new Article( $arr[0]['header'], $arr[0]['text'], $arr[0]['author'] );
       }
       return null;
    }
}