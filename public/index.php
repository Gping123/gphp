<?php

# 引入composer自动加载文件
require __DIR__.'/../vendor/autoload.php';

# 创建一个应用
$app = \Gphp\App\App::create(__DIR__);

# 运行应用
$app->run();


