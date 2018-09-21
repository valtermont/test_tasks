## Тестовое задание №1

На чистом PHP.

Требуется написать роутер, который сможет перенаправлять запросы url адреса 
вида `/module/controller/action` в конкретный модуль (`module`), 
контроллер (`controller`), метод (`action`)

К примеру есть следующая структура модулей:

```
modules/
modules/news
modules/news/controllers
modules/news/controllers/ListController.php
modules/news/controllers/RssController.php
modules/register/controllers/UserConroller.php
```

Следовательно url `/news/list/index` должно привести к выполнению метода `index`
 в `modules/news/controllers/ListController.php`.