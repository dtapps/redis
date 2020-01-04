<?php
/**
 * (c) Chaim <gc@dtapp.net>
 */

namespace DtApp\Redis;

use Redis;

/**
 * 配置
 * Class Base
 * @package Redis
 */
class Base extends Client
{
    /**
     * 配置连接
     * @param string $db
     * @param string $ip
     * @param int $port
     * @return Redis
     * @throws RedisException
     */
    protected static function connection($db = "0", $ip = "127.0.0.1", $port = 6379)
    {
        try {
            $redis = new Redis();
        } catch (RedisException $e) {
            throw new RedisException('php.ini缺少php_redis.dll文件配置');
        }
        try {
            $redis->connect($ip, $port);
        } catch (RedisException $e) {
            throw new RedisException("连接redis服务器失败,请检查redis服务器是否开启");
        }
        $redis->select($db);
        return $redis;
    }

}
