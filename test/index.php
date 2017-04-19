<?php
require_once dirname(__FILE__).'/autoload.php';
define('REDIS_HOST', '127.0.0.1');
define('REDIS_PORT', '6379');
define('REDIS_PASSWORD', '');
define('REDIS_PREFIX', '');
use Rupeelabs\Phpredis\Cache;
$redis = new Cache();
$redis->sadd('myset','dog');
var_dump($redis->sismember('myset','dog'));