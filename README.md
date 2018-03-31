# laravel-db-options

Laravel Database Options

### Composer Install
```code
composer require "ahmeti/db-option:@dev"
```

### Create Table
```sql
CREATE TABLE `options` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL DEFAULT '',
  `type` enum('string','int','float','json') NOT NULL DEFAULT 'string',
  `value` text NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;
```

### Use in App
```php
<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Ahmeti\DBOption\Facades\DBOption;

class TestController extends Controller
{

    # Data Types: 'string', 'int', 'float', 'json'
    
    # SET Args: DBOption::set($name, $value, $type='string', $description=null);

    public function sample_1()
    {
        DBOption::set('site_url', 'ahmetimamoglu.com.tr');
        
        return DBOption::get('site_url'); # (string) 'www.ahmetimamoglu.com.tr'
    }
    

    public function sample_2()
    {
        DBOption::set('site_id', 10, 'int');
        
        return DBOption::get('site_id'); # (int) 10
    }
    
    
    public function sample_3()
    {
        DBOption::set('site_price', 150.001, 'float');
        
        return DBOption::get('site_price'); # (float) 150.001
    }
    
    
    public function sample_4()
    {
        $jsonString='{ "url":"ahmetimamoglu.com.tr", "site_id": 10, "site_price": 150.001 }';
    
        DBOption::set('site_options', $jsonString, 'json');
        
        $site_options = DBOption::get('site_options'); # (json -> php object)
        
        return $site_options->url; # (string) 'ahmetimamoglu.com.tr'
        return $site_options->site_id; # (int) 10
        return $site_options->site_price; # (float) 150.001
    }    
```
