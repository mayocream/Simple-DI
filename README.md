# Simple-DI

## Usage

```php

include "DI.php";

$app = Di::instance();

共享 Share
$app->set('db', function() {
	return new Medoo\Medoo;
});

单例 Singleton
$app->new('md', function() {
	// ...
});

获取服务
$app->get('db');
$app->get('md');


```