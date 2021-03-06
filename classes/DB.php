<?php

class DB //1.Создаём класс DB
{
    protected $dbh;

    //$path = __DIR__ . '/../config.php'
    public function __construct($path) //1.1 Создаём конструктор. В нём устанавливаем соединение с БД.
    {
        $conf = require $path; //Параметры берём из файла config.php
        if ( is_array($conf) ) {
            if ( isset( $conf['dsn'], $conf['username'], $conf['password'] ) ) {
                $this->dbh = new \PDO( $conf['dsn'], $conf['username'], $conf['password'] );
            }
        }
    }

    public function execute(string $sql) //1.2 Метод execute(string $sql) выполняет запрос и возвращает либо true, либо false
    {
        $sth = $this->dbh->prepare($sql); //подготовка запроса

        if (false === $sth) { //если ошибка при подготовке запроса
            return false;
        }
        return $sth->execute(); //возвращает или true или false, в зависимости от того, удалось ли выполнение
    }

//1.3 Метод query(string $sql, array $data) выполняет запрос, подставляет в него данные $data, возвращает данные результата запроса или false
    public function query(string $sql, array $data)
    {
        $sth = $this->dbh->prepare($sql); //Подготавливает запрос к выполнению

        if (false !== $sth) { //если запрос подготовлен
            if ( $sth->execute($data) ) { //если запрос выполнен
                return $sth->fetchAll();
            }
        }
        return false;
    }
}