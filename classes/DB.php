<?php

class DB //1.Создаём класс DB
{
    protected $dbh;

    //$path = __DIR__ . '/../config.php'
    public function __construct($path) //1.1 Создаём конструктор. В нём устанавливаем соединение с БД.
    {
        require $path; //Параметры берём из файла config.php
        $dsn = BD_DSN;
        $this->dbh = new PDO($dsn, BD_USERNAME, BD_PASS);
    }

    public function execute(string $sql) //1.2 Метод execute(string $sql) выполняет запрос и возвращает либо true, либо false
    {
        $sth = $this->dbh->preвpare($sql); //подготовка запроса

        if ( false === $sth ) { //если ошибка при подготовке запроса

                return false;
            }

        return $sth->execute(); //возвращает или true или false, в зависимости от того, удалось ли выполнение
    }

//1.3 Метод query(string $sql, array $data) выполняет запрос, подставляет в него данные $data, возвращает данные результата запроса или false
    public function query(string $sql, array $data)
    {
        $sth = $this->dbh->prepare($sql); //Подготавливает запрос к выполнению

        if ( false !== $sth ) {
            if ( $sth->execute($data) ) {

                return $sth->fetchAll();
            }
        }

        return false;
    }
}