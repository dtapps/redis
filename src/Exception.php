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
class Exception extends \Exception
{
    public function errorMessage()
    {
        return $this->getMessage();
    }
}
