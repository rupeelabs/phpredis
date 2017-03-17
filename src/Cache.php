<?php
namespace Rupeelabs\Phpredis;

use Rupeelabs\Phpredis\Redis;

class Cache
{
    public $redis;

    public function __construct()
    {
        $this->redis = Redis::getInstance();
    }

    public function set($key, $value, $expire = 0)
    {
        $key = $this->redis->prefix.$key;
        $value = serialize($value);
        if (!empty($expire)) {
            return $this->redis->setex($key, $expire, $value);
        } else {
            return $this->redis->set($key, $value);
        }
    }

    public function get($key)
    {
        $key = $this->redis->prefix.$key;
        $value = $this->redis->get($key);
        if (!empty($value)) {
            return unserialize($value);
        } else {
            return null;
        }
    }

    /**
     * 同时设置多个key-value 对
     * @param $set array
     * @return boolean
     */
    public function mset($set)
    {
        $new = [];
        if (!empty($this->redis->prefix)) {
            foreach ($set as $key=>$val) {
                $new[$this->redis->prefix.$key] = $val;
            }
        } else {
            $new = $set;
        }
        return $this->redis->mset($new);
    }

    /**
     * 同时获取多个key的值
     * @param $keys array
     * @return array
     */
    public function mget($keys)
    {
        if (!empty($this->redis->prefix)) {
            foreach ($keys as &$val) {
                $val = $this->redis->prefix.$val;
            }
        }
        return $this->redis->mget($keys);
    }
    /**
     * 删除缓存 如果$key为数组可同时删除多个
     * @param $key string|array
     */
    public function del($key)
    {
        if (!empty($this->redis->prefix)) {
            if (is_array($key)) {
                foreach ($key as &$val) {
                    $val = $this->redis->prefix.$val;
                }
            } else {
                $key = $this->redis->prefix.$key;
            }
        }
        return $this->redis->del($key);
    }

    /**
     * 将一个值value插入的列表key的表头
     * @param $key string
     * @param $value string
     * @return integer 插入后列表的长度
     */
    public function lpush($key,$value)
    {
        if (!empty($this->redis->prefix)) {
            $key = $this->redis->prefix.$key;
        }
        return $this->redis->lpush($key,$value);
    }

    /**
     * 同时将多个field-value对设置到哈希表key 中
     * @param $key string
     * @param $fieldValues array
     * @return array
     */
    public function hmset($key,$fieldValues)
    {
        if (!empty($this->redis->prefix)) {
            $key = $this->redis->prefix.$key;
        }
        return $this->redis->hmset($key,$fieldValues);
    }
    /**
     * 返回列表key从索引start到stop 的值
     * @param $key
     * @param $start
     * @param $stop
     * @return array
     */
    public function lrange($key, $start, $stop)
    {
        if (!empty($this->redis->prefix)) {
            $key = $this->redis->prefix.$key;
        }
        return $this->redis->lrange($key, $start, $stop);
    }
    public function __call($method, $param)
    {
        $count = count($param);
        switch ($count) {
            case 0 :
                return $this->redis->$method();
                break;
            case 1 :
                return $this->redis->$method($param[0]);
                break;
            case 2 :
                return $this->redis->$method($param[0], $param[1]);
                break;
            case 3 :
                return $this->redis->$method($param[0], $param[1], $param[2]);
                break;
            case 4 :
                return $this->redis->$method($param[0], $param[1], $param[2], $param[3]);
                break;
            case 5 :
                return $this->redis->$method($param[0], $param[1], $param[2], $param[3], $param[4]);
                break;
            default :
                return false;
        }
    }
}