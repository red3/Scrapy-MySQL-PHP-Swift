# Scrapy-MySQL-PHP-Swift
Scrapy+MySQL+PHP+Swift开发攻略
# 准备工作
因为并没有将数据库的配置文件加入版本控制，所以需要自己创建这个文件
	cd api/include
	vi config.db.php
这个文件应该是这个样子的：

	<?php
	/**
	* Database configuration
	*/
	define('DB_USERNAME', 'xx');
	define('DB_PASSWORD', 'xx');
	define('DB_HOST', 'xx');
	define('DB_NAME', 'xx');
	 
	?>
将"xx"替换成自己的配置就可以了
