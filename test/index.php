<?php
require_once dirname(__FILE__).'/autoload.php';
define('REDIS_HOST', '127.0.0.1');
define('REDIS_PORT', '6379');
define('REDIS_PASSWORD', '');
define('REDIS_PREFIX', '');
use Rupeelabs\Phpredis\Cache;
$redis = new Cache();
$rs1 = $redis->set('www1', 'sss', 100);
$rs2 = $redis->set('www2', 'sss');
var_dump($rs2);
//$redis->del(['www1', 'www2']);
$result = $redis->get('www1');
var_dump($result);