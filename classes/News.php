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

   public function getAll()
   {
       if ( isset($this->articles) ) {

           return $this->articles;
       }

       $sql = 'SELECT * FROM news ORDER BY id DESC';

       $ret = [];

       $arts = $this->data->query($sql, $ret);

       $this->articles = [];
        if ( false !== $arts ) {
            foreach ( $arts as $arr ) {
                if ( is_array($arr) ) {
                    if ( isset( $arr['header'], $arr['text'], $arr['author'], $arr['id'] ) ) {
                        $this->articles[$arr['id']] = new Article( $arr['header'], $arr['text'], $arr['author'] );
                    }
                }
            }

            return $this->articles;
        }
   }

   public function getOneArticle(string $id)
   {
       $sql = 'SELECT * FROM news WHERE id=:id';
       $ret = [':id' => $id];
       $arr = $this->data->query($sql, $ret);

       if ( is_array($arr) ) {
           if ( isset($arr[0]) ) {
               if ( isset($arr[0]['header'], $arr[0]['text'], $arr[0]['author']) ) {

                   return new Article( $arr[0]['header'], $arr[0]['text'], $arr[0]['author'] );
               }
           }
       }

       return null;
   }
}