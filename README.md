# php-redis
The library to oprate redis

## INSTALLATIONE

Edit your composer.json 

  {  
    "require": {  
      "rupeelabs/phpredis": "dev-master"  
    },  
    "repositories": [  
      {  
        "type": "git",  
        "url":  "https://github.com/rupeelabs/phpredis.git"
      }
    ]
  }

##USAGE

use Rupeelabs\Phpredis\Cache;

$redis = new Cache();

$rs1 = $redis->set('aaa', 'sss', 100);
