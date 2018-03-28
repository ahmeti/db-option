# laravel-db-options

Laravel Database Options

```code
composer require "ahmeti/db-option:@dev"
```

```code
CREATE TABLE `options` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL DEFAULT '',
  `type` enum('string','int','float','json') NOT NULL DEFAULT 'string',
  `value` text NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;
```
