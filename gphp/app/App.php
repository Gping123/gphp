<?php

namespace Gphp\App;

use Gphp\Filesystem\Dir;
use Gphp\Route\Router;
use Gphp\Traits\AttributeTrait;
use Gphp\Traits\SingletonTrait;

class App
{
    use AttributeTrait , SingletonTrait;

    /**
     * 版本信息
     */
    const VERSION = 'v1.0.0';

    /**
     * @var null
     */
    public static $app = null;

    /**
     * @var string 根目录
     */
    protected $rootDir = '';

    /**
     * @var Router
     */
    protected $route;

    /**
     * App constructor.
     * @param string $rootDir
     */
    protected function __construct(string $rootDir = '')
    {
        $this->init($rootDir);
    }

    /**
     * 初始化应用
     *
     * @param string $rootDir
     * @author GP
     * DateTime: 2021/1/22 15:56
     */
    public function init(string $rootDir)
    {
        $this->setRootDir($rootDir);

        // 加载路由
        $this->route = Router::create($this->rootDir);

    }


    /**
     * 应用运行
     *
     * @author GP
     * DateTime: 2021/1/21 10:29
     */
    public function run()
    {
        # 分发路由 处理
        $response = $this->route->distribution();

    }

    /**
     * 获取项目根目录
     *
     * @return string
     * @author GP
     * DateTime: 2021/1/22 16:14
     */
    public function getRootDir()
    {
        return $this->rootDir;
    }

    /**
     * 获取版本信息
     *
     * @return string
     * @author GP
     * DateTime: 2021/1/21 10:12
     */
    public function getVersion()
    {
        return self::VERSION;
    }

    /**
     * 设置项目根目录
     *
     * @param string $rootDir
     * @author GP
     * DateTime: 2021/1/22 16:58
     */
    protected function setRootDir(string $rootDir)
    {
        $rootDirArr = explode(DIRECTORY_SEPARATOR, $rootDir);
        array_pop($rootDirArr);

        $this->rootDir = implode(DIRECTORY_SEPARATOR, $rootDirArr);
    }

    #===================== 静态方法 =====================

    /**
     * 创建应用
     *
     * @param string $rootDir
     * @return App
     * @author GP
     * DateTime: 2021/1/21 10:07
     */
    public static function create(string $rootDir = '') : self
    {
        if (is_null(self::$app)) {
            self::$app = new self($rootDir);
        }

        return self::$app;
    }


}
