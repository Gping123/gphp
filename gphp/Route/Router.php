<?php

namespace Gphp\Route;

use Gphp\Traits\SingletonTrait;

class Router
{
    use SingletonTrait;

    protected static $route;

    /**
     * @var array 路由映射
     */
    protected static $routerMap = [];

    /**
     * Router constructor.
     */
    private function __construct()
    {
        $this->init();
    }

    /**
     * 初始化方法
     *
     * @author GP
     * DateTime: 2021/1/22 17:34
     */
    protected function init()
    {

    }

    public function route()
    {

    }

    # ====== static methods ======

    /**
     * 创建路由对象
     *
     * @return Router
     * @author GP
     * DateTime: 2021/1/22 17:42
     */
    public static function create()
    {
        if ( !self::$route ) {
            self::$route = new static();
        }
        return self::$route;
    }


}
