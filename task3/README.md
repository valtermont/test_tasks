## Тестовое задание №3

У вас есть следующий объект следующего класса:

```php
class Example
{
    public $list = ['orange', 'red', 'blue'];
}
```

Как необходимо модифицировать класс, чтобы результаты не изменились при выполнении следующего кода (т.е. код ниже менять нельзя, можно только менять класса)

```php
$example = new Example();

foreach ($example as $item)
{
    echo $item;
    echo “\n”;
}
```
```
//Результат

//orange
//red
//blue

echo get_class($example);

//Результат
//Example
```