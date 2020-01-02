<?php
/**
 * (c) Chaim <gc@dtapp.net>
 */

require_once '../vendor/autoload.php';

$redis = new \Redis\Client();
var_dump($redis->get('pp_fake_bet_img_3'));
