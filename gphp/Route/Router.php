<?php

namespace Gphp\Route;

use Gphp\Helper\Arr;
use Gphp\Traits\SingletonTrait;

class Router
{
    use SingletonTrait;

    /**
     * 路由文件相对路由
     */
    const ROUTE_FILE_PATH = 'route'.DIRECTORY_SEPARATOR.'routes.php';

    const CONTROLLER_NAMESPACE = 'App\\Http\\Controllers\\';

    /**
     * static @var 路由器对象|单例模式
     */
    protected static $route;

    /**
     * @var array 路由映射
     */
    protected  $routerMap = [];

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

    /**
     * 加载路由文件
     *
     * @param string $root
     */
    public function load(string $root)
    {
        require_once Arr::toString($root, self::ROUTE_FILE_PATH);
    }

    /**
     * 注册路由
     *
     * @param string $uri
     * @param $class
     * @param string $method
     */
    public function route(string $uri, $class, $method = '')
    {
        $this->routerMap[ltrim($uri, '/')] = $class;
    }

    /**
     * @return string 获取用户请求路由
     */
    public function getRequestUri()
    {
        return ltrim($_SERVER['REQUEST_URI'], '/');
    }

    /**
     * 发布路由
     *
     * @return mixed
     * @throws \Exception
     */
    public function distribution()
    {
        $uri = $this->getRequestUri();

        if ( !array_key_exists($uri, $this->routerMap) ) {
            throw new \Exception('路由不存在！');
        }

        $action = $this->routerMap[$uri];

        switch (true) {
            case $action instanceof \Closure:
                return call_user_func($action);
            case is_array($action):
                return $this->distributionArray($action);
            case is_string($action):
                return $this->distributionString($action);
        }

    }

    /**
     * 获取控制器
     *
     * @param string $class
     * @return string
     * @throws \Exception
     */
    public function getController(string $class)
    {
        if (class_exists($class)) {
            return $class;
        }

        $class = self::CONTROLLER_NAMESPACE . ltrim($class, '/');
        if (class_exists($class)) {
            return $class;
        }

        throw new \Exception('控制器不存在！');

    }

    /**
     * 发布数组路由
     *
     * @param array $action
     * @return mixed
     * @throws \Exception
     */
    public function distributionArray(array $action)
    {
        if (
            count($action) < 2 ||
            !array_key_exists('controller', $action) ||
            !array_key_exists('method', $action)
        ) {
            throw new \Exception('路由定义有误！');
        }

        $method = $action['method'];
        $controllerClass = $this->getController($action['controller']);

        // todo 这里待改善
        $controllerClass = new $controllerClass;
        return $controllerClass->$method();


    }

    /**
     * 发布字符串路由
     *
     * @param $action
     * @return mixed
     * @throws \Exception
     */
    public function distributionString($action)
    {
        if ( strpos($action, '@') === false) {
            throw new \Exception('路由定义有误！');
        }

        $actionArr = explode('@', $action);
        $actionArr['controller'] = $actionArr[0];
        $actionArr['method'] = $actionArr[1];
        unset($actionArr[0], $actionArr[1]);

        return $this->distributionArray($actionArr);
    }

    # ====== static methods ======

    /**
     * 创建路由对象
     *
     * @param string $rootDir
     * @return Router
     * @author GP
     * DateTime: 2021/1/22 17:42
     */
    public static function create($rootDir = '')
    {
        if ( !self::$route ) {
            self::$route = new static();
            self::$route->load($rootDir);
        }
        return self::$route;
    }


}
