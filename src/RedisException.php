<?php
/**
 * (c) Chaim <gc@dtapp.net>
 */

namespace DtApp\Redis;


/**
 * 处理错误
 * Class Exception
 * @package Redis
 */
class RedisException extends \Exception
{
    public function errorMessage()
    {
        return $this->getMessage();
    }
}
