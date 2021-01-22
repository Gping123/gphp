<?php

namespace Gphp\App;


use Gphp\Traits\AttributeTrait;

class App
{
    use AttributeTrait;

    /**
     * @var null
     */
    public static $app = null;

    /**
     * 版本信息
     */
    const VERSION = 'v1.0.0';

    /**
     * @var string 根目录
     */
    protected $rootDir = '';

    /**
     * App constructor.
     * @param string $rootDir
     */
    protected function __construct(string $rootDir = '')
    {
        $this->rootDir = $rootDir;
    }

    /**
     * @throws \Exception
     * @author GP
     * DateTime: 2021/1/21 10:05
     */
    private function __clone()
    {
        throw new \Exception('无法cloneApp对象');
    }

    /**
     * 应用运行
     *
     * @author GP
     * DateTime: 2021/1/21 10:29
     */
    public function run()
    {

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
