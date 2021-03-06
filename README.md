# KIT - information site

## Парсинг Uri

Uri, на яке перейшов користувач парситься на route, controller, action, params.
Наприклад:

uri = kit.com/admin/user/get/id/2

![tiny arrow](https://res.cloudinary.com/emazecom/image/fetch/c_limit,a_ignore,w_120,h_160/https%3A%2F%2Fimage.freepik.com%2Ffree-icon%2Farrow-bold-down-ios-7-interface-symbol_318-34310.jpg)

router 		= admin (За замовчуванням є всього 2 routes - admin та default. Якщо не заданий цей параметр використовується default)
controller 	= user (За замовчуванням - User, але його можна змінити в файлі config.ini)
action 		= get (За замовчуванням - index, але його можна змінити в файлі config.ini)
params 		= [id,2] (Не обов'язкові параметри)


Ще приклад:
uri = kit.com/page

![tiny arrow](https://res.cloudinary.com/emazecom/image/fetch/c_limit,a_ignore,w_120,h_160/https%3A%2F%2Fimage.freepik.com%2Ffree-icon%2Farrow-bold-down-ios-7-interface-symbol_318-34310.jpg)

router 		= default
controller 	= page
action		= [default_action]

### ~~Парсинг Uri~~

## Controller

Ні в якому випадку не перезаписуйте конструктор контроллерів. Якщо вам потрібна ініціалізація змінних або функціоналу використовуйте функцію init() в вашому контроллері. Вона викликається відразу ж після конструктора.

Контроллер повинен наслідуватися від класу Controller, який в свою чергу має такі змінні:

protected $data, $params;

$data - це масив даних, які можна використовувати в html - сторінці
В зовнішніх сторінках, таких як default.html, admin.html (ті, що знаходяться безпосередньо в папці views/, але не файл 404.html ) $data містить всього 1 значення -- data["content"] -- воно відтворює Action-сторінку.
Що це означає?
 => Запуск поточного контроллера
 => Запуск функції init() цього ж контроллера
 => Запуск action-функції (наприклад index()) 
 => Запуск route-layout-файла (з параметром $data, який містить 1 значення "content") (за замовчуванням views/default.html)
 => Запуск view-файла, яке містить змінну $data поточного контроллера

Всі параметри, які будуть використовуватися в view-файлі повинні бути записані в параметр $data поточного контроллера

### ~~Controller~~

## Model

Parent-клас моделей є клас Model, який містить в собі 2 змінні: 
	$db - підключена база даних;
	$table_name - автоматично береться з назви класу + tolower();
Також клас-предок містить 3 основні функції запитів:
	getById(id) - виконується запит в базу по id значенню
	deleteById($id) - видаляється з бази поле з заданим id значенням
	getAll() - витягує з бази усі поля з даної таблиці

При створення моделі можна (і потрібно) утворювати свої функції;
Зразок запиту за id;
```php
public function getById($id)
{
	$sql = "SELECT * FROM $table_name WHERE id=$id";
	return $this->db->query($sql);
}
```

Клас моделі теж не повинен мати конструктора
Створити екземпляр можна таким способом:
	model = new Model([string $table_name[, Database $db]])
Обидва параметри не обовязкові.

### ~~Model~~

## Порядок створення елементів 

Створення Pages

	controllers/PageController.php
	models/Pages.php
	views/page
	views/page/index.html

Створення view-action для Pages
	
	controllers/PageController.php:
```php
PageController extends Controller
{
	/* ... */
	public function view(){
		/* type code here */
	}
	/* ... */
}
```
views/page/view.html:
```html
<div>
	<b>Action 'view' for controller 'Page'</b>
</div>
```

### ~~Порядок створення елементів~~

## Основні функції та змінні

```php
class Config {
	public static function getRoutes(); // повертає масив routes
	public static function getDefaultRoute(); // повертає route за замовчуванням
	public static function getDefaultController(); // ~ || ~
	public static function getDefaultAction(); // ~ || ~
	public static function getDatabase(); // при першому зверненні створює базу за заданими в config.ini параметрами
}

class App {
    public static function getRouter(); // повертає поточний Router
}
class Database {
	public function query($sql); // виконує запит по строці $sql
	public function escape($str); // повертає escape-строку
	public function error(); // повертає MySQL помилку (якщо така є)
}

class Router {
	public function getRoute();
	public function getController();
	public function getAction();
	public function getParams();
	public function getMethodPrefix(); // для admin - 'admin_' (використовується в actions. Наприклад функція index при (route == admin) повинна мати назву 'admin_index')
	public function getUri();
}
class Model {
	public function setTableName($table_name);
	public function getById($id);
	public function deleteById($id);
	public function getAll();
}
class Controller {
	public function setParams($params);
	public function getData();
}
```