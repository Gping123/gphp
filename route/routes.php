<?php

# +--------------------------------------------------------
# | 路由定义
# +--------------------------------------------------------

$route = Gphp\Route\Router::create();

$route->route('/hello', ['controller'=>\App\Http\Controllers\Controller::class, 'method'=>'index']);

