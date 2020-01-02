<?php
/**
 * (c) Chaim <gc@dtapp.net>
 */

require_once '../vendor/autoload.php';

var_dump(\DtApp\Redis\Client::get('pp_fake_be',22));
var_dump(\DtApp\Redis\Client::set('pp_fake_be',1,1000));
