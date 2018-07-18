<?php


class View      //1.	Создаём объект класса View
{

    protected $data = [];    //Данные, передаваемые в шаблон (используем защищенное свойство - массив для хранения этих данных)

    public function assign( string $name, $value ) //1.2) метод assign($name, $value) сохраняет данные, передаваемые в шаблон
    {
        $this->data[$name] = $value;
      //  return $this;
    }

    public function display( $template )        //1.3)	метод display($template), который отображает указанный шаблон с заранее сохраненными данными
    {
        if ( file_exists($template) ){
            foreach ( $this->data as $name => $value ) {
                $$name = $value;
            }
            include $template;
        }
        //die('Не найдено');
    }

    public function render( $template )  //1.4) Метод render($template), который аналогичен методу display(), но не выводит шаблон с данными в браузер, а возвращает его
    {
        if ( file_exists($template) ) {
            ob_start();
            $this->display($template);
            $ret = ob_get_contents();
            ob_end_clean();
            return $ret;
        }
    }
}