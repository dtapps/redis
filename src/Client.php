<?php
/**
 * (c) Chaim <gc@dtapp.net>
 */

namespace DtApp\Redis;

/**
 * Redis
 * Class Client
 * @package Redis
 */
class Client
{
    /**
     * 链接
     * @var string
     */
    private static $ip = "127.0.0.1";

    /**
     * 端口
     * @var string
     */
    private static $port = 6379;

    /**
     * @var string
     */
    private static $db = "0";

    /**
     * @var string
     */
    private static $prefix = '';

    /**
     * @var string
     */
    private static $expire = 0;

    /**
     * 配置
     * Client constructor.
     * @param array $config
     */
    public function __construct($config = [])
    {
        if (!empty($config['ip'])) self::$ip = $config['ip'];
        if (!empty($config['port'])) self::$port = $config['port'];
        if (!empty($config['db'])) self::$db = $config['db'];
        if (!empty($config['prefix'])) self::$prefix = $config['prefix'];
        if (!empty($config['expire'])) self::$expire = $config['expire'];
    }

    /**
     * 获取
     * @param string $key 键名
     * @param string|int $default 默认
     * @return mixed
     * @throws Exception
     */
    public static function get($key, $default = '')
    {
        if (empty($key)) throw new Exception('请检查参数');
        $name = $key;
        if (!empty( self::$prefix)) $name = self::$prefix . $key;
        $redis = Base::connection(self::$db, self::$ip, self::$port);
        try {
            return $redis->get($name);
        } catch (Exception $e) {
            return $default;
        }
    }


    /**
     * 设置
     * 这里的时间优先于全局
     * @param string $key 键名
     * @param $value
     * @param int $ttl
     * @return bool
     * @throws Exception
     */
    public static function set($key, $value, $ttl = 0)
    {
        if (empty($key) || empty($value)) throw new Exception('请检查参数');
        $name = $key;
        if (!empty(self::$prefix)) $name = self::$prefix . $key;
        $redis = Base::connection(self::$db, self::$ip, self::$port);
        $redis->set($name, $value);
        if (!empty($ttl) || !empty(self::$prefix)) {
            if (!empty($ttl)) {
                $redis->expireAt($name, time() + $ttl);
                return true;
            }
            if (!empty(self::$expire)) {
                $redis->expireAt($name, time() + self::$expire);
                return true;
            }
        }
        return false;
    }

    /**
     * 查看key的存活时间
     * @param string $key 键名
     * @return bool|int
     * @throws Exception
     */
    public static function getTtl($key)
    {
        if (empty($key)) throw new Exception('请检查参数');
        $name = $key;
        if (!empty(self::$prefix)) $name = self::$prefix . $key;
        $redis = Base::connection(self::$db, self::$ip, self::$port);
        return $redis->ttl($name);
    }

    /**
     * 删除一个key
     * @param string $key
     * @return int
     * @throws Exception
     */
    public static function del($key)
    {
        if (empty($key)) throw new Exception('请检查参数');
        $name = $key;
        if (!empty(self::$prefix)) $name = self::$prefix . $key;
        $redis = Base::connection(self::$db, self::$ip, self::$port);
        $res = $redis->del($name);
        if (!empty($res)) return true;
        return false;
    }
}
