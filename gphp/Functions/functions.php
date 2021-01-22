<?php

# +--------------------------------------------------------
# | 助手函数
# +--------------------------------------------------------

/**
 * dump 打印函数
 */
if (!function_exists('dump')) {
    function dump(...$args) {
        foreach ($args as $arg) {
            var_dump($arg);
        }
    }
}

/**
 * dd 函数
 *     打印并终止脚本
 */
if (!function_exists('dd')) {
    function dd(...$args) {
        foreach ($args as $arg) {
            var_dump($arg);
        }
        exit(0);
    }
}

/**
 * app 函数
 */
if (!function_exists('app')) {
    function app() {
        return \Gphp\App\App::create();
    }
}

/**
 * config 函数
 */
if (!function_exists('config')) {
    function config($key) {
        $config = \Gphp\App\Config::create();
        return $config->get($key);
    }
}




