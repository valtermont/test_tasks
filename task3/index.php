<?php
header('Content-Type: text/html; charset=utf-8');

class Example implements Iterator
{
    private $position = 0;
    private $list = ['orange', 'red', 'blue'];

    public function __construct() {
        $this->position = 0;
    }

    public function rewind() {
        $this->position = 0;
    }

    public function current() {
        return $this->list[$this->position];
    }

    public function key() {
        return $this->position;
    }

    public function next() {
        ++$this->position;
    }

    public function valid() {
        return isset($this->list[$this->position]);
    }

}

//Как необходимо модифицировать класс, чтобы результаты не изменились при выполнении следующего кода (т.е. код ниже менять нельзя, можно только менять класса)

$example = new Example();

foreach ($example as $item)
{
    echo $item;
    echo "\n";
}

//Результат

//orange

//red

//blue

echo get_class($example);

//Результат
//Example